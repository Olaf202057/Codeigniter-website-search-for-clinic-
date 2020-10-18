
<div class="spacer min-height">
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
                        <div class="table-responsive">
                        <table class="table table-striped" id="tbl-balance">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all_exam" value=""></th>
                                <th>Metodo di pagamento</th>
                                <th>Modalità di pagamento</th> 
                                <th>Payment Date</th>
                                <th>Profile ID</th>
                                <th>Transaction ID</th>
                                <th>Amount</th> 
                                <th>Balance</th> 
                                <th style="width: 300px">Azione</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(count($pay_acc) > 0){
                            foreach ($pay_acc as $trans) : ?>
                                <tr>
                                    <td><input type="checkbox" name="trans[]" value="<?php echo $trans['id']; ?>"></td>
                                    <td>
                                       <div><?php echo ucfirst($trans['type']); ?></div>
                                    </td>
                                    <?php if($trans['payment_method'] == "recurring")
                                            $str = "Auto";
                                            else
                                              $str =  "Manual"; ?>
                                    <td><?php echo $str; ?></td>
                                    <td><?php echo date('Y-m-d',strtotime($trans['transaction_date'])); ?></td>
                                    <td><?php echo $trans['profile_id'] ; ?></td>
                                     <td><?php echo $trans['transaction_id']; ?></td>
                                    <td> <i class="fa fa-eur" aria-hidden="true"></i> <?php echo $trans['amount'] ; ?></td>
                                    <td> <i class="fa fa-eur" aria-hidden="true"></i> <?php echo $trans['balance_amt'] ; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo base_url();?>ads/order_view/<?php echo $trans['id'];?>"  class="btn btn-primary btn-sm" >View</a>
                                              <?php if($trans['payment_method']=="recurring" && $trans['status']!=""){ ?>
                                              <a  href="javascript:void(0);"  class="btn btn-success btn-sm"><?php echo ucfirst($trans['status']); ?></a>
                                              <?php } ?>
                                               <?php if($trans['payment_method']=="recurring" && $trans['status'] == 'active'){ ?>
                                              <a  href="<?php echo base_url();?>ads/cancel_order/<?php echo $trans['id'];?>"  class="btn btn-danger btn-sm">Cancel Payment</a>
                                              <?php } ?>

                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; } else { ?>
                            <tr><td>No orders.</td></tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


