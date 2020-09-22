<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data['page'] = 'Home';
        $this->data['title'] = 'Home';
        $this->load->model(array('app_store_model'));
    }

    function index() {
        $this->data['view'] = 'home';
        $this->load->view('template', $this->data);
    }
    
    function apps() {
        $this->data['view'] = 'apps';
        $this->data['apps_data'] = $this->app_store_model->getAppStore();
        $this->load->view('template', $this->data);
    }
    
    public function app_detail($id = 0) {
        $this->data['page'] = 'App Detail';
        $this->data['view'] = 'app_detail';
        $this->data['apps_data'] = $this->app_store_model->getAppStoreById($id);
        $this->load->view('template', $this->data);
    }
}
