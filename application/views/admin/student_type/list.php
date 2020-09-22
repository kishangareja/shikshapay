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
                    <?= $page; ?> <a href="javascript:;" onclick="popup_add_student_type(0);" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                        <i class="fa fa-plus"></i>Add Student Type</a>
                    <div class="clearfix"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Student Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/student_type/ajax_student_type_list'); ?>">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="popup_student_type" tabindex="-1" role="basic" aria-hidden="true"></div>
<!-- /content -->
<script>
    function popup_add_student_type(id) {
        $.ajax({
            url: "<?= base_url('admin/student_type/ajax_add_student_type'); ?>",
            data: {student_type_id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_student_type').modal('show');
                $("#popup_student_type").html(response.view);
            }
        });
    }

    function add_student_type() {
        $.ajax({
            url: '<?= base_url('admin/student_type/add_student_type'); ?>',
            type: 'POST',
            data: $('#frmaddstudent_type').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    table.ajax.reload();
                    $("#popup_student_type").modal('hide');
                    toast_msg("Success", "success", data.msg);
                } else {
                    $('#name_err').html(data.error.name);
                    toast_msg("Error", "error", data.msg);
                }
            }
        });
    }

    function delete_student_type(id) {
        confirm_box(id, "<?= base_url('admin/student_type/delete_student_type'); ?>", 'Student Type');
    }
</script>