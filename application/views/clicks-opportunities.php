<style type="text/css">
.act a {color:#050404; /*new colour*/}

</style>

<form method="post" action="" id="examination_form">
<div class="container">
   <div class="row" style="height:100px;">
    </div>
   <div class="row" >


     <?php if($this->session->flashdata('success')!='') {?>
          <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
          <?php } else if($this->session->flashdata('error')!=''){?>
          <div class="alert alert-danger text-center"><?php echo $this->session->flashdata('error');?></div>
          <?php } ?>
      
      <div class="col-sm-12 col-md-12 col-lg-12">
         <div class="dashboard">
            <div class="container-fluid">
               
               <div class="row">
                 
                  <div class="clearfix"></div>
                  <div class="margin-10">
                  
                     <div class="col-sm-12 col-md-12 col-lg-12 pad-10- wow fadeInDown" data-wow-delay="0s">
                        <div class="table-responsive">
                           <div class="table-title">
                              <i class="fa fa-pencil"></i>Opportunità di miglioramento
                              <span class="pull-right"><!-- button type="button" class="btn btn-xs"><i class="fa fa-caret-down" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-remove" aria-hidden="true"></i></button> --></span>
                              <div class="clearfix"></div>
                           </div>
                           <table class="table table-striped">
                              <tr>
                                 <th width="1%"></th>
                                 <th width="14%" class="keyword-col">Esame</th>
                                 <th class="active-click">Click</th>
                                 <th>Costo totale</th>
                                 <th>Impr.</th>
                                 <th>Click mancati</th>
                              </tr>

                              <?php if(count($examination)>0)
                                  {
                                    foreach ($examination as $res) 
                                    {
                                     $sql = "SELECT sum(click_count) as sum, count(date) as cnt, `id`,date FROM
                                                  (SELECT *
                                                  FROM tbl_click_datewise where exam_id =".$res->examination_id." ORDER BY date DESC) AS T
                                                  GROUP BY exam_id ";
                                      
                                      $getCount = $this->db->query($sql)->result();
                                      $missed =0;
                                      if(count($getCount)>0 && $getCount[0]->sum > 0)
                                      {
                                         $click_per_day_avg = $getCount[0]->sum/$getCount[0]->cnt;
                                         $click_per_day_avg = number_format((float)$click_per_day_avg, 2, '.', '');

                                       
                                        $date1 = date('Y-m-d',strtotime($getCount[0]->date));
                                        $date2 = date('Y-m-d');
                                        
                                        $days = (strtotime($date2) - strtotime($date1)) / (60 * 60 * 24);
                                        $missed = round($days*$click_per_day_avg);
                                      }
                              ?>
                                    <tr>
                                       <td><i class="fa fa-circle"></i></td>
                                       <td class="keyword-col"> <?php echo $res->exam_type ;?></td>
                                       <td><?php echo $res->clicks;?></td>
                                       <td><i class="fa fa-eur" aria-hidden="true"></i> <?php echo $res->used_amount;?></td>
                                       <td><?php echo $res->impresion;?></td>
                                       <td><?php echo $missed; ?></td>
                                    </tr>
                                  <?php }
                                  }
                                  else
                                  { ?>
                                      <tr>
                                       <td colspan="7"> No exams found</td>
                                       
                                    </tr> 
                            <?php } ?>
                                    
                           </table>
                           <div class="table-footer"><!-- <a href="#">View saved filter <i class="fa fa-angle-double-right"></i></a> <span class="pull-right"> 1-3 of 10 <button type="button" class="btn btn-xs"><i class="fa fa-angle-left"></i></button> <button type="button" class="btn btn-xs"><i class="fa fa-angle-right"></i></button></span> --></div>
                        </div>
                     </div>
                     <!--End Table -->
                     <!--    End Table -->    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
     <div class="row" style="height:100px;">
    </div>
</div>
</form>




<div aria-hidden="false" style="display: none;" id="model1" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Edit Budget</b></h3>
            </div>
            <form method="post" action="<?php echo base_url();?>ads/edit_budget" >
                <div class="modal-body">
                   <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Exam Type </label>
                        <input type="hidden" id="exam_id" name="exam_id" >
                        <input type="hidden" id="card_type" name="card_type" >
                        <div class="col-sm-9 col-lg-6 controls">
                            <input readonly type="text" class="form-control" name="exam_type" id="exam_type" placeholder="Exam type"  />
                            <div class="error" id="err_member"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">Budget</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control"  name="budget" id="budget" placeholder="budget"  />
                            <div class="error" id="err_budget"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">How To Pay</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <select  class="form-control"  name="payment_method" id="payment_method">
                             <!--  <option value="automatic">Automatic payments (recommended)</option> -->
                              <option value="manual">Manual Payments</option>
                            </select>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-6 control-label" for="port">What you pay with</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <select  class="form-control"  name="payment_type" id="payment_type">
                              <option value="credit">Credit Card</option>
                              <option value="paypal">Paypal</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="payment_div">
                     <div class="form-group">
                       <label class="col-sm-3 col-lg-6 control-label" for="port"></label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control cc-number"  name="card_number" id="card_number" placeholder="Card Number"  />
                            <div class="error" id="err_card_number"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                       <label class="col-sm-3 col-lg-6 control-label" for="port"></label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" class="form-control cc-exp"  name="exp_date" id="exp_date" placeholder="MM/YY"  />
                            <div class="error" id="err_exp_date"></div>
                        </div>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" class="form-control cc-cvc"  name="cvv" id="cvv" placeholder="CVV"  />
                            <div class="error" id="err_cvv"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                       <label class="col-sm-3 col-lg-6 control-label" for="port"></label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="text" class="form-control"  name="holder_name" id="holder_name" placeholder="Cardholder name"  />
                            <div class="error" id="err_holder_name"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_pay" id="btn_pay" ><i class="fa fa-check"></i>Pay</button>
                        <button class="btn" type="button" data-dismiss="modal" onclick="window.location.href='<?php echo base_url();?>ads/opportunities'">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



 <script type="text/javascript">
         window.onload=function(){
           $('.selectpicker').selectpicker();
           $('.rm-mustard').click(function() {
             $('.remove-example').find('[value=Mustard]').remove();
             $('.remove-example').selectpicker('refresh');
           });
           $('.rm-ketchup').click(function() {
             $('.remove-example').find('[value=Ketchup]').remove();
             $('.remove-example').selectpicker('refresh');
           });
           $('.rm-relish').click(function() {
             $('.remove-example').find('[value=Relish]').remove();
             $('.remove-example').selectpicker('refresh');
           });
           $('.ex-disable').click(function() {
               $('.disable-example').prop('disabled',true);
               $('.disable-example').selectpicker('refresh');
           });
           $('.ex-enable').click(function() {
               $('.disable-example').prop('disabled',false);
               $('.disable-example').selectpicker('refresh');
           });
         
           // scrollYou
          /* $('.scrollMe .dropdown-menu').scrollyou();
         
           prettyPrint();*/
           };
         
           $('.getid').on('click',function(){
            var id = $(this).attr('data-id');
            $('#exam_id').val(id);

           document.forms["examination_form"].submit()


           });
           
           $('#payment_type').on('change',function(){
              var pay =$('#payment_type').val();
              if(pay == 'paypal')
                $('.payment_div').hide();
              else
                $('.payment_div').show();
           });

          function getpop(obj){
            var id   = $(obj).attr('data-id');
            var type = $(obj).attr('data-type');
            //var cost = $(obj).attr('data-cost');

            if(id.trim()=='' || type == '')
            {
              alert("something wrong");
            }
            else
            {
              $('#exam_id').val(id);
              $('#exam_type').val(type);
              $('#budget').val("0.00");
            }
         
          }
   </script>
      <script type="text/javascript" language="javascript" src="js/wow.min.js"></script>
      <script type="text/javascript">
        /* wow = new WOW({
             animateClass: 'animated',
             offset: 100,
             callback: function(box) {
                 console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
             }
         });*/
        /* wow.init();
         document.getElementById('moar').onclick = function() {
             var section = document.createElement('section');
             section.className = 'section--purple wow fadeInDown';
             this.parentNode.insertBefore(section, this);
         };*/
      </script>


   



