<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->db->checkadminlogin();
        $this->load->model('section_model');
        $this->data['page'] = 'Section';
        $this->data['title'] = '';
        $this->data['ajax_order_by'] = json_encode(array());
    }

    public function index() {
        $this->data['view'] = 'admin/section/list';
        $this->data['ajax_order_by'] = json_encode(array());
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 's.section_name', 's.status', ''); //set column field database for datatable orderable
        $column_search = array('s.section_name'); //set column field database for datatable searchable
        $order_by = array('s.id' => 'desc'); // default order

        $select_arr = array('s.section_name', 's.status', 's.id');
        $select = json_encode($select_arr);

        $join_json = json_encode(array());

        $where_arr = array('s.is_deleted' => 0);
        if (isset($_POST['custom_val']) && $_POST['custom_val'])
            $where_arr['section_type'] = $_POST['custom_val'];
        $where_json = json_encode($where_arr);

        $this->data['section_type'] = $_POST['custom_val'];
        $this->data['list'] = $this->common->get_datatables($this->common->getSectionTable() . ' AS s', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/section/ajax_list', $this->data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getSectionTable() . ' AS s', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getSectionTable() . ' AS s', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );
        echo json_encode($output);
    }

    public function section_modal() {
        is_ajax();
        $id = $this->input->post('value') + 0;
        $this->data['type'] = $type = $this->input->post('type');
        $this->data['page_title'] = 'Add ' . ucfirst($type);
        if ($id) {
            $this->data['page_title'] = 'Edit ' . ucfirst($type);
            $this->data['section_data'] = $this->section_model->getSectionById($id);
        }
        echo json_encode(array('view' => $this->load->view('admin/section/section_modal', $this->data, true), 'success' => 1));
    }

    public function add($id = 0) {

        is_ajax();
        $this->form_validation->set_rules('section_name', 'Section Name', 'required');
        $type = $this->input->post('section_type');
        if ($this->form_validation->run() == True) {
            $section = array(
                'section_type' => $type,
                'section_name' => trim($this->input->post('section_name')),
                'status' => $this->input->post('status'),
            );

            if (!empty($this->input->post('section_id'))) {
                //Edit institution
                $id = $this->input->post('section_id');
                $result = $this->section_model->updateSection($id, $section);
                if ($result) {
                    echo json_encode(array('message' => 'Section Updated Successfully.', 'success' => 1, 'type' => $type));
                } else {
                    echo json_encode(array('message' => 'Error While Updateing Record.', 'success' => 0));
                }
            } else {
                //Add institution
                $result = $this->section_model->addSection($section);
                if ($result) {
                    echo json_encode(array('message' => 'Section Added Successfully.', 'success' => 1, 'type' => $type));
                } else {
                    echo json_encode(array('message' => 'Error While Inserting Record.', 'success' => 0));
                }
            }
        } else {
            $err_arr = array('section_name' => form_error('section_name'));
            echo json_encode(array('success' => 0, 'error' => $err_arr));
        }
    }

    public function section_delete() {
        is_ajax();
        $success = 0;
        $id = $this->input->post('value') + 0;
        $type = $this->input->post('type');
        if ($this->section_model->deleteSection($id)) {
            $success = 1;
        }
        echo json_encode(array('success' => $success, 'type' => $type));
    }

}
