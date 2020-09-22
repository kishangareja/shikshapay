<div id="main" class="main">
    <link rel="stylesheet" href="<?= base_url('assets/libs/assets/font-awesome/css/font-awesome.min.css'); ?>" type="text/css" />
    <style>
        .small-12 {width: 25%;font-family: Noto Sans,Tahoma,"sans-serif"}
        .column, .columns {position: relative;padding-left: 1.0714285714rem;padding-right: 1.0714285714rem;float: left;}
        .column, .columns {padding-left: 1.0714285714rem;padding-right: 1.0714285714rem;float: left;}
        .card, .card.soft-card {background: #fff;color: #444463;margin-left: 0;margin-right: 0;
                                width: 100%;box-shadow: 0 1px 10px 0 #d1dbeb;border: 1px solid transparent;margin-bottom: 16px;border-radius: 3px;}
        .card {padding: 1rem 1rem 0;}
        .soft-one-half--sides {padding-right: 24px!important;padding-left: 24px!important;}
        .soft--ends {padding-top: 16px!important;padding-bottom: 16px!important;}
        .text-ellipsis {white-space: nowrap;overflow: hidden;text-overflow: ellipsis;}
        .font-16 {font-size: 16px;}
        .soft-half--bottom {padding-bottom: 8px!important;text-align: left;}
        .strong {font-weight: 700;}
        .app-detail .card__banner, .app-summary .card__banner {max-width: 100%;max-height: 10rem;height: auto;width: auto;
                                                               padding: 0;margin-left: auto;margin-right: auto;display: block;}
        a img {border: none;}
        img {display: inline-block;vertical-align: middle;}
        .app-summary.card .card__description {min-height: 3rem;line-height: 18px;font-size: 15px;}
        .push--ends {margin-top: 16px!important;margin-bottom: 16px!important;}
        .soft-half--right {padding-right: 8px!important;}
        .soft-half--left {padding-left: 8px!important;}
        a, a:hover {text-decoration: none;line-height: inherit;}
        .list-rounded{color: #3ac379;padding: 12px;background-color: rgb(243, 245, 248);border-radius: 4px;width: 130px;}

    </style>
    <!-- Array Pricing Section -->
    <div id="pricing" class="pricing-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="pricing-intro wow fadeInDown">
                        <h1>App Store</h1>
                        <p>
                            Our plans are designed to meet the requirements of both beginners <br class="hidden-xs"> and players.
                            Get the right plan that suits you.
                        </p>
                    </div>

                    <div class="row">
                        <?php foreach ($apps_data as $value) { ?>
                            <div class="apps-container columns small-12 medium-4" style="padding: 0px 12px 8px;">
                                <a href="<?= base_url('home/app_detail/' . $value->id); ?>">
                                    <div class="card app-summary soft--ends soft-one-half--sides">
                                        <div class="strong soft-half--bottom font-16 text-ellipsis" title="Pro Analytics"><?php echo $value->title ?></div>
                                        <img alt="" class="card__banner" src="<?php echo base_url() . APPSTORE . $value->image ?>"  style="max-height: 109px; height: 109px; border-radius: 4px;">
                                        <div class="card__description push--ends" style="height: 66px; max-height: 66px; overflow: hidden; color: rgb(110, 110, 133);"><?php echo $value->short_desc ?></div>
                                        <div class="row push--top">
                                            <div class="columns small-7 soft-half--right">
                                                <div class="text-center list-rounded" style="background-color: rgb(243, 245, 248); padding: 9.5px 8px;">
                                                    <div><span class="text-green font-16"><?php echo $value->amount ?></span><span class="soft-quarter--left"></span></div>
                                                </div>
                                            </div>
                                            <div class="columns small-5 soft-half--left">
                                                <div class="float--right" style="border: 1px solid rgb(204, 209, 217); padding: 9px 15px; border-radius: 4px; display: inline-block;"><i class="fa fa-arrow-right"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- Array Pricing Ends -->