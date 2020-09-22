<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Section_model extends CI_Model {

    /**
     * Start Section
     */
    public function addSection($data) {
        return $this->db->insert($this->common->getSectionTable(), $data);
    }

    public function getSection() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getSectionTable())->result();
    }

    public function getSectionById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getSectionTable())->row();
    }

    public function updateSection($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getSectionTable(), $data);
    }

    public function deleteSection($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getSectionTable());
    }

    public function getSectionTypeData($type) {
        $this->db->where('status', 1);
        $this->db->where('section_type', $type);
        return $this->db->get($this->common->getSectionTable())->result();
    }

    public function getSectionByName($name) {
        $this->db->where('section_name', $name);
        return $this->db->get($this->common->getSectionTable())->row();
    }

    /**
     * End Section
     */
}
