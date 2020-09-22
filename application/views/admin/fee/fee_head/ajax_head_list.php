<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $head) {
    $no++;
    $status = $head->status ? 'Active' : 'In Active';
    $status_class = $head->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $head->name;
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-primary btn-sm" href="javascript:;" onclick="popup_add_head(' . $head->id . ');">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_head(' . $head->id . ')">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>