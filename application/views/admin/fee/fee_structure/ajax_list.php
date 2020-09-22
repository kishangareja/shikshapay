<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $fee_structure) {
    $no++;
    $status = $fee_structure->status ? 'Active' : 'In Active';
    $status_class = $fee_structure->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $fee_structure->fee_type;
    $row[] = $fee_structure->fee_structure_name;
    $row[] = $fee_structure->board_name;
    $row[] = $fee_structure->name;
    $row[] = ($fee_structure->student_status == 1) ? 'New' : 'Old';
    $row[] = ($fee_structure->all_month == 1) ? 'Yes' : 'No';
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-info btn-sm" href="javascript:;" onclick="popup_fee_structure(' . $fee_structure->id . ')">View</a> &nbsp'
            . '<a class="btn btn-primary btn-sm" href="' . base_url('admin/feestructure/add_structure/' . $fee_structure->id) .'">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_fee_structure(' . $fee_structure->id . ')">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>