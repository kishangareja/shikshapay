<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Add Student Type</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="" id="frmaddstudent_type">

                <div class="form-group <?php echo ((form_error('name') != "") ? "has-error" : ""); ?>">
                    <label class="control-label col-md-4">Student Type
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <input type="text" name="name" data-required="1" id="name"
                               class="form-control" value="<?php echo isset($student_type->name) ? $student_type->name : set_value('name'); ?>" />
                        <span class="help-inline" style="color:red" id="name_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Status
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <select name="status" class="form-control" id="status">
                            <option value="1" <?php
                            if (isset($student_type) && $student_type->status == 1) {
                                echo "selected";
                            }
                            ?>>Active</option>
                            <option value="0" <?php
                            if (isset($student_type) && $student_type->status == 0) {
                                echo "selected";
                            }
                            ?>>In active</option>
                        </select>
                        <?php echo form_error('status'); ?>
                    </div>
                </div>

                <input type="hidden" name="student_type_id" data-required="1" class="form-control" value="<?= isset($student_type->id) ? $student_type->id : 0; ?>" />
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" onclick="add_student_type()" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>