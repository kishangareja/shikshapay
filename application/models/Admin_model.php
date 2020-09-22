<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    /**
     * Start Board
     */
    public function addBoard($data) {
        return $this->db->insert($this->common->getBoardTable(), $data);
    }

    public function getBoard() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getBoardTable())->result();
    }

    public function getBoardById($id) {
        $this->db->where(array('id' => $id));
        return $this->db->get($this->common->getBoardTable())->row();
    }

    public function getBoardByName($name) {
        $this->db->where(array('board_name' => $name));
        return $this->db->get($this->common->getBoardTable())->row();
    }

    public function updateBoard($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getBoardTable(), $data);
    }

    public function deleteBoard($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getBoardTable());
    }

    /**
     * End Board
     */

    /**
     * Start Student Type
     */
    public function addStudentType($data) {
        return $this->db->insert($this->common->getStudentTypeTable(), $data);
    }

    public function getStudentTypeById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getStudentTypeTable())->row();
    }

    public function getStudentType() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getStudentTypeTable())->result();
    }

    public function getStudentTypeByName($name) {
        $this->db->where(array('name' => $name));
        return $this->db->get($this->common->getStudentTypeTable())->row();
    }

    public function updateStudentType($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getStudentTypeTable(), $data);
    }

    public function deleteStudentType($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getStudentTypeTable());
    }

    /**
     * End Student Type
     */

    /**
      start setting
     */
    public function addSetting($data) {
        return $this->db->insert($this->common->getSettingTable(), $data);
    }

    public function getSetting() {
//		$this->db->where('status', 1);
        return $this->db->get($this->common->getSettingTable())->row();
    }

    public function getSettingById($id) {
        $this->db->where(array('id' => $id));
        return $this->db->get($this->common->getSettingTable())->row();
    }

    public function updateSetting($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getSettingTable(), $data);
    }

    public function addChallanSetting($data) {
        return $this->db->insert($this->common->getChallanSettingTable(), $data);
    }

    public function getChallanSetting() {
        return $this->db->get($this->common->getChallanSettingTable())->row();
    }

    public function getChallanSettingById($id) {
        $this->db->where(array('id' => $id));
        return $this->db->get($this->common->getChallanSettingTable())->row();
    }

    public function updateChallanSetting($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getChallanSettingTable(), $data);
    }
    
    /**
      end setting
     */
}
