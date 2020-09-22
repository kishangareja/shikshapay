<div id="notification_id" class="col w-md bg-white-only b-l bg-auto no-border-xs animated fadeInRight w" style="display: none;"></div>
</div>
<!-- footer -->
<footer id="footer" class="app-footer" role="footer">
    <div class="wrapper b-t bg-light">
        <span class="pull-right"><a href ui-scroll="app" class="m-l-sm text-muted"><i class="fa fa-long-arrow-up"></i></a></span>
        <?= PROJECT_NAME; ?> &copy; <?= date('Y'); ?> Copyright.
    </div>
</footer>
<!-- / footer -->

</div>

<script src="<?= base_url('assets/libs/jquery/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js'); ?>"></script>

<script src="<?= base_url('assets/libs/jquery/bootstrap/dist/js/bootstrap.js'); ?>"></script>
<script src="<?= base_url('assets/js/ui-load.js'); ?>"></script>
<script src="<?= base_url('assets/js/ui-jp.config.js'); ?>"></script>
<script src="<?= base_url('assets/js/ui-jp.js'); ?>"></script>
<script src="<?= base_url('assets/js/ui-nav.js'); ?>"></script>
<script src="<?= base_url('assets/js/ui-toggle.js'); ?>"></script>
<script src="<?= base_url('assets/js/ui-client.js'); ?>"></script>
<script src="<?= base_url('assets/libs/jquery/bootstrap-wysiwyg/bootstrap-wysiwyg.js'); ?>"></script>
<!-- sweetalert Js -->
<script src="<?= base_url('assets/regform/sweetalert.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/regform/jquery.toast.js'); ?>"></script>
<script type="text/javascript">
    var table;
    $(document).ready(function () {
    //datatables
    table = $('#table').DataTable({
    "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
            "url": $('#ajax_list_url').val(),
                    "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
            {
            "targets": '<?= isset($ajax_order_by) ? $ajax_order_by : ''; ?>', //first column / numbering column
                    "orderable": false, //set not orderable
            },
            ],
<?php if (isset($column_filter)) { ?>
        dom: 'Bfrtip',
                buttons: [{
                extend: 'csv',
                        exportOptions: {columns: <?= $column_filter; ?>}
                }, {
                extend: 'pdf',
                        exportOptions: {columns: <?= $column_filter; ?>}
                }]
<?php } ?>
    });
    }
    );

    function toast_msg(heading, icon, text) {
        $.toast({
            heading: heading,
            text: text,
            position: 'top-right',
            stack: false,
            showHideTransition: 'slide',
            icon: icon
        });
    }

    function confirm_box(id, url, title) {
        swal({
            title: "Are you sure you want to proceed?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, confirm",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: url,
                    data: {id: id},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data.success == 1) {
                            swal("Success!", title + " was deleted successfully :)", "success");
                            table.ajax.reload();
                        } else {
                            swal("Cancelled", "Something went wrong!", "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "You have cancel it", "error");
            }
        });
    }

    function getNotificationData() {
        var id = '';
        $.ajax({
            url: "<?php echo base_url('admin/home/get_notification') ?>",
            data: {id: id},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.success == 1) {
                    $('#notification_id').html(data.view).show();
                } else {

                }
            }
        });
    }
</script>
</body>
</html>
