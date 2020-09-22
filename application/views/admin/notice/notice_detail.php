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


                       <div class="form-group <?=((form_error('message') != "") ? "has-error" : "");?>">
                            <label class="control-label col-md-4">Message
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <textarea readonly="true" class="form-control" name="message" id="message"><?=set_value('message');?><?php echo isset($notice_data->message) ? $notice_data->message : ''; ?></textarea>
                                <?php echo ((form_error('message') != "") ? '<span class="help-inline" style="color:red">' . form_error('message') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-5">
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