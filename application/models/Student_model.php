<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

    /**
     * Start Student
     */
    public function addStudent($data) {
        return $this->db->insert($this->common->getStudentTable(), $data);
    }

    public function getStudent() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getStudentTable())->result();
    }

    public function getStudentById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getStudentTable())->row();
    }

    public function updateStudent($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getStudentTable(), $data);
    }

    public function deleteStudent($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getStudentTable());
    }

    public function getStudentNo($class_id, $no) {
        $this->db->select('group_concat(registration_id) as registration_id');
        $this->db->like('registration_id', $no);
        if ($class_id)
            $this->db->where_in('class_id', $class_id);
        return $this->db->get($this->common->getStudentTable())->row();
    }

    public function getStudentDetailByNo($no) {
        $this->db->select('s.registration_id, s.id, s.fullname, s.father_name, s.role_no, c.class_name, c.id as class_id, se.section_name, se.id as section_id');
        $this->db->where('registration_id', $no);
        $this->db->where('s.is_deleted', 0);
        $this->db->join($this->common->getClassTable() . ' AS c', 'c.id = s.class_id', 'LEFT');
        $this->db->join($this->common->getSectionTable() . ' AS se', 'se.id = s.section_id', 'LEFT');
        $data = $this->db->get($this->common->getStudentTable() . ' AS s')->row();
        $detail = new stdClass();
        if ($data) {
            $detail = $data;
            $detail->installment = $this->getPayFeeDetail($data->registration_id);
        }
        return $detail;
    }

    public function getStudentDetailByClass($class_id) {
        $this->db->select('s.registration_id, s.id, s.fullname, s.role_no, c.class_name, c.id as class_id');
        $this->db->where('c.id', $class_id);
        $this->db->where('c.is_deleted', 0);
        $this->db->where('s.is_deleted', 0);
        $this->db->join($this->common->getClassTable() . ' AS c', 'c.id = s.class_id', 'LEFT');
        return $this->db->get($this->common->getStudentTable() . ' AS s')->result();
    }

    public function getPayFeeDetail($no) {
        $this->db->select('GROUP_CONCAT(DISTINCT d.installment_id) AS installments');
        $this->db->where('p.admission_no', $no);
        $this->db->where('p.is_deleted', 0);
        $this->db->where('d.is_deleted', 0);
        $this->db->join($this->common->getPayFeeDetailTable() . ' AS d', 'd.payfee_id = p.id', 'LEFT');
        $data = $this->db->get($this->common->getPayFeeTable() . ' AS p')->row();
        $installment_ids = array();
        if($data){
            $installment_ids = explode(",", $data->installments);
        }
        return $installment_ids;
    }

    /**
     * End Student
     */
}
