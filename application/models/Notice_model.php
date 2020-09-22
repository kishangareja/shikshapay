<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notice_model extends CI_Model {

	/**
	 * Start Message
	 */
	public function getAllNotice($type) {

		$result = $this->db->where('type', $type)->get($this->common->getNoticeTable())->result();
		if ($result) {
			foreach ($result as $key => $value) {
				$result[$key] = $value;
				if ($value->user_type == "institution") {
					$institution_data = $this->institution_model->getInstitutionById($value->user_id);
					$result[$key]->institution_name = $institution_data->institution_name;
				} else {
					$institution_data = $this->student_model->getStudentById($value->user_id);
					$result[$key]->institution_name = $institution_data->registration_id;
				}
			}
		}
		return $result;
	}

	public function addNotice($data) {
		return $this->db->insert($this->common->getNoticeTable(), $data);
	}

	public function addEvent($data) {
		return $this->db->insert($this->common->getNoticeTable(), $data);
	}

	public function getNoticeById($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->common->getNoticeTable())->row();
	}

	/**
	 * End Message
	 */
}
