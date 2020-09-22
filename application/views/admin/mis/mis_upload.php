<link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.css'); ?>">
<script src="<?= base_url('assets/js/jquery-ui.js'); ?>"></script>
<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?php echo $page; ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    <?php echo $page; ?>
                </div>
                <div class="panel-body">
                    <form method="post" action="" id="frmmis_upload" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <div class="row">
                                        <label class="control-label col-md-1" style="padding-top: 8px;">Upload File:</label>
                                        <div class="col-md-4">
                                            <input type="file" name="upload_mis" id="upload_mis" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <input class="btn btn-primary" type="submit" name="submit" value="Upload">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
