<link href="<?= base_url('assets/libs/jquery/bootstrap-daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css" media="all" />
<script src="<?= base_url('assets/libs/jquery/moment/moment.js'); ?>"></script>
<script src="<?= base_url('assets/libs/jquery/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
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
                    <?= $page; ?> <a href="javascript:;" onclick="popup_add_fee_installment(0);" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                        <i class="fa fa-plus"></i>Add Fee Installment</a>
                    <div class="clearfix"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Fee Installment Name</th>
                                <th>Fee Collection Start</th>
                                <th>Fee Collection End</th>
                                <th>Late Fee Type</th>
                                <th>Late Fee Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/feestructure/ajax_fee_installment_list'); ?>">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="popup_fee_installment" tabindex="-1" role="basic" aria-hidden="true"></div>
<!-- /content -->
<script>
    function popup_add_fee_installment(id) {
        $.ajax({
            url: "<?= base_url('admin/feestructure/ajax_add_fee_installment'); ?>",
            data: {fee_installment_id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_fee_installment').modal('show');
                $("#popup_fee_installment").html(response.view);
            }
        });
    }

    function add_fee_installment() {
        $.ajax({
            url: '<?= base_url('admin/feestructure/add_fee_installment'); ?>',
            type: 'POST',
            data: $('#frmaddfee_installment').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    table.ajax.reload();
                    $("#popup_fee_installment").modal('hide');
                    toast_msg("Success", "success", data.msg);
                } else {
                    $('#name_err').html(data.error.name);
                    $('#fee_range_err').html(data.error.fee_range);
                    $('#late_amount_err').html(data.error.late_amount);
                    if (data.msg)
                        toast_msg("Error", "error", data.msg);
                }
            }
        });
    }

    function delete_fee_installment(id) {
        confirm_box(id, "<?= base_url('admin/feestructure/delete_fee_installment'); ?>", 'Fee Installment');
    }
</script>