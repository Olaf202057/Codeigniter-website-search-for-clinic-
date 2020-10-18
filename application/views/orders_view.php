
<div class="spacer">
    <div class="container">
        <div class="row">

     <?php if($this->session->flashdata('success')!='') {?>
          <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
          <?php } else if($this->session->flashdata('error')!=''){?>
          <div class="alert alert-danger text-center"><?php echo $this->session->flashdata('error');?></div>
          <?php } ?>

            <div class="col-sm-12">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active " id="myorder">
                      <div class="row"  style="margin-top:5px;" >
                          <div class="col-sm-6">
                             <div class="input-group" style="height:40px;">
                              <!-- <input type="text" class="form-control" id="txt-search" value="<?php echo $this->input->get("q") ?>" placeholder="Search for...">
                              <span class="input-group-btn">
                                <button class="btn btn-default" id="btn-search1" type="button">Go!</button> -->
                              </span>
                            </div>  
                          </div><!-- /.col-lg-6 -->
                      
                        </div>
                        <table class="table table-striped" id="tbl-order">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all_exam" value=""></th>
                                <th>Payment type</th>
                                <th>Amount</th> 
                                 <th>Payment Date</th> 
                               
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(count($order) > 0){
                            foreach ($order as $trans) : ?>
                                <ttr>
                                    <td><input type="checkbox" name="trans[]" value="<?php echo $trans['id']; ?>"></td>
                                    <td>
                                       <div><?php echo ucfirst($trans['type']); ?></div>
                                    </td>
                                    <td><?php echo $trans['amount']; ?></td>
                                    <td><?php echo date('Y-m-d',strtotime($trans['amount'])); ?></td>
                                    
                                </tr>

                            <?php endforeach; } else { ?>
                            <tr><td>No Orders.</td></tr>
                            <?php } ?>


                            </tbody>
                        </table>
                        
                        <div class="row">
                            <div class="col-sm-12" id="result-pagination">
                              <a class="btn btn-primary btn-sm pull-right" id="btn-do-addExam" href="<?php echo base_url();?>ads/myorders"  >Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


