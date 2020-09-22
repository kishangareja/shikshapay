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
                    <li class="active"><a href="javascript:;" onclick="section_type_reload('section')" data-toggle="tab" data-target="#section_list">Section</a></li>
                    <li><a href="javascript:;" onclick="section_type_reload('semester')" data-toggle="tab" data-target="#semester_list">Semester</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="section_list">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Section <a href="javascript:;" onclick="add_section(0, 'section');" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                                    <i class="fa fa-plus"></i>Add Section</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-b" id="section_table">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Section Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="semester_list">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Semester <a href="javascript:;" onclick="add_section(0, 'semester');" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                                    <i class="fa fa-plus"></i>Add Semester</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-b" id="semester_table">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Semester Name</th>
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
                </tabset>
            </div>

        </div>
        <div id="preview"></div>

    </div>
</div>
<!-- /content -->
<script>

    get_section_list('section');
    get_section_list('semester');
    var section_table;
    var semester_table;

    function section_type_reload(type) {
        if (type == 'section')
            section_table.ajax.reload();

        if (type == 'semester')
            semester_table.ajax.reload();
    }

    function get_section_list(type) {
        if (type == 'section') {
            section_table = $('#section_table').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": '<?= base_url('admin/section/ajax_list'); ?>',
                    "data": {custom_val: 'section'},
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

        if (type == 'semester') {
            semester_table = $('#semester_table').DataTable({
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": '<?= base_url('admin/section/ajax_list'); ?>',
                    "data": {custom_val: 'semester'},
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

    function add_section(id, type) {
        $.ajax({//create an ajax request to display.php
            type: "POST",
            url: "<?php echo base_url('admin/section/section_modal'); ?>",
            data: {value: id, type: type},
            dataType: "json", //expect html to be returned
            success: function (result) {
                $('#preview').html(result.view);
                $('#myModal').modal('show');
            }
        });
    }

    function delete_section(id, type) {
        $.ajax({//create an ajax request to display.php
            type: "POST",
            url: "<?php echo base_url('admin/section/section_delete'); ?>",
            data: {value: id, type: type},
            dataType: "json", //expect html to be returned
            success: function (result) {
                $('#preview').html(result.view);
                if (result.type == 'section')
                    section_table.ajax.reload();
                if (result.type == 'semester')
                    semester_table.ajax.reload();
            }
        });
    }

    function submitForm() {
        $('#success_box').css('display', 'none');
        $('#error_box').css('display', 'none');
        var formData = $("#classForm").serialize();
        $.ajax({//create an ajax request to display.php
            type: "POST",
            url: "<?php echo base_url('admin/section/add'); ?>",
            data: $("#classForm").serialize(),
            dataType: "json", //expect html to be returned
            success: function (result) {
                if (result.success == 1) {
                    if (result.type == 'section')
                        section_table.ajax.reload();
                    if (result.type == 'semester')
                        semester_table.ajax.reload();

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