<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->db->checkadminlogin();
        $this->load->model(array('class_model', 'section_model'));
        $this->data['page'] = 'Class';
        $this->data['title'] = '';
        $this->data['ajax_order_by'] = json_encode(array());
    }

    public function index() {
        $this->data['view'] = 'admin/class/list';
        $this->data['ajax_order_by'] = json_encode(array());
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'c.class_name', 'c.status', ''); //set column field database for datatable orderable
        $column_search = array('c.class_name'); //set column field database for datatable searchable
        $order_by = array('c.id' => 'desc'); // default order

        $select_arr = array('c.id', 'c.class_name', 'c.status');
        $select = json_encode($select_arr);
        $join_json = json_encode(array());

        $where_arr = array('c.is_deleted' => 0);
        if (isset($_POST['custom_val']) && $_POST['custom_val'])
            $where_arr['class_type'] = $_POST['custom_val'];
        $where_json = json_encode($where_arr);

        $this->data['class_type'] = $_POST['custom_val'];
        $this->data['list'] = $this->common->get_datatables($this->common->getClassTable() . ' AS c', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/class/ajax_list', $this->data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getClassTable() . ' AS c', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getClassTable() . ' AS c', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );
        echo json_encode($output);
    }

    public function class_modal() {
        is_ajax();
        $this->data['type'] = $type = $this->input->post('type');
        $id = $this->input->post('value') + 0;
        $this->data['page_title'] = 'Add ' . ucfirst($type);

        $class_detail = array();
        if ($id) {
            $this->data['page_title'] = 'Edit ' . ucfirst($type);
            $this->data['class_data'] = $this->class_model->getClassById($id);

            $class_detail_arr = $this->class_model->getClassDetail($id);
            foreach ($class_detail_arr as $value) {
                $class_detail[] = $value->section_id;
            }
        }
        $this->data['class_detail'] = $class_detail;

        $section_type = '';
        $section_data = array();
        if ($type) {
            if ($type == 'class')
                $section_type = 'section';
            if ($type == 'program')
                $section_type = 'semester';
            $section_data = $this->section_model->getSectionTypeData($section_type);
        }
        $this->data['class_type'] = $section_type;
        $this->data['section_data'] = $section_data;
        echo json_encode(array('view' => $this->load->view('admin/class/class_modal', $this->data, true), 'success' => 1));
    }

    public function add($id = 0) {

        is_ajax();
        $this->form_validation->set_rules('class_name', 'Class Name', 'required');
        $type = $this->input->post('class_type');
        if ($this->form_validation->run() == True) {
            $class = array(
                'class_name' => trim($this->input->post('class_name')),
                'class_type' => $type,
                'status' => $this->input->post('status'),
            );

            if (!empty($this->input->post('class_id'))) {
                //Edit Class
                $id = $this->input->post('class_id');
                if ($result = $this->class_model->updateClass($id, $class)) {
                    if (isset($_POST['section_id']) && $_POST['section_id']) {
                        $this->class_model->deleteClassDetail($id);
                        foreach ($_POST['section_id'] as $val) {
                            $class_detail = array('section_id' => $val, 'class_id' => $id);
                            $this->class_model->addClassDetail($class_detail);
                        }
                    }
                    echo json_encode(array('message' => 'Class Updated Successfully.', 'success' => 1, 'type' => $type));
                } else {
                    echo json_encode(array('message' => 'Error While Updateing Record.', 'success' => 0));
                }
            } else {
                //Add Class
                if ($id = $this->class_model->addClass($class)) {
                    if (isset($_POST['section_id']) && $_POST['section_id']) {
                        foreach ($_POST['section_id'] as $val) {
                            $class_detail = array('section_id' => $val, 'class_id' => $id);
                            $this->class_model->addClassDetail($class_detail);
                        }
                    }
                    echo json_encode(array('message' => 'Class Added Successfully.', 'success' => 1, 'type' => $type));
                } else {
                    echo json_encode(array('message' => 'Error While Inserting Record.', 'success' => 0));
                }
            }
        } else {
            $err_arr = array('class_name' => form_error('class_name'));
            echo json_encode(array('success' => 0, 'error' => $err_arr));
        }
    }

    public function delete_class() {
        is_ajax();
        $success = 0;
        $id = $this->input->post('value') + 0;
        $type = $this->input->post('type');
        if ($this->class_model->deleteClass($id)) {
            $success = 1;
        }
        echo json_encode(array('success' => $success, 'type' => $type));
    }

}
