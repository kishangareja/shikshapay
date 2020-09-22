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
                    <?= $page; ?> <a href="javascript:;" onclick="popup_add_fee_type(0);" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                        <i class="fa fa-plus"></i>Add Fee Type</a>
                    <div class="clearfix"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Fee Type Name</th>
                                <th>Payment Gateway</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/feestructure/ajax_fee_type_list'); ?>">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="popup_fee_type" tabindex="-1" role="basic" aria-hidden="true"></div>
<!-- /content -->
<script>
    function popup_add_fee_type(id) {
        $.ajax({
            url: "<?= base_url('admin/feestructure/ajax_add_fee_type'); ?>",
            data: {fee_type_id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_fee_type').modal('show');
                $("#popup_fee_type").html(response.view);
            }
        });
    }

    function add_fee_type() {
        $.ajax({
            url: '<?= base_url('admin/feestructure/add_fee_type'); ?>',
            type: 'POST',
            data: $('#frmaddfeetype').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    table.ajax.reload();
                    $("#popup_fee_type").modal('hide');
                    toast_msg("Success", "success", data.msg);
                } else {
                    $('#name_err').html(data.error.name);
                    $('#gateway_err').html(data.error.gateway);
                    toast_msg("Error", "error", data.msg);
                }
            }
        });
    }

    function delete_fee_type(id) {
        confirm_box(id, "<?= base_url('admin/feestructure/delete_fee_type'); ?>", 'Fee Type');
    }
</script>