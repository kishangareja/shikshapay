<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App_store extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->db->checkadminlogin();
		$this->load->model(array('app_store_model', 'gateway_model'));
		$this->data['page'] = 'App Store';
		$this->data['title'] = '';
		$this->data['ajax_order_by'] = json_encode(array());
	}

	public function index() {
		$this->data['view'] = 'admin/app_store/list';
		$this->data['ajax_order_by'] = json_encode(array());
		$this->load->view('admin/admin_master', $this->data);
	}

	public function ajax_list() {
		is_ajax();
		$this->data['ajax_order_by'] = json_encode(array(0, 3));

		$column_order = array('image', 'title', 'name', 'short_desc', 'amount', 'status', ''); //set column field database for datatable orderable
		$column_search = array('image', 'title', 'name', 'short_desc', 'amount', 'status'); //set column field database for datatable searchable
		$order_by = array('id' => 'desc'); // default order

		$select_arr = array('id', 'image', 'title', 'name', 'short_desc', 'amount', 'status');
		$select = json_encode($select_arr);
		$join_json = json_encode(array());

		$where_json = json_encode(array());

		$data['list'] = $this->common->get_datatables($this->common->getAppStoreTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by);
		$ajax_data = $this->load->view('admin/app_store/ajax_list', $data, true);

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->common->count_all($this->common->getAppStoreTable(), $join_json, $where_json, true),
			"recordsFiltered" => $this->common->count_filtered($this->common->getAppStoreTable(), $select, $join_json, $where_json, $column_order, $column_search, $order_by),
			"data" => json_decode($ajax_data),
		);

		echo json_encode($output);
	}

	public function add($id = 0) {

		$this->data['id'] = $id;
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('short_desc', 'Short Description', 'required');
		$this->form_validation->set_rules('amount', 'Credit', 'required');

		$this->data['premium_module'] = $this->gateway_model->getAllGateway();
		if ($id) {
			$this->data['app_store'] = $this->app_store_model->getAppStoreById($id);
		}

		$success = 0;
		if ($this->form_validation->run() == TRUE) {
			$app = array(
				'title' => $this->input->post('title'),
				'name' => $this->input->post('name'),
				'short_desc' => $this->input->post('short_desc'),
				'amount' => $this->input->post('amount'),
				'description' => $this->input->post('description'),
				'status' => $this->input->post('status'),
			);

			if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
				$temp_file = $_FILES['image']['tmp_name'];

				$img_name = "app_" . mt_rand(10000, 999999999) . time();
				$path = $_FILES['image']['name'];

				$ext = pathinfo($path, PATHINFO_EXTENSION);

				$app['image'] = $img_name . "." . $ext;
				$url = APPSTORE . $app['image'];
				$this->db->compress_image($temp_file, $url, 80);
			}

			if ($id) {
				//Edit App Store
				if ($this->app_store_model->updateAppStore($id, $app)) {
					$success = 1;
					$this->session->set_flashdata('success', "App Store Updated Successfully.");
				} else {
					$this->session->set_flashdata('error', "Error While Updateing Record.");
				}
			} else {
				//Add App Store
				if ($res = $this->app_store_model->addAppStore($app)) {
					$success = 1;
					$this->session->set_flashdata('success', "App Store Added Successfully.");
				} else {
					$this->session->set_flashdata('error', "Error While Inserting Record.");
				}
			}
			redirect('admin/app_store');
		}
		$this->data['view'] = 'admin/app_store/add';
		$this->load->view('admin/admin_master', $this->data);
	}

	public function delete($id = '') {
		$result = $this->app_store_model->deleteAppStore($id);
		if ($result) {
			$this->session->set_flashdata('success', 'App Store Deleted Successfully.');
		} else {
			$this->session->set_flashdata('error', "Error While Deleting Record.");
		}
		redirect(base_url('admin/app_store'));
	}

}
