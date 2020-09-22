<style>
    .form{max-width: 100%;margin: 0px;}
    /*.form-input div{padding: 10px;}*/
    .form-input div input{padding: 10px;}
    .features{padding: 50px}
    .join-text{padding: 0px;font-weight: normal;}
    .font-ctrl{font-weight: normal !important;color: #666666 !important;font-size: 14px !important;}
    .font-ctrl-div{float: left !important;padding-left: 20px;padding-top: 36px;}
    .font-siz{font-weight: normal !important;font-size: 24px !important;}
    .logo-set{width: 70%;padding-top: 60px;}
    .form-note{padding: 35px 10px;line-height: 15px;}
    #maindiv{padding-bottom: 150px;}

    /*form styles*/
    #msform {
        width: 400px;
        margin: 50px auto;
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
        width: 80%;
        margin: 0 10%;

        /*stacking fieldsets above each other*/
        position: relative;
    }
    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
        display: none;
    }
    /*inputs*/
    #msform input, #msform select {
        padding: 15px;
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
        color: black;
        text-transform: uppercase;
        font-size: 9px;
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
                                    <h3 class="fs-subtitle">This is step 1</h3>
                                    <div class="row form-input" id="div0">
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
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <h2 class="fs-title">Social Profiles</h2>
                                    <h3 class="fs-subtitle">Your presence on the social network</h3>
                                    <div class="row form-input" id="div1">
                                        <div class="col-md-6">
                                            <input id="total_students" type="text" name="total_students" value="<?= isset($_POST['total_students']) ? $_POST['total_students'] : ''; ?>"
                                                   placeholder="Enter total no of students" autocomplete="off" required="">
                                                   <?php echo form_error('total_students'); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="fee_type" class="form-control" id="fee_type">
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
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <h2 class="fs-title">Personal Details</h2>
                                    <h3 class="fs-subtitle">We will never sell it</h3>
                                    <div class="row form-input" id="div2">
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
                                            <input type="text" id="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"
                                                   placeholder="Enter your mobile number" name="phone" required="">
                                                   <?php echo form_error('phone'); ?>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <h2 class="fs-title">Personal Details</h2>
                                    <h3 class="fs-subtitle">We will never sell it</h3>
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
                                    <input type="submit" name="submit" class="submit action-button" value="Submit" />
                                </fieldset>

                            </form>
                            <?php /*
                              <form id="frmsignupstep" action="<?= base_url('signup/add'); ?>" method="post" autocomplete="off">
                              <div class="cta-content">
                              <h1 class="font-siz">Open your account now</h1>
                              <div class="form wow fadeIn signup-ctrl" data-wow-delay="0.2s">
                              <div class="row form-input" id="div0">
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
                              <div class="row form-input" id="div1">
                              <div class="col-md-6">
                              <input id="total_students" type="text" name="total_students" value="<?= isset($_POST['total_students']) ? $_POST['total_students'] : ''; ?>"
                              placeholder="Enter total no of students" autocomplete="off" required="">
                              <?php echo form_error('total_students'); ?>
                              </div>
                              <div class="col-md-6">
                              <select name="fee_type" class="form-control" id="fee_type">
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
                              <div class="row form-input" id="div2">
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
                              <input type="text" id="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"
                              placeholder="Enter your mobile number" name="phone" required="">
                              <?php echo form_error('phone'); ?>
                              </div>
                              </div>
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
                              <!--<input class="submit-button" type="submit" value="Sign up now">-->
                              <div id="response"></div>
                              </div>
                              <!--<div class="form-note">
                              <p><a href="">Already started your application? Login here</a></p>
                              </div>-->
                              <div class="row">
                              <div class="col-md-5 form-note">
                              <p><a href="<?= base_url('login'); ?>">Already started your application? Login here</a></p>
                              </div>
                              <div class="col-md-7 text-right">
                              <button class="btn-action" type="button" name="prev0" id="prev0">Previous</button>
                              <button class="btn-action" type="button" name="next0" id="next0">Next</button>
                              </div>
                              </div>
                              </div>
                              </form>
                             */ ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-5">
                    <div class="cta-sm container-m text-left join-text">
                        <div class="cta-content">
                            <h1 class="text-left font-siz">Join our growing community of 1+ million traders!</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
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
        </div>
    </div>

</div>
<script>

//jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function () {
        if (animating)
            return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

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
    })

    /*
     $(document).ready(function () {
     $('.navbar').addClass('effect-main past-main');
     var divs = $('.signup-ctrl>.form-input');
     var now = 0; // currently shown div
     divs.hide().first().show();
     $("#prev" + now).hide();
     $("#next" + now).click(function (e) {
     $("#prev" + now).show();
     divs.eq(now).hide();
     now = (now + 1 < divs.length) ? now + 1 : 0;
     divs.eq(now).show(); // show next
     if (now == 3) {
     $("#next0").html('Finish');
     }
     if (now == 0) {
     $("#next0").remove();
     $("#prev0").remove();
     }
     });
     $("#prev" + now).click(function (e) {
     if (now == 1)
     $("#prev0").hide();
     else
     $("#prev" + now).show();
     divs.eq(now).hide();
     now = (now > 0) ? now - 1 : divs.length - 1;
     divs.eq(now).show(); // or .css('display','block');
     if (now == 3) {
     $("#next0").html('Finish');
     }else{
     $("#next0").html('Next');
     }
     });
     });*/
</script>