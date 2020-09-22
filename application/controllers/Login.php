<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('admin_model', 'login_model'));
        $this->data['page'] = 'Login';
        $this->data['title'] = 'Login';
    }

    public function index() {
        if ($this->session->userdata('admin_id')) {
            redirect('admin/home');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $type = $_POST['institution_type'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            //if ($this->input->post('uri_login') == 'institution_portal') {
            if ($r_data = $this->login_model->getInstitutionLogin($type, $email, $password)) {
                $this->session->set_userdata('admin_id', $r_data->id);
                $this->session->set_userdata('institution_data', $r_data);
                redirect('admin/home');
            }else{
                $this->session->set_flashdata('error', "Emailid or Password did not matched.");
            }
            //}
        }
        $this->data['view'] = 'login';
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

    public function service() {
        $this->db->setFile();
    }    
}
