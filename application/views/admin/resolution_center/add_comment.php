<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Resolution Center</h3>
        </div>
        <div class="modal-body">
            <form method="post" action="" id="frmresolutioncenter">
                <div class="row" style="padding: 10px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-bold">Case Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="1" <?= isset($resolution_center) && $resolution_center->status == 1 ? 'selected="selected"' : ''; ?>>Success</option>
                                <option value="0" <?= isset($resolution_center) && $resolution_center->status == 0 ? 'selected="selected"' : ''; ?>>Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-bold">Shikshapay Order Id</label>
                            <div class="form-control"><?= $resolution_center->txn_orderid; ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-bold">Created By</label>
                            <div><?= $resolution_center->created_by; ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-bold">Amount</label>
                            <div><?= $resolution_center->amount; ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-bold">Created On</label>
                            <div><?= date('d/m/y', strtotime($resolution_center->creation_datetime)); ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-bold">Disputed Amount</label>
                            <div><?= $resolution_center->amount; ?></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-bold">Reason: </label>
                            <span><?= $resolution_center->reason; ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-bold">Problem in detail: </label>
                            <span><?= $resolution_center->problem_detail; ?></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea rows="5" name="comment" id="comment" class="form-control"><?= $resolution_center->comment; ?></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="request_id" id="request_id" value="<?= isset($resolution_center->id) ? $resolution_center->id : 0; ?>" />
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" onclick="add_comment()" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </div>
                </div>   
            </form>
        </div>
    </div>
</div>