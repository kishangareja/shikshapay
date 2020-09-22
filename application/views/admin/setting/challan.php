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
                    <?php $this->load->view('_partials/messages'); ?>
                    <form class="form-horizontal" method="post" action="<?php echo base_url('admin/setting/challan') ?>" id="frmaddboard" enctype="multipart/form-data" >
                        <div class="form-group <?php echo ((form_error('challan_title') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Challan Title
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="challan_title" data-required="1" id="challan_title" class="form-control" value="<?php echo isset($setting_data->challan_title) ? $setting_data->challan_title : set_value('challan_title'); ?>" />
                                <?php echo ((form_error('challan_title') != "") ? '<span class="help-inline" style="color:red">' . form_error('challan_title') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('bank_logo') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Bank Logo
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="file" name="bank_logo" data-required="1" class="form-control"  onchange="readURL(this, 'bank_logo')" />
                                <img src="<?php echo base_url() . CHALLAN . $setting_data->bank_logo; ?>" alt="" height="100" width="100" id="bank_logo">
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('bank_title') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Bank Title
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="bank_title" data-required="1" id="bank_title" class="form-control" value="<?php echo isset($setting_data->bank_title) ? $setting_data->bank_title : set_value('bank_title'); ?>" />
                                <?php echo ((form_error('bank_title') != "") ? '<span class="help-inline" style="color:red">' . form_error('bank_title') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('school_logo') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">School Logo
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="file" name="school_logo" data-required="1" class="form-control"  onchange="readURL(this, 'school_logo')" />
                                <img src="<?php echo base_url() . CHALLAN . $setting_data->school_logo; ?>" alt="" height="100" width="100" id="school_logo">
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('school_title') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">School Title
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="school_title" data-required="1" id="school_title" class="form-control" value="<?php echo isset($setting_data->school_title) ? $setting_data->school_title : set_value('school_title'); ?>" />
                                <?php echo ((form_error('school_title') != "") ? '<span class="help-inline" style="color:red">' . form_error('school_title') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('bank_branch') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Bank Branch
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="bank_branch" data-required="1" id="bank_branch" class="form-control" value="<?php echo isset($setting_data->bank_branch) ? $setting_data->bank_branch : set_value('bank_branch'); ?>" />
                                <?php echo ((form_error('bank_branch') != "") ? '<span class="help-inline" style="color:red">' . form_error('bank_branch') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('bank_name') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Bank Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="bank_name" data-required="1" id="school_title" class="form-control" value="<?php echo isset($setting_data->bank_name) ? $setting_data->bank_name : set_value('bank_name'); ?>" />
                                <?php echo ((form_error('bank_name') != "") ? '<span class="help-inline" style="color:red">' . form_error('bank_name') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('notes') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Notes
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6">
                                <textarea name="notes" id="notes" class="form-control" rows="5"><?php echo isset($setting_data->notes) ? $setting_data->notes : set_value('notes'); ?></textarea>
                                <?php echo ((form_error('notes') != "") ? '<span class="help-inline" style="color:red">' . form_error('notes') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <input type="hidden" name="setting_id" data-required="1"  class="form-control" value="<?= isset($setting_data->id) ? $setting_data->id : 0; ?>" />
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="sublimt" name="submit"  class="btn btn-primary">Save</button>
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
    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
</script>