<!-- aside -->
<aside id="aside" class="app-aside hidden-xs bg-dark">
    <div class="aside-wrap">
        <div class="navi-wrap">

            <!-- nav -->
            <nav ui-nav class="navi clearfix">
                <ul class="nav">
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">

                    </li>
                    <li class="<?=($this->uri->segment('2') == 'home' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/home');?>">
                            <!--<b class="badge bg-info pull-right">9</b>-->
                            <i class="glyphicon glyphicon-stats icon text-info-lter"></i>
                            <span class="font-bold">Dashboard</span>
                        </a>
                    </li>
                    <!--<li class="line dk"></li>-->
                    <li class="<?=($this->uri->segment('2') == 'board' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/board');?>" >
                            <i class="fa fa-mortar-board"></i>
                            <span class="font-bold">Board</span>
                        </a>
                    </li>
                    <li class="<?=($this->uri->segment('2') == 'institution' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/institution');?>">
                            <i class="fa fa-institution"></i>
                            <span class="font-bold">Institution</span>
                        </a>
                    </li>

                    <li class="<?=($this->uri->segment('2') == 'student' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/student');?>">
                            <i class="fa fa-institution"></i>
                            <span class="font-bold">Student</span>
                        </a>
                    </li>

                    <li class="<?=($this->uri->segment('2') == 'student_type' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/student_type');?>">
                            <i class="fa fa-institution"></i>
                            <span class="font-bold">Student Type</span>
                        </a>
                    </li>

                    <li class="<?=(($this->uri->segment('2') == 'classes' || $this->uri->segment('2') == 'section') ? 'active' : '');?>">
                        <a href class="auto">
                            <span class="pull-right text-muted">
                                <i class="fa fa-fw fa-angle-right text"></i>
                                <i class="fa fa-fw fa-angle-down text-active"></i>
                            </span>
                            <i class="glyphicon glyphicon-th"></i>
                            <span class="font-bold">Class Setting</span>
                        </a>
                        <ul class="nav nav-sub dk">
                            <li class="<?=($this->uri->segment('2') == 'classes' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/classes');?>">
                                    <span>Class / Program</span>
                                </a>
                            </li>

                            <li class="<?=($this->uri->segment('2') == 'section' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/section');?>">
                                    <span>Section / Semester</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?=(($this->uri->segment('2') == 'feestructure' || $this->uri->segment('3') == 'fee_type') ? 'active' : '');?>">
                        <a href class="auto">
                            <span class="pull-right text-muted">
                                <i class="fa fa-fw fa-angle-right text"></i>
                                <i class="fa fa-fw fa-angle-down text-active"></i>
                            </span>
                            <i class="glyphicon glyphicon-th"></i>
                            <span class="font-bold">Fee Structure</span>
                        </a>
                        <ul class="nav nav-sub dk">
                            <li class="<?=($this->uri->segment('3') == 'fee_type' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/feestructure/fee_type');?>">
                                    <span>Fee Type</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'head_type' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/feestructure/head_type');?>">
                                    <span>Head Type</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'fee_installment' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/feestructure/fee_installment');?>">
                                    <span>Fee Installment</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'fee_structure' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/feestructure/fee_structure');?>">
                                    <span>Fee Structure</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'bulk_concession' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/feestructure/bulk_concession');?>">
                                    <span>Bulk Concession</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'single_concession' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/feestructure/single_concession');?>">
                                    <span>Single Concession</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'additional_fee' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/feestructure/additional_fee');?>">
                                    <span>Additional Fee</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?=(($this->uri->segment('2') == 'payfee' || $this->uri->segment('3') == 'pay') ? 'active' : '');?>">
                        <a href class="auto">
                            <span class="pull-right text-muted">
                                <i class="fa fa-fw fa-angle-right text"></i>
                                <i class="fa fa-fw fa-angle-down text-active"></i>
                            </span>
                            <i class="glyphicon glyphicon-th"></i>
                            <span class="font-bold">Pay fee</span>
                        </a>
                        <ul class="nav nav-sub dk">
                            <li class="<?=($this->uri->segment('3') == 'pay' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/payfee/pay');?>">
                                    <span>Pay Fee</span>
                                </a>
                            </li>
                            <?php /*
<li class="<?= ($this->uri->segment('2') == 'student_pay' ? 'active' : ''); ?>">
<a href="<?= base_url('admin/payfee/student_pay'); ?>">
<span>Student Pay</span>
</a>
</li>*/?>
                        </ul>
                    </li>

                    <li class="<?=($this->uri->segment('2') == 'mis' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/mis');?>">
                            <i class="fa fa-mortar-board"></i>
                            <span class="font-bold">MIS</span>
                        </a>
                    </li>

                    <li class="<?=(($this->uri->segment('2') == 'transaction' || $this->uri->segment('3') == 'query') ? 'active' : '');?>">
                        <a href class="auto">
                            <span class="pull-right text-muted">
                                <i class="fa fa-fw fa-angle-right text"></i>
                                <i class="fa fa-fw fa-angle-down text-active"></i>
                            </span>
                            <i class="glyphicon glyphicon-th"></i>
                            <span class="font-bold">Transaction</span>
                        </a>
                        <ul class="nav nav-sub dk">
                            <li class="<?=($this->uri->segment('3') == 'query' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/transaction/query');?>">
                                    <span>Transaction Query</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'history' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/transaction/history');?>">
                                    <span>Transaction History</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'success' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/transaction/success');?>">
                                    <span>Transaction Success</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="<?=($this->uri->segment('2') == 'invoice' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/invoice');?>">
                            <i class="fa fa-mortar-board"></i>
                            <span class="font-bold">GST Invoice</span>
                        </a>
                    </li>

                    <li class="<?=($this->uri->segment('2') == 'resolution_center' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/resolution_center');?>">
                            <i class="fa fa-mortar-board"></i>
                            <span class="font-bold">Resolution Center</span>
                        </a>
                    </li>

                    <li class="<?=($this->uri->segment('2') == 'terms_condition' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/home/terms_condition');?>">
                            <i class="fa fa-mortar-board"></i>
                            <span class="font-bold">Terms & Conditions</span>
                        </a>
                    </li>
                    <li class="<?=($this->uri->segment('2') == 'privacy_policy' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/home/privacy_policy');?>">
                            <i class="fa fa-mortar-board"></i>
                            <span class="font-bold">Privacy Policy</span>
                        </a>
                    </li>
                    <li class="<?=(($this->uri->segment('2') == 'gateway') ? 'active' : '');?>">
                        <a href class="auto">
                            <span class="pull-right text-muted">
                                <i class="fa fa-fw fa-angle-right text"></i>
                                <i class="fa fa-fw fa-angle-down text-active"></i>
                            </span>
                            <i class="glyphicon glyphicon-th"></i>
                            <span class="font-bold">Gateway</span>
                        </a>
                        <ul class="nav nav-sub dk">
                            <li class="<?=($this->uri->segment('3') == 'all_gateway' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/gateway/all_gateway');?>">
                                    <span>Gateway Listing</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'payment' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/gateway/payment');?>">
                                    <span>Payment Gateway</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'textmsg' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/gateway/textmsg');?>">
                                    <span>Text Msg Gateway</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'emailmsg' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/gateway/emailmsg');?>">
                                    <span>Email Gateway</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?=(($this->uri->segment('2') == 'message') ? 'active' : '');?>">
                        <a href class="auto">
                            <span class="pull-right text-muted">
                                <i class="fa fa-fw fa-angle-right text"></i>
                                <i class="fa fa-fw fa-angle-down text-active"></i>
                            </span>
                            <i class="glyphicon glyphicon-th"></i>
                            <span class="font-bold">Message</span>
                        </a>
                        <ul class="nav nav-sub dk">
                            <li class="<?=($this->uri->segment('3') == 'textmsg' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/message/textmsg');?>">
                                    <span>Text Message</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'emailmsg' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/message/emailmsg');?>">
                                    <span>Email Message</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?=(($this->uri->segment('2') == 'notice') ? 'active' : '');?>">
                        <a href class="auto">
                            <span class="pull-right text-muted">
                                <i class="fa fa-fw fa-angle-right text"></i>
                                <i class="fa fa-fw fa-angle-down text-active"></i>
                            </span>
                            <i class="glyphicon glyphicon-th"></i>
                            <span class="font-bold">Notice</span>
                        </a>
                        <ul class="nav nav-sub dk">
                            <li class="<?=($this->uri->segment('3') == 'textmsg' ? 'active' : '');?>">
                                <a href="<?=base_url('admin/notice');?>">
                                    <span>Notice</span>
                                </a>
                            </li>
                            <li class="<?=($this->uri->segment('3') == 'event' ? 'active' : '');?>">
                               <a href="<?=base_url('admin/notice/event');?>">
                                   <span>Event</span>
                               </a>
                           </li>
                        </ul>
                    </li>
                    <li class="<?=($this->uri->segment('2') == 'rolemodel' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/rolemodel');?>">
                            <i class="icon-diamond"></i>
                            <span class="font-bold">Role & Permission</span>
                        </a>
                    </li>
                    <li class="<?=($this->uri->segment('2') == 'app_store' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/app_store');?>">
                            <i class="icon-diamond"></i>
                            <span class="font-bold">App Store Setting</span>
                        </a>
                    </li>
                    <li class="<?=($this->uri->segment('2') == 'apps' ? 'active' : '');?>">
                        <a href="<?=base_url('admin/apps');?>">
                            <i class="icon-diamond"></i>
                            <span class="font-bold">Apps</span>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- nav -->
        </div>
    </div>
</aside>
<!-- / aside -->
