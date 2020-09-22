<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Feestructure extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data['ajax_order_by'] = json_encode(array());
        $this->load->model('fee_model');
        //$this->save[''] = array();
        $this->data['page'] = '';
        $this->data['title'] = '';
        $this->data['msg'] = '';
    }

    public function fee_type() {
        $this->data['page'] = 'Fee Type';
        $this->data['title'] = 'Fee Type';
        $this->data['view'] = 'admin/fee/fee_type/type_list';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_fee_type_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'name', 'gateway', 'status', ''); //set column field database for datatable orderable
        $column_search = array('name', 'gateway'); //set column field database for datatable searchable
        $order_by = array('id' => 'desc'); // default order

        $select_arr = array('id', 'name', 'gateway', 'status');
        $select = json_encode($select_arr);
        $join_json = json_encode(array());

        $where_json = json_encode(array());

        $data['list'] = $this->common->get_datatables($this->common->getFeeTypeTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/fee/fee_type/ajax_type_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getFeeTypeTable(), $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getFeeTypeTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function ajax_add_fee_type() {
        is_ajax();
        $this->load->model('gateway_model');
        $id = $this->input->post('fee_type_id') + 0;
        $this->data['gateway_data'] = $this->gateway_model->getPayGateway();
        $this->data['fee_type_data'] = $this->fee_model->getFeeTypeById($id);
        echo json_encode(array('view' => $this->load->view('admin/fee/fee_type/ajax_type_add', $this->data, true)));
    }

    public function add_fee_type() {

        $id = $this->input->post('fee_type_id') + 0;
        $this->form_validation->set_rules('name', 'Fee Type Name', 'required');
        $this->form_validation->set_rules('gateway', 'Payment Gateway', 'required');

        $success = $res = 0;
        if ($this->form_validation->run() == TRUE) {
            $fee_type_name = trim($this->input->post('name'));
            $head = array(
                'name' => $fee_type_name,
                'gateway' => $this->input->post('gateway'),
                'status' => $this->input->post('status'),
            );

            if ($id) {
                //Edit head
                if ($this->fee_model->updateFeeType($id, $head)) {
                    $success = 1;
                    $this->data['msg'] = "Fee type name updated.";
                }
            } else {
                if ($this->fee_model->getFeeTypeByName($fee_type_name)) {
                    $this->data['msg'] = "Fee type name is already exists.";
                } else {
                    //Add head
                    if ($res = $this->fee_model->addFeeType($head)) {
                        $success = 1;
                        $this->data['msg'] = "Fee type name added.";
                    }
                }
            }
        }
        $err_arr = array('name' => form_error('name'), 'gateway' => form_error('gateway'));
        echo json_encode(array('success' => $success, 'key' => $res, 'error' => $err_arr, 'msg' => $this->data['msg']));
    }

    public function delete_fee_type() {
        $id = $this->input->post('id');
        $success = 0;
        if ($this->fee_model->deleteFeeType($id))
            $success = 1;

        echo json_encode(array('success' => $success));
    }

    public function head_type() {
        $this->data['page'] = 'Head Type';
        $this->data['title'] = 'Head Type';
        $this->data['view'] = 'admin/fee/fee_head/head_list';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_head_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'name', 'status', ''); //set column field database for datatable orderable
        $column_search = array('name'); //set column field database for datatable searchable
        $order_by = array('id' => 'desc'); // default order

        $select_arr = array('id', 'name', 'status');
        $select = json_encode($select_arr);
        $join_json = json_encode(array());

        $where_json = json_encode(array());

        $data['list'] = $this->common->get_datatables($this->common->getHeadTypeTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/fee/fee_head/ajax_head_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getHeadTypeTable(), $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getHeadTypeTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function ajax_add_head() {
        is_ajax();
        $id = $this->input->post('head_id') + 0;
        $this->data['head_data'] = $this->fee_model->getHeadById($id);
        echo json_encode(array('view' => $this->load->view('admin/fee/fee_head/ajax_head_add', $this->data, true)));
    }

    public function add_head() {

        $id = $this->input->post('head_id') + 0;
        $this->form_validation->set_rules('name', 'Head Name', 'required');

        $success = $res = 0;
        if ($this->form_validation->run() == TRUE) {
            $head_name = trim($this->input->post('name'));
            $head = array(
                'name' => $head_name,
                'status' => $this->input->post('status'),
            );

            if ($id) {
                //Edit head
                if ($this->fee_model->updateHead($id, $head)) {
                    $success = 1;
                    $this->data['msg'] = "Head name updated.";
                }
            } else {
                if ($this->fee_model->getHeadByName($head_name)) {
                    $this->data['msg'] = "Head Name is already exists.";
                } else {
                    //Add head
                    if ($res = $this->fee_model->addHead($head)) {
                        $success = 1;
                        $this->data['msg'] = "Head name added.";
                    }
                }
            }
        }
        $err_arr = array('name' => form_error('name'));
        echo json_encode(array('success' => $success, 'key' => $res, 'error' => $err_arr, 'msg' => $this->data['msg']));
    }

    public function delete_head() {
        $id = $this->input->post('id');
        $success = 0;
        if ($this->fee_model->deleteHead($id))
            $success = 1;

        echo json_encode(array('success' => $success));
    }

    public function fee_installment() {
        $this->data['page'] = 'Fee Installment';
        $this->data['title'] = 'Fee Installment';
        $this->data['view'] = 'admin/fee/fee_installment/list';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_fee_installment_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'name', 'fee_range_start', 'fee_range_end', 'late_fee_type', 'late_fee_amount', 'status', ''); //set column field database for datatable orderable
        $column_search = array('name', 'fee_range_start', 'fee_range_end', 'late_fee_type', 'late_fee_amount'); //set column field database for datatable searchable
        $order_by = array('id' => 'desc'); // default order

        $select_arr = array('id', 'name', 'fee_range_start', 'fee_range_end', 'late_fee_type', 'late_fee_amount', 'status');
        $select = json_encode($select_arr);
        $join_json = json_encode(array());

        $where_json = json_encode(array());

        $data['list'] = $this->common->get_datatables($this->common->getFeeInstallmentTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/fee/fee_installment/ajax_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getFeeInstallmentTable(), $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getFeeInstallmentTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function ajax_add_fee_installment() {
        is_ajax();
        $id = $this->input->post('fee_installment_id') + 0;
        $this->data['fee_installment'] = $this->fee_model->getFeeInstallmentById($id);
        echo json_encode(array('view' => $this->load->view('admin/fee/fee_installment/ajax_add', $this->data, true)));
    }

    public function add_fee_installment() {

        $id = $this->input->post('head_id') + 0;
        $this->form_validation->set_rules('name', 'Fee Installment Name', 'required');
        $this->form_validation->set_rules('fee_range', 'Fee Collection Range', 'required');
        $this->form_validation->set_rules('late_amount', 'Late Fee Amount', 'required');

        $success = $res = 0;
        if ($this->form_validation->run() == TRUE) {
            $fee_range = explode(" - ", $this->input->post('fee_range'));
            $fee_range_start = date("Y-m-d", strtotime($fee_range[0]));
            $fee_range_end = date("Y-m-d", strtotime($fee_range[1]));
            $head_name = trim($this->input->post('name'));
            $head = array(
                'name' => $head_name,
                'fee_range_start' => $fee_range_start,
                'fee_range_end' => $fee_range_end,
                'late_fee_type' => trim($this->input->post('late_fee_type')),
                'late_fee_amount' => trim($this->input->post('late_amount')),
                'status' => $this->input->post('status'),
            );

            if ($id) {
                //Edit head
                if ($this->fee_model->updateFeeInstallment($id, $head)) {
                    $success = 1;
                    $this->data['msg'] = "Fee installment updated.";
                }
            } else {

                if ($this->fee_model->getFeeInstallmentByName($head_name)) {
                    $this->data['msg'] = "Fee installment name is already exists.";
                } else {
                    //Add head
                    if ($res = $this->fee_model->addFeeInstallment($head)) {
                        $success = 1;
                        $this->data['msg'] = "Fee installment added.";
                    }
                }
            }
        }
        $err_arr = array('name' => form_error('name'), 'fee_range' => form_error('fee_range'), 'late_amount' => form_error('late_amount'));
        echo json_encode(array('success' => $success, 'key' => $res, 'error' => $err_arr, 'msg' => $this->data['msg']));
    }

    public function delete_fee_installment() {
        $id = $this->input->post('id');
        $success = 0;
        if ($this->fee_model->deleteFeeInstallment($id))
            $success = 1;

        echo json_encode(array('success' => $success));
    }

    public function fee_structure() {
        $this->data['page'] = 'Fee Structure';
        $this->data['title'] = 'Fee Structure';
        $this->data['view'] = 'admin/fee/fee_structure/list';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_fee_structure_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 't.name', 'fee_structure_name', 'board_name', 's.name', 'student_status', 'all_month', 'f.status', ''); //set column field database for datatable orderable
        $column_search = array('t.name', 'fee_structure_name', 'board_name', 's.name'); //set column field database for datatable searchable
        $order_by = array('f.id' => 'desc'); // default order

        $select_arr = array('f.id', 'board_name', 't.name as fee_type', 'fee_structure_name', 's.name', 'student_status', 'all_month', 'f.status');
        $select = json_encode($select_arr);

        $join_arr = array(
            array("table" => $this->common->getFeeTypeTable() . ' AS t', "fields" => array('f.fee_type_id = t.id')),
            array("table" => $this->common->getBoardTable() . ' AS b', "fields" => array('f.board_id = b.id')),
            array("table" => $this->common->getStudentTypeTable() . ' AS s', "fields" => array('f.student_type = s.id'))
        );
        $join_json = json_encode($join_arr);

        $where_arr = array('f.is_deleted' => 0);
        $where_json = json_encode($where_arr);

        $data['list'] = $this->common->get_datatables($this->common->getFeeStructureTable() . ' AS f', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/fee/fee_structure/ajax_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getFeeStructureTable() . ' AS f', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getFeeStructureTable() . ' AS f', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function add_structure($id = 0) {

        $this->form_validation->set_rules('fee_type', 'Fee Type', 'required');
        $this->form_validation->set_rules('name', 'Fee Structure Name', 'required');
        $this->form_validation->set_rules('board_id', 'Board', 'required');
        $this->form_validation->set_rules('student_type', 'Student Type', 'required');
        $this->form_validation->set_rules('student_status', 'Student Status', 'required');
        $this->form_validation->set_rules('class[]', 'Class', 'required');

        if ($this->form_validation->run() == TRUE) {
            $fee_structure_name = trim($this->input->post('name'));
            $fee_structure_data = array(
                'fee_type_id' => $this->input->post('fee_type'),
                'fee_structure_name' => $fee_structure_name,
                'student_type' => $this->input->post('student_type'),
                'student_status' => $this->input->post('student_status'),
                'all_month' => $this->input->post('all_month') ? $this->input->post('all_month') : 0,
                'board_id' => $this->input->post('board_id'),
                'status' => $this->input->post('status')
            );

            if ($id) {
                //Edit head
                if ($this->fee_model->updateFeeStructure($id, $fee_structure_data)) {
                    $this->fee_model->deleteFeeStructureClass($id, 'fee_structure');
                    $this->data['msg'] = "Fee structure updated.";
                    $fee_structure_id = $id;
                }
            } else {

                /* if ($this->fee_model->getFeeStructureByName($fee_structure_name)) {
                  $this->data['msg'] = "Fee structure name is already exists.";
                  } else { */
                //Add head
                if ($fee_structure_id = $this->fee_model->addFeeStructure($fee_structure_data)) {
                    $this->data['msg'] = "Fee structure added.";
                }
                //}
            }

            if (isset($_POST['class']) && $_POST['class']) {
                foreach ($_POST['class'] as $class) {
                    $fee_head_arr = array();
                    if (isset($_POST['head_type']) && $_POST['head_type']) {
                        foreach ($_POST['head_type'] as $mk => $head_types) {
                            $fee_installment_id = 0;
                            $chkval = array();
                            foreach ($head_types as $hk => $head_type) {
                                if (isset($_POST['check'][$mk][$hk])) {
                                    foreach ($_POST['check'][$mk] as $key => $value) {
                                        if ($key == $hk) {
                                            $chkval[$hk] = $value;
                                        }
                                    }
                                } else {
                                    $chkval[$hk] = "0";
                                }

                                if ($head_type) {
                                    $fee_installment_id = $mk;
                                    $fee_head_arr = array('check' => $chkval, 'head_type' => $head_types, 'amount' => $_POST['amount'][$mk]);
                                }
                            }

                            if ($fee_installment_id) {
                                $fee_structure_class = array(
                                    'fee_structure_id' => $fee_structure_id,
                                    'class_id' => $class,
                                    'fee_installment_id' => $fee_installment_id,
                                    'fee_head_json' => json_encode($fee_head_arr),
                                    'fee_form_type' => 'fee_structure'
                                );
                                $this->fee_model->addFeeStructureClass($fee_structure_class);
                            }
                        }
                    }
                }
            }
            redirect('admin/feestructure/fee_structure');
        }

        $class_data = array();
        if ($id) {
            $this->data['fee_structure'] = $fee_structure = $this->fee_model->getFeeStructureById($id);
            $fee_structure_class = $this->fee_model->getFeeStructureClass($id, 'fee_structure');
            $fee_class = $fee_installment = array();
            foreach ($fee_structure_class as $value) {
                $fee_class[$value->class_id] = $value->class_id;
                $fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
            }

            $fee_type_id = $fee_structure ? $fee_structure->fee_type_id : 0;
            if ($data = $this->fee_model->getFeeStructureClassByFeeType($fee_type_id)) {
                foreach ($data as $value) {
                    $class_data[] = $value->class_id;
                }
            }

            $this->data['fee_structure_class'] = $fee_class;
            $this->data['fee_structure_installment'] = $fee_installment;
        }
        $this->load->model(array('admin_model', 'class_model'));
        $this->data['page'] = 'Fee Structure';
        $this->data['title'] = 'Fee Structure';
        $this->data['class_data'] = $class_data;
        $this->data['fee_structure_id'] = $id;
        $this->data['boards'] = $this->admin_model->getBoard();
        $this->data['student_types'] = $this->admin_model->getStudentType();
        $this->data['classes'] = $this->class_model->getClass();
        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        $this->data['fee_type_data'] = $this->fee_model->getFeeType();
        $this->data['view'] = 'admin/fee/fee_structure/fee_structure';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_get_fee_type() {
        is_ajax();
        $fee_type_id = $this->input->post('fee_type');
        $class_data = array();
        if ($data = $this->fee_model->getFeeStructureClassByFeeType($fee_type_id)) {
            foreach ($data as $value) {
                $class_data[] = $value->class_id;
            }
        }
        echo json_encode(array('class_data' => $class_data, 'success' => 1));
    }

    public function delete_fee_structure() {
        $id = $this->input->post('id');
        $success = 0;
        if ($this->fee_model->deleteFeeStructure($id, 'fee_structure'))
            $success = 1;

        echo json_encode(array('success' => $success));
    }

    public function ajax_fee_structure_class() {
        is_ajax();
        $id = $this->input->post('fee_structure_id') + 0;
        $this->data['fee_structure'] = $this->fee_model->getFeeStructureById($id);
        $fee_structure_class = $this->fee_model->getFeeStructureClass($id, 'fee_structure');
        $fee_class = $fee_installment = array();
        foreach ($fee_structure_class as $value) {
            $fee_class[$value->class_id] = $value->class_id;
            $fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
        }

        $this->data['fee_structure_class'] = $fee_class;
        $this->data['fee_structure_installment'] = $fee_installment;

        $this->load->model(array('admin_model', 'class_model'));
        $this->data['boards'] = $this->admin_model->getBoard();
        $this->data['student_types'] = $this->admin_model->getStudentType();
        $this->data['classes'] = $this->class_model->getClass();
        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        $this->data['fee_type_data'] = $this->fee_model->getFeeType();
        echo json_encode(array('view' => $this->load->view('admin/fee/fee_structure/ajax_class', $this->data, true)));
    }

    public function bulk_concession() {
        $this->data['page'] = 'Bulk Fee Concession';
        $this->data['title'] = 'Bulk Fee Concession';
        $this->data['view'] = 'admin/fee/fee_concession/bulk_list';

        $this->load->model(array('admin_model', 'class_model'));
        $this->data['student_types'] = $this->admin_model->getStudentType();
        $this->data['classes'] = $this->class_model->getClass();
        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_bulk_concession_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 's.name', 'concession_type', 'all_month', 'c.status', ''); //set column field database for datatable orderable
        $column_search = array('s.name', 'concession_type'); //set column field database for datatable searchable
        $order_by = array('c.id' => 'desc'); // default order

        $select_arr = array('c.id', 's.name', 'concession_type', 'all_month', 'c.status');
        $select = json_encode($select_arr);

        $join_arr = array(
            array("table" => $this->common->getStudentTypeTable() . ' AS s', "fields" => array('c.student_type = s.id'))
        );
        $join_json = json_encode($join_arr);

        $where_arr = array('c.is_deleted' => 0);
        $where_json = json_encode($where_arr);

        $data['list'] = $this->common->get_datatables($this->common->getFeeConcessionBulkTable() . ' AS c', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/fee/fee_concession/ajax_bulk_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getFeeConcessionBulkTable() . ' AS c', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getFeeConcessionBulkTable() . ' AS c', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function add_bulk_concession($id = 0) {
//         echo '<pre>';        print_r($_POST);die;
        $this->form_validation->set_rules('student_type', 'Student Type', 'required');
        if ($this->form_validation->run() == TRUE) {
            $fee_concession_data = array(
                'student_type' => $this->input->post('student_type'),
                'all_month' => $this->input->post('all_month') ? $this->input->post('all_month') : 0,
                'concession_type' => $this->input->post('concession_type'),
                'status' => $this->input->post('status')
            );

            if ($id) {
                //Edit bulk fee concession
                if ($this->fee_model->updateBulkConcession($id, $fee_concession_data)) {
                    $this->fee_model->deleteFeeStructureClass($id, 'bulk_concession');
                    $this->data['msg'] = "Fee bulk concession updated.";
                    $fee_concession_id = $id;
                }
            } else {
                $fee_concession_id = $this->fee_model->addBulkConcession($fee_concession_data);
                $this->data['msg'] = "Fee bulk concession added.";
            }

            if (isset($_POST['class']) && $_POST['class']) {
                foreach ($_POST['class'] as $class) {
                    $fee_head_arr = array();
                    if (isset($_POST['head_type']) && $_POST['head_type']) {
                        foreach ($_POST['head_type'] as $mk => $head_types) {
                            $fee_installment_id = 0;
                            foreach ($head_types as $hk => $head_type) {
                                if ($head_type) {
                                    $fee_installment_id = $mk;
                                    $fee_head_arr = array('head_type' => $head_types, 'amount' => $_POST['amount'][$mk], 'remark' => $_POST['remark'][$mk]);
                                }
                            }

                            if ($fee_installment_id) {
                                $fee_structure_class = array(
                                    'fee_structure_id' => $fee_concession_id,
                                    'class_id' => $class,
                                    'fee_installment_id' => $fee_installment_id,
                                    'fee_head_json' => json_encode($fee_head_arr),
                                    'fee_form_type' => 'bulk_concession'
                                );
                                $this->fee_model->addFeeStructureClass($fee_structure_class);
                            }
                        }
                    }
                }
            }
            redirect('admin/feestructure/bulk_concession');
        }

        if ($id) {
            $this->data['fee_concession'] = $this->fee_model->getBulkConcessionById($id);
            $fee_structure_class = $this->fee_model->getFeeStructureClass($id, 'bulk_concession');
            $fee_class = $fee_installment = array();
            foreach ($fee_structure_class as $value) {
                $fee_class[$value->class_id] = $value->class_id;
                $fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
            }

            $this->data['fee_concession_class'] = $fee_class;
            $this->data['fee_concession_installment'] = $fee_installment;
        }
        $this->load->model(array('admin_model', 'class_model'));
        $this->data['page'] = 'Bulk Fee Concession';
        $this->data['title'] = 'Bulk Fee Concession';
        $this->data['view'] = 'admin/fee/fee_concession/bulk_concession';
        $this->data['student_types'] = $this->admin_model->getStudentType();
        $this->data['classes'] = $this->class_model->getClass();
        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        $this->load->view('admin/admin_master', $this->data);
    }

    public function delete_bulk_concession() {
        $id = $this->input->post('id');
        $success = 0;
        if ($this->fee_model->deleteBulkConcession($id))
            $success = 1;

        echo json_encode(array('success' => $success));
    }

    public function ajax_bulk_concession_class() {
        is_ajax();
        $id = $this->input->post('bulk_concession_id') + 0;
        $this->data['fee_concession'] = $this->fee_model->getBulkConcessionById($id);
        $fee_structure_class = $this->fee_model->getFeeStructureClass($id, 'bulk_concession');
        $fee_class = $fee_installment = array();
        foreach ($fee_structure_class as $value) {
            $fee_class[$value->class_id] = $value->class_id;
            $fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
        }

        $this->data['fee_concession_class'] = $fee_class;
        $this->data['fee_concession_installment'] = $fee_installment;

        $this->load->model(array('admin_model', 'class_model'));
        $this->data['student_types'] = $this->admin_model->getStudentType();
        $this->data['classes'] = $this->class_model->getClass();
        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        echo json_encode(array('view' => $this->load->view('admin/fee/fee_concession/ajax_bulk_class', $this->data, true)));
    }

    public function single_concession() {
        $this->data['page'] = 'Single Fee Concession';
        $this->data['title'] = 'Single Fee Concession';
        $this->data['view'] = 'admin/fee/fee_concession/single_list';

        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_single_concession_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'admission_no', 's.fullname', 's.role_no', 'c.class_name', 'se.section_name', 'concession_type', 'all_month', 'f.status', ''); //set column field database for datatable orderable
        $column_search = array('admission_no', 's.fullname', 's.role_no', 'c.class_name', 'se.section_name', 'concession_type'); //set column field database for datatable searchable
        $order_by = array('f.id' => 'desc'); // default order

        $select_arr = array('f.id', 'admission_no', 's.fullname', 's.role_no', 'c.class_name', 'se.section_name', 'concession_type', 'all_month', 'f.status');
        $select = json_encode($select_arr);

        $join_arr = array(
            array("table" => $this->common->getStudentTable() . ' AS s', "fields" => array('f.admission_no = s.registration_id')),
            array("table" => $this->common->getClassTable() . ' AS c', "fields" => array('s.class_id = c.id')),
            array("table" => $this->common->getSectionTable() . ' AS se', "fields" => array('s.section_id = se.id'))
        );
        $join_json = json_encode($join_arr);

        $where_arr = array('f.is_deleted' => 0);
        $where_json = json_encode($where_arr);

        $data['list'] = $this->common->get_datatables($this->common->getFeeConcessionSingleTable() . ' AS f', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/fee/fee_concession/ajax_single_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getFeeConcessionSingleTable() . ' AS f', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getFeeConcessionSingleTable() . ' AS f', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function add_single_concession($id = 0) {
        //echo '<pre>';        print_r($_POST);die;
        $this->form_validation->set_rules('register_no', 'Admission Number', 'required');
        if ($this->form_validation->run() == TRUE) {
            $fee_concession_data = array(
                'admission_no' => $this->input->post('register_no'),
                'all_month' => $this->input->post('all_month') ? $this->input->post('all_month') : 0,
                'concession_type' => $this->input->post('concession_type'),
                'status' => $this->input->post('status')
            );

            if ($id) {
                //Edit bulk fee concession
                if ($this->fee_model->updateSingleConcession($id, $fee_concession_data)) {
                    $this->fee_model->deleteFeeStructureClass($id, 'single_concession');
                    $this->data['msg'] = "Single fee concession updated.";
                    $fee_concession_id = $id;
                }
            } else {
                $fee_concession_id = $this->fee_model->addSingleConcession($fee_concession_data);
                $this->data['msg'] = "Single fee concession added.";
            }

            if (isset($_POST['class_id']) && $_POST['class_id']) {
                $fee_head_arr = array();
                $class = $_POST['class_id'];
                if (isset($_POST['head_type']) && $_POST['head_type']) {
                    foreach ($_POST['head_type'] as $mk => $head_types) {
                        $fee_installment_id = 0;
                        foreach ($head_types as $hk => $head_type) {
                            if ($head_type) {
                                $fee_installment_id = $mk;
                                $fee_head_arr = array('head_type' => $head_types, 'amount' => $_POST['amount'][$mk], 'remark' => $_POST['remark'][$mk]);
                            }
                        }

                        if ($fee_installment_id) {
                            $fee_structure_class = array(
                                'fee_structure_id' => $fee_concession_id,
                                'class_id' => $class,
                                'fee_installment_id' => $fee_installment_id,
                                'fee_head_json' => json_encode($fee_head_arr),
                                'fee_form_type' => 'single_concession'
                            );
                            $this->fee_model->addFeeStructureClass($fee_structure_class);
                        }
                    }
                }
            }
            redirect('admin/feestructure/single_concession');
        }

        if ($id) {
            $this->data['fee_concession'] = $this->fee_model->getSingleConcessionById($id);
            $fee_structure_class = $this->fee_model->getFeeStructureClass($id, 'single_concession');
            $fee_class = $fee_installment = array();
            foreach ($fee_structure_class as $value) {
                $fee_class[$value->class_id] = $value->class_id;
                $fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
            }

            $this->data['fee_concession_class'] = $fee_class;
            $this->data['fee_concession_installment'] = $fee_installment;
        }
        $this->data['page'] = 'Single Fee Concession';
        $this->data['title'] = 'Single Fee Concession';
        $this->data['view'] = 'admin/fee/fee_concession/single_concession';
        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        $this->load->view('admin/admin_master', $this->data);
    }

    public function delete_single_concession() {
        $id = $this->input->post('id');
        $success = 0;
        if ($this->fee_model->deleteSingleConcession($id))
            $success = 1;

        echo json_encode(array('success' => $success));
    }

    public function ajax_single_concession_class() {
        is_ajax();
        $id = $this->input->post('single_concession_id') + 0;
        $this->data['fee_concession'] = $this->fee_model->getSingleConcessionById($id);
        $fee_structure_class = $this->fee_model->getFeeStructureClass($id, 'single_concession');
        $fee_class = $fee_installment = array();
        foreach ($fee_structure_class as $value) {
            $fee_class[$value->class_id] = $value->class_id;
            $fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
        }

        $this->data['fee_concession_class'] = $fee_class;
        $this->data['fee_concession_installment'] = $fee_installment;

        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        echo json_encode(array('view' => $this->load->view('admin/fee/fee_concession/ajax_single_class', $this->data, true)));
    }

    public function additional_fee() {
        $this->data['page'] = 'Additional Fee';
        $this->data['title'] = 'Additional Fee';
        $this->data['view'] = 'admin/fee/additional_fee/list';
        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        $this->load->view('admin/admin_master', $this->data);
    }

    public function ajax_additional_fee_list() {
        is_ajax();
        $this->data['ajax_order_by'] = json_encode(array(0, 3));

        $column_order = array(null, 'admission_no', 's.fullname', 's.role_no', 'c.class_name', 'se.section_name', 'concession_type', 'all_month', 'f.status', ''); //set column field database for datatable orderable
        $column_search = array('admission_no', 's.fullname', 's.role_no', 'c.class_name', 'se.section_name', 'concession_type'); //set column field database for datatable searchable
        $order_by = array('f.id' => 'desc'); // default order

        $select_arr = array('f.id', 'admission_no', 's.fullname', 's.role_no', 'c.class_name', 'se.section_name', 'concession_type', 'all_month', 'f.status');
        $select = json_encode($select_arr);

        $join_arr = array(
            array("table" => $this->common->getStudentTable() . ' AS s', "fields" => array('f.admission_no = s.registration_id')),
            array("table" => $this->common->getClassTable() . ' AS c', "fields" => array('s.class_id = c.id')),
            array("table" => $this->common->getSectionTable() . ' AS se', "fields" => array('s.section_id = se.id'))
        );
        $join_json = json_encode($join_arr);

        $where_arr = array('f.is_deleted' => 0);
        $where_json = json_encode($where_arr);

        $data['list'] = $this->common->get_datatables($this->common->getAdditionalFeeTable() . ' AS f', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
        $ajax_data = $this->load->view('admin/fee/additional_fee/ajax_list', $data, true);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->common->count_all($this->common->getAdditionalFeeTable() . ' AS f', $join_json, $where_json, true),
            "recordsFiltered" => $this->common->count_filtered($this->common->getAdditionalFeeTable() . ' AS f', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
            "data" => json_decode($ajax_data),
        );

        echo json_encode($output);
    }

    public function add_additional_fee($id = 0) {
        $this->form_validation->set_rules('register_no', 'Admission Number', 'required');
        if ($this->form_validation->run() == TRUE) {
            $additional_fee_data = array(
                'admission_no' => $this->input->post('register_no'),
                'all_month' => $this->input->post('all_month') ? $this->input->post('all_month') : 0,
                'concession_type' => $this->input->post('concession_type'),
//                'additional_fee' => $this->input->post('additional_fee'),
                'status' => $this->input->post('status')
            );

            if ($id) {
                //Edit bulk fee concession
                if ($this->fee_model->updateAdditionalFee($id, $additional_fee_data)) {
                    $this->fee_model->deleteFeeStructureClass($id, 'additional_fee');
                    $this->data['msg'] = "Additional fee updated.";
                    $fee_concession_id = $id;
                }
            } else {
                $fee_concession_id = $this->fee_model->addAdditionalFee($additional_fee_data);
                $this->data['msg'] = "Additional fee added.";
            }

            if (isset($_POST['class_id']) && $_POST['class_id']) {
                $fee_head_arr = array();
                $class = $_POST['class_id'];
                if (isset($_POST['head_type']) && $_POST['head_type']) {
                    foreach ($_POST['head_type'] as $mk => $head_types) {
                        $fee_installment_id = 0;
                        foreach ($head_types as $hk => $head_type) {
                            if ($head_type) {
                                $fee_installment_id = $mk;
                                $fee_head_arr = array('head_type' => $head_types, 'amount' => $_POST['amount'][$mk], 'remark' => $_POST['remark'][$mk]);
                            }
                        }

                        if ($fee_installment_id) {
                            $fee_structure_class = array(
                                'fee_structure_id' => $fee_concession_id,
                                'class_id' => $class,
                                'fee_installment_id' => $fee_installment_id,
                                'fee_head_json' => json_encode($fee_head_arr),
                                'fee_form_type' => 'additional_fee'
                            );
                            $this->fee_model->addFeeStructureClass($fee_structure_class);
                        }
                    }
                }
            }
            redirect('admin/feestructure/additional_fee');
        }

        if ($id) {
            $this->data['additional_fee'] = $this->fee_model->getAdditionalFeeById($id);
//        echo '<pre>';        print_r($this->data['additional_fee']);die;
            $fee_structure_class = $this->fee_model->getFeeStructureClass($id, 'additional_fee');
            $fee_class = $fee_installment = array();
            foreach ($fee_structure_class as $value) {
                $fee_class[$value->class_id] = $value->class_id;
                $fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
            }

            $this->data['additional_fee_class'] = $fee_class;
            $this->data['additional_fee_installment'] = $fee_installment;
        }
        $this->data['page'] = 'Additional Fee';
        $this->data['title'] = 'Additional Fee';
        $this->data['view'] = 'admin/fee/additional_fee/add';
        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        $this->load->view('admin/admin_master', $this->data);
    }

    public function delete_additional_fee() {
        $id = $this->input->post('id');
        $success = 0;
        if ($this->fee_model->deleteAdditionalFee($id))
            $success = 1;

        echo json_encode(array('success' => $success));
    }

    public function ajax_additional_fee_class() {
        is_ajax();
        $id = $this->input->post('additional_fee_id') + 0;
        $this->data['additional_fee'] = $this->fee_model->getAdditionalFeeById($id);
        $fee_structure_class = $this->fee_model->getFeeStructureClass($id, 'additional_fee');
        $fee_class = $fee_installment = array();
        foreach ($fee_structure_class as $value) {
            $fee_class[$value->class_id] = $value->class_id;
            $fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
        }

        $this->data['additional_fee_class'] = $fee_class;
        $this->data['additional_fee_installment'] = $fee_installment;

        $this->data['installments'] = $this->fee_model->getFeeInstallment();
        $this->data['head_types'] = $this->fee_model->getHead();
        echo json_encode(array('view' => $this->load->view('admin/fee/additional_fee/ajax_class', $this->data, true)));
    }

}
