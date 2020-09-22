<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"><?=$page;?></h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="frmaddegateway">

                <div class="form-group">
                    <label class="control-label col-md-3">Name
                        <span class="required"> * </span>
                    </label>

                    <div class="col-md-8">
                        <input type="text" name="name" class="form-control" value="<?=$gateway && $gateway->name ? $gateway->name : set_value('name');?>" readonly="true"/>
                        <span class="help-inline" style="color:red" id="gateway_name_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Type
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="type" class="form-control" value="<?=$gateway && $gateway->type ? $gateway->type : set_value('type');?>" readonly="true"/>
                        <span class="help-inline" style="color:red" id="type_err"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Live URL
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="live_url" class="form-control" value="<?=$gateway && $gateway->live_url ? $gateway->live_url : set_value('live_url');?>" />
                        <span class="help-inline" style="color:red" id="live_url_err"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Test URL
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="test_url" class="form-control" value="<?=$gateway && $gateway->test_url ? $gateway->test_url : set_value('test_url');?>" />
                        <span class="help-inline" style="color:red" id="test_url_err"></span>
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