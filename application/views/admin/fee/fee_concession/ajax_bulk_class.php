<div class="modal-dialog" role="document" style="width: 90%;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">View Bulk Fee Concession</h3>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-md-2">Student Type</label>
                    <div class="col-md-4">
                        <?php
                        if ($student_types) {
                            foreach ($student_types as $types) {
                                if (isset($fee_concession->student_type) && $fee_concession->student_type == $types->id) {
                                    echo $types->name;
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Class</label>
                    <div class="col-md-10">
                        <?php
                        if ($classes) {
                            foreach ($classes as $ck => $class) {
                                if ($class->class_type == "class") {
                                    if ((isset($fee_concession_class) && $fee_concession_class) && in_array($class->id, $fee_concession_class)) {
                                        ?>
                                        <label class="checkbox-inline"><?= $class->class_name; ?> </label>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </div><br>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Program</label>
                    <div class="col-md-10">
                        <?php
                        if ($classes) {
                            foreach ($classes as $pk => $class) {
                                if ($class->class_type == "program") {
                                    if ((isset($fee_concession_class) && $fee_concession_class) && in_array($class->id, $fee_concession_class)) {
                                        ?>
                                        <label class="checkbox-inline">
                                            <?= $class->class_name; ?>
                                        </label>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="line line-dashed b-b line-lg pull-in"></div><br>
                <div class="form-group">
                    <label class="control-label col-md-2">Same for all:</label>
                    <div class="col-md-2">
                        <?= isset($fee_concession->all_month) && $fee_concession->all_month ? 'Yes' : 'No'; ?>
                    </div>

                    <label class="control-label col-md-1">Status:</label>
                    <div class="col-md-4">
                        <?= (isset($fee_concession) && $fee_concession->status == 1) ? 'Active' : 'In Active'; ?>
                    </div>
                    
                    <label class="control-label col-md-2">Concession Type:</label>
                    <div class="col-md-1">
                        <?= isset($fee_concession->concession_type) ? $fee_concession->concession_type : ''; ?>
                    </div>
                </div>
                <div class="line line-dashed b-b line-lg pull-in"></div>

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

                <div class="tab-content">
                    <?php
                    $first = 0;
                    if ($installment_ids) {
                        $first = current($installment_ids);
                        foreach ($installment_ids as $idk => $ids) {
                            if (isset($fee_concession_installment) && $fee_concession_installment) {
                                $installment_val = $amount_val = array();
                                foreach ($fee_concession_installment as $month => $month_val) {
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