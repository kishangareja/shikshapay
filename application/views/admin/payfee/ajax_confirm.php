<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Confirm</h3>
        </div>
        <div class="modal-body">
            <div class="row" style="padding-left: 40px;padding-right: 40px;padding-bottom: 20px;">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select name="payment_gateway" class="form-control" id="payment_gateway" onchange="confirm_payment();">
                            <option value="">-- Select --</option>
                            <?php foreach ($pay_gateway as $key => $value) {?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->gateway . '_' . $value->gateway_name ?></option>
                            <?php }?>
                            <!--
                            <option value="fonepaisa">Fonepaisa</option>
                            <option value="paytm">Paytm</option>
                            <option value="ebs">EBS</option>
                            <option value="ccavenue">CCAvenue</option>
                            <option value="payumoney">Payumoney</option> -->
                            <!--<option value="payubiz">Payubiz</option>-->
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>