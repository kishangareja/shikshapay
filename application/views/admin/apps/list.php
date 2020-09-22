<style type="text/css" media="screen">
    /*.container {width: 1106px; }*/
    .col-sm-3 {padding: 0; }
    .card, .card.soft-card {background: #fff; color: #444463; margin-left: 0; margin-right: 0; width: 100%; box-shadow: 0 1px 10px 0 #d1dbeb; border: 1px solid transparent; margin-bottom: 16px; border-radius: 3px; }
    .soft-one-half--sides {padding-right: 24px!important; padding-left: 24px!important; }
    .soft--ends {padding-top: 16px!important; padding-bottom: 16px!important; }
    .text-ellipsis {white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .font-16 {font-size: 16px; }
    .soft-half--bottom {padding-bottom: 8px!important; }
    .strong {font-weight: 700; }
    .app-detail .card__banner, .app-summary .card__banner {max-width: 100%; max-height: 10rem; height: auto; width: auto; padding: 0; margin-left: auto; margin-right: auto; display: block; }
    a img {border: none; }
    .app-summary.card .card__description {min-height: 3rem; }
    .push--ends {margin-top: 16px!important; margin-bottom: 16px!important; }
    .push--top {margin-top: 16px!important; }
    .soft-half--right {padding-right: 8px!important; }
    .column, .columns {position: relative; padding-left: 1.0714285714rem; padding-right: 1.0714285714rem; float: left; }
    .small-7 {width: 58.3333333333%; }
    .list-rounded {border-radius: 4px; }
    .text-center {text-align: center!important; }
    .text-green {color: #3ac379; }
    .font-16 {font-size: 16px; }
    .soft-quarter--left {padding-left: 4px!important; }
    [class*=column]+[class*=column].end, [class*=column]+[class*=column]:last-child {float: left; }
    .soft-half--left {padding-left: 8px!important; }
    .small-5 {width: 41.6666666667%; }
    .float--right {float: right!important; }
    .nc-icon-outline.sm {font-size: .75em; vertical-align: 10%; }
    .nc-icon-outline {display: inline-block; font: normal normal normal 14px/1 Nucleo Outline; font-size: inherit; speak: none; text-transform: none; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
    .text-blue {color: #2277bc; } .flush--right {margin-right: 0!important; }
    .nc-icon-outline.arrows-1_minimal-down:before, .nc-icon-outline.arrows-1_minimal-right:before {font-weight: bolder; }
    .nc-icon-outline.arrows-1_minimal-right:before {content: "\ea6c"; }
</style>
<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
        <div class="hbox hbox-auto-xs hbox-auto-sm">
            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3"><?= $page; ?></h1>
            </div>
            <div class="wrapper-md">
                <?php $this->load->view('_partials/messages'); ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= $page; ?>
                    </div>
                    <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                <?php foreach ($apps_data as $value) { ?>
                                    <div class="col-sm-3">
                                        <div class="apps-container columns small-12 medium-4" style="padding: 0px 12px 8px;">
                                            <a href="<?= base_url('admin/apps/detail/' . $value->id); ?>">
                                                <div class="card app-summary soft--ends soft-one-half--sides">
                                                    <div class="strong soft-half--bottom font-16 text-ellipsis" title="Pro Analytics"><?php echo $value->title ?></div>
                                                    <img alt="" class="card__banner" src="<?php echo base_url() . APPSTORE . $value->image ?>" style="border-radius: 4px;">
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
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / right col -->
</div>
<!-- /content -->