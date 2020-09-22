<script src="<?= base_url('assets/export/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/export/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/export/jszip.min.js'); ?>"></script>
<script src="<?= base_url('assets/export/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('assets/export/vfs_fonts.js'); ?>"></script>
<script src="<?= base_url('assets/export/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/export/buttons.print.min.js'); ?>"></script>
<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="table-responsive" style="width: 98%; margin: 0 auto;">
                    <table class="table table-striped b-t b-b" id="table" style="width: 100%; margin: 0 auto;">
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/transaction/ajax_history_list'); ?>">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content -->
<script type="text/javascript">

</script>