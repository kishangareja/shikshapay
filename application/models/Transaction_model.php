<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

	/**
	 * Start Transaction
	 */
	public function addTransaction($data) {
		$transaction_id = $this->db->insert($this->common->getTransactionTable(), $data);

		$notification_data = array(
			'user_id' => $_SESSION['student_id'],
			'user_type' => "student",
			'notification_id' => $transaction_id,
			'type' => 'transaction',
			'title' => 'Transaction',
		);
		$this->common->insertNotification($notification_data);
		return $transaction_id;
	}

	public function getTransaction() {
		$this->db->where('status', 1);
		return $this->db->get($this->common->getTransactionTable())->result();
	}

	public function getTransactionById($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->common->getTransactionTable())->row();
	}

	public function updateTransaction($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->common->getTransactionTable(), $data);
	}

	public function getTransactionByStudent($admission_no, $class_id, $installment_id) {
		$this->db->where('t.admission_no', $admission_no);
		$this->db->where('t.class_id', $class_id);
		$this->db->where('d.installment_id', $installment_id);
		$this->db->join($this->common->getPayFeeDetailTable() . ' AS d', 'd.payfee_id = t.txn_orderid', 'LEFT');
		return $this->db->get($this->common->getTransactionTable() . ' AS t')->row();
	}

	/**
	 * End Transaction
	 */

	/**
	 * Start Resolution Center
	 */
	public function addResolutionCenter($data) {
		return $this->db->insert($this->common->getResolutionCenterTable(), $data);
	}

	public function getResolutionCenter() {
		$this->db->where('status', 1);
		return $this->db->get($this->common->getResolutionCenterTable())->result();
	}

	public function getResolutionCenterById($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->common->getResolutionCenterTable())->row();
	}

	public function updateResolutionCenter($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->common->getResolutionCenterTable(), $data);
	}

	/**
	 * End Resolution Center
	 */
}
