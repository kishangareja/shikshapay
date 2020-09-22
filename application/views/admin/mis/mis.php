<link rel="stylesheet" href="<?= base_url('assets/libs/jquery/chosen/bootstrap-chosen.css'); ?>">
<script src="<?= base_url('assets/libs/jquery/chosen/chosen.jquery.min.js'); ?>"></script>

<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?php echo $page; ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    MIS Upload
                </div>
                <div class="panel-body">
                    <form method="post" action="<?= base_url('admin/mis/upload'); ?>" id="frmmis_upload" enctype="multipart/form-data">
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

            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    MIS Download
                </div>
                <div class="panel-body">
                    <form method="post" action="<?= base_url('admin/mis/download'); ?>" id="frmmis_download" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-5 col-md-offset-1">
                                                <div class="form-group <?= ((form_error('install_id[]') != "") ? "has-error" : ""); ?>">
                                                    <label>Select Installment</label>
                                                    <select name="install_id[]" id="install_id" multiple class="form-control">
                                                        <?php
                                                        if ($installment_data) {
                                                            foreach ($installment_data as $installment) {
                                                                ?>
                                                                <option value="<?php echo $installment->id ?>"><?php echo $installment->name ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php echo ((form_error('install_id[]') != "") ? '<span class="help-inline" style="color:red">' . form_error('install_id[]') . '</span>' : ''); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-5 col-md-offset-1">
                                                <div class="form-group <?= ((form_error('class_id') != "") ? "has-error" : ""); ?>">
                                                    <label>Select Class</label>
                                                    <select name="class_id" class="form-control" class="w-md">
                                                        <option value="">-- Select Class --</option>
                                                        <?php
                                                        if ($class_data) {
                                                            foreach ($class_data as $class) {
                                                                ?>
                                                                <option value="<?php echo $class->id ?>"><?php echo $class->class_name ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php echo ((form_error('class_id') != "") ? '<span class="help-inline" style="color:red">' . form_error('class_id') . '</span>' : ''); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-3 col-md-offset-3">
                                                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                                                </div>
                                            </div>
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
<script >
    $("#install_id").chosen();
</script>
