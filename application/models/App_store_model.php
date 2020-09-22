<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App_store_model extends CI_Model {

    /**
     * Start App Store
     */
    public function addAppStore($data) {
        return $this->db->insert($this->common->getAppStoreTable(), $data);
    }

    public function getAppStore() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getAppStoreTable())->result();
    }

    public function getAppStoreById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getAppStoreTable())->row();
    }

    public function updateAppStore($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getAppStoreTable(), $data);
    }

    public function deleteAppStore($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getAppStoreTable());
    }

    /**
     * End App Store
     */
}
