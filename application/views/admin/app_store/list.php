<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="hbox hbox-auto-xs hbox-auto-sm">

            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3"><?= $page; ?></h1>
            </div>
            <div class="wrapper-md">
            <?php $this->load->view('_partials/messages'); ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= $page; ?> <a href="<?= base_url('admin/app_store/add'); ?>" class="pull-right btn m-b-xs btn-sm btn-primary btn-addon">
                            <i class="fa fa-plus"></i>Add App Store</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-b" id="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Short Desc</th>
                                    <th>Credit</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <input type="hidden" id="ajax_list_url" value="<?= base_url('admin/app_store/ajax_list'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / right col -->
</div>
<!-- /content -->