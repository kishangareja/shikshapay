<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $fee_type) {
    $no++;
    $status = $fee_type->status ? 'Active' : 'In Active';
    $status_class = $fee_type->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $fee_type->name;
    $row[] = $fee_type->gateway;
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-primary btn-sm" href="javascript:;" onclick="popup_add_fee_type(' . $fee_type->id . ');">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_fee_type(' . $fee_type->id . ')">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>