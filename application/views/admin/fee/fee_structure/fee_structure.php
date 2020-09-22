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
                    <form class="form-horizontal" method="post" action="" id="frmaddfee_structure">
                        <div class="form-group">
                            <label class="control-label col-md-2">Fee Structure Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-5 <?php echo ((form_error('name') != "") ? "has-error" : ""); ?>">
                                <input type="text" name="name" data-required="1"  class="form-control" value="<?php echo isset($fee_structure->fee_structure_name) ? $fee_structure->fee_structure_name : set_value('name'); ?>" />
                                <?php echo ((form_error('name') != "") ? '<span class="help-inline" style="color:red">' . form_error('name') . '</span>' : ''); ?>
                            </div>
                            <label class="control-label col-md-1">Fee Type
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4 <?php echo ((form_error('fee_type') != "") ? "has-error" : ""); ?>">
                                <select name="fee_type" class="form-control" onchange="select_fee_type(this)">
                                    <option value="">-- Select --</option>
                                    <?php
                                    if ($fee_type_data) {
                                        foreach ($fee_type_data as $fee_type) {
                                            $fee_type_id = (set_value('fee_type') == $fee_type->id) ? ' selected="selected"' : '';
                                            ?>
                                            <option value="<?= $fee_type->id; ?>" <?= isset($fee_structure->fee_type_id) && $fee_structure->fee_type_id == $fee_type->id ? 'selected="selected"' : $fee_type_id; ?>><?= $fee_type->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo ((form_error('fee_type') != "") ? '<span class="help-inline" style="color:red">' . form_error('fee_type') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group <?php echo ((form_error('class[]') != "") ? "has-error" : ""); ?>">
                            <label class="col-md-2 control-label">Select Class
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-10">
                                <?php
                                $class_arr = array();
                                if ($classes) {
                                    foreach ($classes as $ck => $class) {
                                        if ($class->class_type == "class") {
                                            $class_id = (set_value('class[' . $ck . ']') == $class->id) ? ' checked="checked"' : '';
                                            $class_disabled = '';
                                            if ($class_data && in_array($class->id, $class_data)) {
                                                $class_id = ' checked="checked"';
                                                $class_disabled = ' disabled="disabled"';
                                                
                                                if ((isset($fee_structure_class) && $fee_structure_class) && in_array($class->id, $fee_structure_class)) {
                                                    $class_disabled = '';
                                                    $class_arr[] = $class->id;
                                                }
                                            }
                                            ?>
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" id="class_<?= $class->id; ?>" class="class_recheck" <?= $class_disabled; ?> name="class[<?= $ck; ?>]" value="<?= $class->id; ?>" <?= $class_id; ?>><i></i> <?= $class->class_name; ?>
                                            </label>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <?php echo ((form_error('class[]') != "") ? '<span class="help-inline" style="color:red">' . form_error('class[]') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('class[]') != "") ? "has-error" : ""); ?>">
                            <label class="col-md-2 control-label">Select Program
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-10">
                                <?php
                                if ($classes) {
                                    foreach ($classes as $pk => $class) {
                                        if ($class->class_type == "program") {
                                            $program_id = (set_value('class[' . $pk . ']') == $class->id) ? ' checked="checked"' : '';
                                            $program_disabled = '';
                                            if ($class_data && in_array($class->id, $class_data)) {
                                                $program_id = ' checked="checked"';
                                                $program_disabled = ' disabled="disabled"';
                                                
                                                if ((isset($fee_structure_class) && $fee_structure_class) && in_array($class->id, $fee_structure_class)) {
                                                    $program_disabled = '';
                                                    $class_arr[] = $class->id;
                                                }
                                            }
                                            ?>
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox" id="class_<?= $class->id; ?>" class="class_recheck" <?= $program_disabled; ?> name="class[<?= $pk; ?>]" value="<?= $class->id; ?>" <?= $program_id; ?>><i></i> <?= $class->class_name; ?>
                                            </label>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <?php echo ((form_error('class[]') != "") ? '<span class="help-inline" style="color:red">' . form_error('class[]') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="line line-dashed b-b line-lg pull-in"></div><br>
                        <div class="form-group">
                            <label class="control-label col-md-2 <?= ((form_error('board_id') != "") ? "has-error" : ""); ?>">Select Board
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4 <?= ((form_error('board_id') != "") ? "has-error" : ""); ?>">
                                <select name="board_id" class="form-control" >
                                    <option value="">-- Select Board --</option>
                                    <?php
                                    if ($boards) {
                                        foreach ($boards as $board) {
                                            $board_id = (set_value('board_id') == $board->id) ? ' selected="selected"' : '';
                                            ?>
                                            <option value="<?= $board->id; ?>" <?= isset($fee_structure->board_id) && $fee_structure->board_id == $board->id ? 'selected="selected"' : $board_id; ?>><?= $board->board_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo ((form_error('board_id') != "") ? '<span class="help-inline" style="color:red">' . form_error('board_id') . '</span>' : ''); ?>
                            </div>

                            <label class="control-label col-md-2 <?= ((form_error('student_type') != "") ? "has-error" : ""); ?>">Student Type
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4 <?= ((form_error('student_type') != "") ? "has-error" : ""); ?>">
                                <select name="student_type" class="form-control" >
                                    <option value="">-- Select Student Type --</option>
                                    <?php
                                    if ($student_types) {
                                        foreach ($student_types as $types) {
                                            $student_type = (set_value('student_type') == $types->id) ? ' selected="selected"' : '';
                                            ?>
                                            <option value="<?= $types->id; ?>" <?= isset($fee_structure->student_type) && $fee_structure->student_type == $types->id ? 'selected="selected"' : $student_type; ?>><?= $types->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo ((form_error('student_type') != "") ? '<span class="help-inline" style="color:red">' . form_error('student_type') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Same for all</label>
                            <div class="col-md-1">
                                <div class="checkbox">
                                    <label class="i-checks">                                        
                                        <input type="checkbox" name="all_month" data-required="1" id="all_month"
                                               value="1" <?= isset($fee_structure->all_month) && $fee_structure->all_month ? 'checked="checked"' : ''; ?>/> 
                                        <i></i>                                        
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="radio <?php echo ((form_error('student_status') != "") ? "has-error" : ""); ?>">
                                    <?php
                                    $old = (set_value('student_status') == 0) ? ' checked="checked"' : '';
                                    $new = (set_value('student_status') == 1) ? ' checked="checked"' : '';
                                    ?>
                                    <label class="col-md-5 i-checks">                                        
                                        <input type="radio" name="student_status" value="0" <?= isset($fee_structure->student_status) && $fee_structure->student_status == 0 ? 'checked="checked"' : $old; ?>/><i></i> Old Student                                                                                
                                    </label>
                                    <label class="col-md-5 i-checks">                                        
                                        <input type="radio" name="student_status" value="1" <?= isset($fee_structure->student_status) && $fee_structure->student_status == 1 ? 'checked="checked"' : $new; ?>/><i></i> New Student
                                    </label>
                                </div>
                                <?php echo ((form_error('student_status') != "") ? '<span class="help-inline" style="color:red">' . form_error('student_status') . '</span>' : ''); ?>
                            </div>

                            <label class="control-label col-md-1">Status
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <select name="status" class="form-control" id="status">
                                    <option value="1" <?= (isset($fee_structure) && $fee_structure->status == 1) ? 'selected="selected"' : ''; ?>>Active</option>
                                    <option value="0" <?= (isset($fee_structure) && $fee_structure->status == 0) ? 'selected="selected"' : ''; ?>>In active</option>
                                </select>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>

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
                                    if (isset($fee_structure_installment) && $fee_structure_installment) {
                                        $installment_val = $amount_val = array();
                                        foreach ($fee_structure_installment as $month => $month_val) {
                                            if ($month == $ids) {
                                                ?>
                                                <div role="tabpanel" class="tab-pane <?= $idk == 0 ? 'active' : ''; ?>" id="month<?= $ids; ?>">
                                                    <div class="panel panel-default">

                                                        <div class="table-responsive" style="padding-top: 30px;">
                                                            <div class="col-md-12">
                                                                <label class="col-md-offset-2"><b>Compulsory</b></label>
                                                            </div>
                                                            <div class="all_div" ref="<?= $ids; ?>">
                                                                <?php
                                                                $l = 0;
                                                                foreach ($month_val->head_type as $k => $val) {
                                                                    ?>
                                                                    <div class="after-add-more">
                                                                        <div class="col-md-1 col-md-offset-2">
                                                                            <?php $check_id = $month_val->check[$k] ? 'checked="checked"' : ''; ?>
                                                                            <label class="checkbox i-checks">
                                                                                <input id="check_id" type="checkbox" name="check[<?= $ids; ?>][<?= $l++; ?>]" ref="<?= $ids; ?>" onchange="select_check(this)"
                                                                                       value="<?= $month_val->check[$k]; ?>" <?= $check_id; ?>><i></i>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-md-3">
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
                                                    <div class="col-md-12">
                                                        <label class="col-md-offset-2"><b>Compulsory</b></label>
                                                    </div>
                                                    <div class="all_div" ref="<?= $ids; ?>">
                                                        <div class="after-add-more">
                                                            <div class="col-md-1 col-md-offset-2">
                                                                <label class="checkbox i-checks">
                                                                    <input type="checkbox" id="check_id" name="check[<?= $ids; ?>][]" value="0" ref="<?= $ids; ?>" onchange="select_check(this)"><i></i>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-3">
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
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /content -->
<input type="hidden" id="first_month" value="<?= $first; ?>" ref="0">
<div class="after-add-more_head" style="display: none;">
    <div class="col-md-1 col-md-offset-2">
        <label class="checkbox i-checks">
            <input type="checkbox" id="check_id" onchange="select_check(this)" value="0"><i></i>
        </label>
    </div>
    <div class="col-md-3">
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
    <div class="col-md-3">
        <input type="text" id="amount_id" data-required="1" onblur="amount_change(this)" placeholder="Enter Amount"  class="form-control"/>
    </div>
    <div class="col-md-2">
        <div class="form-group change">
            <a id="remove_id" class="btn btn-danger remove" onclick="remove_more_head(this)">- Remove</a>
        </div>
    </div>
</div>
<script type="text/javascript">

    function add_more_head(ref) {
        var id = $(ref).attr('ref');
        var add_more = $(".after-add-more_head").clone();
        add_more.removeAttr('style');
        add_more.removeClass('after-add-more_head').addClass('after-add-more');
        add_more.find('#head_id').attr('name', 'head_type[' + id + '][]').attr('ref', id);
        add_more.find('#amount_id').attr('name', 'amount[' + id + '][]').attr('ref', id);
        add_more.find('#check_id').attr('name', 'check[' + id + '][]').attr('ref', id);
        add_more.find('#remove_id').attr('ref', id);
        $(ref).parents('.after-add-more').after(add_more);

        if (id == $('#first_month').val())
            $('#first_month').attr('ref', 1);

        $(ref).parents('.all_div').children('.after-add-more').each(function (k, v) {
            var idk = $(this).parent('.all_div').attr('ref');
            $(this).find('#check_id').attr('name', 'check[' + idk + '][' + k + ']');
        });
    }

    function remove_more_head(ref) {
        var remove_id = $(ref).parents('.all_div');
        if ($(ref).attr('ref') == $('#first_month').val())
            $('#first_month').attr('ref', 1);
        $(ref).parents(".after-add-more").remove();

        $(remove_id).children('.after-add-more').each(function (k, v) {
            var idk = $(this).parent('.all_div').attr('ref');
            $(this).find('#check_id').attr('name', 'check[' + idk + '][' + k + ']');
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
                $(this).find('#check_id').attr('name', 'check[' + idk + '][]');
                $(this).find('#add_btn').attr('ref', idk);

                $(this).children('.after-add-more').each(function (k, v) {
                    $(this).find('#check_id').attr('name', 'check[' + idk + '][' + k + ']');
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

    function select_check(ref) {
        $(ref).val('0');
        if ($(ref).is(':checked'))
            $(ref).val('1');
    }

    function amount_change(ref) {
        if ($(ref).attr('ref') == $('#first_month').val())
            $('#first_month').attr('ref', 1);
    }

    function select_fee_type(ref) {
        $('.class_recheck').removeAttr('checked').removeAttr('disabled');
        $.ajax({
            url: "<?= base_url('admin/feestructure/ajax_get_fee_type'); ?>",
            data: {fee_type: $(ref).val()},
            type: 'post',
            dataType: 'json',
            success: function (response) {
                if (response.success == 1) {
<?php
if ($classes) {
    foreach ($classes as $class) {
        ?>
                            if ($.inArray('<?= $class->id; ?>', response.class_data) > -1) {
                                $('#class_<?= $class->id; ?>').attr('disabled', 'disabled').prop('checked', true);
                            }
        <?php
    }
}

if ($class_arr) {
    foreach ($class_arr as $clas) {
        ?>
                            if ($.inArray('<?= $clas; ?>', response.class_data) > -1) {
                                $('#class_<?= $clas; ?>').removeAttr('disabled');
                            }
        <?php
    }
}
?>
                }
            }
        });
    }
</script>
