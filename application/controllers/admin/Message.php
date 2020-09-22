<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->db->checkadminlogin();
		$this->load->model(array('message_model', 'gateway_model'));
		$this->data['page'] = 'Text Message';
		$this->data['title'] = '';
		$this->data['ajax_order_by'] = json_encode(array());
	}

	public function textmsg() {
		$this->data['page'] = 'Text Message';
		$this->data['view'] = 'admin/message/text_msglist';
		$this->load->view('admin/admin_master', $this->data);
	}

	public function ajax_textlist() {
		is_ajax();
		$this->data['ajax_order_by'] = json_encode(array(0, 6));

		$column_order = array(null, 'receiver', 'message', 'creation_datetime', ''); //set column field database for datatable orderable
		$column_search = array('receiver', 'message', 'creation_datetime'); //set column field database for datatable searchable
		$order_by = array('id' => 'desc'); // default order

		$select_arr = array('*');
		$select = json_encode($select_arr);
		$join_json = json_encode(array());
		$where_json = json_encode(array('message_type' => 'mobile'));

		$this->data['list'] = $this->common->get_datatables($this->common->getMessageTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
		$ajax_data = $this->load->view('admin/message/ajax_text_msglist', $this->data, true);

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->common->count_all($this->common->getMessageTable(), $join_json, $where_json),
			"recordsFiltered" => $this->common->count_filtered($this->common->getMessageTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
			"data" => json_decode($ajax_data),
		);

		echo json_encode($output);
	}

	public function send_textmsg() {
		$gateway = '';
		if ($result = $this->gateway_model->getTextMsgGatewayByStatus()) {
			$key = $result->key;
			$gateway = $result->gateway;
		}
		$this->data['page'] = 'Send Text Message';
		$this->data['view'] = 'admin/message/text_msg';
		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

		if ($this->form_validation->run() == TRUE) {
			$mobiles = explode(',', $this->input->post('mobile'));
			if (isset($mobiles) && $mobiles) {
				foreach ($mobiles as $mobile) {
					$message_data = array(
						'message' => trim($this->input->post('message')),
						'message_type' => 'mobile',
						'receiver' => $mobile,
					);
					if ($gateway == 'msg91') {
						$this->common->sendSMSmsg91($mobile, $this->input->post('message'), $key);
					}

					if ($gateway == 'textlocal') {
						$this->common->sendSMStextLocal($mobile, $this->input->post('message'), $key);
					}
					$this->message_model->addMessage($message_data);
				}
			}
			redirect('admin/message/textmsg');
		}
		$this->load->view('admin/admin_master', $this->data);
	}

	public function emailmsg() {
		$this->data['page'] = 'Email Message';
		$this->data['view'] = 'admin/message/email_msglist';
		$this->load->view('admin/admin_master', $this->data);
	}

	public function ajax_emaillist() {
		is_ajax();
		$this->data['ajax_order_by'] = json_encode(array(0, 6));

		$column_order = array(null, 'receiver', 'message', 'creation_datetime', ''); //set column field database for datatable orderable
		$column_search = array('receiver', 'message', 'creation_datetime'); //set column field database for datatable searchable
		$order_by = array('id' => 'desc'); // default order

		$select_arr = array('*');
		$select = json_encode($select_arr);
		$join_json = json_encode(array());
		$where_json = json_encode(array('message_type' => 'email'));

		$this->data['list'] = $this->common->get_datatables($this->common->getMessageTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
		$ajax_data = $this->load->view('admin/message/ajax_text_msglist', $this->data, true);

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->common->count_all($this->common->getMessageTable(), $join_json, $where_json),
			"recordsFiltered" => $this->common->count_filtered($this->common->getMessageTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
			"data" => json_decode($ajax_data),
		);

		echo json_encode($output);
	}

	public function send_emailmsg() {
		$gateway = '';
		if ($result = $this->gateway_model->getEmailMsgGatewayByStatus()) {
			$key = $result->key;
			$gateway = $result->gateway;
		}
		if ($gateway == 'sendgrid') {
			require_once APPPATH . 'third_party/sendgrid/vendor/autoload.php';
		}

		$this->data['page'] = 'Send Email Message';

		$this->data['view'] = 'admin/message/email_msg';
		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

		if ($this->form_validation->run() == TRUE) {
			$emails = explode(',', $this->input->post('email'));
			$subject = trim($this->input->post('subject'));
			if (isset($emails) && $emails) {
				foreach ($emails as $email) {
					$message_data = array(
						'message' => trim($this->input->post('message')),
						'message_type' => 'email',
						'receiver' => $email,
					);
					$this->message_model->addMessage($message_data);
					if ($gateway == 'msg91') {
						$this->common->sendMailmsg91($key, $subject, $email, $this->input->post('message'));
					}

					if ($gateway == 'sendgrid') {
						$this->common->sendEmailBySendgrid($key, $email, $subject, $this->input->post('message'));
					}
				}
			}
			redirect('admin/message/emailmsg');
		}
		$this->load->view('admin/admin_master', $this->data);
	}

	public function delete_message() {
		$id = $this->input->post('id');
		$success = 0;
		if ($this->message_model->deleteMessage($id)) {
			$success = 1;
		}

		echo json_encode(array('success' => $success));
	}

}
