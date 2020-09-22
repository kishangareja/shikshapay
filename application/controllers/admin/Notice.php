<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->db->checkadminlogin();
		$this->load->model(array('student_model', 'institution_model', 'notice_model'));
		$this->data['page'] = 'Notice';
		$this->data['title'] = '';
		$this->data['ajax_order_by'] = json_encode(array());
	}

	public function index() {
		$type = 'notice';
		$this->data['notice_data'] = $this->notice_model->getAllNotice($type);
		$this->data['page'] = 'Notice List';
		$this->data['view'] = 'admin/notice/notice_list';
		$this->load->view('admin/admin_master', $this->data);
	}

	public function event() {
		$type = 'event';
		$this->data['notice_data'] = $this->notice_model->getAllNotice($type);
		$this->data['page'] = 'Event List';
		$this->data['view'] = 'admin/event/event_list';
		$this->load->view('admin/admin_master', $this->data);
	}

	public function add_event() {

		$this->data['page'] = 'Add Event';
		$this->data['view'] = 'admin/event/text_msg';
		$this->data['institution_data'] = $this->institution_model->getInstitution();
		$this->data['student_data'] = $this->student_model->getStudent();

		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

		if ($this->form_validation->run() == TRUE) {
			$ids = $this->input->post('institution_id') ? $this->input->post('institution_id') : $this->input->post('student_id');

			$event_id = array();
			foreach ($ids as $id) {
				$message_data = array(
					'user_type' => trim($this->input->post('type')),
					'user_id' => $id,
					'type' => 'event',
					'message' => trim($this->input->post('message')),
				);

				$event_id[] = $this->notice_model->addEvent($message_data);
			}

			$notification_data = array(
				'notification_id' => implode(',', $event_id),
				'type' => 'event',
				'title' => 'Event',
				'user_type' => trim($this->input->post('type')),
				'type' => 'event'
			);
			$this->common->insertNotification($notification_data);
			redirect('admin/event');
		}
		$this->load->view('admin/admin_master', $this->data);
	}

	public function add_notice() {

		$this->data['page'] = 'Add Notice';
		$this->data['view'] = 'admin/notice/text_msg';
		$this->data['institution_data'] = $this->institution_model->getInstitution();
		$this->data['student_data'] = $this->student_model->getStudent();

		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('type', 'Type', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

		// if ($this->input->post('type' == 'Institution')) {
		// 	$this->form_validation->set_rules('institution_id[]', 'Institution', 'required');
		// } else {
		// 	$this->form_validation->set_rules('student_id[]', 'Student', 'required');
		// }

		if ($this->form_validation->run() == TRUE) {
			$ids = $this->input->post('institution_id') ? $this->input->post('institution_id') : $this->input->post('student_id');

			$notice_id = array();
			foreach ($ids as $id) {
				$message_data = array(
					'user_type' => trim($this->input->post('type')),
					'user_id' => $id,
					'type' => 'notice',
					'message' => trim($this->input->post('message')),
				);

				$notice_id[] = $this->notice_model->addNotice($message_data);
			}

			$notification_data = array(
				'notification_id' => implode(',', $notice_id),
				'type' => 'notice',
				'title' => 'Notice',
				'user_type' => trim($this->input->post('type')),
				'type' => 'notice'
			);
			$this->common->insertNotification($notification_data);
			redirect('admin/notice');
		}
		$this->load->view('admin/admin_master', $this->data);
	}

	public function notice_detail($id) {
		$this->data['notice_data'] = $this->notice_model->getNoticeById($id);
		$this->data['page'] = 'Notice Detail';
		$this->data['view'] = 'admin/notice/notice_detail';
		$this->load->view('admin/admin_master', $this->data);
	}

	public function event_detail($id) {
		$this->data['notice_data'] = $this->notice_model->getNoticeById($id);
		$this->data['page'] = 'Event Detail';
		$this->data['view'] = 'admin/event/event_detail';
		$this->load->view('admin/admin_master', $this->data);
	}

}
