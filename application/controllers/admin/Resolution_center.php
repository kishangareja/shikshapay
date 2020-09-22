<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resolution_center extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->db->checkadminlogin();
        $this->load->model('transaction_model');
        $this->data['page'] = 'Resolution Center';
        $this->data['title'] = '';
        $this->data['ajax_order_by'] = json_encode(array());
    }

    public function index() {
        $this->data['page'] = 'Resolution Center';
        $this->data['view'] = 'admin/resolution_center/list';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_resolution_center() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'creation_datetime', 'id', 'created_by', 'txn_orderid', 'payment_type', 'status'); //set column field database for datatable orderable
        $column_search = array('creation_datetime', 'id', 'created_by', 'payment_type', 'status'); //set column field database for datatable searchable
        $order_by = array('id' => 'desc'); // default order

        $select_arr = array('id', 'creation_datetime', 'txn_orderid', 'created_by', 'payment_type', 'status');
        $select = json_encode($select_arr);

        $join_json = json_encode(array());
        $where_json = json_encode(array());

        $data['list'] = $this->common->get_datatables($this->common->getResolutionCenterTable() . ' AS r', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/resolution_center/ajax_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getResolutionCenterTable() . ' AS r', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getResolutionCenterTable() . ' AS r', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data)
        );
        echo json_encode($output);
    }

    public function add() {
        $this->data['page'] = 'Resolution Center Request';
        $this->data['view'] = 'admin/resolution_center/add';
        if ($this->input->post('submit')) {
            $dispute = array(
                'txn_orderid' => $this->input->post('txn_orderid') . rand(00, 99),
                'created_by' => 'Dinesh',
                'payment_type' => 'Online',
                'amount' => $this->input->post('amount'),
                'problem_detail' => $this->input->post('problem_detail'),
                'reason' => $this->input->post('reason')
            );
            $this->transaction_model->addResolutionCenter($dispute);
            redirect('admin/resolution_center');
        }
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_get_resolution_center() {
        is_ajax();
        $id = $this->input->post('id') + 0;
        $this->data['resolution_center'] = $this->transaction_model->getResolutionCenterById($id);
        echo json_encode(array('view' => $this->load->view('admin/resolution_center/add_comment', $this->data, true)));
    }

    public function ajax_update_resolution_center() {
        is_ajax();
        $id = $this->input->post('id') + 0;
        $success = 0;
        $data = array('status' => $this->input->post('status'), 'comment' => $this->input->post('comment'));
        if ($this->transaction_model->updateResolutionCenter($id, $data))
            $success = 1;
        echo json_encode(array('success' => $success));
    }

}
