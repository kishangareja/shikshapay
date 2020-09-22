<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gateway_model extends CI_Model {

	/**
	 * Start Payment Gateway
	 */
	public function getPayGatewayById($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->common->getPayGatewayTable())->row();
	}

	public function addPayGateway($data) {
		return $this->db->insert($this->common->getPayGatewayTable(), $data);
	}

	public function updatePayGateway($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->common->getPayGatewayTable(), $data);
	}

	public function updatePayGatewayDefault($data) {
		$this->db->where('status', 1);
		return $this->db->update($this->common->getPayGatewayTable(), $data);
	}

	public function getAllGateway() {
		/* $this->db->select('*, gateway AS gateway_name');
			          $pay = $this->db->get($this->common->getPayGatewayTable())->result();
			          $this->db->select('*, gateway AS gateway_name');
			          $msg = $this->db->get($this->common->getMessageGatewayTable())->result();
		*/
		$this->db->select('*, name AS gateway_name');
		$this->db->where('status', 1);
		return $this->db->get($this->common->getGatewayTable())->result();
	}

	public function getGatewayByType($type) {
		$this->db->where('type', $type);
		$this->db->where('status', 1);
		return $this->db->get($this->common->getGatewayTable())->result();
	}

	public function getPayGateway() {
		return $this->db->get($this->common->getPayGatewayTable())->result();
	}

	public function deletePayGateway($id) {
		$this->db->where('id', $id);
		return $this->db->delete($this->common->getPayGatewayTable());
	}

	/**
	 * End Payment Gateway
	 */

	/**
	 * Start Message Gateway
	 */
	public function getTextMsgGatewayById($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->common->getMessageGatewayTable())->row();
	}

	public function addTextMsgGateway($data) {
		return $this->db->insert($this->common->getMessageGatewayTable(), $data);
	}

	public function updateTextMsgGateway($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->common->getMessageGatewayTable(), $data);
	}

	public function getTextMsgGatewayByStatus() {
		$this->db->where('is_default', 1);
		$this->db->where('status', 1);
		return $this->db->get($this->common->getMessageGatewayTable())->row();
	}

	public function getEmailMsgGatewayByStatus() {
		$this->db->where('is_default', 1);
		$this->db->where('status', 1);
		$this->db->where('gateway_type', 'email');
		return $this->db->get($this->common->getMessageGatewayTable())->row();
	}

	public function updateMsgGatewayDefault($gateway_type, $data) {
		$this->db->where('status', 1);
		$this->db->where('gateway_type', $gateway_type);
		return $this->db->update($this->common->getMessageGatewayTable(), $data);
	}

	public function deleteTextMsgGateway($id) {
		$this->db->where('id', $id);
		return $this->db->delete($this->common->getMessageGatewayTable());
	}

	/**
	 * End Message Gateway
	 */

/**
 * get all gateway by id
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
	public function getAllGatewayById($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->common->getGatewayTable())->row();
	}
	public function updateAllGateway($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->common->getGatewayTable(), $data);
	}

	/**
	 * author kishan
	 */
	public function getPayGatewayByName($name) {
		$this->db->where('gateway', $name);
		return $this->db->get($this->common->getPayGatewayTable())->row();
	}

	public function getGatewayByName($name) {
		$this->db->where('name', $name);
		return $this->db->get($this->common->getGatewayTable())->row();
	}
	public function getTextMsgGateway() {
		$this->db->where('gateway_type', 'mobile');
		return $this->db->get($this->common->getMessageGatewayTable())->result();
	}
}
