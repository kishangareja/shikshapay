<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <div class="wrapper-md">

            <div class="tab-container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_actions_pending" data-toggle="tab"> Role Group </a>
                    </li>
                    <li>
                        <a href="#tab_actions_completed" data-toggle="tab"> Role Permission </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_actions_pending">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?= $title; ?> <a href="javascript:;" onclick="popup_rolegroup(0);" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                                    <i class="fa fa-plus"></i>Add Role Group</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped b-t b-b" id="table">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Group Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/rolemodel/ajax_role_list'); ?>">
                            </div>				
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_actions_completed">
                        <div class="mt-actions">
                            <div class="portlet-body">
                                <div class="tab-pane" id="permission"></div>  
                                <!-- END: Completed -->
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            <div class="modal fade" id="popup_rolemodel" tabindex="-1" role="basic" aria-hidden="true"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var baseURL = '<?php echo base_url('admin/rolemodel/permission'); ?>';
        $('#permission').load(baseURL + '/permission', function () {});
    });
    
    function popup_rolegroup(id) {
        $.ajax({
            url: "<?= base_url('admin/rolemodel/ajax_rolegroup'); ?>",
            data: {group_id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_rolemodel').modal('show');
                $("#popup_rolemodel").html(response.view);
            }
        });
    }
    
    function add_group() {
        $.ajax({
            url: '<?= base_url('admin/rolemodel/add'); ?>',
            type: 'POST',
            data: $('#frmaddgroup').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    table.ajax.reload();
                    $("#popup_rolemodel").modal('hide');
                } else {
                    $('#groupName_err').html(data.error.groupName);
                }
            }
        });
    }
    
    function delete_rolegroup(id) {
        confirm_box(id, '<?= base_url("admin/rolemodel/delete"); ?>', 'Role Group');
    }
</script>