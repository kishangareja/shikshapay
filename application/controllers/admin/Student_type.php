<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student_type extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->db->checkadminlogin();
        $this->load->model(array('admin_model'));
        $this->data['page'] = 'Student Type';
        $this->data['title'] = '';
        $this->data['msg'] = '';
        $this->data['ajax_order_by'] = json_encode(array());
    }

    public function index() {
        $this->data['view'] = 'admin/student_type/list';
        $this->load->view('admin/admin_master', $this->data);
    }

    
    public function ajax_student_type_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'name', 'status', ''); //set column field database for datatable orderable
        $column_search = array('name'); //set column field database for datatable searchable
        $order_by = array('id' => 'desc'); // default order

        $select_arr = array('id', 'name', 'status');
        $select = json_encode($select_arr);
        $join_json = json_encode(array());

        $where_json = json_encode(array());

        $data['list'] = $this->common->get_datatables($this->common->getStudentTypeTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/student_type/ajax_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getStudentTypeTable(), $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getStudentTypeTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function ajax_add_student_type() {
        is_ajax();
        $id = $this->input->post('student_type_id') + 0;
        $this->data['student_type'] = $this->admin_model->getStudentTypeById($id);
        echo json_encode(array('view' => $this->load->view('admin/student_type/ajax_add', $this->data, true)));
    }

    public function add_student_type() {

        $id = $this->input->post('student_type_id') + 0;
        $this->form_validation->set_rules('name', 'Student Type', 'required');

        $success = $res = 0;
        if ($this->form_validation->run() == TRUE) {
            $head_name = trim($this->input->post('name'));
            $head = array(
                'name' => $head_name,
                'status' => $this->input->post('status'),
            );

            if ($id) {
                //Edit head
                if ($this->admin_model->updateStudentType($id, $head)) {
                    $success = 1;
                    $this->data['msg'] = "Student type updated.";
                }
            } else {
                if ($this->admin_model->getStudentTypeByName($head_name)) {
                    $this->data['msg'] = "Student type is already exists.";
                } else {
                    //Add head
                    if ($res = $this->admin_model->addStudentType($head)) {
                        $success = 1;
                        $this->data['msg'] = "Student type added.";
                    }
                }
            }
        }
        $err_arr = array('name' => form_error('name'));
        echo json_encode(array('success' => $success, 'key' => $res, 'error' => $err_arr, 'msg' => $this->data['msg']));
    }

    public function delete_student_type() {
        $id = $this->input->post('id');
        $success = 0;
        if ($this->admin_model->deleteStudentType($id))
            $success = 1;

        echo json_encode(array('success' => $success));
    }

}
