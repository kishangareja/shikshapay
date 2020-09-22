<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $board) {
    $no++;
    $status = $board->status ? 'Active' : 'In Active';
    $status_class = $board->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $row[] = $no;
    $row[] = $board->board_type;
    $row[] = $board->board_name;
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-primary btn-sm" href="javascript:;" onclick="popup_add_board(' . $board->id . ');">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="' . base_url('admin/board/delete/' . $board->id) . '">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>