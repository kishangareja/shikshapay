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
                    <?php $this->load->view('_partials/messages');?>
                 <form class="form-horizontal" method="post" action="<?php echo base_url('admin/setting/add') ?>" id="frmaddboard" enctype="multipart/form-data" >
                    <h3 class="text-center">Basic Invoice Detail</h3>
                    <div class="form-group <?php echo ((form_error('sgst') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Logo
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="file" name="logo" data-required="1" class="form-control"  onchange="readURL(this)" />
                            <img src="<?php echo base_url() . INVOICE . $setting_data->logo; ?>" alt="" height="100" width="100" id="logo_img">
                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('address') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Address
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <textarea type="text" rows="5" name="address" data-required="1" class="form-control"  ><?php echo isset($setting_data->address) ? $setting_data->address : set_value('address'); ?></textarea>
                            <?php echo ((form_error('address') != "") ? '<span class="help-inline" style="color:red">' . form_error('address') . '</span>' : ''); ?>
                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('invoice_number') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Invoice Number
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="invoice_number" data-required="1" id="invoice_number"class="form-control" value="<?php echo isset($setting_data->invoice_number) ? $setting_data->invoice_number : set_value('invoice_number'); ?>" />
                            <?php echo ((form_error('invoice_number') != "") ? '<span class="help-inline" style="color:red">' . form_error('invoice_number') . '</span>' : ''); ?>
                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('date_of_issue') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Date Of Issue
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="date_of_issue" data-required="1" id="date_of_issue" class="form-control" value="<?php echo isset($setting_data->date_of_issue) ? $setting_data->date_of_issue : set_value('date_of_issue'); ?>" />
                            <?php echo ((form_error('date_of_issue') != "") ? '<span class="help-inline" style="color:red">' . form_error('date_of_issue') . '</span>' : ''); ?>
                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('state') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">State
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="state" data-required="1" id="state" class="form-control" value="<?php echo isset($setting_data->state) ? $setting_data->state : set_value('state'); ?>" />
                            <?php echo ((form_error('state') != "") ? '<span class="help-inline" style="color:red">' . form_error('state') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('issuer_gstin') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Issuer GSTIN
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="issuer_gstin" data-required="1" id="issuer_gstin" class="form-control" value="<?php echo isset($setting_data->issuer_gstin) ? $setting_data->issuer_gstin : set_value('issuer_gstin'); ?>" />
                            <?php echo ((form_error('issuer_gstin') != "") ? '<span class="help-inline" style="color:red">' . form_error('issuer_gstin') . '</span>' : ''); ?>
                        </div>
                    </div>

                    <h3 class="text-center">Customer Detail</h3>

                    <div class="form-group <?php echo ((form_error('customer_name') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Name
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="customer_name" data-required="1" id="customer_name"
                            class="form-control" value="<?php echo isset($setting_data->customer_name) ? $setting_data->customer_name : set_value('customer_name'); ?>" />
                            <?php echo ((form_error('customer_name') != "") ? '<span class="help-inline" style="color:red">' . form_error('customer_name') . '</span>' : ''); ?>
                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('gstin') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">GSTIN
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="gstin" data-required="1" id="gstin"
                            class="form-control" value="<?php echo isset($setting_data->gstin) ? $setting_data->gstin : set_value('gstin'); ?>" />
                            <?php echo ((form_error('gstin') != "") ? '<span class="help-inline" style="color:red">' . form_error('gstin') . '</span>' : ''); ?>
                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('blling_address') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Blling Address
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="blling_address" data-required="1" id="blling_address"
                            class="form-control" value="<?php echo isset($setting_data->blling_address) ? $setting_data->blling_address : set_value('blling_address'); ?>" />
                            <?php echo ((form_error('blling_address') != "") ? '<span class="help-inline" style="color:red">' . form_error('blling_address') . '</span>' : ''); ?>
                        </div>
                    </div>

                    <h3 class="text-center">Invoice Particulars</h3>

                    <div class="form-group <?php echo ((form_error('item_title') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Item Title
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="item_title" data-required="1" id="item_title"
                            class="form-control" value="<?php echo isset($setting_data->item_title) ? $setting_data->item_title : set_value('item_title'); ?>" />
                            <?php echo ((form_error('item_title') != "") ? '<span class="help-inline" style="color:red">' . form_error('item_title') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('sac_code') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">SAC Code
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="sac_code" data-required="1" id="sac_code"
                            class="form-control" value="<?php echo isset($setting_data->sac_code) ? $setting_data->sac_code : set_value('sac_code'); ?>" />
                            <?php echo ((form_error('sac_code') != "") ? '<span class="help-inline" style="color:red">' . form_error('sac_code') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('value') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Value
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="value" data-required="1" id="value"
                            class="form-control" value="<?php echo isset($setting_data->value) ? $setting_data->value : set_value('value'); ?>" />
                            <?php echo ((form_error('value') != "") ? '<span class="help-inline" style="color:red">' . form_error('value') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('sgst') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">SGST Rate
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="sgst" data-required="1" id="sgst"
                            class="form-control" value="<?php echo isset($setting_data->sgst) ? $setting_data->sgst : set_value('sgst'); ?>" />
                            <?php echo ((form_error('sgst') != "") ? '<span class="help-inline" style="color:red">' . form_error('sgst') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('cgst') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">CGST Rate
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="cgst" data-required="1" id="cgst"
                            class="form-control" value="<?php echo isset($setting_data->cgst) ? $setting_data->cgst : set_value('cgst'); ?>" />
                            <?php echo ((form_error('cgst') != "") ? '<span class="help-inline" style="color:red">' . form_error('cgst') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('igst_rate') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">IGST Rate
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="igst_rate" data-required="1" id="igst_rate"
                            class="form-control" value="<?php echo isset($setting_data->igst_rate) ? $setting_data->igst_rate : set_value('igst_rate'); ?>" />
                            <?php echo ((form_error('igst_rate') != "") ? '<span class="help-inline" style="color:red">' . form_error('igst_rate') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('igst_value') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">IGST Value
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="igst_value" data-required="1" id="igst_value"
                            class="form-control" value="<?php echo isset($setting_data->igst_value) ? $setting_data->igst_value : set_value('igst_value'); ?>" />
                            <?php echo ((form_error('igst_value') != "") ? '<span class="help-inline" style="color:red">' . form_error('igst_value') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('total_value') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Total Value
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="total_value" data-required="1" id="total_value"
                            class="form-control" value="<?php echo isset($setting_data->total_value) ? $setting_data->total_value : set_value('total_value'); ?>" />
                            <?php echo ((form_error('total_value') != "") ? '<span class="help-inline" style="color:red">' . form_error('total_value') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('taxable_value') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Taxable Value Of Service
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="taxable_value" data-required="1" id="taxable_value"
                            class="form-control" value="<?php echo isset($setting_data->taxable_value) ? $setting_data->taxable_value : set_value('taxable_value'); ?>" />
                            <?php echo ((form_error('taxable_value') != "") ? '<span class="help-inline" style="color:red">' . form_error('taxable_value') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('charge_amount') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Charge Amount
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="charge_amount" data-required="1" id="charge_amount"
                            class="form-control" value="<?php echo isset($setting_data->charge_amount) ? $setting_data->charge_amount : set_value('charge_amount'); ?>" />
                            <?php echo ((form_error('charge_amount') != "") ? '<span class="help-inline" style="color:red">' . form_error('charge_amount') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo ((form_error('payable_amount') != "") ? "has-error" : ""); ?>">
                        <label class="control-label col-md-4">Payable Amount
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                            <input type="text" name="payable_amount" data-required="1" id="payable_amount"
                            class="form-control" value="<?php echo isset($setting_data->payable_amount) ? $setting_data->payable_amount : set_value('payable_amount'); ?>" />
                            <?php echo ((form_error('payable_amount') != "") ? '<span class="help-inline" style="color:red">' . form_error('payable_amount') . '</span>' : ''); ?>

                        </div>
                    </div>

                    <input type="hidden" name="setting_id" data-required="1"  class="form-control" value="<?=isset($setting_data->id) ? $setting_data->id : 0;?>" />
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="sublimt" name="submit"  class="btn btn-primary pull-right">Save</button>
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
<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logo_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>