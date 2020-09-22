<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $transaction) {
    $no++;
    $status = $transaction->status ? 'Success' : 'Pending';
    $status_class = $transaction->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $transaction->creation_datetime ? date('d/m/y H:i:s', strtotime($transaction->creation_datetime)) : '';
    $row[] = $transaction->id;
    $row[] = $transaction->created_by;
    $row[] = $transaction->txn_orderid;
    $row[] = $transaction->payment_type;
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-primary btn-sm" href="javascript:;" onclick="popup_resolution_center(' . $transaction->id . ');">View</a>';
    $data[] = $row;
}
echo json_encode($data);
?>