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
            <h1 class="m-n font-thin h3"><?php echo $page; ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    <?php echo $page; ?>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url('admin/app_store/add/' . $id); ?>" enctype="multipart/form-data">
                        <div class="form-group <?php echo ((form_error('image') != "") ? "has-error" : ""); ?>">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="image"/>
                                <?php echo ((form_error('image') != "") ? '<span class="help-inline" style="color:red">' . form_error('image') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('title') != "") ? "has-error" : ""); ?>">
                            <label class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" value="<?= isset($app_store->title) ? $app_store->title : ''; ?>"/>
                                <?php echo ((form_error('title') != "") ? '<span class="help-inline" style="color:red">' . form_error('title') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('name') != "") ? "has-error" : ""); ?>">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-9">
                                <select name="name" class="form-control" id="name">
                                    <option value="">-- Select Premium Module --</option>
                                    <?php
                                    if ($premium_module) {
                                        foreach ($premium_module as $module) {
                                            ?>
                                            <option value="<?= $module->gateway; ?>" <?= (isset($app_store) && $app_store->name == $module->gateway) ? 'selected="selected"' : ''; ?>><?= $module->gateway_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo ((form_error('name') != "") ? '<span class="help-inline" style="color:red">' . form_error('name') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('short_desc') != "") ? "has-error" : ""); ?>">
                            <label class="col-sm-2 control-label">Short Desc</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="short_desc" value="<?= isset($app_store->short_desc) ? $app_store->short_desc : ''; ?>"/>
                                <?php echo ((form_error('short_desc') != "") ? '<span class="help-inline" style="color:red">' . form_error('short_desc') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('amount') != "") ? "has-error" : ""); ?>">
                            <label class="col-sm-2 control-label">Credit</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="amount" value="<?= isset($app_store->amount) ? $app_store->amount : ''; ?>"/>
                                <?php echo ((form_error('amount') != "") ? '<span class="help-inline" style="color:red">' . form_error('amount') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('description') != "") ? "has-error" : ""); ?>">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" style="width: 100%;" rows="10"><?= isset($app_store->description) ? $app_store->description : ''; ?></textarea>
                                <?php echo ((form_error('description') != "") ? '<span class="help-inline" style="color:red">' . form_error('description') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo ((form_error('status') != "") ? "has-error" : ""); ?>">
                            <label class="col-sm-2 control-label">status</label>
                            <div class="col-sm-9">
                                <select name="status" class="form-control" id="status">
                                    <option value="1" <?= (isset($app_store) && $app_store->status == 1) ? 'selected="selected"' : ''; ?>>Active</option>
                                    <option value="0" <?= (isset($app_store) && $app_store->status == 0) ? 'selected="selected"' : ''; ?>>In active</option>
                                </select>
                                <?php echo ((form_error('status') != "") ? '<span class="help-inline" style="color:red">' . form_error('status') . '</span>' : ''); ?>
                            </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content -->