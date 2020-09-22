<link rel="stylesheet" href="<?= base_url('assets/libs/jquery/chosen/bootstrap-chosen.css'); ?>" type="text/css" />
<script src="<?= base_url('assets/libs/jquery/chosen/chosen.jquery.min.js'); ?>"></script>
<style type="text/css" media="screen">
    div#success_box {
        background-color: #dff0d8;
        color: #3c763d;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $page_title ?></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="classForm" method="post" action="" enctype="multipart/form-data">

                    <div class="alert alert-danger" style="display: none;" id="error_box">
                        <button class="close" data-close="alert"></button>
                        <span id="error-message"></span>
                    </div>

                    <div class="alert alert-sucess" style="display: none;" id="success_box">
                        <button class="close" data-close="alert"></button>
                        <span id="success-message"></span>
                    </div>

                    <div class="form-group <?php echo ((form_error('class_name') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4"><?= ucfirst($type); ?> Name
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="class_name" data-required="1"  class="form-control" value="<?php echo isset($class_data->class_name) ? $class_data->class_name : set_value('class_name'); ?>" />
                            <span id="class_name_err" class="help-inline" style="color:red"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4"> <?= ucfirst($class_type); ?>
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <select name="section_id[]" multiple class="w-md" id="section_id">
                                <?php foreach ($section_data as $section) { ?>
                                    <option value="<?php echo $section->id; ?>" <?php
                                    if (isset($class_detail) && in_array($section->id, $class_detail)) {
                                        echo "selected";
                                    }
                                    ?>><?php echo $section->section_name; ?></option>
                                        <?php } ?>
                            </select>
                            <?php echo form_error('section_id'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Status
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <select name="status" class="form-control" id="status">
                                <option value="1" <?php
                                if (isset($class_data) && $class_data->status == 1) {
                                    echo "selected";
                                }
                                ?>>Active</option>
                                <option value="0" <?php
                                if (isset($class_data) && $class_data->status == 0) {
                                    echo "selected";
                                }
                                ?>>In active</option>
                            </select>
                            <?php echo form_error('status'); ?>
                        </div>
                    </div>

                    <input type="hidden" name="class_id" data-required="1"  class="form-control" value="<?php echo isset($class_data->id) ? $class_data->id : '' ?>" />
                    <input type="hidden" name="class_type" value="<?= isset($type) ? $type : ''; ?>" />

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-5">
                            <a href="javascript:;" onclick="submitForm()" class="btn btn-primary">Save</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
<script>
    $('#section_id').chosen();
    $('#section_id_chosen').css('width', '100%');
</script>