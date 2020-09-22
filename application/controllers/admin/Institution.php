<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Institution extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->db->checkadminlogin();
        $this->load->model(array('institution_model', 'admin_model', 'class_model'));
        $this->data['page'] = 'Institution';
        $this->data['title'] = '';
        $this->data['ajax_order_by'] = json_encode(array());
    }

    public function index() {
        $this->data['view'] = 'admin/institution/list';
        $this->data['ajax_order_by'] = json_encode(array());
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 6));

        $column_order = array(null, 'board_name', 'institution_name', 'pincode', 'email', 'status', ''); //set column field database for datatable orderable
        $column_search = array('board_name', 'institution_name', 'pincode', 'email', 'status'); //set column field database for datatable searchable
        $order_by = array('id' => 'desc'); // default order

        $select_arr = array('*');
        $select = json_encode($select_arr);
        $join_json = json_encode(array());

        $where_json = json_encode(array());

        $this->data['list'] = $this->common->get_datatables($this->common->getInstitutionTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/institution/ajax_list', $this->data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getInstitutionTable(), $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getInstitutionTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function add($id = 0) {

        $id = $id + 0;
        $this->data['page_title'] = 'Add Institution';
        $this->data['view'] = 'admin/institution/add';
        $this->data['board_data'] = $this->admin_model->getBoard();
        //$this->data['class_data'] = $this->class_model->getClass();
        $this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
        $this->form_validation->set_rules('board_id', 'Board Name', 'required');
        $this->form_validation->set_rules('institution_type', 'Institution Type', 'required');
        $this->form_validation->set_rules('affiliation_no', 'Affiliate Number', 'required');
        $this->form_validation->set_rules('institution_name', 'Institution Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
//        $this->form_validation->set_rules('head_name', 'Head Name', 'required');
//        $this->form_validation->set_rules('school_status', 'School Status', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
//        $this->form_validation->set_rules('class_id[]', 'Class', 'required');
        
        //$class_detail = array();
        if ($id) {
            $this->data['page_title'] = 'Edit Institution';
            $this->data['institution_data'] = $institution_data = $this->institution_model->getInstitutionById($id);
            $this->data['boardById'] = $this->admin_model->getBoardById($institution_data->board_id);
            /*$class_detail_arr = $this->class_model->getClassDetail($id);
            foreach ($class_detail_arr as $value) {
                $class_detail[] = $value->class_id;
            }*/
        }
        //$this->data['class_detail'] = $class_detail;

        if ($this->form_validation->run() == TRUE) {
            $this->data['boardById'] = $this->admin_model->getBoardById($this->input->post('board_id'));
            $institution = array(
                'board_id' => trim($this->input->post('board_id')),
                'board_name' => $this->data['boardById']->board_name,
                'institution_type' => trim($this->input->post('institution_type')),
                'affiliation_no' => trim($this->input->post('affiliation_no')),
                'institution_name' => trim($this->input->post('institution_name')),
                'address' => trim($this->input->post('address')),
                'pincode' => trim($this->input->post('pincode')),
                'state' => trim($this->input->post('state')),
                'city' => trim($this->input->post('city')),
                'email' => trim($this->input->post('email')),
                //'head_name' => trim($this->input->post('head_name')),
                //'school_status' => trim($this->input->post('school_status')),
                'phone' => trim($this->input->post('phone')),
                'status' => $this->input->post('status'),
            );

            if (!empty($this->input->post('institution_id'))) {
                //Edit institution
                $id = $this->input->post('institution_id');
                $result = $this->institution_model->updateInstitution($id, $institution);
                if ($result) {
                    /*$this->class_model->deleteClassDetail($id);
                    foreach ($_POST['class_id'] as $val) {
                        $class_detail = array('class_id' => $val, 'institution_id' => $id);
                        $this->class_model->addClassDetail($class_detail);
                    }*/
                    $this->session->set_flashdata('success', "Institution Updated Successfully.");
                    redirect(base_url('admin/institution'));
                } else {
                    $this->session->set_flashdata('error', "Error While Updateing Record.");
                    redirect(base_url('admin/institution/add'));
                }
            } else {
                //Add institution
                if ($id = $this->institution_model->addInstitution($institution)) {
                    /*foreach ($_POST['class_id'] as $val) {
                        $class_detail = array('class_id' => $val, 'institution_id' => $id);
                        $this->class_model->addClassDetail($class_detail);
                    }*/
                    $this->session->set_flashdata('success', "Institution Added Successfully.");
                    redirect(base_url('admin/institution'));
                } else {
                    $this->session->set_flashdata('error', "Error While Inserting Record.");
                    redirect(base_url('admin/institution/add'));
                }
            }
        }
        $this->load->view('admin/admin_master', $this->data);
    }

    public function delete($id = '') {
        $result = $this->institution_model->deleteInstitution($id);
        if ($result) {
            $this->session->set_flashdata('success', 'Institution Deleted Successfully.');
            redirect(base_url('admin/institution'));
        } else {
            $this->session->set_flashdata('error', "Error While Deleting Record.");
            redirect(base_url('admin/institution'));
        }
    }

    public function check_pincode() {
        is_ajax();
        $pincode = $_POST['pincode'];
        if ($pincode) {
            $result = $this->institution_model->getCityState($pincode);
            $this->data['city'] = $result->city_name;
            $this->data['state'] = $result->state_name;
            echo json_encode(array('success' => 1, 'data' => $this->data));
        }
    }

}
