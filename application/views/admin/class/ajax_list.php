<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $class) {
    $no++;
    $status = $class->status ? 'Active' : 'In Active';
    $status_class = $class->status ? 'btn-success' : 'btn-danger';
    $class_id = $class->id;
    
    //$class_dtl = $this->class_model->getClassDetailData($class_id);
    $edit_class = "add_class($class_id, '" . $class_type . "');";
    $delete_class = "delete_class($class_id, '" . $class_type . "');";
    $row = array();
    $row[] = $no;
    $row[] = $class->class_name;
    //$row[] = $class_dtl ? $class_dtl->section_name : '';
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-primary btn-sm" onclick="' . $edit_class . '" href="javascript:;">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="' . $delete_class . '">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>