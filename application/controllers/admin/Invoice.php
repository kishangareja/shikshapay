<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->db->checkadminlogin();
		$this->load->model('admin_model');
		$this->data['page'] = 'Invoice';
		$this->data['title'] = '';
		$this->data['ajax_order_by'] = json_encode(array());
	}

	public function index() {
		$this->data['page'] = 'GST Invoice';
		$this->data['view'] = 'admin/invoice/success_list';
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

		$where_arr = array('t.is_deleted' => 0);
		$where_json = json_encode($where_arr);

		$data['list'] = $this->common->get_datatables($this->common->getTransactionTable() . ' AS t', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
		$ajax_data = $this->load->view('admin/invoice/ajax_list', $data, true);

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->common->count_all($this->common->getTransactionTable() . ' AS t', $join_json, $where_json, true),
			"recordsFiltered" => $this->common->count_filtered($this->common->getTransactionTable() . ' AS t', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
			"data" => json_decode($ajax_data),
		);

		echo json_encode($output);
	}

	public function gst_invoice() {
		$this->data['setting_data'] = $this->admin_model->getSetting();

		require_once APPPATH . 'third_party/mpdf/autoload.php';
		$mpdf = new \Mpdf\Mpdf([
			'margin_left' => 12,
			'margin_right' => 12,
		]);

		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Shikshapay GST Invoice");
		$mpdf->SetAuthor("Shikshapay");
		$mpdf->SetDisplayMode('fullpage');
		$view = $this->load->view('admin/invoice/invoice', $this->data, true);
		$mpdf->WriteHTML($view);
		$mpdf->Output();
	}

}
