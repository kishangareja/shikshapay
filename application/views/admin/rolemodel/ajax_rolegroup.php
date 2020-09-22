<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"><?= $action . ' ' . $page; ?></h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="" id="frmaddgroup">

                <div class="form-group">
                    <label class="control-label col-md-3">Group Name
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-6">
                        <input name="groupName" id="groupName" type="text" class="form-control" placeholder="Enter Group Name" value="<?= isset($group_data->groupName) ? $group_data->groupName : ''; ?>" /> 
                        <span class="help-inline" style="color:red" id="groupName_err"></span>
                    </div>
                </div>

                <input type="hidden" name="group_id" data-required="1"  class="form-control" value="<?= isset($group_data->group_id) ? $group_data->group_id : 0; ?>" />
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" onclick="add_group()" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </div>
                </div>    
            </form>
        </div>
    </div>
</div>