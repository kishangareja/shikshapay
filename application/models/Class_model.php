<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Class_model extends CI_Model {

    /**
     * Start Class
     */
    public function addClass($data) {
        return $this->db->insert($this->common->getClassTable(), $data);
    }

    public function getClass() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getClassTable())->result();
    }

    public function getClassById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getClassTable())->row();
    }
    
    public function getClassByName($name) {
        $this->db->where('class_name', $name);
        return $this->db->get($this->common->getClassTable())->row();
    }

    public function updateClass($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getClassTable(), $data);
    }

    public function deleteClass($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getClassTable());
    }

    /**
     * End Class
     */

    /**
     * Start Class Detail
     */
    public function addClassDetail($data) {
        return $this->db->insert($this->common->getClassDetailTable(), $data);
    }

    public function getClassDetail($id) {
        $this->db->where('class_id', $id);
        return $this->db->get($this->common->getClassDetailTable())->result();
    }

    public function updateClassDetail($id, $section_id, $data) {
        $this->db->where('class_id', $id);
        $this->db->where('section_id', $section_id);
        return $this->db->update($this->common->getClassDetailTable(), $data);
    }

    public function deleteClassDetail($id) {
        $this->db->where('class_id', $id);
        return $this->db->delete($this->common->getClassDetailTable());
    }

    public function getClassDetailData($id) {
        $this->db->select('GROUP_CONCAT(s.id) AS section_id, GROUP_CONCAT(" ", s.section_name) AS section_name');
        $this->db->where('c.class_id', $id);
        $this->db->where('c.is_deleted', 0);
        $this->db->join($this->common->getSectionTable() . ' AS s', 's.id = c.section_id', 'LEFT');
        return $this->db->get($this->common->getClassDetailTable() . ' AS c')->row();
    }

    /**
     * End Class Detail
     */
}
