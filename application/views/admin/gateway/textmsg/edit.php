<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"><?=$page;?></h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="frmaddegateway">

                <div class="form-group">
                    <label class="control-label col-md-3">Text Msg Gateway
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-4">
                        <select name="gateway" class="form-control">
                            <option value="">-- Select --</option>
                            <?php
if ($mgdata) {
	foreach ($mgdata as $mg) {
		$selected = $gateway && $gateway->gateway == $mg->name ? 'selected="selected"' : '';
		?>
                                  <option value="<?=$mg->name;?>" <?=$selected;?>><?=$mg->name;?></option>
                                  <?php
}
}
?>
                      </select>
                      <span class="help-inline" style="color:red" id="gateway_err"></span>
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="gateway_name" class="form-control" value="<?=$gateway && $gateway->gateway_name ? $gateway->gateway_name : set_value('gateway_name');?>" />
                    <span class="help-inline" style="color:red" id="gateway_name_err"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Key
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <input type="text" name="key" class="form-control" value="<?=$gateway && $gateway->key ? $gateway->key : set_value('key');?>" />
                    <span class="help-inline" style="color:red" id="key_err"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Is Default
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <select name="is_default" class="form-control" id="is_default">
                        <option value="0" <?=$gateway && $gateway->is_default == 0 ? 'selected="selected"' : '';?>>No</option>
                        <option value="1" <?=$gateway && $gateway->is_default == 1 ? 'selected="selected"' : '';?>>Yes</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Status
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <select name="status" class="form-control" id="status">
                        <option value="1" <?=$gateway && $gateway->status == 1 ? 'selected="selected"' : '';?>>Active</option>
                        <option value="0" <?=$gateway && $gateway->status == 0 ? 'selected="selected"' : '';?>>In active</option>
                    </select>
                </div>
            </div>
                 <!-- <div class="form-group">
                <label class="control-label col-md-3">Live
                    <span class"=required"> * </span>
                </label>
                <div class="col-md-8">
                    <label class="i-switch m-t-xs m-r">
                        <input type="checkbox" name="is_live" <?php echo isset($gateway->is_live) && $gateway->is_live == 1 ? "checked" : "" ?>  value="1">
                      <i></i>
                  </label>
                  <span class="help-inline" style="color:red" id="key_err"></span>
              </div>
          </div> -->
          <input type="hidden" name="gateway_id" data-required="1"  class="form-control" value="<?=isset($gateway->id) ? $gateway->id : 0;?>" />
          <div class="modal-footer">
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" onclick="add_mgateway()" class="btn btn-primary pull-right">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>