<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->db->checkadminlogin();
		$this->load->model(array('student_model', 'institution_model', 'admin_model', 'class_model', 'section_model'));
		$this->data['page'] = 'Student';
		$this->data['title'] = '';
		$this->data['ajax_order_by'] = json_encode(array());
	}

	public function index() {
		$this->data['view'] = 'admin/student/list';
		$this->data['ajax_order_by'] = json_encode(array());
		$this->load->view('admin/admin_master', $this->data);
	}

	public function ajax_list() {
		is_ajax();
		$this->data['ajax_order_by'] = json_encode(array(0, 3));

		$column_order = array(null, 'registration_id', 'role_no', 'fullname', 'dob', 'username', 'status', ''); //set column field database for datatable orderable
		$column_search = array('registration_id', 'role_no', 'fullname', 'dob', 'username', 'status'); //set column field database for datatable searchable
		$order_by = array('id' => 'desc'); // default order

		$select_arr = array('id', 'registration_id', 'role_no', 'fullname', 'dob', 'username', 'status');
		$select = json_encode($select_arr);
		$join_json = json_encode(array());

		$where_arr = array('is_deleted' => 0);
		$where_json = json_encode($where_arr);

		$this->data['list'] = $this->common->get_datatables($this->common->getStudentTable() . ' AS s', $select, $join_json, $where_json, $column_order, $column_search, $order_by);
		$ajax_data = $this->load->view('admin/student/ajax_list', $this->data, true);

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->common->count_all($this->common->getStudentTable() . ' AS s', $join_json, $where_json, true),
			"recordsFiltered" => $this->common->count_filtered($this->common->getStudentTable() . ' AS s', $select, $join_json, $where_json, $column_order, $column_search, $order_by),
			"data" => json_decode($ajax_data),
		);

		echo json_encode($output);
	}

	public function student_modal() {
		is_ajax();
		$id = $_POST['student_id'] + 0;
		$this->data['page_title'] = 'Add Student';
		if ($id) {
			$this->data['page_title'] = 'Edit Student';
		}
		$this->data['institution_data'] = $this->institution_model->getInstitution();
		$this->data['setion_data'] = $this->section_model->getSection();
		$this->data['class_data'] = $this->class_model->getClass();
		$this->data['student_data'] = $this->student_model->getStudentById($id);

		echo json_encode(array('view' => $this->load->view('admin/student/student_modal', $this->data, true), 'success' => 1));
	}

	public function add($id = 0) {

		is_ajax();

		$this->form_validation->set_error_delimiters('<div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;">', '</div>');
		$this->form_validation->set_rules('registration_id', 'Registration Number', 'required');
		$this->form_validation->set_rules('role_no', 'Role Number', 'required');
		$this->form_validation->set_rules('fullname', 'Full Name', 'required');
		$this->form_validation->set_rules('institution_id', 'Institution Name', 'required');
		$this->form_validation->set_rules('class_id', 'Class Name', 'required');
		$this->form_validation->set_rules('section_id', 'Section Name', 'required');
		$this->form_validation->set_rules('father_name', 'Father Name', 'required');
		$this->form_validation->set_rules('mother_name', 'Mother Name', 'required');
		$this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('contactno', 'Contact Number', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');

		// print_r($_FILES);die;

		if ($this->form_validation->run() == True) {
			$student = array(
				'registration_id' => trim($this->input->post('registration_id')),
				'role_no' => trim($this->input->post('role_no')),
				'fullname' => trim($this->input->post('fullname')),
				'institution_id' => trim($this->input->post('institution_id')),
				'class_id' => trim($this->input->post('class_id')),
				'section_id' => trim($this->input->post('section_id')),
				'father_name' => trim($this->input->post('father_name')),
				'mother_name' => trim($this->input->post('mother_name')),
				'dob' => trim($this->input->post('dob')),
				'username' => trim($this->input->post('username')),
				'gender' => trim($this->input->post('gender')),
				'password' => trim($this->input->post('password')),
				'contactno' => trim($this->input->post('contactno')),
				'address' => trim($this->input->post('address')),
				'status' => $this->input->post('status'),
			);

			if (isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['error'] == 0) {
				$temp_file = $_FILES['profile_pic']['tmp_name'];

				$img_name = "profile_" . mt_rand(10000, 999999999) . time();
				$path = $_FILES['profile_pic']['name'];

				$ext = pathinfo($path, PATHINFO_EXTENSION);

				$student['profile_pic'] = $img_name . "." . $ext;
				$url = PROFILEPIC . $student['profile_pic'];
				$this->db->compress_image($temp_file, $url, 80);
			} else {
				//default image set
				$student['profile_pic'] = 'product-01.jpg';
			}

			if (!empty($this->input->post('student_id'))) {
				//Edit student
				$id = $this->input->post('student_id');
				$result = $this->student_model->updateStudent($id, $student);
				if ($result) {
					echo json_encode(array('message' => 'Student Updated Successfully.', 'success' => 1));
				} else {
					echo json_encode(array('message' => 'Error While Updateing Record.', 'success' => 0));
				}
			} else {
				//Add student
				$result = $this->student_model->addStudent($student);
				if ($result) {
					echo json_encode(array('message' => 'Student Added Successfully.', 'success' => 1));
				} else {
					echo json_encode(array('message' => 'Error While Inserting Record.', 'success' => 0));
				}
			}
		} else {
			$err_arr = array('registration_id' => form_error('registration_id'),
				'role_no' => form_error('role_no'),
				'fullname' => form_error('fullname'),
				'institution_id' => form_error('institution_id'),
				'class_id' => form_error('class_id'),
				'section_id' => form_error('section_id'),
				'father_name' => form_error('father_name'),
				'mother_name' => form_error('mother_name'),
				'dob' => form_error('dob'),
				'username' => form_error('username'),
				'gender' => form_error('gender'),
				'password' => form_error('password'),
				'contactno' => form_error('contactno'),
				'address' => form_error('address'),
			);
			echo json_encode(array('success' => 0, 'error' => $err_arr));
		}
	}

	public function delete($id = '') {
		$result = $this->student_model->deleteStudent($id);
		if ($result) {
			$this->session->set_flashdata('success', 'Board Deleted Successfully.');
			redirect(base_url('admin/student'));
		} else {
			$this->session->set_flashdata('error', "Error While Deleting Record.");
			redirect(base_url('admin/student'));
		}
	}

	public function get_student_no() {
		is_ajax();
                $this->load->model('fee_model');
		$arr = array();
		$register_no = $this->input->get('term');
		$class_id = array();
                if($fee_class = $this->fee_model->getFeeStructureClassByFeeType($this->input->get('fee_type'))){
                    foreach ($fee_class as $value) {
                        $class_id[] = $value->class_id;
                    }
                }
		$detail = $this->student_model->getStudentNo($class_id, $register_no);
		echo json_encode($detail ? explode(',', $detail->registration_id) : array());
	}

	public function get_student_detail() {
		is_ajax();
		$success = 0;
		$register_no = $this->input->post('register_no');
		if ($detail = $this->student_model->getStudentDetailByNo($register_no)) {
			$success = 1;
		}

		echo json_encode(array('success' => $success, 'detail' => $detail));
	}

	public function upload() {
		if (isset($_FILES['upload_student']['name']) && $_FILES['upload_student']['error'] == 0) {

			$file = fopen($_FILES['upload_student']['tmp_name'], "r");
			while (!feof($file)) {
				$csv[] = fgetcsv($file);
			}
			fclose($file);
			if (isset($csv) && $csv) {
				for ($i = 1; $i < (count($csv) - 1); $i++) {
					$student_id = isset($csv[$i][0]) ? $csv[$i][0] : 0;
					if ($student_id) {

						$class = isset($csv[$i][3]) ? $csv[$i][3] : 0;
						$section = isset($csv[$i][4]) ? $csv[$i][4] : 0;
						if ($class) {
							if ($class_id = $this->class_model->getClassByName($class)) {
								$class = $class_id->id;
							}

						}
						if ($section) {
							if ($section_id = $this->section_model->getSectionByName($section)) {
								$section = $section_id->id;
							}

						}

						$student = array(
							'registration_id' => $student_id,
							'role_no' => isset($csv[$i][1]) ? $csv[$i][1] : '',
							'fullname' => isset($csv[$i][2]) ? $csv[$i][2] : '',
							'class_id' => $class,
							'section_id' => $section,
							'father_name' => isset($csv[$i][5]) ? $csv[$i][5] : '',
							'mother_name' => isset($csv[$i][6]) ? $csv[$i][6] : '',
							'dob' => isset($csv[$i][7]) ? $csv[$i][7] : '',
							'username' => isset($csv[$i][8]) ? $csv[$i][8] : '',
							'gender' => isset($csv[$i][9]) ? $csv[$i][9] : '',
							'password' => isset($csv[$i][10]) ? $csv[$i][10] : '',
							'contactno' => isset($csv[$i][11]) ? $csv[$i][11] : '',
							'address' => isset($csv[$i][12]) ? $csv[$i][12] : '',
							'status' => isset($csv[$i][13]) ? $csv[$i][13] : '',
							//'institution_id' => isset($csv[$i][3]) ? $csv[$i][3] : '',
							'profile_pic' => 'product-01.jpg',
						);
						$this->student_model->addStudent($student);
					}
				}
			}
		}
	}

	public function download() {
		$FileName = 'student-export';
		$header = array('Admission No', 'Roll No', 'Full Name', 'Class Name', 'Section Name', 'Father Name', 'Mother Name', 'DOB', 'Username', 'Gender', 'Password', 'Contact No', 'Address', 'Status');
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename=' . $FileName . '.csv');
		header('Pragma: no-cache');
		header("Expires: 0");
		$outstream = fopen("php://output", "w");
		fputcsv($outstream, $header);

		if ($students = $this->student_model->getStudent()) {
			foreach ($students as $student) {

				$class = $student->class_id;
				$section = $student->section_id;
				if ($class) {
					if ($class_id = $this->class_model->getClassById($class)) {
						$class = $class_id->class_name;
					}

				}
				if ($section) {
					if ($section_id = $this->section_model->getSectionById($section)) {
						$section = $section_id->section_name;
					}

				}

				fputcsv($outstream, array(
					$student->registration_id,
					$student->role_no,
					$student->fullname,
					$class,
					$section,
					$student->father_name,
					$student->mother_name,
					date('d-m-Y', strtotime($student->dob)),
					$student->username,
					$student->gender,
					$student->password,
					"$student->contactno",
					$student->address,
					$student->status,
				));
			}
		}
		fclose($outstream);
		exit();
	}

}
