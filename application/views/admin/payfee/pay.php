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
                    <form method="post" action="<?= base_url('admin/payfee/add_payfee'); ?>" id="frmpayfee">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo ((form_error('fee_type') != "") ? "has-error" : ""); ?>">
                                                <label>Fee Type</label>
                                                <select name="fee_type" id="fee_type" class="form-control" onchange="select_feetype()">
                                                    <option value="">-- Select --</option>
                                                    <?php
                                                    if ($fee_type_data) {
                                                        foreach ($fee_type_data as $fee_type) {
                                                            $fee_type_id = (set_value('fee_type') == $fee_type->id) ? ' selected="selected"' : '';
                                                            ?>
                                                            <option value="<?= $fee_type->id; ?>" <?= $fee_type_id; ?>><?= $fee_type->name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <span class="help-inline" style="color:red" id="fee_type_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?= ((form_error('register_no') != "") ? "has-error" : ""); ?>">
                                                <label>Admission No</label>
                                                <input name="register_no" id="register_no" type="text" class="form-control">
                                                <span class="help-inline" style="color:red" id="register_no_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Student Name</label>
                                                <input name="reg_student_name" type="text" id="reg_student_name" class="form-control" readonly="">
                                                <input type="hidden" id="student_id" name="student_id" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Class</label>
                                                <input type="text" name="student_class" id="student_class" class="form-control" readonly="">
                                                <input type="hidden" id="class_id" name="class_id" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Section</label>
                                                <input type="text" name="student_section" id="student_section" class="form-control" readonly="">
                                                <input type="hidden" id="section_id" name="section_id" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Roll No</label>
                                                <input type="text" name="roll_no" id="roll_no" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-1">Installment:</label>
                                            <div class="col-md-11">
                                                <?php
                                                if ($installments) {
                                                    $installment_ids = array();
                                                    foreach ($installments as $k => $installment) {
                                                        $installment_ids[$k] = $installment->id;
                                                    }
                                                    $first = current($installment_ids);
                                                    foreach ($installments as $key => $installment) {
                                                        $installment_id = (set_value('installment[' . $key . ']') == $installment->id) ? ' checked="checked"' : '';
                                                        if ((isset($fee_structure_installment) && $fee_structure_installment) && in_array($installment->id, $fee_structure_installment)) {
                                                            $installment_id = ' checked="checked"';
                                                        }
                                                        ?>
                                                        <label class="checkbox-inline i-checks">
                                                            <input type="checkbox" name="installment[]" onchange="installment_set('<?= $key; ?>', '<?= $first; ?>', '<?= $installment->id; ?>', '<?= next($installment_ids); ?>')" <?= $installment_id; ?>
                                                                   class="installment_set" <?= $first == $installment->id ? '' : ' disabled=""'; ?> value="<?= $installment->id; ?>" id="month_<?= $installment->id; ?>"><i></i><?= $installment->name; ?>
                                                        </label>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="padding-top: 20px;">
                                        <div class="text-center">
                                            <div class="form-group">
                                                <input class="btn btn-primary" type="button" name="proceed" value="Proceed" onclick="popup_pay_proceed()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="popup_pay_proceed" tabindex="-1" role="basic" aria-hidden="true"></div>
                        <div class="modal fade" id="popup_confirm_proceed" tabindex="-1" role="basic" aria-hidden="true"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content -->
<script language=Javascript>
    $("#register_no").autocomplete({
        //source: "<?php // base_url('admin/student/get_student_no?fee_type=');     ?>" + $('#fee_type').val(),
        source: function (request, response) {
            $.getJSON("<?= base_url('admin/student/get_student_no'); ?>", {fee_type: $('#fee_type').val()},
                    response);
        },
        minLength: 2,
        select: function (event, ui) {
            $('#fee_type_err').html('');
            if ($('#fee_type').val() == '') {
                $('#fee_type_err').html('Please select fee type');
                ui.item.value = '';
            } else {
                $.ajax({
                    url: "<?= base_url('admin/student/get_student_detail'); ?>",
                    data: {fee_type: $('#fee_type').val(), register_no: ui.item.value},
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            $('#reg_student_name').val(data.detail.fullname);
                            $('#student_class').val(data.detail.class_name);
                            $('#student_section').val(data.detail.section_name);
                            $('#roll_no').val(data.detail.role_no);
                            $('#class_id').val(data.detail.class_id);
                            $('#student_id').val(data.detail.id);
                            $('#section_id').val(data.detail.section_id);

                            var m = 0;
                            $(data.detail.installment).each(function (k, v) {
                                $('#month_' + v).prop('checked', true).attr('disabled', 'disabled');
                                m = v;
                            });

                            if (m) {
                                var id = $('#month_' + m).parent('label').next('label').children('input').attr('id');
                                $('#' + id).removeAttr('disabled');
                            }
                        }
                    }
                });
            }
        }
    });

    function select_feetype() {
        $("#register_no").val('');
        $("#reg_student_name").val('');
        $("#student_id").val('');
        $("#student_class").val('');
        $("#class_id").val('');
        $("#student_section").val('');
        $("#section_id").val('');
        $("#roll_no").val('');
        $('.installment_set').removeAttr('checked').attr('disabled', 'disabled');
        $("#month_<?= $first; ?>").removeAttr('disabled');
    }

    function installment_set(key, first, id, next) {
        if ($('#month_' + id).prop('checked')) {
            $('#month_' + next).removeAttr('disabled');
        } else {
            check_installment(key, first, id);
        }

        /*$.ajax({
         url: "<?php //base_url('admin/payfee/ajax_fee_installment');                  ?>",
         data: $('input[name="installment[]"]:checked').serialize() + "&class_id=" + $('#class_id').val(),
         type: 'post',
         dataType: 'json',
         success: function (data) {
         var fee_amount = data.fee_amount;
         var additional_fee = data.additional_fee;
         var concession_fee = data.concession_fee;
         var late_fee = data.late_fee;
         var carry_forward = 0;
         var payable_amount = fee_amount + additional_fee + concession_fee + late_fee + carry_forward;
         $('#fee_amount').val(fee_amount);
         $('#additional_fee').val(additional_fee);
         $('#concession_fee').val(concession_fee);
         $('#late_fee').val(late_fee);
         $('#carry_forward').val(carry_forward);
         $('#payable_amount').val(payable_amount);
         }
         });*/
    }

    function check_installment(key, first, id) {
        $('.installment_set').each(function (k, v) {
            if (key <= k && $(v).attr('id') != first) {
                $(this).prop('checked', false);
                $(this).attr('disabled', 'disabled');
            }
        });
        $('#month_' + id).removeAttr('disabled');
    }

    function popup_pay_proceed() {
        //if ($("#class_id").val()) {
        $.ajax({
            url: "<?= base_url('admin/payfee/ajax_popup_pay_proceed'); ?>",
            data: $('#frmpayfee').serialize(),
            type: 'post',
            dataType: 'json',
            success: function (response) {
                if (response.success == 1) {
                    $('#popup_pay_proceed').modal('show');
                    $("#popup_pay_proceed").html(response.view);
                } else {
                    $('#fee_type_err').html(response.error.fee_type);
                    $('#register_no_err').html(response.error.register_no);
                }
            }
        });
        //}
    }

    function confirm_payment() {
        $('#frmpayfee').submit();
        /*$.ajax({
         url: '<?= base_url('admin/payfee/add_payfee'); ?>',
         type: 'POST',
         data: $('#frmpayfee').serialize(),
         dataType: 'json',
         success: function (data) {
         if (data.success) {
         $("#popup_confirm_proceed").modal('hide');
         $("#popup_pay_proceed").modal('hide');
         location.href = '<?= base_url('admin/transaction/history'); ?>';
         }
         }
         });*/
    }

    function payby_challan() {
        $.ajax({
            url: '<?= base_url('admin/payfee/payby_challan'); ?>',
            type: 'POST',
            data: $('#frmpayfee').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    location.href = '<?= base_url('admin/payfee/pay'); ?>';
                }
            }
        });
    }

    function add_pay_proceed() {
        var terms = $('#term_pay_proceed').prop('checked');
        if (terms) {
            $.ajax({
                url: '<?= base_url('admin/payfee/ajax_confirm_payfee'); ?>',
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    if (data.success == 1) {
                        $('#popup_confirm_proceed').modal('show');
                        $("#popup_confirm_proceed").html(data.view);
                        $('#term_pay_proceed_err').html('');
                    }
                }
            });
        } else {
            $('#term_pay_proceed_err').html('Please, Accept Terms and Conditon');
            $('#term_pay_proceed_err').show();
        }
    }

    function payment_set(val) {
        $('#cheque_div').hide();
        $('#reference_div').hide();
        if (val == 'pos')
            $('#reference_div').show();
        if (val == 'cheque')
            $('#cheque_div').show();
    }

    /**
     * kishan  update 19/06/2019
     */
    function select_check(ref, amount) {
        var fee_amount = parseFloat($("#fee_amount").val());
        var payable_amount = parseFloat($("#payable_amount").val());
        if ($(ref).is(':checked')) {
            fee_amount = fee_amount + amount;
            payable_amount = payable_amount + amount;
        } else {
            fee_amount = fee_amount - amount;
            payable_amount = payable_amount - amount;
        }
        $("#fee_amount").val(fee_amount);
        $("#payable_amount").val(payable_amount);
    }
</script>