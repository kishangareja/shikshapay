<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payfee extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->data['ajax_order_by'] = json_encode(array());
		$this->load->model(array('fee_model', 'transaction_model', 'gateway_model'));
		//$this->save[''] = array();
		$this->data['page'] = '';
		$this->data['title'] = '';
		$this->data['msg'] = '';
	}

	public function pay() {
		$this->data['page'] = 'Pay Fee';
		$this->data['title'] = 'Pay Fee';
		$this->data['view'] = 'admin/payfee/pay';

		$fee_structure_class = $this->fee_model->getFeeStructureClass(13, 'fee_structure');
		$fee_class = $fee_installment = array();
		foreach ($fee_structure_class as $value) {
			$fee_class[$value->class_id] = $value->class_id;
			$fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
		}

		$this->data['additional_fee_class'] = $fee_class;
		$this->data['additional_fee_installment'] = $fee_installment;

		$this->data['installments'] = $this->fee_model->getFeeInstallment();
		$this->data['head_types'] = $this->fee_model->getHead();
                $this->data['fee_type_data'] = $this->fee_model->getFeeType();
		$this->load->view('admin/admin_master', $this->data);
	}

	public function payby_challan() {
		require_once APPPATH . 'third_party/mpdf/autoload.php';
		$mpdf = new \Mpdf\Mpdf([
			'margin_left' => 5,
			'margin_right' => 5,
			'orientation' => 'L',
		]);

		$this->load->model(array('student_model', 'admin_model'));
		$payable_amount = $this->input->post('payable_amount');
		$register_no = $this->input->post('register_no');

		$data['amount'] = 0;
		$data['year'] = date('Y');
		$data['date'] = date('d-m-Y');
		if ($student = $this->student_model->getStudentDetailByNo($register_no)) {
			$data['amount'] = $payable_amount;
			$data['class_name'] = $student->class_name;
			$data['roll_no'] = $student->role_no;
			$data['student_name'] = $student->fullname;
			$data['father_name'] = $student->father_name;
		}

		if ($challan = $this->admin_model->getChallanSetting()) {
			$data['challan_title'] = $challan->challan_title;
			$data['bank_logo'] = $challan->bank_logo;
			$data['bank_title'] = $challan->bank_title;
			$data['school_logo'] = $challan->school_logo;
			$data['school_title'] = $challan->school_title;
			$data['bank_branch'] = $challan->bank_branch;
			$data['bank_name'] = $challan->bank_name;
			$data['notes'] = $challan->notes;
		}

		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Shikshapay Challan");
		$mpdf->SetAuthor("Shikshapay");
		$mpdf->SetDisplayMode('fullpage');
		$view = $this->load->view('admin/invoice/challan', $data, true);
		$mpdf->WriteHTML($view);
		$mpdf->Output();
	}

	public function ajax_popup_pay_proceed() {
		is_ajax();
		$success = 0;
                $this->form_validation->set_rules('fee_type', 'Fee Type', 'required');
		$this->form_validation->set_rules('register_no', 'Admission Number', 'required');
		if ($this->form_validation->run() == TRUE) {
			$class_id = $this->input->post('class_id');
			$this->data['installment_ids'] = $installments = $this->input->post('installment');
			$installment_arr = $fee_installment = $additional_fee = $single_concession = array();
			$fee_amount = $additional_amount = $late_fee = $concession_amount = 0;
			if ($installments) {
				foreach ($installments as $installment) {
					$installment_arr[] = $this->fee_model->getFeeInstallmentById($installment);
					if ($fee_structure_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment, $class_id, 'fee_structure')) {
						foreach ($fee_structure_class as $value) {
							$fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
							$fee_amount += array_sum($fee_installment[$value->fee_installment_id]->amount);
						}
					}
					if ($additional_fee_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment, $class_id, 'additional_fee')) {
						foreach ($additional_fee_class as $value) {
							$additional_fee[$value->fee_installment_id] = json_decode($value->fee_head_json);
							$additional_amount += array_sum($additional_fee[$value->fee_installment_id]->amount);
						}
					}
					if ($single_concession_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment, $class_id, 'single_concession')) {
						foreach ($single_concession_class as $value) {
							$single_concession[$value->fee_installment_id] = json_decode($value->fee_head_json);
							$concession_amount += array_sum($single_concession[$value->fee_installment_id]->amount);
						}
					}
					$late_fee += $this->fee_model->getLateFeeInstallmentById($installment, date('Y-m-d'));
				}
				$this->data['fee_structure_installment'] = $fee_installment;
				$this->data['fee_structure_additional'] = $additional_fee;
				$this->data['fee_structure_concession'] = $single_concession;
				$this->data['fee_data'] = array('fee_amount' => $fee_amount, 'additional_fee' => $additional_amount, 'concession_fee' => $concession_amount, 'late_fee' => $late_fee);
				$success = 1;
			}
			$this->data['installments'] = $installment_arr;
			$this->data['head_types'] = $this->fee_model->getHead();
		}
		$err_arr = array('register_no' => form_error('register_no'), 'fee_type' => form_error('fee_type'));
		echo json_encode(array('view' => $this->load->view('admin/payfee/ajax_proceed', $this->data, true), 'success' => $success, 'error' => $err_arr));
	}

	public function ajax_confirm_payfee() {
		is_ajax();
		$this->data['pay_gateway'] = $this->gateway_model->getPayGateway();
		echo json_encode(array('view' => $this->load->view('admin/payfee/ajax_confirm', $this->data, true), 'success' => 1));
	}

	public function ajax_fee_installment() {
		is_ajax();
		$class_id = $this->input->post('class_id');
		$fee_amount = $additional_fee = $late_fee = $concession_fee = 0;
		if ($installments = $this->input->post('installment')) {
			$fee_installment = array();
			foreach ($installments as $installment) {
				if ($fee_structure_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment, $class_id, 'fee_structure')) {
					foreach ($fee_structure_class as $value) {
						$fee_installment = json_decode($value->fee_head_json);
						$fee_amount += array_sum($fee_installment->amount);
					}
				}
				if ($additional_fee_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment, $class_id, 'additional_fee')) {
					foreach ($additional_fee_class as $value) {
						$fee_installment = json_decode($value->fee_head_json);
						$additional_fee += array_sum($fee_installment->amount);
					}
				}
				if ($concession_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment, $class_id, 'single_concession')) {
					foreach ($concession_class as $value) {
						$fee_installment = json_decode($value->fee_head_json);
						$concession_fee += array_sum($fee_installment->amount);
					}
				}
				$late_fee += $this->fee_model->getLateFeeInstallmentById($installment, date('Y-m-d'));
			}
		}
		echo json_encode(array('fee_amount' => $fee_amount, 'additional_fee' => $additional_fee, 'concession_fee' => $concession_fee, 'late_fee' => $late_fee));
	}

	public function add_payfee() {
		//is_ajax();
		if (isset($_POST['class_id']) && $_POST['class_id']) {
			$payfee_data = array(
				'admission_no' => $this->input->post('register_no'),
				'concession_type' => 'single',
				'fee_amount' => $this->input->post('fee_amount'),
				'additional_fee' => $this->input->post('additional_fee'),
				'late_fee' => $this->input->post('late_fee'),
				'concession_amount' => $this->input->post('concession_fee'),
				'carry_forward_amount' => $this->input->post('carry_forward'),
				'payable_amount' => $this->input->post('payable_amount'),
				'payment_by' => $this->input->post('payment_by'),
				'cheque_no' => $this->input->post('cheque_no'),
				'cheque_date' => $this->input->post('cheque_date') ? date('Y-m-d', strtotime($this->input->post('cheque_date'))) : '',
				'bank_name' => $this->input->post('bank_name'),
				'reference_no' => $this->input->post('reference_no'),
			);

			$payfee_id = $this->fee_model->addPayFee($payfee_data);

			$fee_head_arr = array();
			$class_id = $_POST['class_id'];
			$installments = $this->input->post('installment');
			if ($installments) {
				foreach ($installments as $installment_id) {

					if ($fee_structure_class = $this->fee_model->getFeeStructureByInstallmentWithClass($installment_id, $class_id, 'fee_structure')) {

						foreach ($fee_structure_class as $value) {
							$fee_structure_detail = array(
								'payfee_id' => $payfee_id,
								'class_id' => $class_id,
								'installment_id' => $installment_id,
								'payfee_head_json' => $value->fee_head_json,
								'fee_form_type' => 'fee_structure',
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
								'fee_form_type' => 'additional_fee',
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
								'fee_form_type' => 'single_concession',
							);
							$this->fee_model->addPayFeeDetail($fee_structure_detail);
						}
					}
				}
			}

			$_SESSION['student_id'] = $this->input->post('student_id');
			$_SESSION['class_id'] = $this->input->post('class_id');
			$_SESSION['section_id'] = $this->input->post('section_id');
			$_SESSION['payment_gateway'] = $this->input->post('payment_gateway');
			$_SESSION['admission_no'] = $this->input->post('register_no');
			$_SESSION['payfee_id'] = $payfee_id;
			if ($this->input->post('payment_gateway') != 'ccavenue') {

				$url_type = $this->gateway_model->getPayGatewayById($this->input->post('payment_gateway'));
				$txn_url = $this->gateway_model->getGatewayByName($url_type->gateway);
				if ($url_type->is_live) {
					$url = $txn_url->live_url;
				} else {
					$url = $txn_url->test_url;
				}

				$this->{$url_type->gateway}($this->input->post('payable_amount'), $url);
				// $this->{$this->input->post('payment_gateway')}($this->input->post('payable_amount'));
			}
		}
		//echo json_encode(array('success' => 1));
	}

	public function fonepaisa($amount, $url) {
		require_once APPPATH . 'third_party/fonepaisa/fonepaisa.php';
		$fonepaisa = $this->common->getPayGatewayByPG('fonepaisa');
		fonepaisa_forward(array(
			'id' => 'FPTEST',
			'merchant_id' => $fonepaisa->merchant_id,
			'merchant_display' => 'fonePaisa Test Merchant',
			'invoice_amt' => number_format($amount, 2),
			'amount' => number_format($amount, 2),
			'email' => '',
			'mobile_no' => '',
			//'callback_url'=>'https://test.fonepaisa.com/pgt/cfm.jsp',
			'callback_url' => base_url('pglib/fonepaisa'),
			//'callback_failure_url'=>'https://test.fonepaisa.com/pgt/fail.jsp',
			'callback_failure_url' => base_url('pglib/fonepaisa'),
			'invoice' => 'FPORD' . rand(1, 100000000),
			'api_key' => $fonepaisa->key,
			'private_key' => 'file://' . APPPATH . 'third_party/fonepaisa/priv.pem',
			'public_key' => '',
			'is_live_env' => $url, //The value should be changed to 'Y' when one wants to move to production
		));
	}

	public function paytm($amount, $url) {
		require_once APPPATH . 'third_party/paytm/config_paytm.php';
		require_once APPPATH . 'third_party/paytm/encdec_paytm.php';

		$checkSum = "";
		$paramList = array();

		$ORDER_ID = "PTMORD" . rand(10000, 99999999);
		$CUST_ID = "CUST001";
		$INDUSTRY_TYPE_ID = "Retail";
		$CHANNEL_ID = "WEB";
		$TXN_AMOUNT = number_format($amount, 2);

		// Create an array having all required parameters for creating checksum.
		$paramList["MID"] = PAYTM_MERCHANT_MID;
		$paramList["ORDER_ID"] = $ORDER_ID;
		$paramList["CUST_ID"] = $CUST_ID;
		$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
		$paramList["CHANNEL_ID"] = $CHANNEL_ID;
		$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
		$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
		$paramList["CALLBACK_URL"] = base_url('pglib/paytm');
		$checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);

		$paytm_data = '<form method="post" action="' . $url . '" name="f1">';
		$paytm_data .= '<input type="hidden" name="MID" value="' . PAYTM_MERCHANT_MID . '">';
		$paytm_data .= '<input type="hidden" name="ORDER_ID" value="' . $ORDER_ID . '">';
		$paytm_data .= '<input type="hidden" name="CUST_ID" value="' . $CUST_ID . '">';
		$paytm_data .= '<input type="hidden" name="INDUSTRY_TYPE_ID" value="' . $INDUSTRY_TYPE_ID . '">';
		$paytm_data .= '<input type="hidden" name="CHANNEL_ID" value="' . $CHANNEL_ID . '">';
		$paytm_data .= '<input type="hidden" name="TXN_AMOUNT" value="' . $TXN_AMOUNT . '">';
		$paytm_data .= '<input type="hidden" name="WEBSITE" value="' . PAYTM_MERCHANT_WEBSITE . '">';
		$paytm_data .= '<input type="hidden" name="CALLBACK_URL" value="' . base_url('pglib/paytm') . '">';
		$paytm_data .= '<input type="hidden" name="CHECKSUMHASH" value="' . $checkSum . '">';
		$paytm_data .= '<script type="text/javascript">document.f1.submit();</script>';
		$paytm_data .= '</form>';
		echo $paytm_data;
	}

	public function ebs($amount, $url) {
		$ebsuser_name = "User Name";
		$ebsuser_address = "Address";
		$ebsuser_zipcode = "City Pin code";
		$ebsuser_city = "City";
		$ebsuser_state = "State";
		$ebsuser_country = "Country";
		$ebsuser_phone = "Phone Number";
		$ebsuser_email = "Email";
		$description = "Test Order Description";
		$account_id = "111111111111";
		$finalamount = $amount;
		$reference_no = "EBSORD" . rand(10000, 99999999);
		$return_url = base_url('pglib/ebs');
		$mode = $url;
		$secure_hash = '';

		$hashData = "Your Secret Key"; //Pass your Registered Secret Key
		$hash_key = $hashData . "|" . $account_id . "|" . $finalamount . "|" . $reference_no . "|" . $return_url . "|" . $mode;
		$secure_hash = strtoupper(hash("sha512", $hash_key)); //for SHA512

		$pay_data = '<form method="post" action="https://secure.ebs.in/pg/ma/sale/pay" name="frmPaymentConfirm" >';
		$pay_data .= '<input name="account_id" value="' . $account_id . '" type="hidden">';
		$pay_data .= '<input name="return_url" size="60" value="' . $return_url . '" type="hidden">';
		$pay_data .= '<input name="mode" size="60" value="TEST" type="hidden">';
		$pay_data .= '<input name="reference_no" value="' . $reference_no . '" type="hidden">';
		$pay_data .= '<input name="description" value="' . $description . '" type="hidden">';
		$pay_data .= '<input name="name" maxlength="255" value="' . $ebsuser_name . '" type="hidden">';
		$pay_data .= '<input name="address" maxlength="255" value="' . $ebsuser_address . '" type="hidden">';
		$pay_data .= '<input name="city" maxlength="255" value="' . $ebsuser_city . '" type="hidden">';
		$pay_data .= '<input name="state" maxlength="255" value="' . $ebsuser_state . '" type="hidden">';
		$pay_data .= '<input name="postal_code" maxlength="255" value="' . $ebsuser_zipcode . '" type="hidden">';
		$pay_data .= '<input name="country" maxlength="255" value="' . $ebsuser_country . '" type="hidden">';
		$pay_data .= '<input name="phone" maxlength="255" value="' . $ebsuser_phone . '" type="hidden">';
		$pay_data .= '<input name="email" size="60" value="' . $ebsuser_email . '" type="hidden">';
		$pay_data .= '<input name="secure_hash" size="60" value="' . $secure_hash . '" type="hidden">';
		$pay_data .= '<input name="amount" id="amount" readonly="" value="' . $finalamount . '" type="hidden">';
		$pay_data .= '<script type="text/javascript">document.frmPaymentConfirm.submit();</script>';
		$pay_data .= '</form>';
		echo $pay_data;
	}

	public function payumoney($amount, $url) {
		$payumoney = $this->common->getPayGatewayByPG('payumoney');
		$MERCHANT_KEY = $payumoney->key;
		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$hash = '';
		$fname = 'dinesh';
		$email = 'dinesh@gmail.com';
		$phone = '9874563210';
		$productinfo = 'test product';
		$call_back = base_url('pglib/payumoney');

		$pay_data = '<form method="post" action="' . base_url('admin/payfee/payumoney_submit') . '" name="frmpayumoney" >';
		$pay_data .= '<input name="key" value="' . $MERCHANT_KEY . '" type="hidden">';
		$pay_data .= '<input name="hash" value="' . $hash . '" type="hidden">';
		$pay_data .= '<input name="txnid" value="' . $txnid . '" type="hidden">';
		$pay_data .= '<input name="amount" value="' . $amount . '" type="hidden">';
		$pay_data .= '<input name="firstname" value="' . $fname . '" type="hidden">';
		$pay_data .= '<input name="email" value="' . $email . '" type="hidden">';
		$pay_data .= '<input name="phone" value="' . $phone . '" type="hidden">';
		$pay_data .= '<input name="productinfo" value="' . $productinfo . '" type="hidden">';
		$pay_data .= '<input name="surl" value="' . $call_back . '" type="hidden">';
		$pay_data .= '<input name="furl" value="' . $call_back . '" type="hidden">';
		$pay_data .= '<input name="service_provider" value="payu_paisa" type="hidden">';
                $pay_data .= '<input name="geturl" value="' . $url . '" type="hidden">';
		$pay_data .= '<script type="text/javascript">document.frmpayumoney.submit();</script>';
		$pay_data .= '</form>';
		echo $pay_data;
	}

	public function payumoney_submit() {
		$url = isset($_POST['geturl']) ? $_POST['geturl'] : '';
		$payumoney = $this->common->getPayGatewayByPG('payumoney');
		$MERCHANT_KEY = $payumoney->key;
		$SALT = $payumoney->merchant_id;
		// Merchant Key and Salt as provided by Payu.

		$PAYU_BASE_URL = $url; // For Sandbox Mode
		// $PAYU_BASE_URL = "https://sandboxsecure.payu.in"; // For Sandbox Mode
		//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

		$action = '';

		$posted = array();
		if (!empty($_POST)) {
			//print_r($_POST);
			foreach ($_POST as $key => $value) {
				$posted[$key] = $value;
			}
		}
		$formError = 0;

		if (empty($posted['txnid'])) {
			// Generate random transaction id
			$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		} else {
			$txnid = $posted['txnid'];
		}
		$hash = '';

		// Hash Sequence
		$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
//        echo '<pre>';print_r($posted);die;
		if (empty($posted['hash']) && sizeof($posted) > 0) {
			//echo '<pre>';    print_r($posted);die;
			if (
				empty($posted['key']) || empty($posted['txnid']) || empty($posted['amount']) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl']) || empty($posted['service_provider'])
			) {
				$formError = 1;
			} else {
				//$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
				$hashVarsSeq = explode('|', $hashSequence);
				$hash_string = '';
				foreach ($hashVarsSeq as $hash_var) {
					$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
					$hash_string .= '|';
				}

				$hash_string .= $SALT;

				$hash = strtolower(hash('sha512', $hash_string));
				$action = $PAYU_BASE_URL . '/_payment';
			}
		} elseif (!empty($posted['hash'])) {
			$hash = $posted['hash'];
			$action = $PAYU_BASE_URL . '/_payment';
		}

		//$PAYU_BASE_URL = "https://sandboxsecure.payu.in"; // For Sandbox Mode
		//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode
		$fname = $posted['firstname'];
		$email = $posted['email'];
		$phone = $posted['phone'];
		$productinfo = $posted['productinfo'];
		$amount = $posted['amount'];
		$call_back = base_url('pglib/payumoney');
		$action = $PAYU_BASE_URL . '/_payment';

		$pay_data = '<form method="post" action="' . $action . '" name="frmpayumoney" >';
		$pay_data .= '<input name="key" value="' . $MERCHANT_KEY . '" type="hidden">';
		$pay_data .= '<input name="hash" value="' . $hash . '" type="hidden">';
		$pay_data .= '<input name="txnid" value="' . $txnid . '" type="hidden">';
		$pay_data .= '<input name="amount" value="' . $amount . '" type="hidden">';
		$pay_data .= '<input name="firstname" value="' . $fname . '" type="hidden">';
		$pay_data .= '<input name="email" value="' . $email . '" type="hidden">';
		$pay_data .= '<input name="phone" value="' . $phone . '" type="hidden">';
		$pay_data .= '<input name="productinfo" value="' . $productinfo . '" type="hidden">';
		$pay_data .= '<input name="surl" value="' . $call_back . '" type="hidden">';
		$pay_data .= '<input name="furl" value="' . $call_back . '" type="hidden">';
		$pay_data .= '<input name="service_provider" value="payu_paisa" type="hidden">';
		$pay_data .= '<script type="text/javascript">document.frmpayumoney.submit();</script>';
		$pay_data .= '</form>';
		echo $pay_data;
	}

	public function worldline($amount, $url) {
		$worldline = $this->common->getPayGatewayByPG('worldline');
		$mid = $worldline->merchant_id;
		$enckey = $worldline->key;
		$OrderId = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$responseUrl = base_url('pglib/worldline');
		$amount = $amount * 100;
		$pay_data = '<form method="post" action="' . base_url('admin/payfee/worldline_submit') . '" name="frmworldline" >';
		$pay_data .= '<input name="OrderId" value="' . $OrderId . '" type="hidden">';
		$pay_data .= '<input name="currencyName" value="INR" type="hidden">';
		$pay_data .= '<input name="meTransReqType" value="S" type="hidden">';
		$pay_data .= '<input name="amount" value="' . $amount . '" type="hidden">';
		$pay_data .= '<input name="mid" value="' . $mid . '" type="hidden">';
		$pay_data .= '<input name="enckey" value="' . $enckey . '" type="hidden">';
		$pay_data .= '<input name="responseUrl" value="' . $responseUrl . '" type="hidden">';
		$pay_data .= '<input name="geturl" value="' . $url . '" type="hidden">';
		$pay_data .= '<script type="text/javascript">document.frmworldline.submit();</script>';
		$pay_data .= '</form>';
		echo $pay_data;
	}

	public function worldline_submit() {
		$url = isset($_POST['geturl']) ? $_POST['geturl'] : '';
		include APPPATH . 'third_party/worldline/AWLMEAPI.php';
		$worldline = $this->common->getPayGatewayByPG('worldline');
		$mid = $worldline->merchant_id;
		$enckey = $worldline->key;

		//create an Object of the above included class
		$obj = new AWLMEAPI();

		//create an object of Request Message
		$reqMsgDTO = new ReqMsgDTO();

		/* Populate the above DTO Object On the Basis Of The Received Values */
		// PG MID
		$reqMsgDTO->setMid($_REQUEST['mid']);
		// Merchant Unique order id
		$reqMsgDTO->setOrderId($_REQUEST['OrderId']);
		//Transaction amount in paisa format
		$reqMsgDTO->setTrnAmt($_REQUEST['amount']);
		// Merchant transaction type (S/P/R)
		$reqMsgDTO->setMeTransReqType($_REQUEST['meTransReqType']);
		// Merchant encryption key
		$reqMsgDTO->setEnckey($_REQUEST['enckey']);
		// Merchant transaction currency
		$reqMsgDTO->setTrnCurrency($_REQUEST['currencyName']);
		// Merchant response URl
		$reqMsgDTO->setResponseUrl($_REQUEST['responseUrl']);
		//Generate transaction request message
		$merchantRequest = "";

		$reqMsgDTO = $obj->generateTrnReqMsg($reqMsgDTO);

		if ($reqMsgDTO->getStatusDesc() == "Success") {
			$merchantRequest = $reqMsgDTO->getReqMsg();
		}

		$pay_data = '<form method="post" action=' . $url . ' name="frmworldline" >';
		// $pay_data = '<form method="post" action="https://cgt.in.worldline.com/ipg/doMEPayRequest" name="frmworldline" >';
		$pay_data .= '<input name="merchantRequest" value="' . $merchantRequest . '" type="hidden">';
		$pay_data .= '<input name="MID" value="' . $reqMsgDTO->getMid() . '" type="hidden">';
		$pay_data .= '<script type="text/javascript">document.frmworldline.submit();</script>';
		$pay_data .= '</form>';
		echo $pay_data;
	}

	public function student_pay() {
		$this->data['page'] = 'Student Pay';
		$this->data['title'] = 'Student Pay';
		$this->data['view'] = 'admin/payfee/student_pay';

		$fee_structure_class = $this->fee_model->getFeeStructureClass(13, 'fee_structure');
		$fee_class = $fee_installment = array();
		foreach ($fee_structure_class as $value) {
			$fee_class[$value->class_id] = $value->class_id;
			$fee_installment[$value->fee_installment_id] = json_decode($value->fee_head_json);
		}

		$this->data['additional_fee_class'] = $fee_class;
		$this->data['additional_fee_installment'] = $fee_installment;

		$this->data['installments'] = $this->fee_model->getFeeInstallment();
		$this->data['head_types'] = $this->fee_model->getHead();
		$this->load->view('admin/admin_master', $this->data);
	}

}
