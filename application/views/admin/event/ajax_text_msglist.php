<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $message) {
    $no++;
    $row = array();
    $row[] = $no;
    $row[] = $message->receiver;
    $row[] = $message->message;
    $row[] = $message->creation_datetime ? date('d-m-Y H:i:s', strtotime($message->creation_datetime)) : '';
    $row[] = '<a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_message(' . $message->id . ')">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>