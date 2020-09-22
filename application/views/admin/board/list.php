<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="hbox hbox-auto-xs hbox-auto-sm">

            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3"><?=$page;?></h1>
            </div>
            <?php //$this->load->view('_partials/messages'); ?>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?=$page;?> <a href="javascript:;" onclick="popup_add_board(0);" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                            <i class="fa fa-plus"></i>Add Board</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-b" id="table">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Board Type</th>
                                    <th>Board Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <input type="hidden" id="ajax_list_url" value="<?=base_url('admin/board/ajax_list');?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / right col -->
</div>
<div class="modal fade" id="popup_board" tabindex="-1" role="basic" aria-hidden="true"></div>
<!-- /content -->
<script>
    function popup_add_board(id) {
        $.ajax({
            url: "<?=base_url('admin/board/ajax_add_board');?>",
            data: {board_id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_board').modal('show');
                $("#popup_board").html(response.view);
            }
        });
    }

    function add_board() {
        $.ajax({
            url: '<?=base_url('admin/board/add');?>',
            type: 'POST',
            data: $('#frmaddboard').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    table.ajax.reload();
                    $("#popup_board").modal('hide');
                } else {
                    $('#board_name_err').html(data.error.board_name);
                }
            }
        });
    }
</script>