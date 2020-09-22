<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

    private $admin = 'admin';
    private $board = 'board';
    private $institution = 'institution';
    private $faq = 'faq';
    private $terms_condition = 'terms_condition';
    private $privacy_policy = 'privacy_policy';
    private $pincodes = 'pincodes';
    private $student = 'students';
    private $class = 'class';
    private $section = 'section';
    private $group_master = 'group_master';
    private $role_group_master = 'role_group_master';
    private $permission_set_master = 'permission_set_master';
    private $role_permission_master = 'role_permission_master';
    private $class_detail = 'class_detail';
    private $section_detail = 'section_detail';
    private $head_type = 'head_type';
    private $fee_installment = 'fee_installment';
    private $student_type = 'student_type';
    private $fee_structure = 'fee_structure';
    private $fee_structure_class = 'fee_structure_class';
    private $fee_concession_single = 'fee_concession_single';
    private $fee_concession_bulk = 'fee_concession_bulk';
    private $additional_fee = 'additional_fee';
    private $transaction = 'transaction';
    private $resolution_center = 'resolution_center';
    private $payfee = 'payfee';
    private $payfee_detail = 'payfee_detail';
    private $settings = 'settings';
    private $pay_gateway = 'pay_gateway';
    private $message_gateway = 'message_gateway';
    private $message = 'message';
    private $challan_setting = 'challan_setting';
    private $noification_table = 'noification_table';
    private $notice = 'notice_event';
    private $app_store = 'app_store';
    private $fee_type = 'fee_type';
    private $gateway = 'gateway';

    public function getGatewayTable() {
        return $this->gateway;
    }

    public function getFeeTypeTable() {
        return $this->fee_type;
    }

    public function getAppStoreTable() {
        return $this->app_store;
    }

    public function getNoticeTable() {
        return $this->notice;
    }

    public function getNotificationTable() {
        return $this->noification_table;
    }

    public function getChallanSettingTable() {
        return $this->challan_setting;
    }

    public function getMessageGatewayTable() {
        return $this->message_gateway;
    }

    public function getMessageTable() {
        return $this->message;
    }

    public function getPayGatewayTable() {
        return $this->pay_gateway;
    }

    public function getSettingTable() {
        return $this->settings;
    }

    public function getPayFeeDetailTable() {
        return $this->payfee_detail;
    }

    public function getPayFeeTable() {
        return $this->payfee;
    }

    public function getResolutionCenterTable() {
        return $this->resolution_center;
    }

    public function getTransactionTable() {
        return $this->transaction;
    }

    public function getAdditionalFeeTable() {
        return $this->additional_fee;
    }

    public function getFeeConcessionSingleTable() {
        return $this->fee_concession_single;
    }

    public function getFeeConcessionBulkTable() {
        return $this->fee_concession_bulk;
    }

    public function getFeeStructureClassTable() {
        return $this->fee_structure_class;
    }

    public function getFeeStructureTable() {
        return $this->fee_structure;
    }

    public function getHeadTypeTable() {
        return $this->head_type;
    }

    public function getFeeInstallmentTable() {
        return $this->fee_installment;
    }

    public function getStudentTypeTable() {
        return $this->student_type;
    }

    public function getSectionDetailTable() {
        return $this->section_detail;
    }

    public function getClassDetailTable() {
        return $this->class_detail;
    }

    public function getSectionTable() {
        return $this->section;
    }

    public function getClassTable() {
        return $this->class;
    }

    public function getStudentTable() {
        return $this->student;
    }

    public function getPincodeTable() {
        return $this->pincodes;
    }

    public function getAdminTable() {
        return $this->admin;
    }

    public function getBoardTable() {
        return $this->board;
    }

    public function getInstitutionTable() {
        return $this->institution;
    }

    public function getRoleGroupTable() {
        return $this->role_group_master;
    }

    public function getRolePermissionTable() {
        return $this->role_permission_master;
    }

    public function generatePassword() {
        $post = '';
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($p = 0; $p <= 7; $p++) {
            $post .= substr($string, rand(0, strlen($string) - 1), 1);
        }
        return $post;
    }

    /**
     * Send Push Notification
     */
    function sendPush($data, $message_array, $push_data = array()) {

        $device_type = $data['device_type'];
        $register_id = $data['register_id'];

        $apiKey = "";

        $registrationIDs = array($register_id);

// Message to be sent
        //$message = "Push notification testing by hemal";
        // Set POST variables
        //$url = 'https://android.googleapis.com/gcm/send';
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => $registrationIDs,
            'data' => $message_array,
        );

        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json',
        );

// Open connection
        $ch = curl_init();

// Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

// Execute post
        $result = curl_exec($ch);
//print_r($result);
        // Close connection
        curl_close($ch);
    }

    /**
     * Send Email
     */
    function sendMail($toEmail, $subject, $mail_body, $fromEmail = '', $fromName = '', $ccEmails = '', $replyTo = '') {
        $this->load->library('email');
        if (!$fromEmail) {
            $fromEmail = FROM_EMAIL;
        }

        if (!$fromName) {
            $fromName = PROJECT_NAME;
        }

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = '';
        $config['mail_path'] = '';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = '';
        $config['smtp_pass'] = '';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $this->email->from($fromEmail, $fromName);
        $this->email->to($toEmail);
        $this->email->subject($subject);
        $this->email->message($mail_body);

        if ($replyTo != "") {
            $this->email->reply_to($replyTo, '');
        }

        if ($ccEmails != "") {
            $this->email->cc($ccEmails);
        }

        return $this->email->send();
//echo $this->email->print_debugger();
    }

    /**
     * datatable query
     */
    private function _get_datatables_query($table, $select, $join_json, $where_json, $column_order, $column_search, $order_by, $group_by) {
        $i = 0;
        $select_decode = json_decode($select);
        if ($select_decode) {
            $this->db->select($select_decode);
        }
        //echo '<pre>';
        $join_decode = json_decode($join_json);
        if ($join_decode) {
            foreach ($join_decode as $join_arr) {
                foreach ($join_arr->fields as $join) {
                    $this->db->join($join_arr->table, $join, isset($join_arr->join) ? 'RIGHT' : 'LEFT');
                }
            }
        }

        $where_decode = json_decode($where_json);
        if ($where_decode) {
            foreach ($where_decode as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        if ($group_by) {
            $group_by_decode = json_decode($group_by);
            if ($group_by_decode) {
                foreach ($group_by_decode as $val) {
                    $this->db->group_by($val);
                }
            }
        }

        foreach ($column_search as $item) {
            // loop column
            if (isset($_POST['search']['value'])) {
                // if datatable send POST for search
                if ($i === 0) {
                    // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) {
                    //last loop
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order_by)) {
            $order = $order_by;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    /**
     * datatable records
     */
    function get_datatables($table, $select, $join_json, $where_json, $column_order, $column_search, $order_by, $group_by = array(), $is_limit = true) {

        $this->_get_datatables_query($table, $select, $join_json, $where_json, $column_order, $column_search, $order_by, $group_by);

        if ($is_limit) {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
        }
        $join_decode = json_decode($join_json);
        //print_r($table);die;
        if ($join_decode) {
            $data = $this->db->get($table)->result();
        } else {
            $data = $this->db->get($table)->result();
        }

        // echo $this->db->last_query();die;
        return $data;
    }

    /**
     * count of filtered data
     */
    function count_filtered($table, $select, $join_json, $where_json, $column_order, $column_search, $order_by, $group_by = array()) {
        $this->_get_datatables_query($table, $select, $join_json, $where_json, $column_order, $column_search, $order_by, $group_by);
        $join_decode = json_decode($join_json);
        if ($join_decode) {
            $where_decode = json_decode($where_json);
            if ($where_decode) {
                foreach ($where_decode as $key => $val) {
                    $this->db->where($key, $val);
                }
            }
            $data = $this->db->get($table)->num_rows();
        } else {
            $data = $this->db->get($table)->num_rows();
        }
        //echo $this->db->last_query();die;
        return $data;
    }

    /**
     * count of all data
     */
    public function count_all($table, $join_json, $where_json, $is_join = false) {
        $join_decode = json_decode($join_json);
        if ($join_decode) {
            foreach ($join_decode as $join_arr) {
                foreach ($join_arr->fields as $join) {
                    $this->db->join($join_arr->table, $join, 'LEFT');
                }
            }
        }

        $where_decode = json_decode($where_json);
        if ($where_decode) {
            foreach ($where_decode as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        if ($is_join) {
            $data = $this->db->from($table)->count_all_results();
        } else {
            $data = $this->db->from($table)->count_all_results();
        }

        // echo $this->db->last_query();die;
        return $data;
    }

    /**
     * datatable custom records
     */
    function get_datatables_custom($query, $column_order, $column_search, $order_by, $limit, $is_limit = true) {
        //$query = $this->_get_datatables_custom_query($query, $column_order, $column_search, $order_by);

        if (isset($_POST['order'])) {
            // here order processing
            $query .= " ORDER BY " . $column_order[$_POST['order']['0']['column']] . " " . $_POST['order']['0']['dir'];
        } else if (isset($order_by)) {
            $order = $order_by;
            if ($order) {
                $query .= " ORDER BY " . key($order) . " " . $order[key($order)];
            }
        }

        if ($is_limit) {
            $start = $_POST['start'];
            if ($limit < 0) {
                $limit = 10;
            }

            $query .= " LIMIT $start, $limit";
        }
        /* if ($_POST['length'] != -1)
          $this->db->limit($_POST['length'], $start); */
        $data = $this->db->query($query)->result();
        //echo $this->db->last_query();die;
        return $data;
    }

    /**
     * count of filtered custom data
     */
    function count_filtered_custom($query, $column_order, $column_search, $order_by) {
        //$this->_get_datatables_custom_query($query, $column_order, $column_search, $order_by);

        $data = $this->db->query($query)->num_rows();
        //echo $this->db->last_query();die;
        return $data;
    }

    /**
     * count of all custom data
     */
    public function count_all_custom($query) {
        //$data = $this->db->from($query)->count_all_results();
        $data = $this->db->query($query)->num_rows();
        // echo $this->db->last_query();die;
        return $data;
    }

    /**
     * Verify user account
     */
    public function verifyAccount($verify_token) {
        $this->db->where('verify_token', $verify_token);
        $this->db->where('verify_token !=', 1);
        $this->db->where('code', 0);
        return $this->db->get($this->admin)->row();
    }

    /**
     * Verify forgot password
     */
    public function verifyForgot($verify_token) {
        $this->db->where('verify_token', $verify_token);
        $this->db->where('verify_token !=', 1);
        $this->db->where('code !=', 0);
        return $this->db->get($this->admin)->row();
    }

    /**
     * Successfully verify user account
     */
    public function successVerifyAccount($verify_token) {
        $data['verify_token'] = 1;
        $this->db->where('verify_token', $verify_token);
        $this->db->where('verify_token !=', 1);
        return $this->db->update($this->admin, $data);
    }

    /**
     * Successfully verify forgot password
     */
    public function successVerifyForgot($verify_token, $code, $password) {
        $data['verify_token'] = 1;
        $data['code'] = 0;
        $data['password'] = md5($password);
        $this->db->where('verify_token', $verify_token);
        $this->db->where('code', $code);

        $this->db->where('verify_token !=', 1);
        return $this->db->update($this->admin, $data);
    }

    /**
     * check verify forgot password code
     */
    public function checkVerifyForgot($verify_token, $code) {
        $data['verify_token'] = 1;
        $this->db->where('verify_token', $verify_token);
        $this->db->where('code', $code);
        $this->db->where('verify_token !=', 1);
        return $this->db->get($this->admin)->row();
    }

    /*
      public function updateContactUs($info) {
      $this->db->where('id', 1);
      return $this->db->update($this->contact_us_info, $info);
      }

     */

    public function updateFaq($faq) {
        $this->db->where('id', 1);
        return $this->db->update($this->faq, $faq);
    }

    public function getFaqInfo() {
        $this->db->where('id', 1);
        return $this->db->get($this->faq)->row();
    }

    public function getTermsConditionInfo() {
        $this->db->where('id', 1);
        return $this->db->get($this->terms_condition)->row();
    }

    public function updateTc($tc) {
        $this->db->where('id', 1);
        return $this->db->update($this->terms_condition, $tc);
    }

    public function getPrivacyPolicy() {
        $this->db->where('id', 1);
        return $this->db->get($this->privacy_policy)->row();
    }

    public function updatePrivacyPolicy($policy) {
        $this->db->where('id', 1);
        $result = $this->db->update($this->privacy_policy, $policy);
        $notification_data = array(
            'notification_id' => 1,
            'type' => 'privacy',
            'title' => 'Privacy Update',
        );
        $this->insertNotification($notification_data);
        return $result;
    }

    public function insertNotification($data) {
        return $this->db->insert($this->noification_table, $data);
    }

    public function getNotification($type) {
        $this->db->where('type', $type);
        $data = $this->db->get($this->noification_table)->result();
        if ($data) {
            foreach ($data as $key => $value) {
                if ($type == 'notice' || $type == 'event') {
                    if ($notification_arr = $this->getNoticeOrEvents($type, (array) $value->notification_id)) {
                        $data[$key] = $value;
                        $data[$key]->message = $notification_arr->message;
                    }
                }
            }
        }
        return $data;
    }

    public function getNoticeOrEvents($type, $notification_id) {
        $this->db->where('type', $type);
        $this->db->where_in('id', $notification_id);
        return $this->db->get($this->notice)->row();
    }

    /**
     * get All Role Group
     */
    public function getAllRoleGroup() {
        return $this->db->get($this->common->getRoleGroupTable())->result();
    }

    public function validPermission($key = "", $opr = "") {

        $module = $this->session->userdata('module_permission');
        if (array_key_exists(strtolower($key), $module)) {
            if (array_search(strtolower($opr), $module[strtolower($key)]) !== false) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getPermission($id = 0) {

        $selectedOptions = array();
        $query = $this->db->get_where('role_permission_master', array("group_id" => $id));
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $selectedOptions = json_decode($result[0]['permission_set'], true);
        }

        $query1 = $this->db->get('module_master');
        if ($query1->num_rows() > 0) {
            $finalResult = array();
            $moduleResultSet = $query1->result_array();
            //echo "<pre>"; print_r($moduleResultSet); die;
            for ($i = 0; $i < count($moduleResultSet); $i++) {
                $moduleOption = json_decode($moduleResultSet[$i]['permission_sets'], true);
                if (array_key_exists($moduleResultSet[$i]['id'], $selectedOptions) === true) {
                    $selectedOption = $selectedOptions[$moduleResultSet[$i]['id']][1];
                    $tempOption = array();
                    for ($j = 0; $j < count($moduleOption); $j++) {
                        if (in_array($moduleOption[$j], $selectedOption) === true) {
                            $tempOption[] = array($moduleOption[$j], 1);
                        } else {
                            $tempOption[] = array($moduleOption[$j], 0);
                        }
                    }
                    $finalResult[$moduleResultSet[$i]['id']] = array($selectedOptions[$moduleResultSet[$i]['id']][0], $tempOption);
                } else {
                    $tempOption = array();
                    for ($j = 0; $j < count($moduleOption); $j++) {
                        $tempOption[] = array($moduleOption[$j], 0);
                    }
                    //echo $selectedOptions[$moduleResultSet[$i]['id']][0]."<br>";
                    $finalResult[$moduleResultSet[$i]['id']] = array(0, $tempOption);
                }
            }
            $this->resultset = $finalResult;
            return $this->resultset;
        }
        return false;
    }

    public function getModuleData($field, $id) {
        $query = $this->db->get_where('module_master', array('id' => $id));
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result[0][$field];
        }
    }

    public function getPermissionData($field, $id) {
        $query = $this->db->get_where('permission_set_master', array('id' => $id));
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result[0][$field];
        }
    }

    public function updateRolePermission($group_id, $tempArray) {
        $this->db->where('group_id', $_POST['group_id'], $tempArray);
        return $this->db->update($this->common->getRolePermissionTable(), $tempArray);
        // echo $this->db->last_query(); die;
    }

    /**
     * Add Role Group
     */
    public function addRoleGroup($data) {
        return $this->db->insert($this->common->getRoleGroupTable(), $data);
    }

    /**
     * delete Role Group
     */
    public function deleteRoleGroup($group_id) {
        $this->db->where('group_id', $group_id);
        return $this->db->delete($this->common->getRoleGroupTable());
    }

    /**
     * Return Role Group  by  group_id
     */
    public function getRoleGroup($group_id) {
        $this->db->where('group_id', $group_id);
        return $this->db->get($this->common->getRoleGroupTable())->row();
    }

    /**
     * Check Role Group Name Exists or not
     */
    public function getRoleGroupByName($name) {
        $this->db->where(array('groupName' => $name));
        return $this->db->get($this->common->getRoleGroupTable())->row();
    }

    /**
     * Update Role Group
     */
    public function updateRoleGroup($group_id, $data) {
        $this->db->where('group_id', $group_id);
        return $this->db->update($this->common->getRoleGroupTable(), $data);
    }

    public function addRolePermission($tempArray) {
        return $this->db->insert($this->common->getRolePermissionTable(), $tempArray);
    }

    public function getRolePermission($group_id) {
        $this->db->where('group_id', $group_id);
        $query1 = $this->db->get($this->common->getRolePermissionTable());
        $result = $query1->row();

        $selectedOptions = json_decode($result->permission_set, true);
        //echo '<pre>'; print_r($selectedOptions); die;
        $modulePermission = array();

        foreach ($selectedOptions as $key => $value) {
            $moduleName = strtolower($this->common->getModuleData('module_name', $key));
            // echo '<pre>'; print_r($value);
            $permission = array();
            foreach ($value[1] as $key1 => $value1) {
                array_push($permission, strtolower($this->common->getPermissionData('Label', $value1[0])));
            }
            $modulePermission[$moduleName] = $permission;
            // echo '<pre>'; print_r($modulePermission);
        //
		}
        return $modulePermission;
        //echo '<pre>'; print_r($modulePermission);
        //die;
    }

    public function getPayGatewayByPG($gateway) {
        $this->db->where('gateway', $gateway);
        return $this->db->get($this->common->getPayGatewayTable())->row();
    }

    public function sendSMSmsg91($mobile, $message, $key) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?route=4&sender=SIKSPE&mobiles=$mobile&authkey=$key&message=$message&country=91",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function sendSMStextLocal($mobile, $message, $key) {
        // Account details
        $apiKey = urlencode($key);

        // Message details
        $numbers = array($mobile);
        $message = rawurlencode($message);

        $numbers = implode(',', $numbers);

        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "message" => $message);

        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Process your response here
        echo $response;
    }

    public function getNotificationById($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->noification_table)->row();
    }

    public function sendMailmsg91($key, $subject, $email, $message) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://control.msg91.com/api/sendmail.php?authkey=$key&from=no-reply@shikshapay.in&to=$email&subject=$subject&body=$message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function sendEmailBySendgrid($key, $to, $subject, $message) {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("no-reply@shikshapay.in", "ShikshaPay");
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/plain", $message);
        $sendgrid = new \SendGrid($key);
        try {
            $response = $sendgrid->send($email);
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

}
