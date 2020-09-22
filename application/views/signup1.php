<style>
    .form-input div input{padding: 10px;}
    .features{padding: 50px}
    .join-text{padding-top: 20px;padding-bottom: 0px;font-weight: normal;}
    .font-ctrl{font-weight: normal !important;color: #666666 !important;font-size: 14px !important;}
    .font-ctrl-div{float: left !important;padding-top: 30px;width: 100% !important;}
    .font-siz{font-weight: normal !important;font-size: 24px !important;}
    .logo-set{width: 75%;padding-top: 60px;}
    .form-note{padding: 35px 10px;line-height: 15px;}
    .help-inline p {text-align: left;padding-bottom: 10px;line-height: 18px;font-size: 12px;}

    /*form styles*/
    #msform {
        text-align: center;
        position: relative;
    }
    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 20px 30px;
        box-sizing: border-box;
        width: 100%;
        position: relative;
    }
    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
        display: none;
    }
    /*inputs*/
    #msform input, #msform select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-bottom: 10px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        font-size: 13px;
    }
    /*buttons*/
    #msform .action-button {
        width: 100px;
        background: #27AE60;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 1px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }
    #msform .action-button:hover, #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
    }
    /*headings*/
    .fs-title {
        font-size: 15px;
        text-transform: uppercase;
        color: #2C3E50;
        margin-bottom: 10px;
    }
    .fs-subtitle {
        font-weight: normal;
        font-size: 13px;
        color: #666;
        margin-bottom: 20px;
    }
    /*progressbar*/
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        /*CSS counters to number the steps*/
        counter-reset: step;
    }
    #progressbar li {
        list-style-type: none;
        color: #666666;
        font-size: 14px;
        width: 25%;
        float: left;
        position: relative;
    }
    #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 20px;
        line-height: 20px;
        display: block;
        font-size: 10px;
        color: #333;
        background: white;
        border-radius: 3px;
        margin: 0 auto 5px auto;
    }
    /*progressbar connectors*/
    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: white;
        position: absolute;
        left: -50%;
        top: 9px;
        z-index: -1; /*put it behind the numbers*/
    }
    #progressbar li:first-child:after {
        /*connector not needed before the first step*/
        content: none; 
    }
    /*marking active/completed steps green*/
    /*The number of the step and the connector before it = green*/
    #progressbar li.active:before,  #progressbar li.active:after{
        background: #27AE60;
        color: white;
    }
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
                            <form id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active">Account Setup</li>
                                    <li>Institution Setup</li>
                                    <li>Module Setup</li>
                                    <li>Complete</li>
                                </ul>
                                <!-- fieldsets -->
                                <fieldset>
                                    <h2 class="fs-title">Create your account</h2>
                                    <h3 class="fs-subtitle">Institution account information</h3>
                                    <div class="row form-input" id="div0">
                                        <div class="col-md-6">
                                            <select name="institution_type" id="institution_type">
                                                <option value="school" <?= (isset($_POST['institution_type']) && $_POST['institution_type'] == 'school') ? 'selected="selected"' : ''; ?>>School</option>
                                                <option value="college" <?= (isset($_POST['institution_type']) && $_POST['institution_type'] == 'college') ? 'selected="selected"' : ''; ?>>College</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="board_id" id="board_id">
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
                                    <input type="button" name="next" class="next action-button" value="Next" ref="0"/>
                                </fieldset>
                                <fieldset>
                                    <h2 class="fs-title">Institution Setup</h2>
                                    <h3 class="fs-subtitle">How many student you have</h3>
                                    <div class="row form-input" id="div1">
                                        <div class="col-md-6">
                                            <input id="total_students" type="text" name="total_students" value="<?= isset($_POST['total_students']) ? $_POST['total_students'] : ''; ?>"
                                                   placeholder="Enter total no of students" autocomplete="off" required="">
                                                   <?php echo form_error('total_students'); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="fee_type" id="fee_type">
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
                                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                                    <input type="button" name="next" class="next action-button" value="Next" ref="1"/>
                                </fieldset>
                                <fieldset>
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
                                            <select name="board_id" id="board_id">
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
                                                   placeholder="Enter your mobile number" name="phone" required="">
                                                   <?php echo form_error('phone'); ?>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                                    <input type="button" name="next" class="next action-button" value="Next" ref="2"/>
                                </fieldset>
                                <fieldset>
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
                                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                                    <input type="submit" name="submit" class="submit action-button" value="Submit"/>
                                </fieldset>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>

//jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function () {

        var id = $(this).attr('ref');
        if (animating)
            return false;
        animating = true;

        console.log(check_error(id));

        /*var current_fs1 = $(this).parent();
        var next_fs1 = $(this).parent().next();
        var arr = {};
        if (id == 0) {
            arr = {
                step: id,
                board_id: $('#board_id').val(),
                institution_type: $('#institution_type').val(),
                institution_name: $('#institution_name').val(),
                affiliation_no: $('#affiliation_no').val(),
                email: $('#email').val(),
                phone: $('#phone').val()
            };
        } else if (id == 1) {
            arr = {
                step: id,
                total_students: $('#total_students').val(),
                fee_type: $('#fee_type').val(),
                pincode: $('#pincode').val()
            };
        } else if (id == 2) {
            /*var arr = {
             step: id,
             board_id: $('#board_id').val(),
             institution_type: $('#institution_type').val(),
             institution_name: $('#institution_name').val(),
             affiliation_no: $('#affiliation_no').val(),
             email: $('#email').val(),
             phone: $('#phone').val(),
             };*
        }*/
var arr ={};
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('signup/step'); ?>",
            data: arr,
            dataType: "json",
            success: function (result) {
                if (result.success == 1) {

                    current_fs = current_fs1;
                    next_fs = next_fs1;

                    //activate next step on progressbar using the index of next_fs
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                    //show the next fieldset
                    next_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function (now, mx) {
                            //as the opacity of current_fs reduces to 0 - stored in "now"
                            //1. scale current_fs down to 80%
                            scale = 1 - (1 - now) * 0.2;
                            //2. bring next_fs from the right(50%)
                            left = (now * 50) + "%";
                            //3. increase opacity of next_fs to 1 as it moves in
                            opacity = 1 - now;
                            current_fs.css({
                                'transform': 'scale(' + scale + ')',
                                'position': 'absolute'
                            });
                            next_fs.css({'left': left, 'opacity': opacity});
                        },
                        duration: 800,
                        complete: function () {
                            current_fs.hide();
                            animating = false;
                        },
                        //this comes from the custom easing plugin
                        easing: 'easeInOutBack'
                    });
                } else {
                    $.each(result.error, function (k, v) {
                        $('#' + k + '_err').html(v);
                    });
                }
            }
        });
    });

    $(".previous").click(function () {
        if (animating)
            return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".submit").click(function () {
        return false;
    });

    function check_error(id) {
        var err = 1;
        if (id == 0) {
            err = err ? check_post_val($('#board_id').val()) : 1;
            err = err ? check_post_val($('#institution_type').val()) : 1;
            err = err ? check_post_val($('#institution_name').val()) : 1;
            err = err ? check_post_val($('#affiliation_no').val()) : 1;
            err = err ? check_post_val($('#email').val()) : 1;
            err = err ? check_post_val($('#phone').val()) : 1;
        } else if (id == 1) {
            arr = {
                step: id,
                total_students: $('#total_students').val(),
                fee_type: $('#fee_type').val(),
                pincode: $('#pincode').val()
            };
        } else if (id == 2) {
            /*var arr = {
             step: id,
             board_id: $('#board_id').val(),
             institution_type: $('#institution_type').val(),
             institution_name: $('#institution_name').val(),
             affiliation_no: $('#affiliation_no').val(),
             email: $('#email').val(),
             phone: $('#phone').val(),
             };*/
        }
        return err;
    }

    function check_post_val(val) {
        var error = 1;
        if (val == '') {
            error = 0;
        }
        return error;
    }
</script>