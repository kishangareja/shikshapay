<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Add Fee Type</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="" id="frmaddfeetype">

                <div class="form-group <?php echo ((form_error('name') != "") ? "has-error" : ""); ?>">
                    <label class="control-label col-md-4">Fee Type Name
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <input type="text" name="name" data-required="1" id="name"
                               class="form-control" value="<?php echo isset($fee_type_data->name) ? $fee_type_data->name : set_value('name'); ?>" />
                        <span class="help-inline" style="color:red" id="name_err"></span>
                    </div>
                </div>
                <div class="form-group <?php echo ((form_error('gateway') != "") ? "has-error" : ""); ?>">
                    <label class="control-label col-md-4">Payment Gateway
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <select name="gateway" class="form-control" id="gateway">
                            <option value="">-- Select --</option>
                            <?php
                            if ($gateway_data) {
                                foreach ($gateway_data as $gateway) {
                                    $selected = ($gateway->gateway . '_' . $gateway->gateway_name) == $fee_type_data->gateway ? ' selected="selected"' : '';
                                    ?>
                                    <option value="<?= ($gateway->gateway . '_' . $gateway->gateway_name); ?>" <?= $selected; ?>><?= ($gateway->gateway . '_' . $gateway->gateway_name); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="help-inline" style="color:red" id="gateway_err"></span>
                        <?php echo form_error('gateway'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Status
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <select name="status" class="form-control" id="status">
                            <option value="1" <?php
                            if (isset($fee_type_data) && $fee_type_data->status == 1) {
                                echo "selected";
                            }
                            ?>>Active</option>
                            <option value="0" <?php
                            if (isset($fee_type_data) && $fee_type_data->status == 0) {
                                echo "selected";
                            }
                            ?>>In active</option>
                        </select>
                        <?php echo form_error('status'); ?>
                    </div>
                </div>

                <input type="hidden" name="fee_type_id" data-required="1" class="form-control" value="<?= isset($fee_type_data->id) ? $fee_type_data->id : 0; ?>" />
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" onclick="add_fee_type()" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>