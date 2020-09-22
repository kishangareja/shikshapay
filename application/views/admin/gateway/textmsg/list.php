<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <?=$page;?> <a href="javascript:;" onclick="popup_add_mgateway(0);" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                            <i class="fa fa-plus"></i>Add Text Message Gateway</a>
                        <div class="clearfix"></div>
                    </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Gateway</th>
                                <th>Key</th>
                                <th>Default</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/gateway/ajax_textlist'); ?>">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="popup_gateway" tabindex="-1" role="basic" aria-hidden="true"></div>
<!-- /content -->
<script>
    function popup_add_mgateway(id) {
        $.ajax({
            url: "<?=base_url('admin/gateway/ajax_add_tgateway');?>",
            data: {gateway_id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_gateway').modal('show');
                $("#popup_gateway").html(response.view);
            }
        });
    }

    function add_mgateway() {
        $.ajax({
            url: '<?=base_url('admin/gateway/textmsgedit');?>',
            type: 'POST',
            data: $('#frmaddegateway').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    table.ajax.reload();
                    $("#popup_gateway").modal('hide');
                } else {
                    $('#gateway_err').html(data.error.gateway);
                    $('#gateway_name_err').html(data.error.gateway_name);
                    $('#key_err').html(data.error.key);
                }
            }
        });
    }
    
    function delete_mgateway(id) {
        confirm_box(id, "<?=base_url('admin/gateway/delete_mgateway');?>", 'Email Gateway');
    }
</script>