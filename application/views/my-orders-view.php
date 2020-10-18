
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
                                <th>Metodo di pagamento</th>
                                <th>Modalità di pagamento</th> 
                                <th>Data di pagamento</th>
                                <th>Rinnovi</th>
                                <th>Prossimo rinnovo</th>
                                <th>Totale</th> 
                                <th style="width: 300px">Azione</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(count($transaction) > 0){
                            foreach ($transaction as $trans) : ?>
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
                                      <td><?php echo $trans['no_of_cycle'] ; ?></td>
                                      <?php if($trans['next_pay_date'] == '0000-00-00' || $trans['next_pay_date']==null){?>
                                     <td>-</td>
                                     <?php } else{ ?>
                                       <td><?php echo date('Y-m-d',strtotime($trans['next_pay_date'])); ?></td>
                                     <?php } ?>
                                    <td> <i class="fa fa-eur" aria-hidden="true"></i> <?php echo $trans['amount'] ; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if($trans['payment_method'] == "recurring"){?>
                                              <a href="<?php echo base_url();?>ads/order_view/<?php echo $trans['id'];?>"  class="btn btn-primary btn-sm" >Vedi</a> 
                                              <?php } ?>
                                              <?php if($trans['payment_method']=="recurring" && $trans['status']!=""){ 
                                                if($trans['status']=='active')
                                                  $status1 = "Attivo";
                                                else if($trans['status'] == 'cancelled')
                                                    $status1 = "Cancellato";
                                                 else 
                                                  $status1 = ucfirst($trans['status']);
                                                ?>
                                              <a  href="javascript:void(0);"  class="btn btn-success btn-sm"><?php echo $status1; ?></a>
                                              <?php } ?>
                                               <?php if($trans['payment_method']=="recurring" && $trans['status'] == 'active'){ ?>
                                              <a  href="<?php echo base_url();?>ads/cancel_order/<?php echo $trans['id'];?>"  class="btn btn-danger btn-sm">Cancella</a>
                                              <?php } ?>

                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; } else { ?>
                            <tr><td>No orders.</td></tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        
                        <div class="row">
                            <div class="col-sm-12" id="result-pagination">
                               <?php echo $pagination_links; ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


