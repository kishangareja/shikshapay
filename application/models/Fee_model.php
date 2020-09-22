<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fee_model extends CI_Model {

    /**
     * Start Fee Type
     */
    public function addFeeType($data) {
        return $this->db->insert($this->common->getFeeTypeTable(), $data);
    }

    public function getFeeType() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getFeeTypeTable())->result();
    }

    public function getFeeTypeById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getFeeTypeTable())->row();
    }

    public function getFeeTypeByName($name) {
        $this->db->where('name', $name);
        return $this->db->get($this->common->getFeeTypeTable())->row();
    }

    public function updateFeeType($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getFeeTypeTable(), $data);
    }

    public function deleteFeeType($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getFeeTypeTable());
    }

    public function getFeeStructureClassByFeeType($fee_type_id) {
        $this->db->select('f.*, c.class_id');
        $this->db->where('f.fee_type_id', $fee_type_id);
        $this->db->where('f.is_deleted', 0);
        $this->db->where('c.is_deleted', 0);
        $this->db->group_by('c.class_id');
        $this->db->join($this->common->getFeeStructureClassTable() . ' AS c', 'c.fee_structure_id = f.id', 'LEFT');
        return $this->db->get($this->common->getFeeStructureTable() . ' AS f')->result();
    }

    /**
     * End Fee Type
     */

    /**
     * Start Head
     */
    public function addHead($data) {
        return $this->db->insert($this->common->getHeadTypeTable(), $data);
    }

    public function getHead() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getHeadTypeTable())->result();
    }

    public function getHeadById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getHeadTypeTable())->row();
    }

    public function getHeadByName($name) {
        $this->db->where('name', $name);
        return $this->db->get($this->common->getHeadTypeTable())->row();
    }

    public function updateHead($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getHeadTypeTable(), $data);
    }

    public function deleteHead($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getHeadTypeTable());
    }

    /**
     * End Head
     */

    /**
     * Start FeeInstallment
     */
    public function addFeeInstallment($data) {
        return $this->db->insert($this->common->getFeeInstallmentTable(), $data);
    }

    public function getFeeInstallment() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getFeeInstallmentTable())->result();
    }

    public function getFeeInstallmentById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getFeeInstallmentTable())->row();
    }

    public function getLateFeeInstallmentById($id, $date) {
        $late_fee = 0;
        if ($data = $this->getFeeInstallmentById($id)) {

            $end_date = date("Y-m-d", strtotime($data->fee_range_end));
            $fee_range_start = $data->fee_range_start;
            $fee_range_end = $data->fee_range_end;
            if ($data->late_fee_type == 'one_time') {
                if ($end_date <= $date) {
                    $late_fee = $data->late_fee_amount;
                }
            }
            if ($data->late_fee_type == 'daily') {
                $late_fee = $this->late_fee_calc('day', $date, $end_date, $data->late_fee_amount);
            }
            if ($data->late_fee_type == 'monthly') {
                $late_fee = $this->late_fee_calc('month', $date, $end_date, $data->late_fee_amount);
            }
            if ($data->late_fee_type == 'yearly') {
                $late_fee = $this->late_fee_calc('year', $date, $end_date, $data->late_fee_amount);
            }
            if ($data->late_fee_type == 'quarterly') {
                $late_fee = $this->get_start_and_end_date('quarter_' . $this->getQuarter($data->fee_range_end), $date, $end_date, $data->late_fee_amount);
            }

            if ($fee_range_start >= $date && $fee_range_end <= $date) {
                $late_fee = 0;
            }
        }
        return $late_fee;
    }

    public function late_fee_calc($day, $date, $end_date, $amount) {
        $fee_amt = $amount;
        if ($end_date >= $date) {
            $fee_amt = $fee_amt - $amount;
        } else {
            $end_date = date('Y-m-d', strtotime("+1 $day", strtotime($end_date)));
            $fee_amt += $this->late_fee_calc($day, $date, $end_date, $fee_amt);
        }
        return $fee_amt;
    }

    function get_start_and_end_date($case, $date, $end_date, $amount) {

        $fee_amt = $amount;
        $day = date('d', strtotime($end_date));
        switch ($case) {
            default :
            case 'quarter_1' : $end_date = date("Y-3-$day");
                break;
            case 'quarter_2' : $end_date = date("Y-6-$day");
                break;
            case 'quarter_3' : $end_date = date("Y-9-$day");
                break;
            case 'quarter_4' : $end_date = date("Y-12-$day");
                break;
        }

        $fee_range_end = strtotime(date($end_date));
        $date1 = strtotime(date("Y-m-d", strtotime($date)));

        if ($fee_range_end >= $date1) {
            $fee_amt = $fee_amt - $amount;
        } else {
            $date1 = date('Y-m-d', strtotime($date));
            $fee_range_end = date('Y-m-d', strtotime("+3 month", strtotime(date($end_date))));
            $fee_amt += $this->get_start_and_end_date('quarter_' . $this->getQuarter($fee_range_end), $date1, $fee_range_end, $fee_amt);
        }
        return $fee_amt;
    }

    public function getQuarter($date) {
        $quarter = 0;
        if ($data = $this->db->query("SELECT QUARTER('$date') AS quarter")->row()) {
            $quarter = $data->quarter;
        }
        return $quarter;
    }

    public function getFeeInstallmentByName($name) {
        $this->db->where('name', $name);
        return $this->db->get($this->common->getFeeInstallmentTable())->row();
    }

    public function updateFeeInstallment($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getFeeInstallmentTable(), $data);
    }

    public function deleteFeeInstallment($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getFeeInstallmentTable());
    }

    /**
     * End Fee Installment
     */

    /**
     * Start Fee Structure
     */
    public function addFeeStructure($data) {
        return $this->db->insert($this->common->getFeeStructureTable(), $data);
    }

    public function getFeeStructure() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getFeeStructureTable())->result();
    }

    public function getFeeStructureById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getFeeStructureTable())->row();
    }

    public function getFeeStructureByInstallmentWithClass($installment_id, $class_id, $fee_form_type) {
        $this->db->where('fee_installment_id', $installment_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('fee_form_type', $fee_form_type);
        return $this->db->get($this->common->getFeeStructureClassTable())->result();
    }

    public function getFeeStructureByName($name) {
        $this->db->where('fee_structure_name', $name);
        return $this->db->get($this->common->getFeeStructureTable())->row();
    }

    public function updateFeeStructure($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getFeeStructureTable(), $data);
    }

    public function deleteFeeStructure($id, $fee_form_type) {
        $this->deleteFeeStructureClass($id, $fee_form_type);
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getFeeStructureTable());
    }

    public function addFeeStructureClass($data) {
        return $this->db->insert($this->common->getFeeStructureClassTable(), $data);
    }

    public function getFeeStructureClass($fee_structure_id, $fee_form_type) {
        $this->db->where('fee_structure_id', $fee_structure_id);
        $this->db->where('fee_form_type', $fee_form_type);
        return $this->db->get($this->common->getFeeStructureClassTable())->result();
    }

    public function updateFeeStructureClass($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getFeeStructureClassTable(), $data);
    }

    public function deleteFeeStructureClass($id, $fee_form_type) {
        $this->db->where('fee_structure_id', $id);
        $this->db->where('fee_form_type', $fee_form_type);
        return $this->db->delete($this->common->getFeeStructureClassTable());
    }

    /**
     * End Fee Structure
     */

    /**
     * Start Bulk Fee Concession
     */
    public function addBulkConcession($data) {
        return $this->db->insert($this->common->getFeeConcessionBulkTable(), $data);
    }

    public function getBulkConcession() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getFeeConcessionBulkTable())->result();
    }

    public function getBulkConcessionById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->common->getFeeConcessionBulkTable())->row();
    }

    public function updateBulkConcession($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getFeeConcessionBulkTable(), $data);
    }

    public function deleteBulkConcession($id, $fee_form_type) {
        $this->deleteFeeStructureClass($id, $fee_form_type);
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getFeeConcessionBulkTable());
    }

    /**
     * End Bulk Fee Concession
     */

    /**
     * Start Single Fee Concession
     */
    public function addSingleConcession($data) {
        return $this->db->insert($this->common->getFeeConcessionSingleTable(), $data);
    }

    public function getSingleConcession() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getFeeConcessionSingleTable())->result();
    }

    public function getSingleConcessionById($id) {
        $this->db->select('f.*, s.fullname, s.role_no, c.class_name, c.id AS class_id, se.section_name');
        $this->db->where('f.id', $id);
        $this->db->where('f.is_deleted', 0);
        $this->db->join($this->common->getStudentTable() . ' AS s', 's.registration_id = f.admission_no', 'LEFT');
        $this->db->join($this->common->getClassTable() . ' AS c', 'c.id = s.class_id', 'LEFT');
        $this->db->join($this->common->getSectionTable() . ' AS se', 'se.id = s.section_id', 'LEFT');
        return $this->db->get($this->common->getFeeConcessionSingleTable() . ' AS f')->row();
    }

    public function updateSingleConcession($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getFeeConcessionSingleTable(), $data);
    }

    public function deleteSingleConcession($id, $fee_form_type) {
        $this->deleteFeeStructureClass($id, $fee_form_type);
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getFeeConcessionSingleTable());
    }

    /**
     * End Single Fee Concession
     */

    /**
     * Start Additional Fee
     */
    public function addAdditionalFee($data) {
        return $this->db->insert($this->common->getAdditionalFeeTable(), $data);
    }

    public function getAdditionalFee() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getAdditionalFeeTable())->result();
    }

    public function getAdditionalFeeById($id) {
        $this->db->select('f.*, s.fullname, s.role_no, c.class_name, c.id AS class_id, se.section_name');
        $this->db->where('f.id', $id);
        $this->db->where('f.is_deleted', 0);
        $this->db->join($this->common->getStudentTable() . ' AS s', 's.registration_id = f.admission_no', 'LEFT');
        $this->db->join($this->common->getClassTable() . ' AS c', 'c.id = s.class_id', 'LEFT');
        $this->db->join($this->common->getSectionTable() . ' AS se', 'se.id = s.section_id', 'LEFT');
        return $this->db->get($this->common->getAdditionalFeeTable() . ' AS f')->row();
    }

    public function updateAdditionalFee($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getAdditionalFeeTable(), $data);
    }

    public function deleteAdditionalFee($id, $fee_form_type) {
        $this->deleteFeeStructureClass($id, $fee_form_type);
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getAdditionalFeeTable());
    }

    /**
     * End Additional Fee
     */

    /**
     * Start Pay Fee
     */
    public function addPayFee($data) {
        return $this->db->insert($this->common->getPayFeeTable(), $data);
    }

    public function addPayFeeDetail($data) {
        return $this->db->insert($this->common->getPayFeeDetailTable(), $data);
    }

    public function getPayFee() {
        $this->db->where('status', 1);
        return $this->db->get($this->common->getPayFeeTable())->result();
    }

    public function getPayFeeById($id) {
        $this->db->select('f.*, s.fullname, s.role_no, c.class_name, c.id AS class_id, se.section_name');
        $this->db->where('f.id', $id);
        $this->db->where('f.is_deleted', 0);
        $this->db->join($this->common->getStudentTable() . ' AS s', 's.registration_id = f.admission_no', 'LEFT');
        $this->db->join($this->common->getClassTable() . ' AS c', 'c.id = s.class_id', 'LEFT');
        $this->db->join($this->common->getSectionTable() . ' AS se', 'se.id = s.section_id', 'LEFT');
        return $this->db->get($this->common->getPayFeeTable() . ' AS f')->row();
    }

    public function updatePayFee($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->common->getPayFeeTable(), $data);
    }

    public function deletePayFee($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->common->getPayFeeTable());
    }

    /**
     * End Additional Fee
     */
}
