<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Institution_model extends CI_Model {
	/**
	 * Start Institution
	 */
	public function addInstitution($data) {
		return $this->db->insert($this->common->getInstitutionTable(), $data);
	}

	public function getInstitution() {
		$this->db->where('status', 1);
		return $this->db->get($this->common->getInstitutionTable())->result();
	}

	public function getInstitutionById($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->common->getInstitutionTable())->row();
	}

	public function updateInstitution($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->common->getInstitutionTable(), $data);
	}

	public function deleteInstitution($id) {
		$this->db->where('id', $id);
		return $this->db->delete($this->common->getInstitutionTable());
	}

	public function getCityState($pincode) {
		$this->db->where('pincode', $pincode);
		return $this->db->get($this->common->getPincodeTable())->row();
	}
	/**
	 * End Institution
	 */
}
