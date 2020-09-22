<div class="portlet-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= $title; ?> 
            <div class="clearfix"></div>
        </div><br><br>

        <form method="post" action="<?php echo base_url(); ?>admin/rolemodel/addPermission" id="frmcategory" name="frmcategory" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-md-2">Role Group
                    <span class="required"> * </span>
                </label>
                <div class="col-md-5 <?php echo ((form_error('group_id') != "") ? "has-error" : ""); ?>">
                    <select class="form-control select2me" name="group_id" id="group_id" onchange="javascript:getPermissionSet(this.value);">
                        <?php foreach ($role_data as $category) { ?>
                            <option value="<?= $category->group_id; ?>"><?= $category->groupName; ?></option>
                        <?php } ?>
                    </select>
                    <?php echo ((form_error('group_id') != "") ? '<span class="help-inline" style="color:red">' . form_error('group_id') . '</span>' : ''); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="tab-pane" id="getPermission"></div> 
            </div>
            <div class="form-group">
                <div class="line line-dashed b-b line-lg pull-in"></div>
                <div class="col-sm-4 col-sm-offset-5">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Save Changes</button>
                    <a href="<?php echo base_url('admin/rolemodel') ?>" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var baseURL = '<?php echo base_url('admin/rolemodel'); ?>';
        $('#getPermission').load(baseURL + '/getPermission/1', function () {});
    });

    function getPermissionSet(group_id)
    {
        //alert(group_id);
        if (group_id != '')
        {
            $.post('<?php echo base_url() ?>admin/rolemodel/getPermission/' + group_id, {}, function (result)
            {
                $("#getPermission").html(result);
                //$("#city").html('<option value="">Select City</option>');
            });
        }
    }



</script>

