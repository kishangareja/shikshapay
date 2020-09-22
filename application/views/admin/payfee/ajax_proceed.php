<div class="modal-dialog" role="document" style="width: 90%;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Pay Fee Details</h3>
        </div>
        <div class="modal-body">
            <div class="row">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs mtb10" role="tablist" style="background: #dee5e7;border-bottom: 0px;width: 98%;margin: 0 auto;">
                    <?php
if ($installments) {
	foreach ($installments as $key => $installment) {
		?>
                            <li role="presentation" class="<?=$key == 0 ? 'active' : '';?>">
                                <a href="#month<?=$installment->id;?>" id="<?=$installment->id;?>" aria-controls="month<?=$installment->id;?>" role="tab" data-toggle="tab"><?=$installment->name;?></a>
                            </li>
                            <?php
}
}
?>
                </ul>

                <div class="tab-content">
                    <?php
$first = current($installment_ids);
if (isset($fee_structure_installment) && $fee_structure_installment) {
	$idk = 0;
	foreach ($fee_structure_installment as $ids => $month_val) {
		?>
                            <div role="tabpanel" class="tab-pane <?=$idk == 0 ? 'active' : '';?>" id="month<?=$ids;?>">
                                <div class="panel panel-default">

                                    <div class="table-responsive" style="padding-top: 30px;padding-left: 38px;padding-bottom: 40px;">
                                        <div class="col-md-4">
                                            <h4 style="padding-left: 5px;">Fee Structure Amount</h4>
                                            <div class="all_div" ref="<?=$ids;?>">
                                                <?php foreach ($month_val->head_type as $k => $val) {
			?>
                                                    <div class="row after-add-more">
                                                        <?php if (isset($month_val->check[$k])) {?>
                                                        <div class="col-md-1" style="border: 1px solid #dee5e7;">
                                                            <?php $check_id = $month_val->check[$k];?>
                                                            <label class="checkbox i-checks" style="padding-left: 13px;">
                <input id="check_id" type="checkbox" <?=$check_id ? 'disabled="disabled"' : '';?> value="<?=$month_val->check[$k];?>" checked="checked" <?=$check_id ? '' : 'onchange="select_check(this,' . $month_val->amount[$k] . ')"';?> ><i></i>
                                                            </label>
                                                        </div>
                                                        <?php }?>
                                                        <div class="col-md-9" style="padding: 10px;border: 1px solid #dee5e7;">
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
                                                            <?=$month_val->amount[$k];?>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="fee_head_type[<?=$ids;?>][]" value="<?=$val;?>">
                                                    <input type="hidden" name="installment_amount[<?=$ids;?>][]" value="<?=$month_val->amount[$k];?>">
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="padding-left: 5px;">Additional Fee</h4>
                                            <div class="all_div" ref="<?=$ids;?>">
                                                <?php
if (isset($fee_structure_additional[$ids]) && $fee_structure_additional[$ids]) {
			foreach ($fee_structure_additional[$ids]->head_type as $k => $val) {
				?>
                                                        <div class="after-add-more">
                                                            <div class="col-md-9" style="padding: 10px;border: 1px solid #dee5e7;">
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
                                                                <?=$fee_structure_additional[$ids]->amount[$k];?>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="additional_head_type[<?=$ids;?>][]" value="<?=$val;?>">
                                                        <input type="hidden" name="additional_amount[<?=$ids;?>][]" value="<?=$fee_structure_additional[$ids]->amount[$k];?>">
                                                        <?php
}
		}
		?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="padding-left: 5px;">Concession Fee</h4>
                                            <div class="all_div" ref="<?=$ids;?>">
                                                <?php
if (isset($fee_structure_concession[$ids]) && $fee_structure_concession[$ids]) {
			foreach ($fee_structure_concession[$ids]->head_type as $k => $val) {
				?>
                                                        <div class="after-add-more">
                                                            <div class="col-md-9" style="padding: 10px;border: 1px solid #dee5e7;">
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
                                                                <?=$fee_structure_concession[$ids]->amount[$k];?>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="concession_head_type[<?=$ids;?>][]" value="<?=$val;?>">
                                                        <input type="hidden" name="concession_amount[<?=$ids;?>][]" value="<?=$fee_structure_concession[$ids]->amount[$k];?>">
                                                        <?php
}
		}
		?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
$idk++;
	}
}
?>
                </div>
            </div>

            <div class="row" style="padding-left: 40px;padding-right: 40px;padding-bottom: 20px;">
                <?php
if ($fee_data) {
	$payable_amount = $fee_data['fee_amount'] + $fee_data['additional_fee'] + $fee_data['concession_fee'] + $fee_data['late_fee'];
	?>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Fee Amount</label>
                                <input type="text" name="fee_amount" id="fee_amount" class="form-control" readonly="" value="<?=$fee_data['fee_amount'];?>">
                                <span class="fa fa-plus" style="margin-top: -22px;float: right;margin-right: -21px;"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Additional Fee</label>
                                <input type="text" name="additional_fee" id="additional_fee" class="form-control" readonly="" value="<?=$fee_data['additional_fee'];?>">
                                <span class="fa fa-plus" style="margin-top: -22px;float: right;margin-right: -21px;"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Late Fee</label>
                                <input type="text" name="late_fee" id="late_fee" class="form-control" value="<?=$fee_data['late_fee'];?>">
                                <span class="fa fa-plus" style="margin-top: -22px;float: right;margin-right: -21px;"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Concession Amount</label>
                                <input type="text" name="concession_fee" id="concession_fee" class="form-control" readonly="" value="<?=$fee_data['concession_fee'];?>">
                                <span class="fa fa-plus" style="margin-top: -22px;float: right;margin-right: -21px;"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Carry Forward Amount</label>
                                <input type="text" name="carry_forward" id="carry_forward" class="form-control" readonly="" value="0">
                                <span class="fa fa-minus" style="margin-top: -25px;float: right;margin-right: -21px;"></span>
                                <span class="fa fa-minus" style="margin-top: -20px;float: right;margin-right: -21px;"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Payable Amount</label>
                                <input type="text" name="payable_amount" id="payable_amount" class="form-control" readonly="" value="<?=$payable_amount;?>">
                            </div>
                        </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                <?php }?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Payment Through</label>
                            <select name="payment_by" class="form-control" id="payment_by" onchange="payment_set(this.value);">
                                <option value="cheque">Cheque</option>
                                <option value="pos">POS</option>
                                <option value="cash">Cash</option>
                            </select>
                        </div>
                    </div>
                    <div id="cheque_div">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cheque Number</label>
                                <input name="cheque_no" class="form-control" id="cheque_no" placeholder="Cheque Number">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cheque Date</label>
                                <input name="cheque_date" class="form-control" id="cheque_date" placeholder="Cheque Date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input name="bank_name" class="form-control" id="bank_name" placeholder="Bank Name">
                            </div>
                        </div>
                    </div>
                    <div id="reference_div" style="display: none;">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Reference Number</label>
                                <input name="reference_no" class="form-control" id="reference_no" placeholder="Reference Number">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8" style="padding-left: 55px;">
                    <label class="checkbox-inline i-checks font-bold">
                        <input type="checkbox" name="term_pay_proceed" id="term_pay_proceed"><i></i> Accept Terms and Condition
                    </label>
                    <span class="help-inline" style="color:red;padding-left: 10px;" id="term_pay_proceed_err"></span>
                </div>
                <div class="col-md-2" style="text-align: right;padding-left: 150px;">
                    <div class="form-group">
                        <input class="btn btn-dark" type="button" name="by_challan" value="Pay by Challan" onclick="payby_challan()">
                    </div>
                </div>
                <div class="col-md-2" style="padding-left: 70px;">
                    <div class="form-group">
                        <input class="btn btn-primary" type="button" name="confirm_pay" value="Confirm Pay" onclick="add_pay_proceed()">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#cheque_date').datepicker();
</script>