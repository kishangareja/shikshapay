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
    <style>
        /** Shared */
        .loginBtn {
          box-sizing: border-box;
          position: relative;
          /* width: 13em;  - apply for fixed size */
          margin: 0.2em;
          padding: 0 15px 0 46px;
          border: none;
          text-align: left;
          line-height: 34px;
          white-space: nowrap;
          border-radius: 0.2em;
          font-size: 16px;
          color: #FFF;
      }
      .loginBtn:before {
          content: "";
          box-sizing: border-box;
          position: absolute;
          top: 0;
          left: 0;
          width: 34px;
          height: 100%;
      }
      .loginBtn:focus {
          outline: none;
      }
      .loginBtn:active {
          box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
      }
      /* Google */
      .loginBtn--google {
          /*font-family: "Roboto", Roboto, arial, sans-serif;*/
          background: #DD4B39;
      }
      .loginBtn--google:before {
          border-right: #BB3F30 1px solid;
          background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
      }
      .loginBtn--google:hover,
      .loginBtn--google:focus {
          background: #E74B37;
      }
  </style>
</head>
<body>
    <div class="app app-header-fixed ">


        <div class="container w-xxl w-auto-xs" >
            <a href class="navbar-brand block m-t"><?php echo PROJECT_NAME; ?></a>
            <div class="m-b-lg">
                <div class="wrapper text-center">
                       <!-- <span class="help-inline" style="color:red;font-size:15px;">
                        <?php
if ($this->session->flashdata('msg')) {
	echo $this->session->flashdata('msg');
}
?>
</span> -->

<div class="alert alert-danger" id="err_msg" style="display: none;">
    <button class="close" data-close="alert"></button>
    <span>Emailid or Password did not matched.</span>
</div>

</div>
<form name="form" class="form-validation" id="login_form"  method="post">
    <div class="list-group list-group-sm">
        <div class="list-group-item">
            <input type="email" placeholder="Email" id="email" name="email" class="form-control no-border" required>
            <?php echo ((form_error('email') != "") ? '<span class="help-inline" style="color:red">' . form_error('email') . '</span>' : ''); ?>
        </div>
        <div class="list-group-item">
            <input type="password" id="password" placeholder="Password" class="form-control no-border" name="pwd" required>
            <?php echo ((form_error('pwd') != "") ? '<span class="help-inline" style="color:red">' . form_error('pwd') . '</span>' : ''); ?>
        </div>
    </div>
    <input type="hidden" name="uri_login" value="<?=$this->uri->segment('1');?>">
    <input type="button" class="btn btn-lg btn-primary btn-block" value="Send OTP" onclick="sendOTP()">
    <div class="text-center m-t m-b"><a href="<?=base_url('admin/login/forgotpassword');?>">Forgot password?</a></div>

    <a href="<?php echo $loginURL; ?>">
      <div class="loginBtn loginBtn--google">
        Login with Google+
    </div>
</a>

<div class="line line-dashed"></div>
</form>


<!-- enter email OTP section -->

<div class="alert alert-danger" id="otp_msg" style="display: none;">
    <button class="close" data-close="alert"></button>
    <span>OTP is wrong</span>
</div>
<form name="form" class="form-validation" id="verify_otp"  method="post" style="display: none">
    <div class="list-group list-group-sm">
        <div class="list-group-item">
            <input type="text" id="otp" placeholder="Enter OTP" name="otp" class="form-control no-border" required>
        </div>
    </div>
    <input type="hidden" name="uri_login" value="<?=$this->uri->segment('1');?>">
    <input type="button" class="btn btn-lg btn-primary btn-block" value="Log in" onclick="getLogin()">
    <div class="line line-dashed"></div>
</form>
<!--end enter email OTP section -->



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
<script>
    function sendOTP(){
        var email = $("#email").val();
        var password = $("#password").val();
        if (email&&password) {
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url('admin/login/index') ?>',
                dataType : 'JSON',
                data : $('#login_form').serialize(),
                success: function(response){
                    if (response.success==1) {
                        $('#login_form').hide();
                        $('#verify_otp').show();
                        $('#err_msg').hide();
                    }else{
                        $('#err_msg').show();
                    }
                }
            });
        }else{
            alert('Email and Password is required..!');
        }
    }

    function getLogin(){
        var otp = $("#otp").val();
        if (otp) {
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url('admin/login/verify_otp') ?>',
                dataType : 'JSON',
                data : $('#verify_otp').serialize(),
                success: function(response){
                    if (response.success==1) {
                        location.reload();
                    }else{
                        $('#otp_msg').show();
                    }
                }
            });
        }else{
            alert('Please enter OTP sent on registred mail id..!');
        }
    }
</script>
