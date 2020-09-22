<div class="modal-dialog" role="document" style="width: 90%;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">View Additional Fee</h3>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group <?= ((form_error('register_no') != "") ? "has-error" : ""); ?>">
                                <label>Admission No</label>
                                <div><?= isset($additional_fee->admission_no) && $additional_fee->admission_no ? $additional_fee->admission_no : ''; ?></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Student  Name</label>
                                <input name="reg_student_name" type="text" id="reg_student_name" class="form-control" disabled=""
                                       value="<?= isset($additional_fee->fullname) && $additional_fee->fullname ? $additional_fee->fullname : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Class</label>
                                <input type="text" name="student_class" id="student_class" class="form-control" disabled=""
                                       value="<?= isset($additional_fee->class_name) && $additional_fee->class_name ? $additional_fee->class_name : ''; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Section</label>
                                <input type="text" name="student_section" id="student_section" class="form-control" disabled=""
                                       value="<?= isset($additional_fee->section_name) && $additional_fee->section_name ? $additional_fee->section_name : ''; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Roll No</label>
                                <input type="text" name="roll_no" id="roll_no" class="form-control" disabled=""
                                       value="<?= isset($additional_fee->role_no) && $additional_fee->role_no ? $additional_fee->role_no : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-1">Same for all:</label>
                            <div class="col-md-3">
                                <?= isset($additional_fee->all_month) && $additional_fee->all_month ? 'Yes' : 'No'; ?>
                            </div>

                            <label class="control-label col-md-1">Status:</label>
                            <div class="col-md-3">
                                <?= (isset($additional_fee) && $additional_fee->status == 1) ? 'Active' : 'In Active'; ?>
                            </div>
<?php /*
                            <label class="control-label col-md-1">Additional Fee</label>
                            <div class="col-md-3">
                                <?= (isset($additional_fee) && $additional_fee->additional_fee) ? $additional_fee->additional_fee : ''; ?>
                            </div>
*/ ?>
                            <label class="control-label col-md-2">Concession Type:</label>
                            <div class="col-md-2">
                                <?= isset($additional_fee->concession_type) ? $additional_fee->concession_type : ''; ?>
                            </div>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>

                    <div class="row">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs mtb10" role="tablist" style="background: #dee5e7;border-bottom: 0px;width: 98%;margin: 0 auto;">
                            <?php
                            $installment_ids = array();
                            if ($installments) {
                                foreach ($installments as $key => $installment) {
                                    $installment_ids[$key] = $installment->id;
                                    ?>
                                    <li role="presentation" class="<?= $key == 0 ? 'active' : ''; ?>">
                                        <a href="#month<?= $installment->id; ?>" id="<?= $installment->id; ?>" aria-controls="month<?= $installment->id; ?>" role="tab" data-toggle="tab"><?= $installment->name; ?></a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="tab-content">
                            <?php
                            $first = 0;
                            if ($installment_ids) {
                                $first = current($installment_ids);
                                foreach ($installment_ids as $idk => $ids) {
                                    if (isset($additional_fee_installment) && $additional_fee_installment) {
                                        $installment_val = $amount_val = array();
                                        foreach ($additional_fee_installment as $month => $month_val) {
                                            if ($month == $ids) {
                                                ?>
                                                <div role="tabpanel" class="tab-pane <?= $idk == 0 ? 'active' : ''; ?>" id="month<?= $ids; ?>">
                                                    <div class="panel panel-default">

                                                        <div class="table-responsive" style="padding-top: 30px;">
                                                            <div class="all_div" ref="<?= $ids; ?>">
                                                                <?php foreach ($month_val->head_type as $k => $val) { ?>
                                                                    <div class="after-add-more">
                                                                        <div class="col-md-4 col-md-offset-3" style="padding: 10px;border: 1px solid #dee5e7;">
                                                                            <?php
                                                                            if ($head_types) {
                                                                                foreach ($head_types as $type) {
                                                                                    if ($type->id == $val) {
                                                                                        echo $type->name;
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <div class="col-md-2" style="padding: 10px;border: 1px solid #dee5e7;">
                                                                            <?= $month_val->amount[$k]; ?>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>

                                                            <div class="col-md-2 col-md-offset-10">
                                                                <div class="form-group">
                                                                    <?php if ($next = next($installment_ids)) { ?>
                                                                        <a class="btn btn-primary" onclick="next_button('<?= $next; ?>')">Next</a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>