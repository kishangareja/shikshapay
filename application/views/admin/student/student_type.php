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

                        <div class="form-group <?php echo ((form_error('name') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Name
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="name" data-required="1"  class="form-control" value="<?php echo isset($institution_data->name) ? $institution_data->name : set_value('name'); ?>" />
                                <?php echo ((form_error('name') != "") ? '<span class="help-inline" style="color:red">' . form_error('name') . '</span>' : ''); ?>
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





                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-5">
                                <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                                <!-- <a href="<?php echo base_url('admin/institution') ?>" class="btn btn-default">Cancel</a> -->
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
