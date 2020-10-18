
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
                              </span>
                            </div>  
                          </div><!-- /.col-lg-6 -->
                        </div>
                        <form method="post" id="frm_split" name="frm_split" action="">
                        Totale disponibile<input type="text" name="balance" id="balance" value="<?php echo $balance[0]['balance_amount']; ?>" class="input-address">
                        <div class="table-responsive">
                        <table class="table table-striped" id="tbl-balance">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all_exam" value=""></th>
                                <th>Esame</th>
                                <th>Budget assegnato</th>
                                <th>Budget utilizzato</th> 
                                <th>Budget disponibile</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(count($examination) > 0){
                            foreach ($examination as $exam) : ?>
                           
                                <tr>
                                    <td><input  type="checkbox" name="exam[]" value="<?php echo $exam['id']; ?>"></td>
                                     <td>
                                       <div><?php echo ucfirst($exam['exam_type']); ?></div>
                                    </td>
                                    <td>
                                       <div><input class="input-address exam_budget" type="text" id="allocated_amt" name="allocated_amt[]" data-used="<?php echo $exam['used_amount'] ; ?>" value="<?php echo ucfirst($exam['budget_amount']); ?>"/></div>
                                    </td>
                                    <td><?php echo $exam['used_amount'] ; ?></td>
                                     <td>
                                     <input type="hidden" id="ad_id" name="ad_id[]" class="ad_id" value="<?php echo $exam['id']; ?>" />
                                     <input type="hidden" id="remianing_amount rem_amt" name="remianing_amount[]" class="remianing_amt" value="<?php echo $exam['remianing_amount']; ?>" />
                                     
                                     <span class="remianing_amount" data-used="<?php echo $exam['used_amount'] ; ?>" data-remain="<?php echo $exam['remianing_amount']; ?>"><?php echo $exam['remianing_amount']; ?></span></td>
                                    
                                </tr>
                               
                            <?php endforeach; ?>
                            <tr>
                                    <td></td>
                                     <td>
                                       <div>Totale</div>
                                    </td>
                                    <td>
                                       <div><input class="input-address" type="text" id="final_amt" name="v" value="<?php echo $balance[0]['budget_amount']; ?>" readonly/>
                                          <div id="err_final_amt"  class="text-danger"></div>
                                       </div>

                                    </td>
                                    <td></td>
                                     <td><input type="submit" id="btnUpdate" class="btn btn-primary btn-sm pull-right" name="btnUpdate" value="Submit"></td>
                                    
                                </tr>
                            <?php }else { ?>
                            <tr><td>No orders.</td></tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(function(){
    $('.exam_budget').on('keyup',function(){
      $("#err_final_amt").text('');
      var val = $(this).val();
      var used_amt = $(this).attr('data-used');
      var remain = parseFloat(val) - parseFloat(used_amt);
      var balance_amt = $('#balance').val();
      $(this).closest('tr').find('.remianing_amount').html(remain.toFixed(2));
      $(this).closest('tr').find('.remianing_amt').val(remain);
      var sum_val = 0;
      $('.exam_budget').each(function(){
        $('#final_amt').css('border-color','');
        $(this).css('border-color','');
        var cur_val = $(this).val();
        sum_val = parseFloat(sum_val) + parseFloat(cur_val);
        var used_amt = $(this).attr('data-used');
      });
      $('#final_amt').val(sum_val);
      if(sum_val > balance_amt)
      {
        $('#final_amt').css('border-color','red');
        $(this).css('border-color','red');
      }
      else
      {
        $('#final_amt').css('border-color','');
        $(this).css('border-color','');
      }
    });
  });

$('#btnUpdate').on('click',function(){
  var balance_amt = $('#balance').val(); 
  var final_amt = $('#final_amt').val();
  var valid = (final_amt.match(/^-?\d*(\.\d+)?$/));
  $('#final_amt').css('border-color','');
  $("#err_final_amt").text('');
  if(parseFloat(final_amt) > parseFloat(balance_amt))
  {
    $('#final_amt').css('border-color','red');
    $("#err_final_amt").text('Splited amount is incorrect.')
    return false
  }
  if(valid == null)
  {
    alert("Please enter proper value.");
    return false
  }

})


</script>


