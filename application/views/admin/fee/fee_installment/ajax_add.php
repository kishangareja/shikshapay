<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Add Fee Installment</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="" id="frmaddfee_installment">

                <div class="form-group <?php echo ((form_error('name') != "") ? "has-error" : ""); ?>">
                    <label class="control-label col-md-4">Fee Installment Name
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <input type="text" name="name" data-required="1" id="name"
                               class="form-control" value="<?php echo isset($fee_installment->name) ? $fee_installment->name : set_value('name'); ?>" />
                        <span class="help-inline" style="color:red" id="name_err"></span>
                    </div>
                </div>
                <?php
                $fee_range = "";
                if (isset($fee_installment->fee_range_start)) {
                    $start_range = date("m/d/Y", strtotime($fee_installment->fee_range_start));
                    $end_range = date("m/d/Y", strtotime($fee_installment->fee_range_end));
                    $fee_range = $start_range . " - " . $end_range;
                }
                ?>
                <div class="form-group <?php echo ((form_error('fee_range') != "") ? "has-error" : ""); ?>">
                    <label class="control-label col-md-4">Fee Collection Range
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <input type="text" name="fee_range" data-required="1" id="fee_range"
                               class="form-control" value="<?= $fee_range; ?>"/>
                        <span class="help-inline" style="color:red" id="fee_range_err"></span>
                    </div>
                </div>

                <div class="form-group <?php echo ((form_error('late_amount') != "") ? "has-error" : ""); ?>">
                    <label class="control-label col-md-4">Late Fee Amount
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <input type="text" name="late_amount" data-required="1" id="late_amount"
                               class="form-control" value="<?php echo isset($fee_installment->late_fee_amount) ? $fee_installment->late_fee_amount : set_value('late_amount'); ?>" />
                        <span class="help-inline" style="color:red" id="late_amount_err"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Late Fee Type
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <select name="late_fee_type" class="form-control" id="late_fee_type" onchange="set_type(this)">
                            <option value="one_time" <?= (isset($fee_installment) && $fee_installment->late_fee_type == 'one_time') ?: ''; ?>>One Time</option>
                            <option value="daily" <?= (isset($fee_installment) && $fee_installment->late_fee_type == 'daily') ?: ''; ?>>Daily</option>
                            <option value="monthly" <?= (isset($fee_installment) && $fee_installment->late_fee_type == 'monthly') ?: ''; ?>>Monthly</option>
                            <option value="quarterly" <?= (isset($fee_installment) && $fee_installment->late_fee_type == 'quarterly') ?: ''; ?>>Quarterly</option>
                            <option value="yearly" <?= (isset($fee_installment) && $fee_installment->late_fee_type == 'yearly') ?: ''; ?>>Yearly</option>
                            <option value="custom" <?= (isset($fee_installment) && $fee_installment->late_fee_type == 'custom') ?: ''; ?>>Custom</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" id="custom_type">
                    <label class="control-label col-md-4">Custom Range
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <input type="text" name="custom_range" data-required="1" id="custom_range" class="form-control" value=""/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Status
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <select name="status" class="form-control" id="status">
                            <option value="1" <?= (isset($fee_installment) && $fee_installment->status == 1) ? 'selected="selected"' : ''; ?>>Active</option>
                            <option value="0" <?= (isset($fee_installment) && $fee_installment->status == 0) ? 'selected="selected"' : ''; ?>>In active</option>
                        </select>
                        <?php echo form_error('status'); ?>
                    </div>
                </div>

                <input type="hidden" name="head_id" data-required="1" class="form-control" value="<?= isset($fee_installment->id) ? $fee_installment->id : 0; ?>" />
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" onclick="add_fee_installment()" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>
<script>
    $('#fee_range').daterangepicker();
    $('#custom_range').daterangepicker();
    $('#custom_type').hide();

    function set_type(ref) {
        $('#custom_type').hide();
        if ($(ref).val() == 'custom') {
            $('#custom_type').show();
        }
    }
</script>