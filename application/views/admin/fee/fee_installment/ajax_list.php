<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $fee_installment) {
    $no++;
    $status = $fee_installment->status ? 'Active' : 'In Active';
    $status_class = $fee_installment->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $fee_installment->name;
    $row[] = $fee_installment->fee_range_start;
    $row[] = $fee_installment->fee_range_end;
    $row[] = ($fee_installment->late_fee_type == 'one_time') ? 'One Time' : ucfirst($fee_installment->late_fee_type);
    $row[] = $fee_installment->late_fee_amount;
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-primary btn-sm" href="javascript:;" onclick="popup_add_fee_installment(' . $fee_installment->id . ');">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_fee_installment(' . $fee_installment->id . ')">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>