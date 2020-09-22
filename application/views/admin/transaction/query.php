<link href="<?= base_url('assets/libs/jquery/bootstrap-daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css" media="all" />
<script src="<?= base_url('assets/libs/jquery/moment/moment.js'); ?>"></script>
<script src="<?= base_url('assets/libs/jquery/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<script src="<?= base_url('assets/export/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/export/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/export/jszip.min.js'); ?>"></script>
<script src="<?= base_url('assets/export/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('assets/export/vfs_fonts.js'); ?>"></script>
<script src="<?= base_url('assets/export/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/export/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/jquery/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.js'); ?>"></script>
<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    <?php echo $page; ?>
                    <?php
                    if($querydata){
                        $qrydata = json_decode($querydata);
                        $transaction_date = $qrydata->transaction_date;
                        $txn_reference = $qrydata->txn_reference;
                        $order_id = $qrydata->order_id;
                        $payment_type = $qrydata->payment_type;
                        $status = $qrydata->status;
                    }
                    ?>
                </div>
                <div class="panel-body">
                    <form method="post" action="" id="frmtransaction_query">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Transaction Date</label>
                                                <input name="transaction_date" id="transaction_date" type="text" class="form-control" value="<?= $transaction_date; ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>PG Order Id</label>
                                                <input name="txn_reference" id="txn_reference_no" type="text" class="form-control" value="<?= $txn_reference; ?>" placeholder="PG Reference Number">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Shikshapay Order Id</label>
                                                <input name="order_id" id="order_id" type="text" class="form-control" value="<?= $order_id; ?>" placeholder="Shikshapay Order Id">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php /*<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Class</label>
                                                <input name="class" id="class" type="text" class="form-control" value="" disabled="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Section</label>
                                                <input name="section" id="section" type="text" class="form-control" disabled="">
                                            </div>
                                        </div>*/ ?>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Payment Type</label>
                                                <select name="payment_type" id="payment_type" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="online" <?= $payment_type == 'online' ? 'selected="selected"' : ''; ?>>Online</option>
                                                    <option value="offline" <?= $payment_type == 'offline' ? 'selected="selected"' : ''; ?>>Offline</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Shikshapay Status<?= $status; ?></label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">All</option>
                                                    <option value="0" <?= $status == '0' ? 'selected="selected"' : ''; ?>>Pending</option>
                                                    <option value="1" <?= $status == '1' ? 'selected="selected"' : ''; ?>>Success</option>
                                                    <option value="2" <?= $status == '2' ? 'selected="selected"' : ''; ?>>Cancel</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-sm-12">&nbsp;</label>
                                                <div class="col-md-3" style="padding-left: 7px;">
                                                    <input class="btn btn-primary" type="submit" name="submit" value="Search">
                                                </div>
                                                <div class="col-md-3">
                                                    <input class="btn btn-danger" type="reset" name="reset" value="Reset">
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="exportfile" id="exportfile" class="form-control">
                                                        <option value="">Export</option>
                                                        <option value="csv">Download CSV</option>
                                                        <option value="pdf">Download PDF</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table_query">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Date</th>
                                <th>Payment Type</th>
                                <th>PG Orderid</th>
                                <th>Shikshapay Orderid</th>
                                <!--<th>Admission No</th>-->
                                <th>Class</th>
                                <th>Section</th>
                                <!--<th>Installment</th>-->
                                <th>PG Status</th>
                                <th>Shikshapay Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <table id="table-export" style="display: none;">
            <thead>
                <tr>
                    <th>Sr</th>
                    <th>Date</th>
                    <th>Payment Type</th>
                    <th>PG Orderid</th>
                    <th>Shikshapay Orderid</th>
                    <!--<th>Admission No</th>-->
                    <th>Class</th>
                    <th>Section</th>
                    <!--<th>Installment</th>-->
                    <th>PG Status</th>
                    <th>Shikshapay Status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<!-- /content -->
<script type="text/javascript">
    submit_query(<?= $querydata; ?>);
    $('#transaction_date').daterangepicker();
    $(document).ajaxComplete(function () {
        $('.buttons-csv, .buttons-pdf').hide();
        $('#table-export_paginate').remove();
        $('#table-export_info').remove();
        $('#table-export_filter').remove();
    });
    var tbexport = $('#table-export').DataTable({
        "serverSide": true,
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": '<?= base_url('admin/transaction/ajax_export_query'); ?>',
            "type": "POST"
        },
        dom: 'Bfrtip',
        buttons: ['csv', 'pdf']
    });
    $('[name="exportfile"]').on('change', function () {
        var type = $(this).val();
        tbexport.ajax.reload();
        $('.buttons-' + type).click();
        $('.buttons-csv, .buttons-pdf').hide();
        $('#table-export_paginate').remove();
        $('#table-export_info').remove();
        $('#table-export_filter').remove();
    });

    function submit_query(querydata) {
        $('#table_query').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": '<?= base_url('admin/transaction/ajax_query_list'); ?>',
                "data": querydata,
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
</script>