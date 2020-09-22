<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $section) {
    $no++;
    $status = $section->status ? 'Active' : 'In Active';
    $status_class = $section->status ? 'btn-success' : 'btn-danger';
    $section_id = $section->id;
    $edit_section = "add_section($section_id, '" . $section_type . "');";
    $delete_section = "delete_section($section_id, '" . $section_type . "');";
    $row = array();
    $row[] = $no;
    $row[] = $section->section_name;
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-primary btn-sm" onclick="' . $edit_section . '" href="javascript:;">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="' . $delete_section . '">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>