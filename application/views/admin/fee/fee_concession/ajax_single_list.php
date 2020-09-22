<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $single_concession) {
    $no++;
    $status = $single_concession->status ? 'Active' : 'In Active';
    $status_class = $single_concession->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $single_concession->admission_no;
    $row[] = $single_concession->fullname;
    $row[] = $single_concession->role_no;
    $row[] = $single_concession->class_name;
    $row[] = $single_concession->section_name;
    $row[] = $single_concession->concession_type;
    $row[] = ($single_concession->all_month == 1) ? 'Yes' : 'No';
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-info btn-sm" href="javascript:;" onclick="popup_single_concession(' . $single_concession->id . ')">View</a> &nbsp'
            . '<a class="btn btn-primary btn-sm" href="' . base_url('admin/feestructure/add_single_concession/' . $single_concession->id) .'">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_single_concession(' . $single_concession->id . ')">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>