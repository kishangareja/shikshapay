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
                    <form method="post" action="" id="frmsingle_concession">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group <?= ((form_error('register_no') != "") ? "has-error" : ""); ?>">
                                                <label>Admission No</label>
                                                <input name="register_no" id="register_no" type="text" class="form-control" value="ABC165">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Student  Name</label>
                                                <input name="reg_student_name" type="text" id="reg_student_name" class="form-control" disabled="" value="Dinesh Ninave">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Class</label>
                                                <input type="text" name="student_class" id="student_class" class="form-control" disabled="" value="X">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Section</label>
                                                <input type="text" name="student_section" id="student_section" class="form-control" disabled="" value="A">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Roll No</label>
                                                <input type="text" name="roll_no" id="roll_no" class="form-control" disabled="" value="53">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Installment</label>
                                                <select name="installment" class="form-control" id="installment">
                                                    <?php
                                                    if ($installments) {
                                                        foreach ($installments as $key => $installment) {
                                                            ?>
                                                            <option value="<?= $installment->id; ?>"><?= $installment->name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>&nbsp;</label>
                                            <div class="form-group change">
                                                <a id="add_btn" class="btn btn-success add-more" ref="">+ Add</a>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Payment Type</label>
                                                <select name="payment_type" class="form-control" id="payment_type">
                                                    <option value="">-- Select Payment Type --</option>
                                                    <option value="online">Online</option>
                                                    <option value="offline">Offline</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="row">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs mtb10" role="tablist" style="background: #dee5e7;border-bottom: 0px;">
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
                                            <li role="presentation">
                                                <a href="#monthtotal" id="total" aria-controls="monthtotal" role="tab" data-toggle="tab">Total</a>
                                            </li>
                                        </ul>

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
                                                                                <div class="font-bold col-md-2 col-md-offset-2" style="padding-bottom: 20px;">Installment Fee</div>
                                                                                <div class="col-md-2 col-md-offset-6">
                                                                                    <a id="late_btn" class="btn btn-success" ref="">+ Late Fee</a>
                                                                                </div>
                                                                                <div class="col-md-12">
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
                                                                                    <div class="font-bold" id="month_total">
                                                                                        <div class="col-md-4 col-md-offset-3" style="padding: 10px;border: 1px solid #dee5e7;">Total</div>
                                                                                        <div class="col-md-2" style="padding: 10px;border: 1px solid #dee5e7;">1200</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="font-bold col-md-2 col-md-offset-2" style="padding: 20px;">Additional Fee</div>
                                                                                <div class="col-md-12">
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
                                                                                    <div class="font-bold" id="additional_total">
                                                                                        <div class="col-md-4 col-md-offset-3" style="padding: 10px;border: 1px solid #dee5e7;">Total</div>
                                                                                        <div class="col-md-2" style="padding: 10px;border: 1px solid #dee5e7;">600</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-2 col-md-offset-10">
                                                                                <div class="form-group">
                                                                                    <?php if ($next = next($installment_ids)) { ?>
                                                                                        <a class="btn btn-primary" onclick="next_button('<?= $next; ?>')">Next</a>
                                                                                        <div class="col-md-8 pull-right">
                                                                                            <a class="btn btn-danger">Delete</a>
                                                                                        </div>
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
                                            <div role="tabpanel" class="tab-pane" id="monthtotal">
                                                <div class="panel panel-default">
                                                    <div class="table-responsive" style="padding-top: 30px;">
                                                        <div class="all_div" ref="<?= $ids; ?>">
                                                            <div class="after-add-more">
                                                                <div class="col-md-4 col-md-offset-3" style="padding: 10px;border: 1px solid #dee5e7;">
                                                                    Total
                                                                </div>
                                                                <div class="col-md-2" style="padding: 10px;border: 1px solid #dee5e7;">
                                                                    250
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 col-md-offset-10">
                                                            <div class="form-group">

                                                            </div>
                                                        </div>
                                                    </div>
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
<!-- /content -->
<script language=Javascript>

</script>