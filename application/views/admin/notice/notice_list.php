<!-- content -->
        <link rel="stylesheet" href="<?=base_url('assets/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.css');?>" type="text/css" />

<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?=$page;?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$page;?> <a href="<?=base_url('admin/notice/add_notice');?>" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                        <i class="fa fa-plus"></i>Add Notice</a>
                    <div class="clearfix"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table1">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>User Type</th>
                                <th>User/Institution</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
if ($notice_data) {
	$i = 1;
	foreach ($notice_data as $key => $value) {?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo ucfirst($value->user_type) ?></td>
                                <td><?php echo $value->institution_name ?></td>
                                <td><?php echo $value->creation_datetime ?></td>
                                <td><a class="btn btn-primary" href="<?php echo base_url('admin/notice/notice_detail/') . $value->id ?>">view</a></td>
                            </tr>
                                <?php }}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /content -->
<script src="<?=base_url('assets/libs/jquery/datatables/media/js/jquery.dataTables.min.js');?>"></script>
<script src="<?=base_url('assets/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js');?>"></script>


<script>
    function delete_message(id) {
        confirm_box(id, "<?=base_url('admin/notice/delete_message');?>", 'Text Message');
    }
    // table.destroy();
    $("#table1").DataTable();

</script>