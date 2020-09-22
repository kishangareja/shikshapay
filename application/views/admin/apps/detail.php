<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
        <div class="hbox hbox-auto-xs hbox-auto-sm">
            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3"><?= $page; ?></h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= $page; ?>
                    </div>
                    <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                <?= $apps_data ? $apps_data->description : ''; ?>
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