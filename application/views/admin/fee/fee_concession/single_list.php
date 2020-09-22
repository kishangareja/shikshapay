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
                    <?= $page; ?> <a href="<?= base_url('admin/feestructure/add_single_concession'); ?>" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                        <i class="fa fa-plus"></i>Add Single Fee Concession</a>
                    <div class="clearfix"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Admission No</th>
                                <th>Fullname</th>
                                <th>Roll No</th>
                                <th>Class Name</th>
                                <th>Section Name</th>
                                <th>Concession Yype</th>
                                <th>Same for all</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/feestructure/ajax_single_concession_list'); ?>">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="popup_single_concession" tabindex="-1" role="basic" aria-hidden="true"></div>
<!-- /content -->
<script>
    function popup_single_concession(id) {
        $.ajax({
            url: "<?= base_url('admin/feestructure/ajax_single_concession_class'); ?>",
            data: {single_concession_id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_single_concession').modal('show');
                $("#popup_single_concession").html(response.view);
            }
        });
    }

    function delete_single_concession(id) {
        confirm_box(id, "<?= base_url('admin/feestructure/delete_single_concession'); ?>", 'Bulk Fee Concession');
    }
    
    function next_button(id) {
        $('#' + id).click();
    }
</script>