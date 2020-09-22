<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <?php //$this->load->view('_partials/messages'); ?>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= $page; ?> <a href="javascript:;" onclick="popup_add_head(0);" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                        <i class="fa fa-plus"></i>Add Head</a>
                    <div class="clearfix"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Head Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/feestructure/ajax_head_list'); ?>">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="popup_head" tabindex="-1" role="basic" aria-hidden="true"></div>
<!-- /content -->
<script>
    function popup_add_head(id) {
        $.ajax({
            url: "<?= base_url('admin/feestructure/ajax_add_head'); ?>",
            data: {head_id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_head').modal('show');
                $("#popup_head").html(response.view);
            }
        });
    }

    function add_head() {
        $.ajax({
            url: '<?= base_url('admin/feestructure/add_head'); ?>',
            type: 'POST',
            data: $('#frmaddhead').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    table.ajax.reload();
                    $("#popup_head").modal('hide');
                    toast_msg("Success", "success", data.msg);
                } else {
                    $('#name_err').html(data.error.name);
                    toast_msg("Error", "error", data.msg);
                }
            }
        });
    }

    function delete_head(id) {
        confirm_box(id, "<?= base_url('admin/feestructure/delete_head'); ?>", 'Head');
    }
</script>