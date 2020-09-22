<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('google');
		$this->load->model('login_model');
		$this->load->model('gateway_model');
	}

	public function index() {
		// is_ajax();

		if ($this->session->userdata('admin_id') && $this->session->userdata('otp')) {
			redirect('admin/home');
		}

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pwd', 'Password', 'required');

		$this->form_validation->set_error_delimiters('', '');
		$data['msg'] = '';
		if ($this->form_validation->run() == TRUE) {
			$email = $_POST['email'];
			$password = md5($_POST['pwd']);

			$data['msg'] = 'Emailid or Password did not matched.';
			$success = 0;
			$otp = '';
			if ($this->input->post('uri_login') == 'admin') {
				if ($r_data = $this->login_model->getAdminLogin($email, $password)) {
					$this->session->set_userdata('admin_id', $r_data->admin_id);
					$this->session->set_userdata('admin_password', $password);
					$this->session->set_userdata('admin_email', $email);
					$this->session->set_userdata('admin_data', $r_data);
					$data['admin_data'] = $r_data;
					$success = 1;
					$row['otp'] = $otp = rand(1111, 9999);

					$this->login_model->updateOtp($r_data->admin_id, $row);

					if ($result = $this->gateway_model->getEmailMsgGatewayByStatus()) {
						$key = $result->key;
						$gateway = $result->gateway;
					}

					$subject = "Verify OTP";
					$message = 'for login please enter otp';
					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
					$headers .= 'From: <' . FROM_EMAIL . '>' . "\r\n";
					// $headers .= 'Cc: myboss@example.com' . "\r\n";

					mail($email, $subject, $message, $headers);
					// $this->common->sendMailmsg91($key, $subject, $email, $message);

					// $result['role_data'] = $this->common->getRolePermission($data->role_group);
					// $array = array("admin_id" => $data->admin_id, "module_permission" => $result['role_data'], "email" => $data->email_id);
					// $this->session->set_userdata($array);
					// redirect('admin/home');
				}
				echo json_encode(array('success' => $success, 'result' => $data, 'otp' => $otp));
				die;
			}

			if ($this->input->post('uri_login') == 'institution_portal') {
				if ($r_data = $this->login_model->getInstitutionLogin($email, $password)) {
					$this->session->set_userdata('institution_id', $r_data->id);
					$this->session->set_userdata('institution_data', $r_data);
					// $result['role_data'] = $this->common->getRolePermission($data->role_group);
					// $array = array("admin_id" => $data->admin_id, "module_permission" => $result['role_data'], "email" => $data->email_id);
					// $this->session->set_userdata($array);
					redirect('admin/home');
				}
			}
		} else {
			//start google+ login code
			if (isset($_GET['code'])) {
				//authenticate user
				$this->google->getAuthenticate();

				//get user info from google
				$gpInfo = $this->google->getUserInfo();

				//preparing data for database insertion
				$userData['oauth_provider'] = 'google';
				$userData['oauth_uid'] = $gpInfo['id'];
				$userData['firstname'] = $gpInfo['given_name'];
				$userData['lastname'] = $gpInfo['family_name'];
				$userData['email_id'] = $gpInfo['email'];
				$userData['gender'] = !empty($gpInfo['gender']) ? $gpInfo['gender'] : '';
				$userData['locale'] = !empty($gpInfo['locale']) ? $gpInfo['locale'] : '';
				$userData['image_url'] = !empty($gpInfo['link']) ? $gpInfo['link'] : '';
				$userData['user_image'] = !empty($gpInfo['picture']) ? $gpInfo['picture'] : '';
				$userData['role_group'] = 1;
				$userData['status'] = 1;

				//insert or update user data to the database
				$userID = $this->login_model->getAdminByEmail($userData['email_id']);
				if (!$userID) {
					$this->login_model->addAdmin($userData);
					$userID = $this->login_model->getAdminByEmail($userData['email_id']);
				}
				$userData = (object) $userData;
				//store status & user info in session
				$this->session->set_userdata('loggedIn', true);
				$this->session->set_userdata('user_id', $userID->admin_id);
				$this->session->set_userdata('user_email', $userID->email_id);
				$this->session->set_userdata('user_data', $userID);

				//redirect to profile page
				redirect('admin/home');
				//end google+ login code
			}
		}

		//google login url
		$data['loginURL'] = $this->google->loginURL();
		$this->load->view('admin/login', $data);
	}

	public function verify_otp() {
		$success = 0;
		$otp = $this->input->post('otp');
		$email = $this->session->userdata('admin_email');
		$password = $this->session->userdata('admin_password');
		$data['msg'] = 'OTP is wrong';
		$this->login_model->verifyOtp($email, $password, $otp);
		if ($this->login_model->verifyOtp($email, $password, $otp)) {
			$success = 1;
			$this->session->set_userdata('otp', $otp);
			$data['msg'] = 'Login successfully..!';
		}
		echo json_encode(array('success' => $success, 'result' => $data));
	}

	public function logout() {
		//google logout
		if ($this->session->userdata('user_data')->oauth_provider == 'google') {
			// Reset OAuth access token
			$this->google->revokeToken();

			// Remove token and user data from the session
			$this->session->unset_userdata('loggedIn');
			$this->session->unset_userdata('user_data');

			// Destroy entire session data
			$this->session->sess_destroy();
		} else {
			$this->session->sess_destroy();
		}

		redirect('admin/login');
	}

	public function institution_logout() {
		$this->session->sess_destroy();
		redirect('login');
	}

	public function change_password() {
		if (isset($_POST) && !empty($_POST)) {
			$data = array(
				'password' => md5($this->input->post('newpassword')),
			);
			$id = $this->session->userdata('admin_id');
			$this->login_model->updateAdminData($id, $data);
			redirect('admin/login');
		} else {
			$data['view'] = 'admin/login/changepassword';
			$this->load->view('admin/admin_master', $data);
		}
	}

	public function forgotpassword() {
		if (isset($_POST) && !empty($_POST)) {
			$mailid = $_POST['email'];
			$new_password = $this->common->generatePassword();
			$message = 'New Password : ' . $new_password;

			$data = array('password' => md5($new_password));
			$this->login_model->updateAdminData(1, $data);

			$this->common->sendMail($mailid, PROJECT_NAME . ' | New Password', $message);
			redirect('admin/login');
		} else {
			$this->load->view('admin/forgotpassword');
		}
	}

}
