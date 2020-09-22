<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>
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
                    <form class="form-horizontal" method="post" action="<?php echo base_url('admin/home/privacy_policy/'); ?>">
                        <?php $this->load->view('_partials/messages'); ?>
                        <div class="form-group <?php echo ((form_error('description') != "") ? "has-error" : ""); ?>">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" style="width: 100%;" rows="10"> <?php echo $pp_data->description; ?></textarea>
                                <?php echo ((form_error('description') != "") ? '<span class="help-inline" style="color:red">' . form_error('description') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content -->