<!-- right col -->
<div class="col w-md bg-white-only b-l bg-auto no-border-xs">
    <div class="nav-tabs-alt" >
        <ul class="nav nav-tabs" role="tablist">
            <li class="active" style="width: 25%;">
                <a data-target="#tab-1" role="tab" data-toggle="tab">
                    <i class="glyphicon glyphicon-user text-md text-muted wrapper-sm"></i>
                </a>
            </li>
            <li style="width: 25%;">
                <a data-target="#tab-2" role="tab" data-toggle="tab">
                    <i class="glyphicon glyphicon-bell text-md text-muted wrapper-sm"></i>
                </a>
            </li>
            <li style="width: 25%;">
                <a data-target="#tab-3" role="tab" data-toggle="tab">
                    <i class="glyphicon glyphicon-alert text-md text-muted wrapper-sm"></i>
                </a>
            </li>
            <li style="width: 25%;">
                <a data-target="#tab-4" role="tab" data-toggle="tab">
                    <i class="glyphicon glyphicon-transfer text-md text-muted wrapper-sm"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab-1">
            <div class="wrapper-md">
                <div class="m-b-sm text-md">Privacy</div>
                <ul class="list-group list-group-sm list-group-sp list-group-alt auto m-t">
                    <?php
                    if ($privacy_notifications) {
                        foreach ($privacy_notifications as $privacy) {
                            ?>
                            <li class="list-group-item">
                                <span class="text-muted"><?= $privacy->title; ?> at <?= date('d-m-Y H:i g', strtotime($privacy->creation_datetime)); ?></span>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane tab-2" id="tab-2">
            <div class="wrapper-md">
                <div class="m-b-sm text-md">Event</div>
                <ul class="list-group list-group-sm list-group-sp list-group-alt auto m-t">
                    <?php
                    if ($event_notifications) {
                        foreach ($event_notifications as $event) {
                            ?>
                            <li class="list-group-item">
                                <span class="text-muted"><?= $event->title; ?> at <?= date('d-m-Y H:i a', strtotime($event->creation_datetime)); ?></span>
                                <span class="block text-md text-primary"><?= isset($event->message) && $event->message ? $event->message : '' ?></span>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane tab-3" id="tab-3">
            <div class="wrapper-md">
                <div class="m-b-sm text-md">Notice</div>
                <ul class="list-group list-group-sm list-group-sp list-group-alt auto m-t">
                    <?php
                    if ($notice_notifications) {
                        foreach ($notice_notifications as $notice) {
                            ?>
                            <li class="list-group-item">
                                <span class="text-muted"><?= $notice->title; ?> at <?= date('d-m-Y H:i a', strtotime($notice->creation_datetime)); ?></span>
                                <span class="block text-md text-primary"><?= isset($notice->message) && $notice->message ? $notice->message : '' ?></span>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane tab-4" id="tab-4">
            <div class="wrapper-md">
                <div class="m-b-sm text-md">Transaction</div>
                <ul class="list-group list-group-sm list-group-sp list-group-alt auto m-t">
                    <?php
                    if ($transaction_notifications) {
                        foreach ($transaction_notifications as $transaction) {
                            ?>
                            <li class="list-group-item">
                                <span class="text-muted"><?= $transaction->title; ?> at <?= date('d-m-Y H:i a', strtotime($transaction->creation_datetime)); ?></span>
                                <!--<span class="block text-md text-primary">B 23,000.00</span>-->
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- / right col -->