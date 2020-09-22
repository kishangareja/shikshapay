<link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.css'); ?>" type="text/css" />
<script src="<?= base_url('assets/js/jquery-ui.js'); ?>"></script>
<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= $page; ?> 
                    <a href="javascript:;" onclick="addStudent(0);" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                        <i class="fa fa-plus"></i>Add Student</a>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    <form method="post" action="<?= base_url('admin/student/upload'); ?>" id="frmstd_upload" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-md-12">
                                    <label class="control-label col-md-1" style="padding-top: 8px;">Upload File:</label>
                                    <div class="col-md-4">
                                        <input type="file" name="upload_student" id="upload_student" class="form-control">
                                    </div>
                                    <div class="col-md-1">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Upload">
                                    </div>
                                    <div class="col-md-2">
                                        <input class="btn btn-primary" type="button" name="download" onclick="$('#frmstd_download').submit();" value="Download">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form method="post" action="<?= base_url('admin/student/download'); ?>" id="frmstd_download" enctype="multipart/form-data"></form>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Registration Id</th>
                                <th>Role Number</th>
                                <th>Full Name</th>
                                <th>DOB</th>
                                <th>UserName</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/student/ajax_list'); ?>">
                </div>
            </div>
        </div>

        <div id="preview"></div>


    </div>
</div>
<!-- /content -->



<script>

    function addStudent(id) {

        $.ajax({//create an ajax request to display.php
            type: "POST",
            url: "<?php echo base_url('admin/student/student_modal'); ?>",
            data: {student_id: id},
            dataType: "json", //expect html to be returned

            success: function (result) {
                $('#preview').html(result.view);
                $('#myModal').modal('show');
            }
        });
    }


    function submitForm() {
        $('#success_box').css('display', 'none');
        $('#error_box').css('display', 'none');
        var formData = new FormData($('#classForm')[0]);

        $.ajax({//create an ajax request to display.php
            type: "POST",
            url: "<?php echo base_url('admin/student/add'); ?>",
            data: formData,
            dataType: "json", //expect html to be returned
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success == 1) {
                    table.ajax.reload();
                    $('#success-message').html(result.message);
                    $('#success_box').css('display', 'block');
                    $('#myModal').modal('hide');
                } else {
                    $.each(result.error, function (k, v) {
                        $('#' + k + '_err').html(v);
                    });
                }

            }
        });
    }
</script>