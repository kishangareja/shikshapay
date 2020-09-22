<style>
    .features{padding: 50px;padding-bottom: 0px;}
    .form{max-width: 100%;margin: 0px;}
    .form-input div{padding: 10px;}
    .form-input div input{padding: 10px;}
    .signup-ctrl{margin: 0px;margin-top: 10px;}
    .join-text{padding: 0px;font-weight: normal;}
    .font-ctrl{font-weight: normal !important;color: #666666 !important;font-size: 14px !important;}
    .font-ctrl-div{float: left !important;padding-left: 20px;padding-top: 36px;}
    .font-siz{font-weight: normal !important;font-size: 24px !important;}
    .logo-set{width: 60%;padding-top: 85px;}
    .login-section form .row {display: flex;align-items: center;}
    .login-section-break .six {position: relative;border-top: 1px solid #e1e1e1;margin-top: 25px;margin-bottom: 5px;}
    .login-section-break .six:last-child {margin-left: 0 !important;}
    .six.columns {width: 42%;}
    .column, .columns {width: 100%;float: left;box-sizing: border-box;}
    .or-break{padding: 16px;}
    .login_form {padding: 30px 40px;border: 1px solid #e1e1e1;}
    .forgot-div{padding: 34px;font-size: 20px;}
</style>
<div id="main" class="main">
    <div id="products" class="features wow fadeInDown">
        <div class="container-m">
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="feature-list">
                        <div class="card-text">
                            <img class="logo-set" src="<?= base_url('assets/frontend/img/logo.png'); ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="signup" class="cta-sm">
                        <div class="container-m text-left login_form">
                            <form id="frmsignupstep" action="<?= base_url('login'); ?>" method="post" autocomplete="off">
                                <div class="cta-content">
                                    <h1 class="font-siz">Open your <?= PROJECT_NAME; ?> account</h1>
                                    <div class="form wow fadeIn signup-ctrl" data-wow-delay="0.2s">
                                        <div class="row form-input">
                                            <div class="col-md-12">
                                                <select name="institution_type">
                                                    <option value="school" <?= (isset($_POST['institution_type']) && $_POST['institution_type'] == 'school') ? 'selected="selected"' : ''; ?>>School</option>
                                                    <option value="college" <?= (isset($_POST['institution_type']) && $_POST['institution_type'] == 'college') ? 'selected="selected"' : ''; ?>>College</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <input id="email" type="email" name="email" placeholder="Enter your email address" class="form-control" 
                                                       autocomplete="off" required="" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                                <?php echo form_error('email'); ?>
                                            </div>
                                            <div class="col-md-12">
                                                <input class="form-control" type="password" id="password" placeholder="Enter your password" name="password" required="">
                                                <?php echo form_error('password'); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn-action" type="submit" name="user_login" id="user_login">Login</button>
                                            </div>
                                            <div class="col-md-6 forgot-div">
                                                <a href="#">Forgot password?</a>
                                            </div>
                                        </div>
                                        <?php if($this->session->flashdata('error')){ ?>
                                        <div id="alrt" class="alert alert-danger" style="padding:5px;margin-top:5px;"><?= $this->session->flashdata('error'); ?></div>
                                        <?php } ?>
                                    </div>
                                    <div class="row login-section-break">
                                        <div class="six columns">&nbsp;</div>
                                        <span class="or-break">OR</span>
                                        <div class="six columns">&nbsp;</div>
                                    </div>
                                    <div class="form wow">
                                        <input class="submit-button" type="button" value="Signup" onclick="window.location = '<?= base_url('signup'); ?>';">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="margin-top: -230px;">
                    <div class="cta-sm container-m text-left join-text">
                        <div class="cta-content">
                            <h1 class="text-left font-siz">Join our growing community of 1+ million traders!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $('.navbar').addClass('effect-main past-main');
</script>