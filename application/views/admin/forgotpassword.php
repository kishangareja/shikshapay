<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title><?php echo PROJECT_NAME; ?></title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="<?php echo base_url('assets/libs/assets/animate.css/animate.css') ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/libs/assets/font-awesome/css/font-awesome.min.css') ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/libs/assets/simple-line-icons/css/simple-line-icons.css') ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/libs/jquery/bootstrap/dist/css/bootstrap.css') ?>" type="text/css" />

  <link rel="stylesheet" href="<?php echo base_url('assets/css/font.css') ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css') ?>" type="text/css" />

</head>
<body>
<div class="app app-header-fixed ">


<div class="container w-xxl w-auto-xs" >
  <a href class="navbar-brand block m-t"><?php echo PROJECT_NAME; ?></a>
  <div class="m-b-lg">
    <div class="wrapper text-center">
            <?php
if (isset($msg) && $msg != '') {
	?>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span><?php echo $msg; ?></span>
                </div>
            <?php }?>
    </div>
    <form name="form" class="form-validation" action="<?php echo base_url(); ?>admin/login/forgotpassword" method="post" id="frmforgotpassword">
            <p> Enter your e-mail address below to reset your password. </p>

      <div class="list-group list-group-sm">
        <div class="list-group-item">
          <input type="email" placeholder="Email" name="email" class="form-control no-border" required>
        </div>

      </div>
      <button type="submit" class="btn btn-lg btn-primary btn-block" >Log in</button>
      <div class="text-center m-t m-b">
                <a href="<?php echo base_url(); ?>admin/login" class="btn red btn-outline">Back</a>


      </div>
      <div class="line line-dashed"></div>
    </form>
  </div>
</div>
</div>
<script src="<?php echo base_url('assets/libs/jquery/jquery/dist/jquery.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/jquery/bootstrap/dist/js/bootstrap.js') ?>"></script>
<script src="<?php echo base_url('assets/js/ui-load.js') ?>"></script>
<script src="<?php echo base_url('assets/js/ui-jp.config.js') ?>"></script>
<script src="<?php echo base_url('assets/js/ui-jp.js') ?>"></script>
<script src="<?php echo base_url('assets/js/ui-nav.js') ?>"></script>
<script src="<?php echo base_url('assets/js/ui-toggle.js') ?>"></script>
<script src="<?php echo base_url('assets/js/ui-client.js') ?>"></script>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function (e)
    {
        $('#frmforgotpassword').validate({
            rules: {
                email: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter email id."
                },
            },
            highlight: function (element) {
                $(element).parent().addClass('error')
            },
            unhighlight: function (element) {
                $(element).parent().removeClass('error')
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

    });

</script>
