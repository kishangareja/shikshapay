<link href="<?= base_url('assets/libs/jquery/chosen/bootstrap-chosen.css'); ?>" rel="stylesheet" type="text/css" media="all" />
<script src="<?= base_url('assets/libs/jquery/chosen/chosen.jquery.min.js'); ?>"></script>
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
                    <form class="form-horizontal" method="post" action="">
                        <?php $this->load->view('_partials/messages');?>

                        <div class="form-group <?php echo ((form_error('type') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Type
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <select name="type" class="form-control" onchange="changeType(this)" >
                                    <option value="">-- Select Type --</option>
                                    <option value="institution"> Institution </option>
                                    <option value="student"> Student </option>
                                </select>
                                <?php echo ((form_error('type') != "") ? '<span class="help-inline" style="color:red">' . form_error('type') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo ((form_error('institution_id') != "") ? "has-error" : ""); ?>" style="display: none;" id="institution_select">
                            <label class="control-label col-md-4">Institution
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <select name="institution_id[]" class="form-control w-md" id="set_institution" multiple="true">
                                    <option value="">-- Select Institution --</option>
                                    <?php foreach ($institution_data as $value) {?>
                                        <option value="<?php echo $value->id; ?>" <?php if (isset($student_data->institution_id) && $value->id == $student_data->institution_id) {echo "selected";}?>><?php echo $value->institution_name; ?></option>
                                    <?php }?>
                                </select>
                                <?php echo ((form_error('institution_id') != "") ? '<span class="help-inline" style="color:red">' . form_error('institution_id') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo ((form_error('student_id') != "") ? "has-error" : ""); ?>" style="display: none;" id="student_select">
                            <label class="control-label col-md-4">Student
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <select name="student_id[]" class="form-control w-md" id="set_student" multiple="true">
                                    <option value="">-- Select Student --</option>
                                    <?php foreach ($student_data as $value) {?>
                                        <option value="<?php echo $value->id; ?>" ><?php echo $value->registration_id; ?></option>
                                    <?php }?>
                                </select>
                                <?php echo ((form_error('student_id') != "") ? '<span class="help-inline" style="color:red">' . form_error('student_id') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?=((form_error('message') != "") ? "has-error" : "");?>">
                            <label class="control-label col-md-4">Message
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <textarea class="form-control" name="message" id="message"><?=set_value('message');?></textarea>
                                <?php echo ((form_error('message') != "") ? '<span class="help-inline" style="color:red">' . form_error('message') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-5">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <a href="<?php echo base_url('admin/notice') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content -->
<script>
    function changeType(ref){
        var type = $(ref).val();
        if (type=='institution') {
            $("#institution_select").show();
            $("#student_select").hide();
            $('#set_institution').chosen();
        }else{
            $("#student_select").show();
            $("#institution_select").hide();
            $('#set_student').chosen();
        }
        $('.chosen-container').css('width', '100%');
     }
</script>