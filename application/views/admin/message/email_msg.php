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
                        <?php $this->load->view('_partials/messages'); ?>
                        <div class="form-group <?php echo ((form_error('mobile') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Email
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="email" class="form-control" value="<?= set_value('email'); ?>" />
                                <?php echo ((form_error('email') != "") ? '<span class="help-inline" style="color:red">' . form_error('email') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?= ((form_error('subject') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Subject
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="subject" id="subject" value="<?= set_value('subject'); ?>"/>
                                <?php echo ((form_error('subject') != "") ? '<span class="help-inline" style="color:red">' . form_error('subject') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?= ((form_error('message') != "") ? "has-error" : ""); ?>">
                            <label class="control-label col-md-4">Message
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <textarea class="form-control" name="message" id="message"><?= set_value('message'); ?></textarea>
                                <?php echo ((form_error('message') != "") ? '<span class="help-inline" style="color:red">' . form_error('message') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-5">
                                <button type="submit" class="btn btn-primary">Send</button>
                                <a href="<?php echo base_url('admin/message/emailmsg') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content -->