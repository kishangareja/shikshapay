<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	/**
	 * Start Admin
	 */
	public function getAdminLogin($email, $pwd) {
		$this->db->where('email_id', $email);
		$this->db->where('password', $pwd);
		return $this->db->get($this->common->getAdminTable())->row();
	}

	public function getAdminData() {
		$this->db->where('admin_id', 1);
		return $this->db->get($this->common->getAdminTable())->row();
	}

	public function updateAdminData($id, $data) {
		$this->db->where('admin_id', $id);
		$this->db->update($this->common->getAdminTable(), $data);
	}

	public function addAdmin($data) {
		return $this->gdb->insert($this->common->getAdminTable(), $data);
	}

	public function getAdminByEmail($email) {
		$this->db->where('email_id', $email);
		return $this->db->get($this->common->getAdminTable())->row();
	}

	public function verifyOtp($email, $password, $otp) {
		$this->db->where('email_id', $email);
		$this->db->where('password', $password);
		$this->db->where('otp', $otp);
		return $this->db->get($this->common->getAdminTable())->row();
	}

	public function updateOtp($id, $data) {
		$this->db->where('admin_id', $id);
		$this->db->update($this->common->getAdminTable(), $data);
	}

	/**
	 * End Admin
	 */

	/**
	 * Start Institution
	 */
	public function getInstitutionLogin($type, $email, $pwd) {
		$this->db->where('institution_type', $type);
		$this->db->where('email', $email);
		$this->db->where('password', $pwd);
		$this->db->where('status', 1);
		return $this->db->get($this->common->getInstitutionTable())->row();
	}

	/**
	 * End Institution
	 */
}
