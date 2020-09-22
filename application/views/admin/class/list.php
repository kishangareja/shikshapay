<!-- content -->
<script src="<?= base_url('assets/libs/jquery/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js'); ?>"></script>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <div class="wrapper-md">

            <div class="tab-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="javascript:;" onclick="class_type_reload('class')" data-toggle="tab" data-target="#class_list">Class</a></li>
                    <li><a href="javascript:;" onclick="class_type_reload('program')" data-toggle="tab" data-target="#program_list">Program</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="class_list">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Class <a href="javascript:;" onclick="add_class(0, 'class');" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                                    <i class="fa fa-plus"></i>Add Class</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-b" id="class_table">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Class Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="program_list">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Program <a href="javascript:;" onclick="add_class(0, 'program');" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                                    <i class="fa fa-plus"></i>Add Program</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-b" id="program_table">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Program Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="preview"></div>

    </div>
</div>
<!-- /content -->
<script>
    get_class_list('class');
    get_class_list('program');
    var class_table;
    var program_table;

    function class_type_reload(type) {
        if (type == 'class')
            class_table.ajax.reload();

        if (type == 'program')
            program_table.ajax.reload();
    }

    function get_class_list(type) {
        if (type == 'class') {
            class_table = $('#class_table').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": '<?= base_url('admin/classes/ajax_list'); ?>',
                    "data": {custom_val: 'class'},
                    "type": "POST",
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                    {
                        "targets": <?= $ajax_order_by; ?>, //first column / numbering column
                        "orderable": false, //set not orderable
                    },
                ]
            });
        }

        if (type == 'program') {
            program_table = $('#program_table').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": '<?= base_url('admin/classes/ajax_list'); ?>',
                    "data": {custom_val: 'program'},
                    "type": "POST",
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                    {
                        "targets": <?= $ajax_order_by; ?>, //first column / numbering column
                        "orderable": false, //set not orderable
                    },
                ]
            });
        }
    }

    function add_class(id, type) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/classes/class_modal'); ?>",
            data: {value: id, type: type},
            dataType: "json", //expect html to be returned
            success: function (result) {
                $('#preview').html(result.view);
                $('#myModal').modal('show');
            }
        });
    }

    function delete_class(id, type) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/classes/delete_class'); ?>",
            data: {value: id, type: type},
            dataType: "json", //expect html to be returned
            success: function (result) {
                $('#preview').html(result.view);
                if (result.type == 'class')
                    class_table.ajax.reload();
                if (result.type == 'program')
                    program_table.ajax.reload();
            }
        });
    }

    function submitForm() {
        $('#success_box').css('display', 'none');
        $('#error_box').css('display', 'none');
        $.ajax({//create an ajax request to display.php
            type: "POST",
            url: "<?php echo base_url('admin/classes/add'); ?>",
            data: $("#classForm").serialize(),
            dataType: "json", //expect html to be returned
            success: function (result) {
                if (result.success == 1) {
                    if (result.type == 'class')
                        class_table.ajax.reload();
                    if (result.type == 'program')
                        program_table.ajax.reload();
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