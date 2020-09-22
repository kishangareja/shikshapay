<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $bulk_concession) {
    $no++;
    $status = $bulk_concession->status ? 'Active' : 'In Active';
    $status_class = $bulk_concession->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $bulk_concession->name;
    $row[] = $bulk_concession->concession_type;
    $row[] = ($bulk_concession->all_month == 1) ? 'Yes' : 'No';
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-info btn-sm" href="javascript:;" onclick="popup_bulk_concession(' . $bulk_concession->id . ')">View</a> &nbsp'
            . '<a class="btn btn-primary btn-sm" href="' . base_url('admin/feestructure/add_bulk_concession/' . $bulk_concession->id) .'">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="javascript:;" onclick="delete_bulk_concession(' . $bulk_concession->id . ')">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>