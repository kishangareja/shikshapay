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
                    <?= $page; ?> <a href="<?= base_url('admin/feestructure/add_additional_fee'); ?>" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                        <i class="fa fa-plus"></i>Add Additional Fee</a>
                    <div class="clearfix"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Admission No</th>
                                <!--<th>Additional Fee</th>-->
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
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/feestructure/ajax_additional_fee_list'); ?>">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="popup_additional_fee" tabindex="-1" role="basic" aria-hidden="true"></div>
<!-- /content -->
<script>
    function popup_additional_fee(id) {
        $.ajax({
            url: "<?= base_url('admin/feestructure/ajax_additional_fee_class'); ?>",
            data: {additional_fee_id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_additional_fee').modal('show');
                $("#popup_additional_fee").html(response.view);
            }
        });
    }

    function delete_additional_fee(id) {
        confirm_box(id, "<?= base_url('admin/feestructure/delete_additional_fee'); ?>", 'Additional Fee');
    }
    
    function next_button(id) {
        $('#' + id).click();
    }
</script>