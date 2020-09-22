<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->db->checkadminlogin();
        $this->load->model(array('login_model', 'admin_model'));
        $this->data['page'] = 'Setting';
        $this->data['title'] = '';
        $this->data['ajax_order_by'] = json_encode(array());
    }

    public function index() {
        $this->data['view'] = 'admin/setting/add';
        $this->data['setting_data'] = $this->admin_model->getSetting();
        $this->load->view('admin/admin_master', $this->data);
    }

    public function add() {
        $this->data['view'] = 'admin/setting/add';
        $this->data['setting_data'] = $this->admin_model->getSetting();

        $this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('invoice_number', 'Invoice Number', 'required');
        $this->form_validation->set_rules('date_of_issue', 'Date Of Issue', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('issuer_gstin', 'Issuer Gstin', 'required');
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
        $this->form_validation->set_rules('gstin', 'Gstin', 'required');
        $this->form_validation->set_rules('blling_address', 'Blling Address', 'required');
        $this->form_validation->set_rules('item_title', 'Item Title', 'required');
        $this->form_validation->set_rules('sac_code', 'SAC Code', 'required');
        $this->form_validation->set_rules('value', 'Value', 'required');
        $this->form_validation->set_rules('sgst', 'SGST', 'required');
        $this->form_validation->set_rules('cgst', 'CGST', 'required');
        $this->form_validation->set_rules('igst_rate', 'Igst Rate', 'required');
        $this->form_validation->set_rules('igst_value', 'Igst Value', 'required');
        $this->form_validation->set_rules('total_value', 'Total Value', 'required');
        $this->form_validation->set_rules('taxable_value', 'Taxable Value', 'required');
        $this->form_validation->set_rules('charge_amount', 'Charge Amount', 'required');
        $this->form_validation->set_rules('payable_amount', 'Payable Amount', 'required');

        if ($this->form_validation->run() == TRUE) {
            $sgst = trim($this->input->post('sgst'));
            $cgst = trim($this->input->post('cgst'));

            $setting = array(
                'address' => $this->input->post('address'),
                'invoice_number' => $this->input->post('invoice_number'),
                'date_of_issue' => $this->input->post('date_of_issue'),
                'state' => $this->input->post('state'),
                'issuer_gstin' => $this->input->post('issuer_gstin'),
                'customer_name' => $this->input->post('customer_name'),
                'gstin' => $this->input->post('gstin'),
                'blling_address' => $this->input->post('blling_address'),
                'item_title' => $this->input->post('item_title'),
                'sac_code' => $this->input->post('sac_code'),
                'value' => $this->input->post('value'),
                'igst_rate' => $this->input->post('igst_rate'),
                'igst_value' => $this->input->post('igst_value'),
                'total_value' => $this->input->post('total_value'),
                'taxable_value' => $this->input->post('taxable_value'),
                'charge_amount' => $this->input->post('charge_amount'),
                'payable_amount' => $this->input->post('payable_amount'),
                'sgst' => $sgst,
                'cgst' => $cgst,
            );

            if (isset($_FILES['logo']['name']) && $_FILES['logo']['error'] == 0) {
                $temp_file = $_FILES['logo']['tmp_name'];

                $img_name = "invoice_" . mt_rand(10000, 999999999) . time();
                $path = $_FILES['logo']['name'];

                $ext = pathinfo($path, PATHINFO_EXTENSION);

                $setting['logo'] = $img_name . "." . $ext;
                $url = INVOICE . $setting['logo'];
                $this->db->compress_image($temp_file, $url, 80);
            }

            $id = $this->input->post('setting_id');
            if ($id) {
                //Edit setting
                if ($this->admin_model->updateSetting($id, $setting)) {
                    $success = 1;
                    $this->session->set_flashdata('success', "Setting Updated Successfully.");
                    redirect(base_url('admin/setting'));
                } else {
                    $this->session->set_flashdata('error', "Error While Updateing Record.");
                }
            }
        }
        $this->load->view('admin/admin_master', $this->data);
    }

    public function challan() {
        $this->data['page'] = 'Challan Setting';
        $this->data['view'] = 'admin/setting/challan';
        $this->data['setting_data'] = $this->admin_model->getChallanSetting();

        $this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
        $this->form_validation->set_rules('challan_title', 'Challan Title', 'required');
//        $this->form_validation->set_rules('bank_logo', 'Bank Logo', 'required');
        $this->form_validation->set_rules('bank_title', 'Bank Title', 'required');
//        $this->form_validation->set_rules('school_logo', 'School Logo', 'required');
        $this->form_validation->set_rules('school_title', 'School Title', 'required');
        $this->form_validation->set_rules('bank_branch', 'Bank Branch', 'required');
        $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');

        if ($this->form_validation->run() == TRUE) {
//            echo '<pre>';            print_r($_POST);die;

            $setting = array(
                'challan_title' => $this->input->post('challan_title'),
                'bank_title' => $this->input->post('bank_title'),
                'school_title' => $this->input->post('school_title'),
                'bank_branch' => $this->input->post('bank_branch'),
                'bank_name' => $this->input->post('bank_name'),
                'notes' => $this->input->post('notes')
            );
            if (isset($_FILES['bank_logo']['name']) && $_FILES['bank_logo']['error'] == 0) {
                $temp_file = $_FILES['bank_logo']['tmp_name'];

                $img_name = "bank_logo_" . mt_rand(10000, 999999999) . time();
                $path = $_FILES['bank_logo']['name'];

                $ext = pathinfo($path, PATHINFO_EXTENSION);

                $setting['bank_logo'] = $img_name . "." . $ext;
                $url = CHALLAN . $setting['bank_logo'];
                move_uploaded_file($temp_file, $url);
            }

            if (isset($_FILES['school_logo']['name']) && $_FILES['school_logo']['error'] == 0) {
                $temp_file = $_FILES['school_logo']['tmp_name'];

                $img_name = "school_logo_" . mt_rand(10000, 999999999) . time();
                $path = $_FILES['school_logo']['name'];

                $ext = pathinfo($path, PATHINFO_EXTENSION);

                $setting['school_logo'] = $img_name . "." . $ext;
                $url = CHALLAN . $setting['school_logo'];
                move_uploaded_file($temp_file, $url);
            }

            $id = $this->input->post('setting_id');
            if ($id) {
                //Edit setting
                if ($this->admin_model->updateChallanSetting($id, $setting)) {
                    $success = 1;
                    $this->session->set_flashdata('success', "Challan Setting Updated Successfully.");
                    redirect(base_url('admin/setting/challan'));
                } else {
                    $this->session->set_flashdata('error', "Error While Updateing Record.");
                }
            }
        }
        $this->load->view('admin/admin_master', $this->data);
    }

    public function credit() {
        $this->data['view'] = 'admin/setting/credit';
        $this->data['setting_data'] = $this->login_model->getAdminData();
        if (isset($_POST['submit']) && $_POST['submit']) {
            $this->login_model->updateAdminData(1, array('credit' => $_POST['credit']));
            $this->session->set_flashdata('success', "Credit Price Updated Successfully.");
            redirect('admin/setting/credit');
        }
        $this->load->view('admin/admin_master', $this->data);
    }

}
