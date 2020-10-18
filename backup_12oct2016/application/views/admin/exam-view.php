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

                    <div role="tabpanel" class="tab-pane fade in active " id="exam">
                      <div class="row"  style="margin-top:5px;" >
                          <div class="col-sm-6">
                            <div class="input-group">
                              <input type="text" class="form-control" id="txt-search" value="<?php echo $this->input->get("q") ?>" placeholder="Search for...">
                              <span class="input-group-btn">
                                <button class="btn btn-default" id="btn-search" type="button">Go!</button>
                              </span>
                            </div><!-- /input-group -->
                          </div><!-- /.col-lg-6 -->
                        <div class="col-sm-6">
                            <button class="btn btn-primary btn-sm pull-right" id="btn-do-assign"  >Assign Common</button>
                        </div>
                        </div>
                        <table class="table table-striped" id="tbl-exams">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all_exam" value=""></th>
                                <th>Exam</th>
                                <th>Common Name</th>
                                <th>Official Waiting Days</th>
                                <th>Reported Waiting Days</th>
                                <th>Price</th>
                                <th style="width: 115px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($exams as $key =>$exam) : ?>
                                <tr>
                                    <td><input type="checkbox" name="exam_id[]" value="<?php echo $exam->id ?>"></td>
                                    <td>
                                        <div><?php echo $exam->exam_type ?></div>
                                        <i><?php echo $exam->hospital ?></i>
                                    </td>
                                    <td><?php echo $exam->common_name ?></td>
                                    
                                    <td><?php echo empty($exam->official_waiting_days) ? 'N/A' : $exam->official_waiting_days ?></td>
                                      <td><?php echo empty($exam->reported_waiting_days) ? 0 : $exam->reported_waiting_days ?></td>
                                    <td><?php echo empty($exam->price) ? 0 : $exam->price ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/edit_exam/'.$exam->id ?>" type="button" data-id="<?php echo $exam->id ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <button type="button" data-id="<?php echo $exam->id ?>"  class="btn btn-remove-exam btn-danger btn-sm">Delete</button>
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

<!-- Modal -->
<div class="modal fade" id="modal-assign-common" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
               Assign Common Label
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr">New Common Name:</label>
                    <input type="text" class="form-control" id="common_name">
                </div>
                <div> - O -</div>
                <ul class="list-group">
                    <?php foreach($common_names as $row) : ?>
                    <li class="list-group-item"><label><input type="radio" name="r_common_name" value="<?php echo $row->common_name ?>" /> <?php echo $row->common_name ?></label></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary pull-right" id="btn-assign-common" >Assign</button>

            </div>
        </div>
    </div>
</div>