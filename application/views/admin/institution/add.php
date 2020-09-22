<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?php echo $page_title ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    <?php echo $page_title ?>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url('admin/institution/add/'); ?>" enctype="multipart/form-data">
                        <?php $this->load->view('_partials/messages'); ?>

                        <div class="form-group">
                            <label class="control-label col-md-4">Institution Type
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <select name="institution_type" class="form-control"  >
                                    <option value="school" <?php
                                    if (isset($institution_data->institution_type) && $institution_data->institution_type == 'school') {
                                        echo "selected";
                                    }
                                    ?>> School </option>
                                    <option value="college" <?php
                                    if (isset($institution_data->institution_type) && $institution_data->institution_type == 'college') {
                                        echo "selected";
                                    }
                                    ?>> College </option>
                                </select>
                                <?= form_error('institution_type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Board
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <select name="board_id" class="form-control" id="board_id">
                                    <option value="">-- Select Board --</option>
                                    <?php foreach ($board_data as $value) { ?>
                                        <option value="<?php echo $value->id; ?>" <?php
                                        if (isset($boardById->id) && $value->id == $boardById->id) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $value->board_name; ?></option>
                                            <?php } ?>
                                </select>
                                <?php echo form_error('board_id'); ?>
                            </div>
                            <a href="javascript:;" onclick="popup_add_board();" class="btn m-b-xs btn-sm btn-primary">
                                <i class="fa fa-plus"></i></a>
                        </div>

                        <div class="form-group <?= ((form_error('affiliation_no') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Affiliate Number
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="affiliation_no" data-required="1"  class="form-control" value="<?php echo isset($institution_data->affiliation_no) ? $institution_data->affiliation_no : set_value('affiliation_no'); ?>" />
                                <?php echo ((form_error('affiliation_no') != "") ? '<span class="help-inline" style="color:red">' . form_error('affiliation_no') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo ((form_error('institution_name') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Institution Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="institution_name" data-required="1"  class="form-control" value="<?php echo isset($institution_data->institution_name) ? $institution_data->institution_name : set_value('institution_name'); ?>" />
                                <?php echo ((form_error('institution_name') != "") ? '<span class="help-inline" style="color:red">' . form_error('institution_name') . '</span>' : ''); ?>
                            </div>
                        </div>
                        
                        <?php /*
                        <div class="form-group">
                            <label class="control-label col-md-4">Class
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <select name="class_id[]" multiple class="w-md" id="class_id">
                                    <?php foreach ($class_data as $class) { ?>
                                        <option value="<?php echo $class->id; ?>" <?php
                                        if (isset($class_detail) && in_array($class->id, $class_detail)) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $class->class_name; ?></option>
                                            <?php } ?>
                                </select>
                                <?php echo form_error('class_id'); ?>
                            </div>
                        </div> */ ?>

                        <div class="form-group <?php echo ((form_error('address') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Address
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="address" data-required="1"  class="form-control" value="<?php echo isset($institution_data->address) ? $institution_data->address : set_value('address'); ?>" />
                                <?php echo ((form_error('address') != "") ? '<span class="help-inline" style="color:red">' . form_error('address') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo ((form_error('pincode') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Pincode
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input  type="text" name="pincode" data-required="1"  class="form-control" value="<?php echo isset($institution_data->pincode) ? $institution_data->pincode : set_value('pincode'); ?>" id="pincode"  maxlength="6" onkeypress="return isNumberKey(event);" onkeyup="return checkStateCity(this);" />
                                <?php echo ((form_error('pincode') != "") ? '<span class="help-inline" style="color:red">' . form_error('pincode') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo ((form_error('state') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">State
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="state" data-required="1"  class="form-control" value="<?php echo isset($institution_data->state) ? $institution_data->state : set_value('state'); ?>" id="state_name" readonly="true" />
                                <?php echo ((form_error('state') != "") ? '<span class="help-inline" style="color:red">' . form_error('state') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo ((form_error('city') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">City
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="city" data-required="1"  class="form-control" value="<?php echo isset($institution_data->city) ? $institution_data->city : set_value('city'); ?>" id="city_name" readonly="true" />
                                <?php echo ((form_error('city') != "") ? '<span class="help-inline" style="color:red">' . form_error('city') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo ((form_error('email') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Email
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="email" name="email" data-required="1"  class="form-control" value="<?php echo isset($institution_data->email) ? $institution_data->email : set_value('email'); ?>" />
                                <?php echo ((form_error('email') != "") ? '<span class="help-inline" style="color:red">' . form_error('email') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <?php /*
                          <div class="form-group <?php echo ((form_error('head_name') != "") ? "has-error" : ""); ?>">
                          <label class="control-label col-md-4">Head Name
                          <span class="required"> * </span>
                          </label>
                          <div class="col-md-4">
                          <input type="text" name="head_name" data-required="1"  class="form-control" value="<?php echo isset($institution_data->head_name) ? $institution_data->head_name : set_value('head_name'); ?>" />
                          <?php echo ((form_error('head_name') != "") ? '<span class="help-inline" style="color:red">' . form_error('head_name') . '</span>' : ''); ?>
                          </div>
                          </div>

                          <div class="form-group <?php echo ((form_error('school_status') != "") ? "has-error" : ""); ?>">
                          <label class="control-label col-md-4">Scholl Status
                          <span class="required"> * </span>
                          </label>
                          <div class="col-md-4">
                          <input type="text" name="school_status" data-required="1"  class="form-control" value="<?php echo isset($institution_data->school_status) ? $institution_data->school_status : set_value('school_status'); ?>" />
                          <?php echo ((form_error('school_status') != "") ? '<span class="help-inline" style="color:red">' . form_error('school_status') . '</span>' : ''); ?>
                          </div>
                          </div>
                         */ ?>

                        <div class="form-group <?php echo ((form_error('phone') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Contact Number
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="phone" data-required="1"  class="form-control" value="<?php echo isset($institution_data->phone) ? $institution_data->phone : set_value('phone'); ?>" id="contact_number" onkeypress="return isNumberKey(event)" />
                                <?php echo ((form_error('phone') != "") ? '<span class="help-inline" style="color:red">' . form_error('phone') . '</span>' : ''); ?>
                                <span id="errmsg" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Status
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <select name="status" class="form-control" id="status">
                                    <option value="1" <?php
                                    if (isset($institution_data) && $institution_data->status == 1) {
                                        echo "selected";
                                    }
                                    ?>>Active</option>
                                    <option value="0" <?php
                                    if (isset($institution_data) && $institution_data->status == 0) {
                                        echo "selected";
                                    }
                                    ?>>In active</option>
                                </select>
                                <?php echo form_error('status'); ?>
                            </div>
                        </div>

                        <input type="hidden" name="institution_id" data-required="1"  class="form-control" value="<?php echo isset($institution_data->id) ? $institution_data->id : '' ?>" />

                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-5">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="<?php echo base_url('admin/institution') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="popup_institution" tabindex="-1" role="basic" aria-hidden="true"></div>
<!-- /content -->
<script language=Javascript>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function checkStateCity(ref) {
        $("#state_name").val('');
        $("#city_name").val('');
        var pincode = $(ref).val();
        if (pincode.length == 6) {
            $.ajax({//create an ajax request to display.php
                type: "POST",
                url: "<?php echo base_url('admin/institution/check_pincode'); ?>",
                data: {'pincode': pincode},
                dataType: "json", //expect html to be returned
                success: function (result) {
                    // console.log(result.data.city);
                    $("#state_name").val(result.data.state);
                    $("#city_name").val(result.data.city);
                }
            });
        }
    }

    function popup_add_board() {
        $.ajax({
            url: "<?= base_url('admin/board/ajax_add_board'); ?>",
            dataType: 'json',
            success: function (response) {
                $('#popup_institution').modal('show');
                $("#popup_institution").html(response.view);
            }
        });
    }

    function add_board() {
        $.ajax({
            url: '<?= base_url('admin/board/add'); ?>',
            type: 'POST',
            data: $('#frmaddboard').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('#board_id').append($('<option value="' + data.key + '" selected="selected">' + $('#board_name').val() + '</option>'));
                    $("#popup_institution").modal('hide');
                } else {
                    $('#board_name_err').html(data.error.board_name);
                }
            }
        });
    }
</script>