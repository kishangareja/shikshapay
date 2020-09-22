<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->db->checkadminlogin();
        $this->load->model(array('app_store_model', 'gateway_model'));
        $this->data['page'] = 'Apps';
        $this->data['title'] = '';
        $this->data['ajax_order_by'] = json_encode(array());
    }

    public function index() {
        $this->data['view'] = 'admin/apps/list';
        $this->data['apps_data'] = $this->app_store_model->getAppStore();
        $this->load->view('admin/admin_master', $this->data);
    }

    public function detail($id = 0) {
        $this->data['page'] = 'App Detail';
        $this->data['view'] = 'admin/apps/detail';
        $this->data['apps_data'] = $this->app_store_model->getAppStoreById($id);
        $this->load->view('admin/admin_master', $this->data);
    }
}
