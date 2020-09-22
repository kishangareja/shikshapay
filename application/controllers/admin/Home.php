<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->db->checkadminlogin();
        $this->data['page'] = '';
        $this->data['title'] = '';
    }

    public function index() {
        $this->data['view'] = 'admin/dashboard';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function challan() {
//        $this->load->view('admin/invoice/challan', $this->data);
        require_once APPPATH . 'third_party/mpdf/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 5,
            'margin_right' => 5,
            'orientation' => 'L',
        ]);

        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Shikshapay Challan");
        $mpdf->SetAuthor("Shikshapay");
        $mpdf->SetDisplayMode('fullpage');
        $view = $this->load->view('admin/invoice/challan', $this->data, true);
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function profile() {
        $this->data['page'] = 'Profile';
        $this->data['view'] = 'admin/profile';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function faq() {
        $this->data['faq_info'] = $this->common->getFaqInfo();
        $this->data['view'] = 'admin/faq';
        $this->data['page_title'] = 'FAQ';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function update_faq() {
        $this->data['faq_info'] = $this->common->getFaqInfo();
        if ($this->input->post('description')) {

            $faq = array('description' => $this->input->post('description') ? $this->input->post('description') : '');
            if ($result = $this->common->updateFaq($faq)) {
                $this->session->set_flashdata('success', "Information Update Successfully.");
                redirect(base_url('admin/home/faq'));
            } else {
                $this->session->set_flashdata('error', "Error While Update Information.");
                redirect(base_url('admin/home/faq'));
            }
        }
        $this->data['page_title'] = 'FAQ';
        $this->data['view'] = 'admin/faq';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function terms_condition() {
        $this->data['tc_data'] = $this->common->getTermsConditionInfo();
        if ($this->input->post('description')) {
            $tc = array('description' => $this->input->post('description') ? $this->input->post('description') : '');
            if ($result = $this->common->updateTc($tc)) {
                $this->session->set_flashdata('success', "Information Update Successfully.");
                redirect(base_url('admin/home/terms_condition'));
            } else {
                $this->session->set_flashdata('error', "Error While Update Information.");
                redirect(base_url('admin/home/terms_condition'));
            }
        }
        $this->data['page_title'] = 'Terms & Conditions';
        $this->data['view'] = 'admin/terms_condition';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function privacy_policy() {
        $this->data['pp_data'] = $this->common->getPrivacyPolicy();
        if ($this->input->post('description')) {
            $pp = array('description' => $this->input->post('description') ? $this->input->post('description') : '');
            if ($result = $this->common->updatePrivacyPolicy($pp)) {
                $this->session->set_flashdata('success', "Information Update Successfully.");
                redirect(base_url('admin/home/privacy_policy'));
            } else {
                $this->session->set_flashdata('error', "Error While Update Information.");
                redirect(base_url('admin/home/privacy_policy'));
            }
        }
        $this->data['page_title'] = 'Privacy Policy';
        $this->data['view'] = 'admin/privacy_policy';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function get_notification() {
        $this->data['privacy_notifications'] = $this->common->getNotification('privacy');
        $this->data['event_notifications'] = $this->common->getNotification('event');
        $this->data['notice_notifications'] = $this->common->getNotification('notice');
        $this->data['transaction_notifications'] = $this->common->getNotification('transaction');
        $view = $this->load->view('admin/notifications', $this->data, true);
        echo json_encode(array('success' => 1, 'view' => $view));
    }

    public function notification_detail($id) {
        $this->data['notification_data'] = $this->common->getNotificationById($id);
        $this->data['page'] = 'Notification Detail';
        $this->data['view'] = 'admin/notification_detail';
        $this->load->view('admin/admin_master', $this->data);
    }

}
