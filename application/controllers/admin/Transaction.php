<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->db->checkadminlogin();
        $this->load->model('admin_model');
        $this->data['page'] = 'Transaction';
        $this->data['title'] = '';
        $this->data['ajax_order_by'] = json_encode(array());
    }

    public function query() {
        $this->data['page'] = 'Transaction Query';
        $this->data['view'] = 'admin/transaction/query';

        $query_data = array('transaction_date' => '', 'txn_reference' => '', 'order_id' => '', 'payment_type' => '', 'status' => '');
        if (isset($_POST['submit']) && $_POST['submit'] == 'Search') {
            $query_data['transaction_date'] = $_POST['transaction_date'];
            $query_data['txn_reference'] = $_POST['txn_reference'];
            $query_data['order_id'] = $_POST['order_id'];
            $query_data['payment_type'] = $_POST['payment_type'];
            $query_data['status'] = $_POST['status'];
            $is_post = 1;
        }

        $this->data['querydata'] = json_encode($query_data);
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_query_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status'); //set column field database for datatable orderable
        $column_search = array('transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status'); //set column field database for datatable searchable
        $order_by = array('t.id' => 'desc'); // default order

        $select_arr = array('t.id', 'transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status');
        $select = json_encode($select_arr);

        $join_arr = array(
            array("table" => $this->common->getClassTable() . ' AS c', "fields" => array('c.id = t.class_id')),
            array("table" => $this->common->getSectionTable() . ' AS s', "fields" => array('s.id = t.section_id')),
                //array("table" => $this->common->getFeeInstallmentTable() . ' AS i', "fields" => array('i.id = t.installment_id')),
        );
        $join_json = json_encode($join_arr);

        $where_arr = array('t.is_deleted' => 0);
        if ($transaction_date = $this->input->post('transaction_date')) {
            $transaction_dt = explode(' - ', $transaction_date);
            $start_date = date('Y-m-d', strtotime($transaction_dt[0]));
            $end_date = date('Y-m-d', strtotime($transaction_dt[1]));
            if ($start_date && $end_date) {
                $where_arr['transaction_date >= '] = "$start_date";
                $where_arr['transaction_date <= '] = "$end_date";
            }
        }
        if ($txn_reference = $this->input->post('txn_reference')) {
            $where_arr['pgorderid'] = $txn_reference;
        }
        if ($order_id = $this->input->post('order_id')) {
            $where_arr['txn_orderid'] = $order_id;
        }
        if ($payment_type = $this->input->post('payment_type')) {
            $where_arr['payment_type'] = $payment_type;
        }
        $status = $this->input->post('status');
        if ($status != '')
            $where_arr['t.status'] = $status;

        $where_json = json_encode($where_arr);

        $data['list'] = $this->common->get_datatables($this->common->getTransactionTable() . ' AS t', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/transaction/ajax_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getTransactionTable() . ' AS t', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getTransactionTable() . ' AS t', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function ajax_export_query() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status'); //set column field database for datatable orderable
        $column_search = array('transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status'); //set column field database for datatable searchable
        $order_by = array('t.id' => 'desc'); // default order

        $select_arr = array('t.id', 'transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status');
        $select = json_encode($select_arr);

        $join_arr = array(
            array("table" => $this->common->getClassTable() . ' AS c', "fields" => array('c.id = t.class_id')),
            array("table" => $this->common->getSectionTable() . ' AS s', "fields" => array('s.id = t.section_id')),
                //array("table" => $this->common->getFeeInstallmentTable() . ' AS i', "fields" => array('i.id = t.installment_id')),
        );
        $join_json = json_encode($join_arr);

        $where_arr = array('t.is_deleted' => 0);
        $where_json = json_encode($where_arr);

        $data['list'] = $this->common->get_datatables($this->common->getTransactionTable() . ' AS t', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/transaction/ajax_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getTransactionTable() . ' AS t', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getTransactionTable() . ' AS t', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
            "column_filter" => "0, 1, 2, 3, 4, 5, 6, 7, 8, 9"
        );
        echo json_encode($output);
    }

    public function history() {
        $this->data['page'] = 'Transaction History';
        $this->data['view'] = 'admin/transaction/history_list';
        $this->data['column_filter'] = "[0, 1, 2, 3, 4, 5, 6, 7, 8, 9]";
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_history_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status', ''); //set column field database for datatable orderable
        $column_search = array('transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status'); //set column field database for datatable searchable
        $order_by = array('t.id' => 'desc'); // default order

        $select_arr = array('t.id', 'transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status');
        $select = json_encode($select_arr);

        $join_arr = array(
            array("table" => $this->common->getClassTable() . ' AS c', "fields" => array('c.id = t.class_id')),
            array("table" => $this->common->getSectionTable() . ' AS s', "fields" => array('s.id = t.section_id')),
                //array("table" => $this->common->getFeeInstallmentTable() . ' AS i', "fields" => array('i.id = t.installment_id')),
        );
        $join_json = json_encode($join_arr);

        $where_arr = array('t.is_deleted' => 0);
        $where_json = json_encode($where_arr);

        $data['list'] = $this->common->get_datatables($this->common->getTransactionTable() . ' AS t', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/transaction/ajax_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getTransactionTable() . ' AS t', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getTransactionTable() . ' AS t', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function success() {
        $this->data['page'] = 'Transaction Success';
        $this->data['view'] = 'admin/transaction/success_list';
        $this->data['column_filter'] = "[0, 1, 2, 3, 4, 5, 6, 7, 8, 9]";
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_success_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status'); //set column field database for datatable orderable
        $column_search = array('transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status'); //set column field database for datatable searchable
        $order_by = array('t.id' => 'desc'); // default order

        $select_arr = array('t.id', 'transaction_date', 'payment_type', 'pgorderid', 'txn_orderid', 'admission_no', 'class_name', 'section_name', 't.payment_status', 't.status');
        $select = json_encode($select_arr);

        $join_arr = array(
            array("table" => $this->common->getClassTable() . ' AS c', "fields" => array('c.id = t.class_id')),
            array("table" => $this->common->getSectionTable() . ' AS s', "fields" => array('s.id = t.section_id')),
                //array("table" => $this->common->getFeeInstallmentTable() . ' AS i', "fields" => array('i.id = t.installment_id')),
        );
        $join_json = json_encode($join_arr);

        $where_arr = array('t.is_deleted' => 0, 't.status' => 1);
        $where_json = json_encode($where_arr);

        $data['list'] = $this->common->get_datatables($this->common->getTransactionTable() . ' AS t', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/transaction/ajax_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getTransactionTable() . ' AS t', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getTransactionTable() . ' AS t', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

}
