<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rolemodel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data['ajax_order_by'] = json_encode(array());
        $this->data['page'] = '';
        $this->data['title'] = '';
        $this->data['msg'] = '';
    }

    public function index() {
        $this->data['page'] = 'Role & Permission';
        $this->data['title'] = 'Role Group';
        $this->data['view'] = 'admin/rolemodel/role';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_role_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'groupName', ''); //set column field database for datatable orderable
        $column_search = array('groupName'); //set column field database for datatable searchable
        $order_by = array('group_id' => 'desc'); // default order

        $select_arr = array('group_id', 'groupName');
        $select = json_encode($select_arr);
        $join_json = json_encode(array());

        $where_json = json_encode(array());

        $data['list'] = $this->common->get_datatables($this->common->getRoleGroupTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/rolemodel/ajax_role_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getRoleGroupTable(), $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getRoleGroupTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function ajax_rolegroup() {
        is_ajax();
        $this->data['page'] = 'Role Group';
        $this->data['title'] = 'Role Group';
        $this->data['action'] = 'Add';
        $id = $this->input->post('group_id') + 0;
        if ($id) 
            $this->data['action'] = 'Edit';
        
        $this->data['group_data'] = $this->common->getRoleGroup($id);
        echo json_encode(array('view' => $this->load->view('admin/rolemodel/ajax_rolegroup', $this->data, true)));
    }

    public function add() {

        $this->data['page'] = 'Role Group';
        $this->data['title'] = 'Role Group';
        $this->data['action'] = 'Add';
        $id = $this->input->post('group_id') + 0;
        if ($id) {
            $this->data['action'] = 'Edit';
            $this->data['group_data'] = $this->common->getRoleGroup($id);
        }

        $this->form_validation->set_rules('groupName', 'Group Name', 'required');

        $success = $res = 0;
        $msg = "";
        $err_arr = array();
        if ($this->form_validation->run() == TRUE) {
            $group_name = trim($this->input->post('groupName'));
            $group = array('groupName' => $group_name);

            if ($id) {
                //Edit Role Group
                if ($this->common->updateRoleGroup($id, $group)) {
                    $success = 1;
                }
            } else {
                if ($this->common->getRoleGroupByName($group_name)) {
                    $msg = "Role group is already exists.";
                } else {
                    //Add Role Group
                    if ($res = $this->common->addRoleGroup($group)) {
                        $success = 1;
                    }
                }
            }
        }
        $err_arr = array('groupName' => form_error('groupName') ? form_error('groupName') : $msg);
        echo json_encode(array('success' => $success, 'key' => $res, 'error' => $err_arr));
    }

    public function addPermission($group_id = "") {
        $dataArray = array();
        for ($i = 0; $i < count($_POST['selectmodule']); $i++) {
            //echo '<pre>'; print_r($); die;
            $temp = @$_POST['selectpermission_' . $_POST['selectmodule'][$i]];
            $dataPermission = array();
            for ($j = 0; $j < count($temp); $j++) {
                array_push($dataPermission, $temp[$j]);
            }
            $dataArray[$_POST['selectmodule'][$i]] = array(1, $dataPermission);
        }
        $tempArray = array('group_id' => $_POST['group_id'], 'permission_set' => json_encode($dataArray));

        $this->db->where('group_id', $_POST['group_id']);
        if ($this->db->count_all_results('role_permission_master') == 0) {
            $this->common->addRolePermission($tempArray);
            $this->session->set_flashdata('success', "Role Permission Set Data Added Successfully.");
        } else {
            $this->common->updateRolePermission($group_id, $tempArray);
            $this->session->set_flashdata('success', "Role Permission Set Data Update Successfully.");
        }

        redirect('admin/rolemodel');
    }

    public function delete() {        
        $success = 0;
        $group_id = $this->input->post('id');
        if ($this->common->deleteRoleGroup($group_id))
            $success = 1;

        echo json_encode(array('success' => $success));
    }

    public function permission() {
        is_ajax();
        $this->data['title'] = 'Role Permission';
        $this->data['role_data'] = $this->common->getAllRoleGroup();
        $this->load->view('admin/rolemodel/permission', $this->data);
    }

    public function getPermission($group_id) {
        //$result = $this->common->getRolePermission($group_id);

        $data['role_data'] = $this->common->getPermission($group_id);
        //echo '<pre>'; print_r($result['role_data']); die;
        //$array['role_data'] = array("module_permission" => $result);
        //echo '<pre>'; print_r($array); die;
        $this->load->view('admin/rolemodel/getPermission', $data);
    }

}
