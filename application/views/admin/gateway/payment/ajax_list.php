<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $gateway) {
    $no++;
    $status = $gateway->status ? 'Active' : 'In Active';
    $status_class = $gateway->status ? 'btn-success' : 'btn-danger';
    $is_default = $gateway->is_default ? 'Yes' : 'No';
    $default_class = $gateway->is_default ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = ucfirst($gateway->gateway) . '_' . $gateway->gateway_name;
    $row[] = $gateway->merchant_id;
    $row[] = $gateway->key;
    $row[] = '<span class="btn btn-xs m-t-xs ' . $default_class . '">' . $is_default . '</span>';
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-primary btn-sm" href="javascript:;" onclick="popup_add_pgateway(' . $gateway->id . ');">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_pgateway(' . $gateway->id . ');">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>