<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $gateway) {
	$no++;
	$status = $gateway->status ? 'Active' : 'In Active';
	$status_class = $gateway->status ? 'btn-success' : 'btn-danger';
	$row = array();
	$row[] = $no;
	$row[] = $gateway->name;
	$row[] = $gateway->type;
	$row[] = $gateway->live_url;
	$row[] = $gateway->test_url;
	$row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
	$row[] = '<a class="btn btn-primary btn-sm" href="javascript:;" onclick="popup_add_mgateway(' . $gateway->id . ');">Edit</a> ';
	$data[] = $row;
}
echo json_encode($data);
?>