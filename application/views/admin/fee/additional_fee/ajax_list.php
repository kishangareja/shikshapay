<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $additional_fee) {
    $no++;
    $status = $additional_fee->status ? 'Active' : 'In Active';
    $status_class = $additional_fee->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $additional_fee->admission_no;
//    $row[] = $additional_fee->additional_fee;
    $row[] = $additional_fee->fullname;
    $row[] = $additional_fee->role_no;
    $row[] = $additional_fee->class_name;
    $row[] = $additional_fee->section_name;
    $row[] = $additional_fee->concession_type;
    $row[] = ($additional_fee->all_month == 1) ? 'Yes' : 'No';
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-info btn-sm" href="javascript:;" onclick="popup_additional_fee(' . $additional_fee->id . ')">View</a> &nbsp'
            . '<a class="btn btn-primary btn-sm" href="' . base_url('admin/feestructure/add_additional_fee/' . $additional_fee->id) .'">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_additional_fee(' . $additional_fee->id . ')">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>