<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Search by Case ID or Shikshapay Order Id</label>
                            <input type="text" name="case_id" id="case_id" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Payment Type</label>
                            <select name="payment_type" class="form-control">
                                <option value="">All</option>
                                <option value="online">Online</option>
                                <option value="offline">Offline</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Case Status</label>
                            <select name="case_status" class="form-control">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="success">Success</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="col-md-12">&nbsp;</label>
                            <input class="btn btn-primary col-md-5" type="button" name="search" value="Search">
                            <input class="btn btn-danger col-md-5 col-md-offset-1" type="reset" name="reset" value="Reset">
                        </div>
                    </div>

                    <div class="table-responsive"><br>
                        <table class="table table-striped b-t b-b" id="table">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Issued On</th>
                                    <th>Case Id</th>
                                    <th>Created By</th>
                                    <th>Shikshapay Orderid</th>
                                    <th>Payment Type</th>
                                    <th>Case Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/resolution_center/ajax_resolution_center'); ?>">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /content -->
<div class="modal fade" id="popup_resolution_center" tabindex="-1" role="basic" aria-hidden="true"></div>
<script>
    function popup_resolution_center(id) {
        $.ajax({
            url: "<?= base_url('admin/resolution_center/ajax_get_resolution_center'); ?>",
            data: {id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_resolution_center').modal('show');
                $("#popup_resolution_center").html(response.view);
            }
        });
    }

    function add_comment() {
        $.ajax({
            url: '<?= base_url('admin/resolution_center/ajax_update_resolution_center'); ?>',
            type: 'POST',
            data: {id: $('#request_id').val(), comment: $('#comment').val(), status: $('#status').val()},
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    table.ajax.reload();
                    $("#popup_resolution_center").modal('hide');
                } 
            }
        });
    }
</script>