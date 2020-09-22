<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {

    /**
     * Start Message
     */
    public function getMessageById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getMessageTable())->row();
    }

    public function addMessage($data) {
        return $this->db->insert($this->common->getMessageTable(), $data);
    }
    
    public function updateMessage($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getMessageTable(), $data);
    }

    public function deleteMessage($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getMessageTable());
    }

    /**
     * End Message
     */
}
