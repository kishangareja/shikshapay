<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $student_type) {
    $no++;
    $status = $student_type->status ? 'Active' : 'In Active';
    $status_class = $student_type->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $student_type->name;
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-primary btn-sm" href="javascript:;" onclick="popup_add_student_type(' . $student_type->id . ');">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_student_type(' . $student_type->id . ')">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>