<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $transaction) {
    $no++;
    $row = array();
    $row[] = $no;
    $row[] = $transaction->transaction_date ? date('d/m/y', strtotime($transaction->transaction_date)) : '';
    $row[] = $transaction->txn_orderid;
    $row[] = '<a class="btn btn-primary btn-sm" href="'. base_url('admin/invoice/gst_invoice').'">Download</a>';
    $data[] = $row;
}
echo json_encode($data);
?>