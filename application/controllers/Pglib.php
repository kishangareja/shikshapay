<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pglib extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('transaction_model'));
    }

    public function fonepaisa() {
        // Add Transaction
        $transaction_data = array(
            'transaction_date' => date('Y-m-d'),
            'payment_type' => 'offline',
            'txn_orderid' => $_POST['payment_reference'],
            'pgorderid' => $_POST['invoice'],
            'payment_status' => $_POST['status'],
            'student_id' => $_SESSION['student_id'],
            'class_id' => $_SESSION['class_id'],
            'section_id' => $_SESSION['section_id'],
            'payment_gateway' => $_SESSION['payment_gateway'],
            'admission_no' => $_SESSION['admission_no'],
            'payfee_id' => $_SESSION['payfee_id']
        );
        $this->transaction_model->addTransaction($transaction_data);
        unset($_SESSION['payfee_id'], $_SESSION['admission_no'], $_SESSION['student_id'], $_SESSION['class_id'], $_SESSION['section_id'], $_SESSION['payment_gateway']);
        redirect('admin/transaction/history');
    }

    public function paytm() {
        require_once APPPATH . 'third_party/paytm/config_paytm.php';
        require_once APPPATH . 'third_party/paytm/encdec_paytm.php';

        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";

        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
        //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

        if ($isValidChecksum == "TRUE") {
            //echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
            if ($_POST["STATUS"] == "TXN_SUCCESS") {
                //echo "<b>Transaction status is success</b>" . "<br/>";
                //Process your transaction here as success transaction.
                //Verify amount & order id received from Payment gateway with your application's order id and amount.
                //Add Transaction
                $transaction_data = array(
                    'transaction_date' => date('Y-m-d'),
                    'payment_type' => 'offline',
                    'txn_orderid' => $_POST['ORDERID'],
                    'pgorderid' => $_POST['TXNID'],
                    'payment_status' => 'S',
                    'student_id' => $_SESSION['student_id'],
                    'class_id' => $_SESSION['class_id'],
                    'section_id' => $_SESSION['section_id'],
                    'payment_gateway' => $_SESSION['payment_gateway'],
                    'admission_no' => $_SESSION['admission_no'],
                    'payfee_id' => $_SESSION['payfee_id']
                );
                $this->transaction_model->addTransaction($transaction_data);
                unset($_SESSION['payfee_id'], $_SESSION['admission_no'], $_SESSION['student_id'], $_SESSION['class_id'], $_SESSION['section_id'], $_SESSION['payment_gateway']);
                redirect('admin/transaction/history');
            } else {
                echo "<b>Transaction status is failure</b>" . "<br/>";
                redirect('admin/payfee/pay');
            }
        } else {
            echo "<b>Checksum mismatched.</b>";
            redirect('admin/payfee/pay');
        }
    }

    public function ebs() {
        $ebs = $this->common->getPayGatewayByPG('ebs');
        $secret_key = $ebs->key;  // Pass Your Registered Secret Key from EBS secure Portal
        if (isset($_REQUEST)) {
            $response = $_REQUEST;
            $sh = $response['SecureHash'];
            $params = $secret_key;
            ksort($response);
            foreach ($response as $key => $value) {
                if (strlen($value) > 0 and $key != 'SecureHash') {
                    $params .= '|' . $value;
                }
            }

            $hashValue = strtoupper(hash("sha512", $params)); // for SHA512
            if ($sh != $hashValue){
                echo "<center><h3>Hash validation Failed!</H3></center>";
                redirect('admin/payfee/pay');
            }
            if ($response) {
                //echo '<pre>';print_r($response);die;
                unset($_SESSION['payfee_id'], $_SESSION['admission_no'], $_SESSION['student_id'], $_SESSION['class_id'], $_SESSION['section_id'], $_SESSION['payment_gateway']);
                redirect('admin/transaction/history');
            }
        }
    }

    public function payumoney() {
        $status = $_POST["status"];
        $firstname = $_POST["firstname"];
        $amount = $_POST["amount"];
        $txnid = $_POST["txnid"];
        $posted_hash = $_POST["hash"];
        $key = $_POST["key"];
        $productinfo = $_POST["productinfo"];
        $email = $_POST["email"];
        $salt = "";

        $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;

        $hash = hash("sha512", $retHashSeq);
        if ($hash != $posted_hash) {
            echo "Invalid Transaction. Please try again";
            redirect('admin/payfee/pay');
        } else {

            //Add Transaction
            $transaction_data = array(
                'transaction_date' => date('Y-m-d'),
                'payment_type' => 'offline',
                'txn_orderid' => "PUMORD" . rand(10000, 99999999),
                'pgorderid' => $txnid,
                'payment_status' => $status,
                'student_id' => $_SESSION['student_id'],
                'class_id' => $_SESSION['class_id'],
                'section_id' => $_SESSION['section_id'],
                'payment_gateway' => $_SESSION['payment_gateway'],
                'admission_no' => $_SESSION['admission_no'],
                'payfee_id' => $_SESSION['payfee_id']
            );
            $this->transaction_model->addTransaction($transaction_data);
            unset($_SESSION['payfee_id'], $_SESSION['admission_no'], $_SESSION['student_id'], $_SESSION['class_id'], $_SESSION['section_id'], $_SESSION['payment_gateway']);
            redirect('admin/transaction/history');
        }
    }

    public function worldline() {
        include APPPATH . 'third_party/worldline/AWLMEAPI.php';
        $worldline = $this->common->getPayGatewayByPG('worldline');
        //create an Object of the above included class
        $obj = new AWLMEAPI();

        /* This is the response Object */
        $resMsgDTO = new ResMsgDTO();

        /* This is the request Object */
        $reqMsgDTO = new ReqMsgDTO();

        //This is the Merchant Key that is used for decryption also
        $enc_key = $worldline->key;

        /* Get the Response from the WorldLine */
        $responseMerchant = $_REQUEST['merchantResponse'];

        $response = $obj->parseTrnResMsg($responseMerchant, $enc_key);
        
        //Add Transaction
        if($response->getStatusCode() == 'S'){
            $transaction_data = array(
                'transaction_date' => date('Y-m-d'),
                'payment_type' => 'offline',
                'txn_orderid' => $response->getOrderId(),
                'pgorderid' => $response->getPgMeTrnRefNo(),
                'payment_status' => $response->getStatusCode(),
                'student_id' => $_SESSION['student_id'],
                'class_id' => $_SESSION['class_id'],
                'section_id' => $_SESSION['section_id'],
                'payment_gateway' => $_SESSION['payment_gateway'],
                'admission_no' => $_SESSION['admission_no'],
                'payfee_id' => $_SESSION['payfee_id']
            );
            $this->transaction_model->addTransaction($transaction_data);
            unset($_SESSION['payfee_id'], $_SESSION['admission_no'], $_SESSION['student_id'], $_SESSION['class_id'], $_SESSION['section_id'], $_SESSION['payment_gateway']);
            redirect('admin/transaction/history');
        }
    }

}
