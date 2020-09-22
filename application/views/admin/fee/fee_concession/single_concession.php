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
                    <form method="post" action="" id="frmsingle_concession">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group <?= ((form_error('register_no') != "") ? "has-error" : ""); ?>">
                                                <label>Admission No</label>
                                                <input name="register_no" id="register_no" type="text" class="form-control" placeholder="Enter Reg No"
                                                       value="<?= isset($fee_concession->admission_no) && $fee_concession->admission_no ? $fee_concession->admission_no : set_value('register_no'); ?>">
                                                       <?php echo ((form_error('register_no') != "") ? '<span class="help-inline" style="color:red">' . form_error('register_no') . '</span>' : ''); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Student  Name</label>
                                                <input name="reg_student_name" type="text" id="reg_student_name" class="form-control" disabled=""
                                                       value="<?= isset($fee_concession->fullname) && $fee_concession->fullname ? $fee_concession->fullname : ''; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Class</label>
                                                <input type="text" name="student_class" id="student_class" class="form-control" disabled=""
                                                       value="<?= isset($fee_concession->class_name) && $fee_concession->class_name ? $fee_concession->class_name : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Section</label>
                                                <input type="text" name="student_section" id="student_section" class="form-control" disabled=""
                                                       value="<?= isset($fee_concession->section_name) && $fee_concession->section_name ? $fee_concession->section_name : ''; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Roll No</label>
                                                <input type="text" name="roll_no" id="roll_no" class="form-control" disabled=""
                                                       value="<?= isset($fee_concession->role_no) && $fee_concession->role_no ? $fee_concession->role_no : ''; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Same for all</label>
                                                <div class="checkbox">
                                                    <label class="i-checks">     
                                                        <input type="checkbox" name="all_month" data-required="1" id="all_month"
                                                               value="1" <?= isset($fee_concession->all_month) && $fee_concession->all_month ? 'checked="checked"' : ''; ?>/> 
                                                        <i></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control" id="status">
                                                    <option value="1" <?= (isset($fee_concession) && $fee_concession->status == 1) ? 'selected="selected"' : ''; ?>>Active</option>
                                                    <option value="0" <?= (isset($fee_concession) && $fee_concession->status == 0) ? 'selected="selected"' : ''; ?>>In active</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Concession Type</label>
                                                <select name="concession_type" class="form-control" id="concession_type">
                                                    <option value="percentage" <?= (isset($fee_concession) && $fee_concession->concession_type == 'percentage') ? 'selected="selected"' : ''; ?>>Percentage</option>
                                                    <option value="rupee" <?= (isset($fee_concession) && $fee_concession->concession_type == 'rupee') ? 'selected="selected"' : ''; ?>>Rupee</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="class_id" name="class_id" value="<?= isset($fee_concession->class_id) && $fee_concession->class_id ? $fee_concession->class_id : ''; ?>">
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
                                                                                <?php 
                                                                                $l = 0;
                                                                                foreach ($month_val->head_type as $k => $val) {
                                                                                    ?>
                                                                                    <div class="after-add-more">
                                                                                        <div class="col-md-3 col-md-offset-1">
                                                                                            <select id="head_id" name="head_type[<?= $ids; ?>][]" class="form-control" ref="<?= $ids; ?>" onchange="select_head(this)">
                                                                                                <option value="">-- Select Head Type --</option>
                                                                                                <?php
                                                                                                if ($head_types) {
                                                                                                    foreach ($head_types as $type) {
                                                                                                        ?>
                                                                                                        <option value="<?= $type->id; ?>" <?= ($type->id == $val) ? ' selected="selected"' : ''; ?>><?= $type->name; ?></option>
                                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <input id="amount_id" type="text" name="amount[<?= $ids; ?>][]" ref="<?= $ids; ?>" onblur="amount_change(this)"
                                                                                                   value="<?= $month_val->amount[$k]; ?>" data-required="1" placeholder="Enter Amount" class="form-control"/>
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <input id="remark_id" type="text" name="remark[<?= $ids; ?>][<?= $l++; ?>]" ref="<?= $ids; ?>" 
                                                                                                   value="<?= isset($month_val->remark[$k]) ? $month_val->remark[$k] : ''; ?>" data-required="1" placeholder="Enter Remark" class="form-control"/>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <div class="form-group change">
                                                                                                <?php if ($k) { ?>
                                                                                                    <a class="btn btn-danger remove" id="remove_id" onclick="remove_more_head(this)" ref="<?= $ids; ?>">- Remove</a>
                                                                                                <?php } else { ?>
                                                                                                    <a id="add_btn" class="btn btn-success add-more" onclick="add_more_head(this)" ref="<?= $ids; ?>">+ Add</a>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>

                                                                            <div class="col-md-2 col-md-offset-10">
                                                                                <div class="form-group">
                                                                                    <?php if ($next = next($installment_ids)) { ?>
                                                                                        <a class="btn btn-primary" onclick="next_button('<?= $next; ?>')">Next</a>
                                                                                    <?php } else { ?>
                                                                                        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    } else {
                                                        ?>
                                                        <div role="tabpanel" class="tab-pane <?= $idk == 0 ? 'active' : ''; ?>" id="month<?= $ids; ?>">
                                                            <div class="panel panel-default">

                                                                <div class="table-responsive" style="padding-top: 30px;">
                                                                    <div class="all_div" ref="<?= $ids; ?>">
                                                                        <div class="after-add-more">
                                                                            <div class="col-md-3 col-md-offset-1">
                                                                                <select id="head_id" name="head_type[<?= $ids; ?>][]" class="form-control" ref="<?= $ids; ?>" onchange="select_head(this)">
                                                                                    <option value="">-- Select Head Type --</option>
                                                                                    <?php
                                                                                    if ($head_types) {
                                                                                        foreach ($head_types as $type) {
                                                                                            ?>
                                                                                            <option value="<?= $type->id; ?>"><?= $type->name; ?></option>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input id="amount_id" type="text" name="amount[<?= $ids; ?>][]" ref="<?= $ids; ?>" onblur="amount_change(this)" 
                                                                                       data-required="1" placeholder="Enter Amount" class="form-control"/>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input id="remark_id" type="text" name="remark[<?= $ids; ?>][]" ref="<?= $ids; ?>"
                                                                                       data-required="1" placeholder="Enter Remark" class="form-control"/>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group change">
                                                                                    <a id="add_btn" class="btn btn-success add-more" onclick="add_more_head(this)" ref="<?= $ids; ?>">+ Add</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2 col-md-offset-10">
                                                                        <div class="form-group">
                                                                            <?php if ($next = next($installment_ids)) { ?>
                                                                                <a class="btn btn-primary" onclick="next_button('<?= $next; ?>')">Next</a>
                                                                            <?php } else { ?>
                                                                                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
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
                                            ?>
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
<input type="hidden" id="first_month" value="<?= $first; ?>" ref="0">
<div class="after-add-more_head" style="display: none;">
    <div class="col-md-3 col-md-offset-1">
        <select class="form-control" id="head_id" onchange="select_head(this)">
            <option value="">-- Select Head Type --</option>
            <?php
            if ($head_types) {
                foreach ($head_types as $type) {
                    ?>
                    <option value="<?= $type->id; ?>"><?= $type->name; ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    <div class="col-md-3 ">
        <input type="text" id="amount_id" data-required="1" onblur="amount_change(this)" placeholder="Enter Amount"  class="form-control"/>
    </div>
    <div class="col-md-3 ">
        <input type="text" id="remark_id" data-required="1" placeholder="Enter Remark"  class="form-control"/>
    </div>
    <div class="col-md-2">
        <div class="form-group change">
            <a id="remove_id" class="btn btn-danger remove" onclick="remove_more_head(this)">- Remove</a>
        </div>
    </div>
</div>
<!-- /content -->
<script type="text/javascript">
    $("#register_no").autocomplete({
        source: "<?= base_url('admin/student/get_student_no'); ?>",
        minLength: 2,
        select: function (event, ui) {
            $.ajax({
                url: "<?= base_url('admin/student/get_student_detail'); ?>",
                data: {register_no: ui.item.value},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        $('#reg_student_name').val(data.detail.fullname);
                        $('#student_class').val(data.detail.class_name);
                        $('#student_section').val(data.detail.section_name);
                        $('#roll_no').val(data.detail.role_no);
                        $('#class_id').val(data.detail.class_id);
                    }
                }
            });
        }
    });

    function add_more_head(ref) {
        var id = $(ref).attr('ref');
        var add_more = $(".after-add-more_head").clone();
        add_more.removeAttr('style');
        add_more.removeClass('after-add-more_head').addClass('after-add-more');
        add_more.find('#head_id').attr('name', 'head_type[' + id + '][]').attr('ref', id);
        add_more.find('#amount_id').attr('name', 'amount[' + id + '][]').attr('ref', id);
        add_more.find('#remark_id').attr('name', 'remark[' + id + '][]').attr('ref', id);
        add_more.find('#remove_id').attr('ref', id);
        $(ref).parents('.after-add-more').after(add_more);

        if (id == $('#first_month').val())
            $('#first_month').attr('ref', 1);
        
        $(ref).parents('.all_div').children('.after-add-more').each(function (k, v) {
            var idk = $(this).parent('.all_div').attr('ref');
            $(this).find('#remark_id').attr('name', 'remark[' + idk + '][' + k + ']');
        });
    }

    function remove_more_head(ref) {
        var remove_id = $(ref).parents('.all_div');
        if ($(ref).attr('ref') == $('#first_month').val())
            $('#first_month').attr('ref', 1);
        $(ref).parents(".after-add-more").remove();
        
        $(remove_id).children('.after-add-more').each(function (k, v) {
            var idk = $(this).parent('.all_div').attr('ref');
            $(this).find('#remark_id').attr('name', 'remark[' + idk + '][' + k + ']');
        });
    }

    function next_button(id) {
        $('#' + id).click();
    }

    $('#all_month').on('click', function () {
        var id = $('#first_month').val();
        var ref = $('#first_month').attr('ref');
        if (ref == 1 && $(this).is(':checked', true)) {
            var first = $('#month' + id + ' .table-responsive .all_div .after-add-more').clone();
            $('.all_div').html(first);
            $('#first_month').attr('ref', 0);

            $('.all_div').each(function () {
                var idk = $(this).attr('ref');
                $(this).find('#head_id').attr('name', 'head_type[' + idk + '][]');
                $(this).find('#amount_id').attr('name', 'amount[' + idk + '][]');
                $(this).find('#remark_id').attr('name', 'remark[' + idk + '][]');
                $(this).find('#add_btn').attr('ref', idk);
                
                $(this).children('.after-add-more').each(function (k, v) {
                    $(this).find('#remark_id').attr('name', 'remark[' + idk + '][' + k + ']');
                });
            });
        }
    });

    function select_head(ref) {
        if ($(ref).attr('ref') == $('#first_month').val())
            $('#first_month').attr('ref', 1);

        $(ref).children('option[selected="selected"]').each(function () {
            $(this).removeAttr('selected');
        });
        $(ref).children('option:selected').attr("selected", "selected");
    }

    function amount_change(ref) {
        if ($(ref).attr('ref') == $('#first_month').val())
            $('#first_month').attr('ref', 1);
    }
</script>