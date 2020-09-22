<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $transaction) {
    $no++;
    $pgstatus = $transaction->payment_status == 'S' ? 'Success' : 'Pending';
    $pgstatus_class = $transaction->payment_status == 'S' ? 'btn-success' : 'btn-danger';
    $status = $transaction->status ? 'Success' : 'Pending';
    $status_class = $transaction->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $transaction->transaction_date ? date('d/m/y', strtotime($transaction->transaction_date)) : '';
    $row[] = $transaction->payment_type;
    $row[] = $transaction->pgorderid;
    $row[] = $transaction->txn_orderid;
//    $row[] = $transaction->admission_no;
    $row[] = $transaction->class_name;
    $row[] = $transaction->section_name;
    //$row[] = $transaction->name;
    $row[] = '<span class="btn btn-xs m-t-xs ' . $pgstatus_class . '">' . $pgstatus . '</span>';
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = $transaction->status == 0 ? '<a class="btn btn-primary btn-sm" href="'. base_url('admin/resolution_center/add').'">Dispute</a>' : '';
    $data[] = $row;
}
echo json_encode($data);
?>