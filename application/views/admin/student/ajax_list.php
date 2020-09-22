<?php
$data = array();
$no = $_POST['start'];
foreach ($list as $student) {
	$no++;
	$status = $student->status ? 'Active' : 'In Active';
	$status_class = $student->status ? 'btn-success' : 'btn-danger';
	$row = array();
	$row[] = $no;
	$row[] = $student->registration_id;
	$row[] = $student->role_no;
	$row[] = $student->fullname;
	$row[] = $student->dob;
	$row[] = $student->username;
	$row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
	$row[] = '<a class="btn btn-primary btn-sm" onclick="addStudent(' . $student->id . ');" href="javascript:;">Edit</a> &nbsp'
	. ' <a class="btn btn-danger btn-sm" href="' . base_url('admin/student/delete/' . $student->id) . '">Delete</a>';
	$data[] = $row;
}
echo json_encode($data);
?>