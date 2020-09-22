<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $role_group) {
    $no++;
    $row = array();
    $row[] = $no;
    $row[] = $role_group->groupName;
    $row[] = '<a class="btn btn-primary btn-sm" href="javascript:;" onclick="popup_rolegroup(' . $role_group->group_id . ');">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_rolegroup(' . $role_group->group_id . ')">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>