<?php

$data = array();
$no = $_POST['start'];
foreach ($list as $app) {
    $no++;
    $status = $app->status ? 'Active' : 'In Active';
    $status_class = $app->status ? 'btn-success' : 'btn-danger';
    $row = array();
    $premium = $this->gateway_model->getPayGatewayById($app->name);
    
//    $row[] = $no;
    $row[] = '<img src="' . base_url() . APPSTORE . $app->image . '" style="height:40px;width:50px;"/>';
    $row[] = $app->title;
    $row[] = $app->name;
    $row[] = $app->short_desc;
    $row[] = $app->amount;
    $row[] = '<span class="btn btn-xs m-t-xs ' . $status_class . '">' . $status . '</span>';
    $row[] = '<a class="btn btn-primary btn-sm" href="' . base_url('admin/app_store/add/' . $app->id) . '">Edit</a> &nbsp'
            . ' <a class="btn btn-danger btn-sm" href="' . base_url('admin/app_store/delete/' . $app->id) . '">Delete</a>';
    $data[] = $row;
}
echo json_encode($data);
?>