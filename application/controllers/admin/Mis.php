<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mis extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->db->checkadminlogin();
        $this->load->model(array('class_model', 'student_model', 'fee_model', 'transaction_model'));
        $this->data['title'] = '';
        $this->data['ajax_order_by'] = json_encode(array());
    }

    public function index() {
        $this->data['page'] = 'MIS';
        $this->data['installment_data'] = $this->fee_model->getFeeInstallment();
        $this->data['class_data'] = $this->class_model->getClass();
        $this->data['view'] = 'admin/mis/mis';
        $this->load->view('admin/admin_master', $this->data);
    }

    public function upload() {
        if (isset($_FILES['upload_mis']['name']) && $_FILES['upload_mis']['error'] == 0) {

            $file = fopen($_FILES['upload_mis']['tmp_name'], "r");
            while (!feof($file)) {
                $csv[] = fgetcsv($file);
            }
            fclose($file);
            if (isset($csv) && $csv) {
                for ($i = 1; $i < (count($csv) - 1); $i++) {
                    $bank_amount = isset($csv[$i][8]) ? $csv[$i][8] : 0;
                    if ($bank_amount) {
                        $admission_no = isset($csv[$i][0]) ? $csv[$i][0] : '';
                        $installment = isset($csv[$i][1]) ? $csv[$i][1] : '';
                        $class = isset($csv[$i][2]) ? $csv[$i][2] : '';
                        $fee_amount = isset($csv[$i][3]) ? $csv[$i][3] : 0;
                        $additional_fee = isset($csv[$i][4]) ? $csv[$i][4] : 0;
                        $late_fee = isset($csv[$i][5]) ? $csv[$i][5] : 0;
                        $concession_fee = isset($csv[$i][6]) ? $csv[$i][6] : 0;
                        $total = isset($csv[$i][7]) ? $csv[$i][7] : 0;

                        if ($student = $this->student_model->getStudentDetailByNo($admission_no)) {

                            $payfee_data = array(
                                'admission_no' => $admission_no,
                                'concession_type' => 'single',
                                'fee_amount' => $fee_amount,
                                'additional_fee' => $additional_fee,
                                'late_fee' => $late_fee,
                                'concession_amount' => $concession_fee,
                                'carry_forward_amount' => $bank_amount - $total,
                                'payable_amount' => $bank_amount,
                                'payment_by' => 'cash'
                            );

                            $payfee_id = $this->fee_model->addPayFee($payfee_data);
                            if (isset($class) && $class) {
                                $installments = $this->fee_model->getFeeInstallmentByName($installment);
                                $installment_id = $installments ? $installments->id : 0;

                                $classes = $this->class_model->getClassByName($class);
                                $class_id = $classes ? $classes->id : 0;

                                if ($fee_structure_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment_id, $class_id, 'fee_structure')) {

                                    foreach ($fee_structure_class as $value) {
                                        $fee_structure_detail = array(
                                            'payfee_id' => $payfee_id,
                                            'class_id' => $class_id,
                                            'installment_id' => $installment_id,
                                            'payfee_head_json' => $value->fee_head_json,
                                            'fee_form_type' => 'fee_structure'
                                        );
                                        $this->fee_model->addPayFeeDetail($fee_structure_detail);
                                    }
                                }
                                if ($additional_fee_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment_id, $class_id, 'additional_fee')) {
                                    foreach ($additional_fee_class as $value) {
                                        $fee_structure_detail = array(
                                            'payfee_id' => $payfee_id,
                                            'class_id' => $class_id,
                                            'installment_id' => $installment_id,
                                            'payfee_head_json' => $value->fee_head_json,
                                            'fee_form_type' => 'additional_fee'
                                        );
                                        $this->fee_model->addPayFeeDetail($fee_structure_detail);
                                    }
                                }
                                if ($single_concession_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment_id, $class_id, 'single_concession')) {
                                    foreach ($single_concession_class as $value) {
                                        $fee_structure_detail = array(
                                            'payfee_id' => $payfee_id,
                                            'class_id' => $class_id,
                                            'installment_id' => $installment_id,
                                            'payfee_head_json' => $value->fee_head_json,
                                            'fee_form_type' => 'single_concession'
                                        );
                                        $this->fee_model->addPayFeeDetail($fee_structure_detail);
                                    }
                                }

                                // Add Transaction
                                $transaction_data = array(
                                    'transaction_date' => date('Y-m-d'),
                                    'payment_type' => 'offline',
                                    'txn_orderid' => $payfee_id . '/' . time() . rand(00, 99) . rand(000, 999),
                                    'pgorderid' => $payfee_id . '/' . time() . rand(00, 99) . rand(000, 999),
                                    'admission_no' => $admission_no,
                                    'student_id' => $student->id,
                                    'class_id' => $student->class_id,
                                    'section_id' => $student->section_id
                                );
                                $this->transaction_model->addTransaction($transaction_data);
                            }
                        }
                    }
                }
            }
        }
        redirect('admin/transaction/history');
    }

    public function download() {
        $this->data['page'] = 'MIS Download';
        $this->data['installment_data'] = $this->fee_model->getFeeInstallment();
        $this->data['class_data'] = $this->class_model->getClass();
        $this->data['view'] = 'admin/mis/mis_download';

        $this->form_validation->set_rules('install_id[]', 'Installament', 'required');
        $this->form_validation->set_rules('class_id', 'Class', 'required');

        if ($this->form_validation->run() == TRUE) {
            $FileName = 'mis-template';
            $header = array('Admission No', 'Installment', 'Class', 'Fee Amount', 'Additional Fee', 'Late Fee', 'Concession Amount', 'Total', 'Bank Amount');
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename=' . $FileName . '.csv');
            header('Pragma: no-cache');
            header("Expires: 0");
            $outstream = fopen("php://output", "w");
            fputcsv($outstream, $header);

            $class_id = $this->input->post('class_id');
            if ($installments = $this->input->post('install_id')) {
                $fee_installment = array();
                $student_class = $this->student_model->getStudentDetailByClass($class_id);
                foreach ($installments as $installment) {
                    $fee_amount = $additional_fee = $concession_fee = $late_fee = 0;
                    $installment_data = $this->fee_model->getFeeInstallmentById($installment);
                    if ($fee_structure_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment, $class_id, 'fee_structure')) {
                        foreach ($fee_structure_class as $value) {
                            $fee_installment = json_decode($value->fee_head_json);
                            $fee_amount = array_sum($fee_installment->amount);
                        }
                    }
                    if ($additional_fee_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment, $class_id, 'additional_fee')) {
                        foreach ($additional_fee_class as $value) {
                            $fee_installment = json_decode($value->fee_head_json);
                            $additional_fee = array_sum($fee_installment->amount);
                        }
                    }
                    if ($concession_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment, $class_id, 'single_concession')) {
                        foreach ($concession_class as $value) {
                            $fee_installment = json_decode($value->fee_head_json);
                            $concession_fee = array_sum($fee_installment->amount);
                        }
                    }
                    $late_fee = $this->fee_model->getLateFeeInstallmentById($installment, date('Y-m-d'));
                    $total = $fee_amount + $additional_fee + $concession_fee + $late_fee;
                    foreach ($student_class as $key => $rows) {
                        $transaction = $this->transaction_model->getTransactionByStudent($rows->registration_id, $class_id, $installment);
                        if (!$transaction) {
                            $row = array(
                                $rows->registration_id,
                                $installment_data->name,
                                $rows->class_name,
                                $fee_amount,
                                $additional_fee,
                                $late_fee,
                                $concession_fee,
                                $total
                            );
                            fputcsv($outstream, $row);
                        }
                    }
                }
            }

            fclose($outstream);
            exit();
        }

        $this->load->view('admin/admin_master', $this->data);
    }

}
