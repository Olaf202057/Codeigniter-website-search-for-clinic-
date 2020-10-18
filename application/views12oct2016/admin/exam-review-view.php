<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">Administrator</div>
        </div>
    </div>
</div>

<div class="spacer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Nav tabs -->
                <?php $this->load->view('admin/include/admin-menu-view') ?>


                <!-- Tab panes -->
                <div class="tab-content">
                    <br />
                    <div role="tabpanel" class="tab-pane fade in active " id="review">
                        <table class="table table-striped" id="tbl-users">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Hospital & Exam</th>
                                <th>Comment</th>
                                <th>Date Submited</th>
                                <th>Actual Time</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th style="width: 200px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($reviews as $key => $row) : ?>
                                <tr>
                                    <td><?php echo $row->id ?></td>
                                    <td><?php echo $row->name ?></td>
                                    <td>
                                        <a href="<?php echo base_url() ?>hospitals/<?php echo $row->structure_id ?>?exam_id=<?php echo $row->exam_id ?>"><div><?php echo $row->hospital ?></div>
                                        <div style="font-size: smaller"><i><?php echo $row->exam_type ?></i></div></a>
                                    </td>
                                    <td><?php echo $row->comment ?></td>
                                    <td><?php echo $row->submited_date ?></td>
                                    <td><?php echo $row->actual_time ?></td>
                                    <td><?php echo $row->rating ?></td>


                                    <td><?php echo ($row->status==0) ? 'Pending':'Approved' ?></td>
                                    <td>
                                        <div class="btn-group">
                                        <button type="button" data-id="<?php echo $row->id ?>" class="btn <?php echo ($row->status==1) ? '':'btn-success btn-approve-review' ?>  btn-sm">Approved</button>
                                        <a href="#" data-id="<?php echo $row->id ?>" class="btn btn-primary btn-sm btn-edit-review">Edit</a>
                                        <button type="button" data-id="<?php echo $row->id ?>" class="btn btn-danger btn-remove-review btn-sm">Delete</button>
                                            </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-12" id="result-pagination">
                                <?php echo $pagination_links ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-review" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Review</h4>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row" >
                        <div class="col-md-6">
                            <div id="review-msg"></div>
                            <div class="">

                                <div class="row" id="post-review-box">
                                    <div class="col-md-12">
                                        <form id="frm-review" method="post">
                                            <div class="col-md-12">

                                                <input id="ratings-hidden" value=" " name="structure_id" type="hidden">
                                                <input id="ratings-hidden" value="" name="exam_id" type="hidden">
                                                <input id="ratings-hidden" value="" name="id" type="hidden">
                                                <label>Review</label>
                                                <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Actual spent time</label><input type="number" min="0" class="form-control" value="0" name="actual_time" />
                                            </div>
                                            <div class="col-md-6">
                                                <label>Rating</label><input type="number" min="0" max="5" class="form-control" value="0" name="rating" />
                                            </div>




                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn-update-review" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
