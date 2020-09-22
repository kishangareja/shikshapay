<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= $page; ?> <a href="<?= base_url('admin/message/send_textmsg'); ?>" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                        <i class="fa fa-plus"></i>Send Text Message</a>
                    <div class="clearfix"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Mobile Number</th>
                                <th>Message</th>
                                <th>Message Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/message/ajax_textlist'); ?>">
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /content -->
<script>
    function delete_message(id) {
        confirm_box(id, "<?= base_url('admin/message/delete_message'); ?>", 'Text Message');
    }
</script>