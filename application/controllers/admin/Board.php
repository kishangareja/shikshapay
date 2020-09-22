<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->db->checkadminlogin();
		$this->load->model('admin_model');
		$this->data['page'] = 'Board';
		$this->data['title'] = '';
		$this->data['ajax_order_by'] = json_encode(array());
	}

	public function index() {
		$this->data['view'] = 'admin/board/list';
		$this->data['ajax_order_by'] = json_encode(array());
		$this->load->view('admin/admin_master', $this->data);
	}

	public function ajax_list() {
		is_ajax();
		$this->data['ajax_order_by'] = json_encode(array(0, 3));

		$column_order = array(null, 'board_type', 'board_name', 'status', ''); //set column field database for datatable orderable
		$column_search = array('board_type', 'board_name', 'status'); //set column field database for datatable searchable
		$order_by = array('id' => 'desc'); // default order

		$select_arr = array('id', 'board_type', 'board_name', 'status');
		$select = json_encode($select_arr);
		$join_json = json_encode(array());

		$where_json = json_encode(array());

		$data['list'] = $this->common->get_datatables($this->common->getBoardTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
		$ajax_data = $this->load->view('admin/board/ajax_list', $data, true);

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->common->count_all($this->common->getBoardTable(), $join_json, $where_json, true),
			"recordsFiltered" => $this->common->count_filtered($this->common->getBoardTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
			"data" => json_decode($ajax_data),
		);

		echo json_encode($output);
	}

	public function ajax_add_board() {
		is_ajax();
		$id = $this->input->post('board_id') + 0;
		$this->data['board_data'] = $this->admin_model->getBoardById($id);
		echo json_encode(array('view' => $this->load->view('admin/board/ajax_add', $this->data, true)));
	}

	public function add() {

		$id = $this->input->post('board_id') + 0;
		$this->form_validation->set_rules('board_name', 'Board Name', 'required');

		$success = $res = 0;
		if ($this->form_validation->run() == TRUE) {
			$board_name = trim($this->input->post('board_name'));
			$board = array(
				'board_name' => $board_name,
				'board_type' => $this->input->post('board_type'),
				'status' => $this->input->post('status'),
			);

			if ($id) {
				//Edit board
				if ($this->admin_model->updateBoard($id, $board)) {
					$success = 1;
					$this->session->set_flashdata('success', "Board Updated Successfully.");
				} else {
					$this->session->set_flashdata('error', "Error While Updateing Record.");
				}
			} else {
				if ($this->admin_model->getBoardByName($board_name)) {
					$this->session->set_flashdata('error', "Board Name is already exists.");
				} else {
					//Add board
					if ($res = $this->admin_model->addBoard($board)) {
						$success = 1;
						$this->session->set_flashdata('success', "Board Added Successfully.");
					} else {
						$this->session->set_flashdata('error', "Error While Inserting Record.");
					}
				}
			}
		}
		$err_arr = array('board_name' => form_error('board_name'));
		echo json_encode(array('success' => $success, 'key' => $res, 'error' => $err_arr));
	}

	public function delete($id = '') {
		$result = $this->admin_model->deleteBoard($id);
		if ($result) {
			$this->session->set_flashdata('success', 'Board Deleted Successfully.');
			redirect(base_url('admin/board'));
		} else {
			$this->session->set_flashdata('error', "Error While Deleting Record.");
			redirect(base_url('admin/board'));
		}
	}

}