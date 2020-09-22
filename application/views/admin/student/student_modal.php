<style type="text/css" media="screen">
    div#success_box {
background-color: #dff0d8;
color: #3c763d;
}
.form-horizontal .control-label {
padding-top: 7px;
margin-bottom: 0;
text-align: left;
}
.modal-dialog {
width: 850px;
margin: 30px auto;
}
</style>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $page_title ?></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="classForm" method="post" action="" enctype="multipart/form-data">
                    <div class="alert alert-danger" style="display: none;" id="error_box">
                        <button class="close" data-close="alert"></button>
                        <span id="error-message"></span>
                    </div>
                    <div class="alert alert-sucess" style="display: none;" id="success_box">
                        <button class="close" data-close="alert"></button>
                        <span id="success-message"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group <?php echo ((form_error('registration_id') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Registration Number
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" name="registration_id" data-required="1"  class="form-control" value="<?php echo isset($student_data->registration_id) ? $student_data->registration_id : set_value('registration_id'); ?>" />
                            <span id="registration_id_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <div class="form-group <?php echo ((form_error('role_no') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Role No.
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" name="role_no" data-required="1"  class="form-control" value="<?php echo isset($student_data->role_no) ? $student_data->role_no : set_value('role_no'); ?>" />
                            <span id="role_no_err" class="help-inline" style="color:red"></span>


                                </div>
                            </div>
                            <div class="form-group <?php echo ((form_error('fullname') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Student Full Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" name="fullname" data-required="1"  class="form-control" value="<?php echo isset($student_data->fullname) ? $student_data->fullname : set_value('fullname'); ?>" />
                            <span id="fullname_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <div class="form-group <?php echo ((form_error('institution_id') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Institution
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <select name="institution_id" class="form-control"  >
                                        <option value="">-- Select Institution --</option>
                                        <?php foreach ($institution_data as $value) {?>
                                        <option value="<?php echo $value->id; ?>" <?php if (isset($student_data->institution_id) && $value->id == $student_data->institution_id) {echo "selected";}?>><?php echo $value->institution_name; ?></option>
                                        <?php }?>
                                    </select>
                            <span id="institution_id_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-12">Class
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <select name="class_id" class="form-control"  >
                                        <option value="">-- Select Class --</option>
                                        <?php foreach ($class_data as $value) {?>
                                        <option value="<?php echo $value->id; ?>" <?php if (isset($student_data->class_id) && $value->id == $student_data->class_id) {echo "selected";}?>><?php echo $value->class_name; ?></option>
                                        <?php }?>
                                    </select>
                            <span id="class_id_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-12">Section
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <select name="section_id" class="form-control"  >
                                        <option value="">-- Select Section --</option>
                                        <?php foreach ($setion_data as $value) {?>
                                        <option value="<?php echo $value->id; ?>" <?php if (isset($student_data->section_id) && $value->id == $student_data->section_id) {echo "selected";}?>><?php echo $value->section_name; ?></option>
                                        <?php }?>
                                    </select>
                            <span id="section_id_err" class="help-inline" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group <?php echo ((form_error('father_name') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Father Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" name="father_name" data-required="1"  class="form-control" value="<?php echo isset($student_data->father_name) ? $student_data->father_name : set_value('father_name'); ?>" />
                            <span id="father_name_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <div class="form-group <?php echo ((form_error('mother_name') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Mother Name
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" name="mother_name" data-required="1"  class="form-control" value="<?php echo isset($student_data->mother_name) ? $student_data->mother_name : set_value('mother_name'); ?>" />
                            <span id="mother_name_err" class="help-inline" style="color:red"></span>


                                </div>
                            </div>
                            <div class="form-group <?php echo ((form_error('dob') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Date Of Birth
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" id="datepicker" name="dob" data-required="1"  class="form-control" value="<?php echo isset($student_data->dob) ? $student_data->dob : set_value('dob'); ?>" />
                            <span id="dob_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <div class="form-group <?php echo ((form_error('username') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Userame
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" name="username" data-required="1"  class="form-control" value="<?php echo isset($student_data->username) ? $student_data->username : set_value('username'); ?>" />
                            <span id="username_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-12">Gender
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <select name="gender" class="form-control" id="gender">
                                        <option value="male" <?php if (isset($student_data) && $student_data->gender == 'male') {echo "selected";}?>>Male</option>
                                        <option value="female" <?php if (isset($student_data) && $student_data->gender == 'female') {echo "selected";}?>>Female</option>
                                    </select>
                            <span id="gender_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <div class="form-group <?php echo ((form_error('password') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Password
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="password" name="password" data-required="1"  class="form-control" value="<?php echo isset($student_data->password) ? $student_data->password : set_value('password'); ?>" />
                            <span id="password_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group <?php echo ((form_error('contactno') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Contact Number
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="text" name="contactno" data-required="1"  class="form-control" value="<?php echo isset($student_data->contactno) ? $student_data->contactno : set_value('contactno'); ?>" />
                            <span id="password_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <div class="form-group <?php echo ((form_error('address') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Address
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <textarea type="text" name="address" data-required="1"  class="form-control"><?php echo isset($student_data->address) ? $student_data->address : set_value('address'); ?></textarea>
                            <span id="address_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <!--  <div class="form-group <?php echo ((form_error('class_name') != "") ? "has-error" : ""); ?>">
                                <div class="col-md-12">
                                    <label class="control-label">Student
                                        <span class="required"> * :</span>
                                    </label>
                                    <input type="radio" name="class_name" data-required="1"  value="<?php echo isset($student_data->class_name) ? $student_data->class_name : set_value('class_name'); ?>" /> New
                                    <input type="radio" name="class_name" data-required="1"  value="<?php echo isset($student_data->class_name) ? $student_data->class_name : set_value('class_name'); ?>" /> Old
                                </div>
                            </div> -->
                            <div class="form-group <?php echo ((form_error('profile_pic') != "") ? "has-error" : ""); ?>">
                                <label class="control-label col-md-12">Profile Pic
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <input type="file" name="profile_pic" onchange="imagePreview(this)" data-required="1"  class="form-control" />
                                    <img id="blah" src="<?php echo isset($student_data->profile_pic) ? base_url() . PROFILEPIC . $student_data->profile_pic : ''; ?>" alt="" height="60" width="60">
                            <span id="profile_pic_err" class="help-inline" style="color:red"></span>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-12">Status
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <select name="status" class="form-control" id="status">
                                        <option value="1" <?php if (isset($student_data) && $student_data->status == 1) {echo "selected";}?>>Active</option>
                                        <option value="0" <?php if (isset($student_data) && $student_data->status == 0) {echo "selected";}?>>In active</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="student_id" data-required="1"  class="form-control" value="<?php echo isset($student_data->id) ? $student_data->id : 0; ?>" />
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-5">
                            <a href="javascript:;" onclick="submitForm()" class="btn btn-primary">Save</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


  <script>

function imagePreview(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

  $( function() {
    /* Initialise the date picker */

    $( "#datepicker" ).datepicker();
    // $("#datepicker").datepicker("destroy");

  } );


  </script>