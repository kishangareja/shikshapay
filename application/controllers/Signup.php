<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('institution_model', 'admin_model'));
		$this->data['page'] = 'Signup';
		$this->data['title'] = 'Signup';
	}

	function index() {
		$this->data['view'] = 'signup3';
		$this->data['board_data'] = $this->admin_model->getBoard();
		$this->data['email'] = $this->input->post('email');
		$this->load->view('template', $this->data);
	}

	public function step() {
		is_ajax();
		$step = $this->input->post('step');

		if ($step == 0) {
			$this->form_validation->set_rules('board_id', 'Board Name', 'required');
			$this->form_validation->set_rules('institution_name', 'Institution Name', 'required');
			$this->form_validation->set_rules('affiliation_no', 'Affiliation Number', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
		} else if ($step == 1) {
			$this->form_validation->set_rules('total_students', 'Total Students', 'required');
			$this->form_validation->set_rules('fee_type', 'Fee Type', 'required');
			$this->form_validation->set_rules('pincode', 'Pincode', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			$err_arr = '';
			if ($step == 0) {
				$err_arr = array(
					'board_id' => form_error('board_id'),
					'institution_name' => form_error('institution_name'),
					'affiliation_no' => form_error('affiliation_no'),
					'email' => form_error('email'),
					'phone' => form_error('phone'),
				);
			} else if ($step == 1) {
				$err_arr = array(
					'total_students' => form_error('total_students'),
					'fee_type' => form_error('fee_type'),
					'pincode' => form_error('pincode'),
				);
			}
			echo json_encode(array('success' => 0, 'error' => $err_arr));
		} else {
			echo json_encode(array('success' => 1));
		}
	}

	public function add() {

		$this->data['view'] = 'signup';
		$this->data['board_data'] = $this->admin_model->getBoard();
		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('board_id', 'Board Name', 'required');
		$this->form_validation->set_rules('institution_type', 'Institution Type', 'required');
		$this->form_validation->set_rules('affiliation_no', 'Affiliate Number', 'required');
		$this->form_validation->set_rules('institution_name', 'Institution Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
//        $this->form_validation->set_rules('password', 'Password', 'trim|required');
		//        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('phone', 'Phone', 'required');

		if ($this->form_validation->run() == TRUE) {
			$this->data['boardById'] = $this->admin_model->getBoardById($this->input->post('board_id'));
			$institution = array(
				'board_id' => trim($this->input->post('board_id')),
				'board_name' => $this->data['boardById']->board_name,
				'institution_type' => trim($this->input->post('institution_type')),
				'affiliation_no' => trim($this->input->post('affiliation_no')),
				'institution_name' => trim($this->input->post('institution_name')),
				'email' => trim($this->input->post('email')),
//                'password' => md5(trim($this->input->post('password'))),
				'phone' => trim($this->input->post('phone')),
				'status' => 1,
			);

			//Add institution
			if ($id = $this->institution_model->addInstitution($institution)) {
				//$this->session->set_flashdata('success', "Institution Added Successfully.");
				redirect('login');
			} else {
				//$this->session->set_flashdata('error', "Error While Inserting Record.");
				redirect('signup');
			}
		}
		$this->load->view('template', $this->data);
	}

	public function ajax_login() {
		$success = 1;
		$check_code = 0;
		$data['error_msg'] = "";
		$form = $this->input->post('view');
		$data['type'] = $this->input->post('type');
		if ($form == 'post') {
			$success = 0;
			$this->form_validation->set_rules('mobile', 'Mobile', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($data['type'] == 'register') {
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', array('is_unique' => 'This %s already exists.'));
			}

			if ($this->form_validation->run() == TRUE) {
				$success = 1;
				if ($data['type'] == 'login') {
					$mobile = $this->input->post('mobile');
					if ($check = $this->user_model->checkUserLogin($mobile)) {
						$password = md5($this->input->post('password'));
						$login = $this->user_model->getUserLogin($mobile, $password);
						if ($login) {
							$data['id'] = $login->user_id;
							$data['type'] = 'code';
							$check_code = 'login';
							$data['random_code'] = rand(1111, 9999);
							$this->user_model->updateUser(array('code' => $data['random_code']), $login->user_id);
						} else {
							$data['error_msg'] = "Email/Mobile and password is wrong";
						}
					}
				}

				if ($data['type'] == 'register') {
					$data['random_code'] = rand(1111, 9999);
					$user_data = array(
						'email' => $this->input->post('email'),
						'mobile' => $this->input->post('mobile'),
						'password' => md5($this->input->post('password')),
						'code' => $data['random_code'],
					);
					$data['id'] = $this->user_model->addUserData($user_data);
					$data['type'] = 'code';
					$check_code = 'register';
				}
			}
		}
		$view = $this->load->view('ajax_login', $data, true);
		echo json_encode(array('success' => $success, 'view' => $view, 'type' => $data['type'], 'login' => $check_code));
	}

	public function check_code() {
		$success = 0;
		$data['random_code'] = "";
		$data['error_msg'] = "";
		$data['type'] = 'code';
		$data['id'] = $user_id = $this->input->post('id');
		$code = $this->input->post('code');
		$login = $this->user_model->verifyUserLogin($user_id, $code);
		if ($login) {
			$user_image = base_url('assets/images/default_profile.png');
			if ($login->user_image) {
				$user_image = base_url() . PROFILEPIC . $data->user_image;
			}
			$this->session->set_userdata('user_image', $user_image);
			$this->session->set_userdata('user_id', $login->user_id);
			$this->session->set_userdata('user_email', $login->email);
			$this->session->set_userdata('user_data', $login);
			$success = 1;
		} else {
			$data['error_msg'] = "OTP is wrong,please try again";
		}
		$view = $this->load->view('ajax_login', $data, true);
		echo json_encode(array('success' => $success, 'view' => $view, 'type' => 'code'));
	}

	public function user_profile() {
		$user_id = $this->session->userdata('user_id');
		$this->data['user_data'] = $this->user_model->getUser($user_id);
		$email = $this->session->userdata('email_id');

		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('email_id', 'Email', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|regex_match[/^[0-9]{10}$/]');

		if ($this->form_validation->run() == TRUE) {

			$data = array(
				'username' => $this->input->post('username'),
				'email_id' => $this->input->post('email_id'),
				'mobile' => $this->input->post('mobile'),
				'address' => $this->input->post('address'),
			);
			if (isset($_FILES['user_image']['name']) && $_FILES['user_image']['error'] == 0) {
				$temp_file = $_FILES['user_image']['tmp_name'];
				$img_name = "user_" . mt_rand(10000, 999999999) . time();
				$path = $_FILES['user_image']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$data['user_image'] = $img_name . "." . $ext;
				$url = PROFILEPIC . $data['user_image'];
				$this->db->compress_image($temp_file, $url, 80);
			}

			$user_details = $this->user_model->getUserImage($user_id);

			if (isset($_FILES['user_image']['name']) && $_FILES['user_image']['error'] == 0) {
				if (file_exists(PROFILEPIC . $user_details->user_image)) {
					@unlink(PROFILEPIC . $user_details->user_image);
				}
			}

			$result = $this->user_model->updateUser($data, $user_id);
			if ($result) {
				$this->session->set_flashdata('success', "User Data Updated Successfully.");
				redirect(base_url('home/user_profile'));
			} else {
				$this->session->set_flashdata('error', "Error While Updating Record.");
				redirect(base_url('home/user_profile'));
			}
		}
		$this->data['view'] = 'profile';
		$this->load->view('front_master', $this->data);
	}

	public function change_password() {
		$id = $this->session->userdata('user_id');
		$this->data['user_data'] = $this->user_model->getUser($id);

		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('currentpassword', 'Current Password', 'required');
		$this->form_validation->set_rules('newpassword', 'New Password', 'required');
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			if ($this->data['user_data']->password == md5($this->input->post('currentpassword'))) {
				if ($this->input->post('newpassword') == $this->input->post('confirmpassword')) {

					if (isset($_POST) && !empty($_POST)) {
						$data = array(
							'password' => md5($this->input->post('newpassword')),
						);
						$this->user_model->updateUserPassword($id, $data);
						$this->session->set_flashdata('success', "Password change successfully.");
						redirect('home/change_password');
					} else {
						$this->data['view'] = 'change_password';
						$this->load->view('front_master', $this->data);
					}
				} else {
					$this->session->set_flashdata('error', "New password and confirm password does not match.");
					redirect(base_url('home/change_password'));
				}
			} else {
				$this->session->set_flashdata('error', "Current password is wrong.");
				redirect(base_url('home/change_password'));
			}
		}
		$this->data['view'] = 'change_password';
		$this->load->view('front_master', $this->data);
	}

	/**
	 * Logout
	 */
	public function logout() {
		$this->session->sess_destroy();
		redirect('home');
	}

	/**
	 * Facebook login
	 */
	public function fb_login() {
		require APPPATH . 'third_party' . DSC . 'Facebook' . DSC . 'facebook.php';
		require APPPATH . 'third_party' . DSC . 'Facebook' . DSC . 'fb_config.php';
		$this->fb = $facebook;
		$this->fb_loginurl = $this->fb->getLoginUrl(
			array(
				'scope' => 'user_about_me,user_friends,user_activities,user_birthday,user_checkins,'
				. 'user_education_history,user_events,user_groups,user_hometown,'
				. 'user_interests,user_likes,user_location,user_notes,user_online_presence'
				. ',user_photo_video_tags,user_photos,user_relationships,user_relationship_details,'
				. 'user_religion_politics,user_status,user_videos,user_website,'
				. 'user_work_history,email,read_friendlists,read_insights,read_mailbox,'
				. 'read_requests,read_stream,xmpp_login,ads_management,'
				. 'create_event,manage_friendlists,manage_notifications,'
				. 'offline_access,publish_checkins,publish_stream,rsvp_event,'
				. 'sms,publish_actions,manage_pages',
			));
		$this->fb_logouturl = $this->fb->getLogoutUrl();
		//echo '<pre>';        print_r($this->fb);die;
		if ($this->fb->getUser()) {
			$userdata = $this->fb->api('/me');
			$this->data['fb_data'] = array('first_name' => $userdata['first_name'], 'last_name' => $userdata['last_name']);

			//Session::setValue("fb_user_data", $userdata);
			redirect("account_signup/popup");
		} else {
			//Loader::template('master', array('view' => 'signup/process_popup'), $this->data);
			header('Location: ' . $this->fb_loginurl);
		}
	}

	/**
	 * Gmail login.
	 */
	public function gmail_login() {
		require_once APPPATH . "third_party" . DSC . "Google" . DSC . "gmail_config.php";
		$this->gmail = $client;
		$this->gmail_loginurl = $auth;
		//echo '<pre>';        print_r($this->gmail);die;
		if (isset($_GET["code"])) {
			$fields = array(
				'code' => urlencode($_GET["code"]),
				'client_id' => urlencode($client_id),
				'client_secret' => urlencode($client_secret),
				'redirect_uri' => urlencode($redirect_uri),
				'grant_type' => urlencode('authorization_code'),
			);
			$post = '';
			foreach ($fields as $key => $value) {
				$post .= $key . '=' . $value . '&';
			}
			$post = rtrim($post, '&');

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
			curl_setopt($curl, CURLOPT_POST, 5);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			$result = curl_exec($curl);
			curl_close($curl);

			$response = json_decode($result);
			//var_dump($response);
			$accesstoken = $response->access_token;

			echo $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results=200&oauth_token=' . $accesstoken;

			function curl_file_get_contents($url) {
				$curl = curl_init();
				$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';

				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);

				curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
				curl_setopt($curl, CURLOPT_TIMEOUT, 10);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

				$contents = curl_exec($curl);
				curl_close($curl);
				return $contents;
			}

			$xmlresponse = curl_file_get_contents($url);
			echo '<pre>';
			print_r($xmlresponse);
			die;
			if ((strlen(stristr($xmlresponse, 'Authorization required')) > 0) && (strlen(stristr($xmlresponse, 'Error ')) > 0)) {
				//At times you get Authorization error from Google.
				echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
				exit();
			}
			echo "<h3>Email Addresses:</h3>";

			$xml = new SimpleXMLElement($xmlresponse);
			$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
			$result = $xml->xpath('//gd:email');

			echo '<pre>';
			print_r($result);
			die;

			foreach ($result as $title) {
				$this->data['name'][] = "Select Name";
				$temp[] = (array) $title->attributes()->address;
			}
			foreach ($temp as $value) {
				$this->data['email'][] = $value[0];
			}
			$this->data['redirect'] = TRUE;
			//Session::setValue("gmail_user_data", $this->data);

			redirect("account_signup/email_popup");
		} else {
			//Loader::template('master', array('view' => 'signup/process_popup'), $this->data);
			header('Location: ' . $this->gmail_loginurl);
		}
	}

}
