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
                    <form class="form-horizontal" method="post" action="" id="frmaddsetting">
                        <div class="form-group">
                            <label class="control-label col-md-2">Credit Price</label>
                            <div class="col-md-4">
                                <input type="text" name="credit" data-required="1" id="credit" class="form-control" value="<?php echo isset($setting_data->credit) ? $setting_data->credit : set_value('credit'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <button type="sublimt" name="submit" value="Save" class="btn btn-primary">Save</button>
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#logo_img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>