

<div class="spacer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
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
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(count($reviews) > 0)
                                {
                                    foreach ($reviews as $row){ ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['firstname'] ?></td>
                                    <td>
                                        <a href="<?php echo base_url() ?>hospitals/<?php echo $row['structure_id'] ?>?exam_id=<?php echo $row['exam_id']; ?>"><div><?php echo $row['hospital'] ?></div>
                                        <div style="font-size: smaller"><i><?php echo $row['exam_type']; ?></i></div></a>
                                    </td>
                                    <td><?php echo $row['comment']; ?></td>
                                    <td><?php echo date('Y-m-d',($row['date_submited'])); ?></td>
                                    <td><?php echo $row['actual_time'] ?></td>
                                    <td><?php echo $row['rating']; ?></td>


                                    <td><?php echo ($row['status']==0) ? 'Pending':'Approved' ?></td>
                                </tr>

                            <?php  } 
                                } else { ?>
                                <tr><td>No Reviews For your Exams.</td></tr>
                                <?php }?>
                            </tbody>
                        </table>
                         <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>exam'">Back</button>
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
