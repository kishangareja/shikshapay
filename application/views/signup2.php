<script src="<?= base_url('assets/frontend/validate/jquery-2.1.1.js'); ?>"></script>
<script src="<?= base_url('assets/frontend/validate/jquery.validate.js'); ?>"></script>
<script src="<?= base_url('assets/frontend/validate/jquery.maskedinput.js'); ?>"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        // add * to required field labels
        $('label.required').append('&nbsp;<strong>*</strong>&nbsp;');

        // accordion functions
        var accordion = $("#stepForm").accordion();
        var current = 0;

        $.validator.addMethod("pageRequired", function (value, element) {
            var $element = $(element)

            function match(index) {
                return current == index && $(element).parents("#sf" + (index + 1)).length;
            }
            if (match(0) || match(1) || match(2)) {
                return !this.optional(element);
            }
            return "dependency-mismatch";
        }, $.validator.messages.required)

        var v = $("#cmaForm").validate({
            errorClass: "warning",
            onkeyup: false,
            onfocusout: false,
            submitHandler: function () {
                alert("Submitted, thanks!");
            }
        });

        // back buttons do not need to run validation
        $("#sf2 .prevbutton").click(function () {
            accordion.accordion("option", "active", 0);
            current = 0;
        });
        $("#sf3 .prevbutton").click(function () {
            accordion.accordion("option", "active", 1);
            current = 1;
        });
        $("#sf4 .prevbutton").click(function () {
            accordion.accordion("option", "active", 2);
            current = 2;
        });
        // these buttons all run the validation, overridden by specific targets above
        $(".open3").click(function () {
            if (v.form()) {
                accordion.accordion("option", "active", 3);
                current = 3;
            }
        });
        $(".open2").click(function () {
            if (v.form()) {
                accordion.accordion("option", "active", 2);
                current = 2;
            }
        });
        $(".open1").click(function () {
            if (v.form()) {
                accordion.accordion("option", "active", 1);
                current = 1;
            }
        });
        $(".open0").click(function () {
            if (v.form()) {
                accordion.accordion("option", "active", 0);
                current = 0;
            }
        });
    });
</script>
<!--<link rel="stylesheet" media="screen" href="<?= base_url('assets/frontend/validate/style.css'); ?>">-->
<style>
    .form-input div input{padding: 10px;}
    .features{padding: 50px}
    .join-text{padding-top: 20px;padding-bottom: 0px;font-weight: normal;}
    .font-ctrl{font-weight: normal !important;color: #666666 !important;font-size: 14px !important;}
    .font-ctrl-div{float: left !important;padding-top: 30px;width: 100% !important;}
    .font-siz{font-weight: normal !important;font-size: 24px !important;}
    .logo-set{width: 25%;padding-top: 60px;}
    .form-note{padding: 35px 10px;line-height: 15px;}
    .help-inline p {text-align: left;padding-bottom: 10px;line-height: 18px;font-size: 12px;}
    
</style>
<div id="main" class="main">
    <div id="products" class="features wow fadeInDown">
        <div class="container-m">
            <div class="row text-center" id="maindiv">
                <div class="col-md-5">
                    <div class="feature-list">
                        <div class="card-text">
                            <img class="logo-set" src="<?= base_url('assets/frontend/img/logo.png'); ?>" alt="">
                        </div>
                        <div class="cta-sm container-m text-left join-text">
                            <div class="cta-content">
                                <h1 class="text-left font-siz">Join our growing community of 1+ million traders!</h1>
                            </div>
                        </div>
                        <div class="ar-feature">
                            <div class="ar-list">
                                <div class="ar-text font-ctrl-div">
                                    <p class="font-ctrl">– The smartest trading technology and platforms</p>
                                    <p class="font-ctrl">– ₹0 equity investments and flat ₹20 intraday trades</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div id="signup" class="cta-sm">
                        <div class="container-m text-left">
                            <!-- multistep form -->
                            <form name="cmaForm" id="cmaForm" method="post">
                                <!-- progressbar -->
                                <ul id="stepForm" class="ui-accordion-container">
                                    <li id="sf1" class="active">
                                        <a href='#' class="ui-accordion-link"></a>-->
                                        <div>
                                            <fieldset>
                                                <legend>Step 1 of 4</legend>
                                                <!--<div class="requiredNotice">*Required Field</div>-->
                                                <h3 class="stepHeader">Tell us about the property you're buying</h3>
                                                <h2 class="fs-title">Create your account</h2>
                                                <h3 class="fs-subtitle">Institution account information</h3>
                                                <div class="formspacer"></div>
                                                <div class="row form-input" id="div0">
                                                    <div class="col-md-6">
                                                        <select name="institution_type" id="institution_type">
                                                            <option value="school" <?= (isset($_POST['institution_type']) && $_POST['institution_type'] == 'school') ? 'selected="selected"' : ''; ?>>School</option>
                                                            <option value="college" <?= (isset($_POST['institution_type']) && $_POST['institution_type'] == 'college') ? 'selected="selected"' : ''; ?>>College</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="board_id" id="board_id" class="inputclass pageRequired" title="Select Board">
                                                            <option value="">-- Select Board --</option>
                                                            <?php foreach ($board_data as $value) { ?>
                                                                <option value="<?php echo $value->id; ?>" <?php
                                                                if (isset($_POST['board_id']) && $value->id == $_POST['board_id']) {
                                                                    echo "selected";
                                                                }
                                                                ?>><?php echo $value->board_name; ?></option>
                                                                    <?php } ?>
                                                        </select>
                                                        <span id="board_id_err" class="help-inline" style="color:red"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input id="institution_name" type="text" name="institution_name" value="<?= isset($_POST['institution_name']) ? $_POST['institution_name'] : ''; ?>"
                                                               placeholder="Enter your institution name" autocomplete="off" required="" id="institution_name">
                                                        <span id="institution_name_err" class="help-inline" style="color:red"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" id="affiliation_no" value="<?= isset($_POST['affiliation_no']) ? $_POST['affiliation_no'] : ''; ?>"
                                                               placeholder="Enter your affiliation number" name="affiliation_no" required="">
                                                        <span id="affiliation_no_err" class="help-inline" style="color:red"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input id="email" type="email" name="email" placeholder="Enter your email address" 
                                                               autocomplete="off" required="" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                                        <span id="email_err" class="help-inline" style="color:red"></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" id="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"
                                                               placeholder="Enter your mobile number" name="phone" required="">
                                                        <span id="phone_err" class="help-inline" style="color:red"></span>
                                                    </div>
                                                </div>
                                                <div class="buttonWrapper">
                                                    <input name="formNext1" type="button" class="open1 nextbutton" value="Next" alt="Next" title="Next">
                                                </div>
                                            </fieldset>
                                        </div>
                                    </li>
                                    <li>
                                        <a href='#' class="ui-accordion-link"></a>
                                        <div>
                                            <fieldset>
                                                <legend>Step 2 of 4</legend>
                                                <h2 class="stepHeader">Institution Setup</h2>
                                                <h3 class="fs-subtitle">How many student you have</h3>
                                                <div class="row form-input" id="div1">
                                                    <div class="col-md-6">
                                                        <input id="total_students" type="text" name="total_students" value="<?= isset($_POST['total_students']) ? $_POST['total_students'] : ''; ?>"
                                                               placeholder="Enter total no of students" autocomplete="off" required="">
                                                               <?php echo form_error('total_students'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="fee_type" id="fee_type" class="inputclass pageRequired" title="Select fee type">
                                                            <option value="">-- Fee collection type --</option>
                                                            <?php foreach ($board_data as $value) { ?>
                                                                <option value="<?php echo $value->id; ?>" <?php
                                                                if (isset($_POST['fee_type']) && $value->id == $_POST['fee_type']) {
                                                                    echo "selected";
                                                                }
                                                                ?>><?php echo $value->board_name; ?></option>
                                                                    <?php } ?>
                                                        </select>
                                                        <?php echo form_error('fee_type'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" id="pincode" value="<?= isset($_POST['pincode']) ? $_POST['pincode'] : ''; ?>"
                                                               placeholder="Enter your area pincode" name="pincode" required="">
                                                               <?php echo form_error('pincode'); ?>
                                                    </div>
                                                </div>
                                                <div class="buttonWrapper">
                                                    <input name="formBack0" type="button" class="open0 prevbutton" value="Back" alt="Back" title="Back">
                                                    <input name="formNext2" type="button" class="open2 nextbutton" value="Next" alt="Next" title="Next">
                                                </div>
                                            </fieldset>
                                        </div>
                                    </li>
                                    <li>     <a href='#' class="ui-accordion-link"></a>
                                        <div>
                                            <fieldset>
                                                <legend>Step 3 of 4</legend>
                                                <h2 class="fs-title">Module Setup</h2>
                                                <h3 class="fs-subtitle">Module Configuration</h3>
                                                <div class="row form-input" id="div2">
                                                    <div class="col-md-6">
                                                        <select name="institution_type">
                                                            <option value="school" <?= (isset($_POST['institution_type']) && $_POST['institution_type'] == 'school') ? 'selected="selected"' : ''; ?>>School</option>
                                                            <option value="college" <?= (isset($_POST['institution_type']) && $_POST['institution_type'] == 'college') ? 'selected="selected"' : ''; ?>>College</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="board_id" id="board_id" class="inputclass pageRequired" title="Select Board">
                                                            <option value="">-- Select Board --</option>
                                                            <?php foreach ($board_data as $value) { ?>
                                                                <option value="<?php echo $value->id; ?>" <?php
                                                                if (isset($_POST['board_id']) && $value->id == $_POST['board_id']) {
                                                                    echo "selected";
                                                                }
                                                                ?>><?php echo $value->board_name; ?></option>
                                                                    <?php } ?>
                                                        </select>
                                                        <?php echo form_error('board_id'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" id="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"
                                                               placeholder="Enter your mobile number" name="phone" class="inputclass pageRequired" title="Enter phone number">
                                                               <?php echo form_error('phone'); ?>
                                                    </div>
                                                </div>
                                                <div class="buttonWrapper">
                                                    <input name="formBack1" type="button" class="open1 prevbutton" value="Back" alt="Back" title="Back">
                                                    <input name="formNext3" type="button" class="open3 nextbutton" value="Next" alt="Next" title="Next">
                                                </div>
                                            </fieldset>
                                        </div>
                                    </li>
                                    <li>   <a href='#' class="ui-accordion-link"></a>
                                        <div>
                                            <fieldset>
                                                <legend>Step 4 of 4</legend>
                                                <h2 class="fs-title">Complete</h2>
                                                <h3 class="fs-subtitle">Your final quatation</h3>
                                                <div class="row form-input" id="div3">
                                                    <div class="col-md-6">
                                                        <select name="institution_type">
                                                            <option value="school" <?= (isset($_POST['institution_type']) && $_POST['institution_type'] == 'school') ? 'selected="selected"' : ''; ?>>School</option>
                                                            <option value="college" <?= (isset($_POST['institution_type']) && $_POST['institution_type'] == 'college') ? 'selected="selected"' : ''; ?>>College</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="board_id" class="form-control" id="board_id">
                                                            <option value="">-- Select Board --</option>
                                                            <?php foreach ($board_data as $value) { ?>
                                                                <option value="<?php echo $value->id; ?>" <?php
                                                                if (isset($_POST['board_id']) && $value->id == $_POST['board_id']) {
                                                                    echo "selected";
                                                                }
                                                                ?>><?php echo $value->board_name; ?></option>
                                                                    <?php } ?>
                                                        </select>
                                                        <?php echo form_error('board_id'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input id="institution_name" type="text" name="institution_name" value="<?= isset($_POST['institution_name']) ? $_POST['institution_name'] : ''; ?>"
                                                               placeholder="Enter your institution name" autocomplete="off" required="">
                                                               <?php echo form_error('institution_name'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" id="affiliation_no" value="<?= isset($_POST['affiliation_no']) ? $_POST['affiliation_no'] : ''; ?>"
                                                               placeholder="Enter your affiliation number" name="affiliation_no" required="">
                                                               <?php echo form_error('affiliation_no'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input id="email" type="email" name="email" placeholder="Enter your email address" 
                                                               autocomplete="off" required="" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                                               <?php echo form_error('email'); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" id="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"
                                                               placeholder="Enter your mobile number" name="phone" required="">
                                                               <?php echo form_error('phone'); ?>
                                                    </div>
                                                </div>
                                                <div class="buttonWrapper">
                                                    <input name="formBack2" type="button" class="open2 prevbutton" value="Back" alt="Back" title="Back">
                                                    <input name="submit" type="submit" id="submit" value="Submit" class="submitbutton" alt="Submit" title="Submit">
                                                </div>
                                            </fieldset>
                                        </div>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
