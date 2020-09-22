
<!-- content -->
<div id="content" class="app-content" role="main">
	<div class="app-content-body ">
		<div class="bg-light lter b-b wrapper-md">
			<h1 class="m-n font-thin h3"><?php echo $page_title ?></h1>
		</div>
		<div class="wrapper-md" ng-controller="FormDemoCtrl">
			<div class="panel panel-default">
				<div class="panel-heading font-bold">
					<?php echo $page_title ?>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="<?php echo base_url('admin/student/add/'); ?>" enctype="multipart/form-data">
							<?php $this->load->view('_partials/messages');?>


						<div class="form-group <?php echo ((form_error('name') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="name" data-required="1"  class="form-control" value="<?php echo isset($student_data->name) ? $student_data->name : set_value('name'); ?>" />
                            <?php echo ((form_error('name') != "") ? '<span class="help-inline" style="color:red">' . form_error('name') . '</span>' : ''); ?>
                            </div>
                        </div>



                        <div class="form-group <?php echo ((form_error('phone') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Contact Number
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="phone" data-required="1"  class="form-control" value="<?php echo isset($student_data->phone) ? $student_data->phone : set_value('phone'); ?>" id="contact_number" onkeypress="return isNumberKey(event)" />
                            <?php echo ((form_error('phone') != "") ? '<span class="help-inline" style="color:red">' . form_error('phone') . '</span>' : ''); ?>
                            <span id="errmsg" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group <?php echo ((form_error('class') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Class
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="class" data-required="1"  class="form-control" value="<?php echo isset($student_data->class) ? $student_data->class : set_value('class'); ?>" />
                            <?php echo ((form_error('class') != "") ? '<span class="help-inline" style="color:red">' . form_error('class') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo ((form_error('section') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Section
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="section" data-required="1"  class="form-control" value="<?php echo isset($student_data->section) ? $student_data->section : set_value('section'); ?>" />
                            <?php echo ((form_error('section') != "") ? '<span class="help-inline" style="color:red">' . form_error('section') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo ((form_error('address') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Address
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="address" data-required="1"  class="form-control" value="<?php echo isset($student_data->address) ? $student_data->address : set_value('address'); ?>" />
                            <?php echo ((form_error('address') != "") ? '<span class="help-inline" style="color:red">' . form_error('address') . '</span>' : ''); ?>
                            </div>
                        </div>

                        <!--

                        <div class="form-group <?php echo ((form_error('email') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Email
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="email" name="email" data-required="1"  class="form-control" value="<?php echo isset($student_data->email) ? $student_data->email : set_value('email'); ?>" />
                            <?php echo ((form_error('email') != "") ? '<span class="help-inline" style="color:red">' . form_error('email') . '</span>' : ''); ?>
                            </div>
                        </div> -->


						<div class="form-group">
                            <label class="control-label col-md-4">Status
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <select name="status" class="form-control" id="status">
                                    <option value="1" <?php if (isset($student_data) && $student_data->status == 1) {echo "selected";}?>>Active</option>
                                    <option value="0" <?php if (isset($student_data) && $student_data->status == 0) {echo "selected";}?>>In active</option>
                                </select>
                            <?php echo form_error('status'); ?>
                            </div>
                        </div>

                        <input type="hidden" name="institution_id" data-required="1"  class="form-control" value="<?php echo isset($student_data->id) ? $student_data->id : '' ?>" />

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
<!-- /content -->
<script language=Javascript>

      function isNumberKey(evt)
      {

         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

   </script>
