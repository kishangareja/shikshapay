<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gateway extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->db->checkadminlogin();
		$this->load->model('gateway_model');
		$this->data['page'] = 'Gateway';
		$this->data['title'] = '';
		$this->data['ajax_order_by'] = json_encode(array());
	}

	public function all_gateway() {
		$this->data['page'] = 'All Gateway';
		$this->data['view'] = 'admin/gateway/all_gateway/list';
		$this->data['ajax_order_by'] = json_encode(array());
		$this->load->view('admin/admin_master', $this->data);
	}

	public function ajax_all_gateway_list() {
		is_ajax();
		$this->data['ajax_order_by'] = json_encode(array(0, 6));

		$column_order = array(null, 'name', 'type', 'live_url', 'test_url', 'status', ''); //set column field database for datatable orderable
		$column_search = array('name', 'type', 'live_url', 'test_url', 'status'); //set column field database for datatable searchable
		$order_by = array('id' => 'desc'); // default order

		$select_arr = array('*');
		$select = json_encode($select_arr);
		$join_json = json_encode(array());
		$where_json = json_encode(array());

		$this->data['list'] = $this->common->get_datatables($this->common->getGatewayTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
		$ajax_data = $this->load->view('admin/gateway/all_gateway/ajax_list', $this->data, true);

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->common->count_all($this->common->getGatewayTable(), $join_json, $where_json, true),
			"recordsFiltered" => $this->common->count_filtered($this->common->getGatewayTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
			"data" => json_decode($ajax_data),
		);

		echo json_encode($output);
	}

	public function ajax_edit_allgateway() {
		is_ajax();
		$id = $this->input->post('gateway_id') + 0;
		$this->data['page'] = 'Add All Gateway';
		if ($id) {
			$this->data['page'] = 'Edit All Gateway';
		}
		$this->data['mgdata'] = $this->gateway_model->getGatewayByType('email');
		$this->data['gateway'] = $this->gateway_model->getAllGatewayById($id);
		echo json_encode(array('view' => $this->load->view('admin/gateway/all_gateway/edit', $this->data, true)));
	}

	public function allgatewayedit() {

		$id = $this->input->post('gateway_id') + 0;
		$this->data['page_title'] = 'Edit Gateway';
		$this->data['view'] = 'admin/gateway/all_gateway/edit';
		//$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		//$this->form_validation->set_rules('live_url', 'Live Url', 'required');
		//$this->form_validation->set_rules('test_url', 'Test Url', 'required');

		$success = 0;
		if ($id) {
			$this->data['gateway'] = $this->gateway_model->getAllGatewayById($id);
		}

		//if ($this->form_validation->run() == TRUE) {
			$pay_gateway = array(
				// 'name' => trim($this->input->post('name')),
				// 'type' => trim($this->input->post('type')),
				'live_url' => trim($this->input->post('live_url')),
				'test_url' => trim($this->input->post('test_url')),
				'status' => trim($this->input->post('status')),
			);

			if ($this->gateway_model->updateAllGateway($id, $pay_gateway)) {
				$success = 1;
				$this->session->set_flashdata('success', "Gateway Updated Successfully.");
			} 
		//}
		//$err_arr = array('name' => form_error('name'), 'type' => form_error('type'), 'live_url' => form_error('live_url'), 'test_url' => form_error('test_url'));
		echo json_encode(array('success' => $success));
	}

	public function payment() {
		$this->data['page'] = 'Payment Gateway';
		$this->data['view'] = 'admin/gateway/payment/list';
		$this->data['ajax_order_by'] = json_encode(array());
		$this->load->view('admin/admin_master', $this->data);
	}

	public function ajax_list() {
		is_ajax();
		$this->data['ajax_order_by'] = json_encode(array(0, 6));

		$column_order = array(null, 'gateway', 'merchant_id', 'key', 'is_default', 'status', ''); //set column field database for datatable orderable
		$column_search = array('gateway', 'gateway_name', 'merchant_id', 'key', 'is_default', 'status'); //set column field database for datatable searchable
		$order_by = array('id' => 'desc'); // default order

		$select_arr = array('*');
		$select = json_encode($select_arr);
		$join_json = json_encode(array());
		$where_json = json_encode(array());

		$this->data['list'] = $this->common->get_datatables($this->common->getPayGatewayTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
		$ajax_data = $this->load->view('admin/gateway/payment/ajax_list', $this->data, true);

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->common->count_all($this->common->getPayGatewayTable(), $join_json, $where_json, true),
			"recordsFiltered" => $this->common->count_filtered($this->common->getPayGatewayTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
			"data" => json_decode($ajax_data),
		);

		echo json_encode($output);
	}

	public function ajax_add_pgateway() {
		is_ajax();
		$id = $this->input->post('gateway_id') + 0;
		$this->data['page'] = 'Add Payment Gateway';
		if ($id) {
			$this->data['page'] = 'Edit Payment Gateway';
		}
		$this->data['pgdata'] = $this->gateway_model->getGatewayByType('payment');
		$this->data['gateway'] = $this->gateway_model->getPayGatewayById($id);
		echo json_encode(array('view' => $this->load->view('admin/gateway/payment/edit', $this->data, true)));
	}

	public function pgedit() {

		$id = $this->input->post('gateway_id') + 0;
		$this->data['page_title'] = 'Edit Payment Gateway';
		$this->data['view'] = 'admin/gateway/payment/edit';
		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('gateway', 'Payment Gateway', 'required');
		$this->form_validation->set_rules('gateway_name', 'Gateway Suffix', 'required');
		$this->form_validation->set_rules('merchant_id', 'Merchant Id', 'required');
		$this->form_validation->set_rules('key', 'Key', 'required');

		$success = 0;
		if ($id) {
			$this->data['gateway'] = $this->gateway_model->getPayGatewayById($id);
		}

		if ($this->form_validation->run() == TRUE) {
			$pay_gateway = array(
				'gateway' => trim($this->input->post('gateway')),
				'gateway_name' => trim($this->input->post('gateway_name')),
				'merchant_id' => trim($this->input->post('merchant_id')),
				'key' => trim($this->input->post('key')),
				'is_default' => trim($this->input->post('is_default')),
				'status' => trim($this->input->post('status')),
				'is_live' => $this->input->post('is_live') ? trim($this->input->post('is_live')) : 0,
			);

			if ($this->input->post('status') && $this->input->post('is_default')) {
				$success = 1;
				$this->gateway_model->updatePayGatewayDefault(array('is_default' => 0));
			}

			if (!$id) {
				$id = $this->gateway_model->addPayGateway($pay_gateway);
			}

			if ($this->input->post('status') && $this->gateway_model->updatePayGateway($id, $pay_gateway)) {
				$success = 1;
				$this->session->set_flashdata('success', "Payment Gateway Updated Successfully.");
			} else {
				$success = 1;
				$pay_gateway['is_default'] = 0;
				$this->gateway_model->updatePayGateway($id, $pay_gateway);
			}
		}
		$err_arr = array('gateway' => form_error('gateway'), 'gateway_name' => form_error('gateway_name'), 'merchant_id' => form_error('merchant_id'), 'key' => form_error('key'));
		echo json_encode(array('success' => $success, 'error' => $err_arr));
	}

	public function delete_pgateway() {
		$id = $this->input->post('id');
		$success = 0;
		if ($this->gateway_model->deletePayGateway($id)) {
			$success = 1;
		}
		echo json_encode(array('success' => $success));
	}

	public function textmsg() {
		$this->data['page'] = 'Text Message Gateway';
		$this->data['view'] = 'admin/gateway/textmsg/list';
		$this->data['ajax_order_by'] = json_encode(array());
		$this->load->view('admin/admin_master', $this->data);
	}

	public function ajax_add_tgateway() {
		is_ajax();
		$id = $this->input->post('gateway_id') + 0;
		$this->data['page'] = 'Add Text Message Gateway';
		if ($id) {
			$this->data['page'] = 'Edit Text Message Gateway';
		}
		$this->data['mgdata'] = $this->gateway_model->getGatewayByType('text');
		$this->data['gateway'] = $this->gateway_model->getTextMsgGatewayById($id);
		echo json_encode(array('view' => $this->load->view('admin/gateway/textmsg/edit', $this->data, true)));
	}

	public function ajax_textlist() {
		is_ajax();
		$this->data['ajax_order_by'] = json_encode(array(0, 6));

		$column_order = array(null, 'gateway', 'key', 'is_default', 'status', ''); //set column field database for datatable orderable
		$column_search = array('gateway', 'key', 'is_default', 'status'); //set column field database for datatable searchable
		$order_by = array('id' => 'desc'); // default order

		$select_arr = array('*');
		$select = json_encode($select_arr);
		$join_json = json_encode(array());
		$where_json = json_encode(array('gateway_type' => 'mobile'));

		$this->data['list'] = $this->common->get_datatables($this->common->getMessageGatewayTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
		$ajax_data = $this->load->view('admin/gateway/textmsg/ajax_list', $this->data, true);

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->common->count_all($this->common->getMessageGatewayTable(), $join_json, $where_json, true),
			"recordsFiltered" => $this->common->count_filtered($this->common->getMessageGatewayTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
			"data" => json_decode($ajax_data),
		);

		echo json_encode($output);
	}

	public function textmsgedit() {

		$id = $this->input->post('gateway_id') + 0;
		$this->data['page_title'] = 'Edit Text Message Gateway';
		$this->data['view'] = 'admin/gateway/textmsg/edit';
		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('gateway', 'Message Gateway', 'required');
		$this->form_validation->set_rules('gateway_name', 'Gateway Suffix', 'required');
		$this->form_validation->set_rules('key', 'Key', 'required');

		$success = 0;
		if ($id) {
			$this->data['gateway'] = $this->gateway_model->getTextMsgGatewayById($id);
		}

		if ($this->form_validation->run() == TRUE) {
			$pay_gateway = array(
				'gateway' => trim($this->input->post('gateway')),
				'gateway_name' => trim($this->input->post('gateway_name')),
				'key' => trim($this->input->post('key')),
				'is_default' => trim($this->input->post('is_default')),
				'gateway_type' => 'mobile',
				'status' => trim($this->input->post('status')),
				// 'is_live' => $this->input->post('is_live') ? trim($this->input->post('is_live')) : 0,
			);
			if ($this->input->post('status') && $this->input->post('is_default')) {
				$this->gateway_model->updateMsgGatewayDefault('mobile', array('is_default' => 0));
			}

			if (!$id) {
				$id = $this->gateway_model->addTextMsgGateway($pay_gateway);
			}

			if ($this->input->post('status') && $this->gateway_model->updateTextMsgGateway($id, $pay_gateway)) {
				$success = 1;
				$this->session->set_flashdata('success', "Text Message Gateway Updated Successfully.");
			} else {
				$success = 1;
				$pay_gateway['is_default'] = 0;
				$this->gateway_model->updateTextMsgGateway($id, $pay_gateway);
			}
		}
		$err_arr = array('gateway' => form_error('gateway'), 'gateway_name' => form_error('gateway_name'), 'key' => form_error('key'));
		echo json_encode(array('success' => $success, 'error' => $err_arr));
	}

	public function delete_mgateway() {
		$id = $this->input->post('id');
		$success = 0;
		if ($this->gateway_model->deleteTextMsgGateway($id)) {
			$success = 1;
		}
		echo json_encode(array('success' => $success));
	}

	public function emailmsg() {
		$this->data['page'] = 'Email Gateway';
		$this->data['view'] = 'admin/gateway/email/list';
		$this->data['ajax_order_by'] = json_encode(array());
		$this->load->view('admin/admin_master', $this->data);
	}

	public function ajax_emaillist() {
		is_ajax();
		$this->data['ajax_order_by'] = json_encode(array(0, 6));

		$column_order = array(null, 'gateway', 'key', 'status', ''); //set column field database for datatable orderable
		$column_search = array('gateway', 'key', 'status'); //set column field database for datatable searchable
		$order_by = array('id' => 'desc'); // default order

		$select_arr = array('*');
		$select = json_encode($select_arr);
		$join_json = json_encode(array());
		$where_json = json_encode(array('gateway_type' => 'email'));

		$this->data['list'] = $this->common->get_datatables($this->common->getMessageGatewayTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
		$ajax_data = $this->load->view('admin/gateway/email/ajax_list', $this->data, true);

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->common->count_all($this->common->getMessageGatewayTable(), $join_json, $where_json, true),
			"recordsFiltered" => $this->common->count_filtered($this->common->getMessageGatewayTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
			"data" => json_decode($ajax_data),
		);

		echo json_encode($output);
	}

	public function ajax_add_egateway() {
		is_ajax();
		$id = $this->input->post('gateway_id') + 0;
		$this->data['page'] = 'Add Email Gateway';
		if ($id) {
			$this->data['page'] = 'Edit Email Gateway';
		}
		$this->data['mgdata'] = $this->gateway_model->getGatewayByType('email');
		$this->data['gateway'] = $this->gateway_model->getTextMsgGatewayById($id);
		echo json_encode(array('view' => $this->load->view('admin/gateway/email/edit', $this->data, true)));
	}

	public function emailedit() {

		$id = $this->input->post('gateway_id') + 0;
		$this->data['page_title'] = 'Edit Email Gateway';
		$this->data['view'] = 'admin/gateway/email/edit';
		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('gateway', 'Email Gateway', 'required');
		$this->form_validation->set_rules('gateway_name', 'Gateway Suffix', 'required');
		$this->form_validation->set_rules('key', 'Key', 'required');

		$success = 0;
		if ($id) {
			$this->data['gateway'] = $this->gateway_model->getTextMsgGatewayById($id);
		}

		if ($this->form_validation->run() == TRUE) {
			$pay_gateway = array(
				'gateway' => trim($this->input->post('gateway')),
				'gateway_name' => trim($this->input->post('gateway_name')),
				'key' => trim($this->input->post('key')),
				'is_default' => trim($this->input->post('is_default')),
				'gateway_type' => 'email',
				'status' => trim($this->input->post('status')),
				// 'is_live' => $this->input->post('is_live') ? trim($this->input->post('is_live')) : 0,
			);
			if ($this->input->post('status') && $this->input->post('is_default')) {
				$this->gateway_model->updateMsgGatewayDefault('email', array('is_default' => 0));
			}

			if (!$id) {
				$id = $this->gateway_model->addTextMsgGateway($pay_gateway);
			}

			if ($this->input->post('status') && $this->gateway_model->updateTextMsgGateway($id, $pay_gateway)) {
				$success = 1;
				$this->session->set_flashdata('success', "Email Gateway Updated Successfully.");
			} else {
				$success = 1;
				$pay_gateway['is_default'] = 0;
				$this->gateway_model->updateTextMsgGateway($id, $pay_gateway);
			}
		}
		$err_arr = array('gateway' => form_error('gateway'), 'gateway_name' => form_error('gateway_name'), 'key' => form_error('key'));
		echo json_encode(array('success' => $success, 'error' => $err_arr));
	}

}
