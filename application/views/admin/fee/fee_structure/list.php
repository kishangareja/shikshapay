<!-- content -->
<style>
    label{font-weight: bold;}
</style>
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <?php //$this->load->view('_partials/messages'); ?>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= $page; ?> <a href="<?= base_url('admin/feestructure/add_structure'); ?>" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                        <i class="fa fa-plus"></i>Add Fee Structure</a>
                    <div class="clearfix"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-b" id="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Fee Type</th>
                                <th>Fee Structure Name</th>
                                <th>Board Name</th>
                                <th>Student Type</th>
                                <th>Student Status</th>
                                <th>Same for All</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/feestructure/ajax_fee_structure_list'); ?>">
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="popup_fee_structure" tabindex="-1" role="basic" aria-hidden="true"></div>
<!-- /content -->
<script>
    function popup_fee_structure(id) {
        $.ajax({
            url: "<?= base_url('admin/feestructure/ajax_fee_structure_class'); ?>",
            data: {fee_structure_id: id},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $('#popup_fee_structure').modal('show');
                $("#popup_fee_structure").html(response.view);
            }
        });
    }

    function delete_fee_structure(id) {
        confirm_box(id, "<?= base_url('admin/feestructure/delete_fee_structure'); ?>", 'Fee Structure');
    }
    
    function next_button(id) {
        $('#' + id).click();
    }
</script>