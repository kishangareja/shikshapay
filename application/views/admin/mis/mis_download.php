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
                    <?php echo $page; ?>
                </div>
                <div class="panel-body">
                    <form method="post" action="" id="frmmis_download" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
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

                                        <div class="col-md-6 col-md-offset-3">
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

                                        <div class="col-md-6 col-md-offset-5">
                                            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
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
