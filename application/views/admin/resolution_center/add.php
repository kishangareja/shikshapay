<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md">
            <h1 class="m-n font-thin h3"><?= $page; ?></h1>
        </div>
        <div class="wrapper-md">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    <?php echo $page; ?>
                </div>
                <div class="panel-body">
                    <form method="post" action="" id="frmresolution_request">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-bold">Payment Amount: </label>
                                                <span>22</span>
                                                <input type="hidden" name="amount" value="22">
                                            </div>
                                            <div class="form-group">
                                                <label class="font-bold">Shikshapay Order Id: </label>
                                                <span>MOJO8c23D05D94491503</span>
                                                <input type="hidden" name="txn_orderid" value="MOJO8c23D05D94491503">
                                            </div>
                                            <div class="form-group">
                                                <label>Choose reason</label>
                                                <select name="reason" id="reason" class="form-control">
                                                    <option value="Amount Mismatch between IPG & ShikshaPay">Amount Mismatch between IPG & ShikshaPay</option>
                                                    <option value="Late Fee discrepancy">Late Fee discrepancy</option>
                                                    <option value="Transaction Status Mismatch between IPG &  ShikshaPay">Transaction Status Mismatch between IPG &  ShikshaPay</option>
                                                    <option value="Put these first and then we'll send the rest upon discussion">Put these first and then we'll send the rest upon discussion</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Explain the Problem in detail</label>
                                                <textarea rows="5" name="problem_detail" id="problem_detail" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            <input class="btn btn-primary" type="submit" name="submit" value="Create Case">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content -->