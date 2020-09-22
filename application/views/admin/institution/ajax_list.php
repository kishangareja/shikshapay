<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $institution) {
	$no++;
	$status = $institution->status ? 'Active' : 'In Active';
	$status_class = $institution->status ? 'btn-success' : 'btn-danger';
	$row = array();
	$row[] = $no;
	$row[] = $institution->board_name;
	$row[] = $institution->institution_name;
	$row[] = $institution->pincode;
	$row[] = $institution->email;
//	$row[] = $institution->head_name;
	$row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
	$row[] = '<a class="btn btn-primary btn-sm" href="' . base_url('admin/institution/add/' . $institution->id) . '">Edit</a> &nbsp'
	. ' <a class="btn btn-danger btn-sm" href="' . base_url('admin/institution/delete/' . $institution->id) . '">Delete</a>';
	$data[] = $row;
}
echo json_encode($data);
?>