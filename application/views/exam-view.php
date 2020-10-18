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
                    <div role="tabpanel" class="tab-pane fade in active " id="exam">

                      <div class="row"  style="margin-top:5px;" >
                        <form method="GET" action="">
                          <div class="col-sm-6">
                            <div class="input-group">
                              <input type="text" class="form-control" id="txt-search" name="q" value="<?php echo $this->input->get("q") ?>" placeholder="Cerca">
                              <div class="error" id="err_search"></div>
                              <span class="input-group-btn">
                                <button class="btn btn-default" id="btn_search" name="btn_search" type="submit">Vai!</button>
                              </span>
                            </div> <!-- /input-group -->
                          </div><!-- /.col-lg-6 -->
                          </form>
                        <div class="col-sm-6">
                            <a class="btn btn-primary btn-sm pull-right" id="btn-do-addExam"  href="javascript:void(0);" data-target="#model3" data-toggle="modal">Aggiungi da file </a>
                            <a class="btn btn-primary btn-sm pull-right" id="btn-do-addExam"  href="javascript:void(0);" data-target="#model_add" data-toggle="modal">Aggiungi</a>
                             <a class="btn btn-primary btn-sm pull-right" id="btn-do-addExam"  href="<?php echo base_url();?>ads/split_budget" >Modifica budget</a>
                        </div>
                        </div>
                        <table class="table table-striped" id="tbl-exams">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all_exam" value=""></th>
                                <th>Esame</th>
                                <th>Budget</th> 
                                <th>Tempo di attesa</th>
                                <th>Costo esame</th>
                                <th style="width: 300px">Azione</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(count($exams) > 0){
                            foreach ($exams as $exam) : ?>
                                <tr>
                                    <td><input type="checkbox" name="exam_id[]" value="<?php echo $exam['id']; ?>"></td>
                                    <td>
                                       <div><?php echo $exam['exam_type']; ?></div>
                                        <i><?php echo $exam['hospital']; ?></i>
                                    </td>
                                    <td><?php echo $exam['budget_amount']; ?></td>
                                    <td><?php echo empty($exam['official_waiting_days']) ? 'N/A' : $exam['official_waiting_days']; ?></td>
                                    <!-- <td><?php echo empty($exam['reported_waiting_days']) ? 0 : $exam['reported_waiting_days'] ?></td> -->
                                    <td><?php echo empty($exam['price']) ? 0 : $exam['price'] ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- <a href="javascript:void(0);" type="button" data-id="<?php echo $exam['id'] ?>" data-type="<?php echo $exam['exam_type'];?>" data-budget="<?php echo $exam['budget_amount'];?>"  class="btn btn-primary btn-sm"   data-target="#model1" data-toggle="modal" onclick="return getpop(this);" >Edit Budget</a> -->
                                            <a type="button" href="<?php echo base_url().'exam/examReviews/'.$exam['id'].'/'.$exam['struct_id']; ?>" class="btn btn-success btn-approve-review btn-sm" >Recensioni</a>
                                            <a href="javascript:void(0);" type="button" data-id="<?php echo $exam['id'] ?>" data-type="<?php echo $exam['exam_type'];?>" data-wait-day="<?php echo $exam['official_waiting_days'];?>" data-price="<?php echo $exam['price'];?>" class="btn btn-primary btn-sm"  data-target="#model2" data-toggle="modal" onclick="return geteditpop(this);">Modifica esame</a>
                                            <button type="button" data-id="<?php echo $exam['id'] ?>"  class="btn btn-remove-exam1 btn-danger btn-sm">Cancella</button>
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; } else { ?>
                            <tr><td>No exams added.</td></tr>
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


<div aria-hidden="false" style="display: none;" id="model3" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Aggiungi da file</b></h3>
            </div>
            <form method="post" action="<?php echo base_url();?>exam/add_exam_csv" enctype="multipart/form-data" >
                <div class="modal-body">
                   <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Select File </label>
                       
                        <div class="col-sm-9 col-lg-6 controls">
                            <input type="file" class="" name="file_name" id="file_name"   />
                            <div class="error" id="err_file"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                 <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_pay_exam_csv" id="btn_pay_exam_csv" ><i class="fa fa-check"></i>Add Esame</button>
                        <button class="btn" type="button" data-dismiss="modal" onclick="window.location.href='<?php echo base_url();?>exam'">Ignora</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>






<div aria-hidden="false" style="display: none;" id="model2" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Edit Esame</b></h3>
            </div>
            <form method="post" action="<?php echo base_url();?>exam/edit" >
                <div class="modal-body">
                   <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Tipo di prestazione : <span class="error">*</span> </label>
                        <input type="hidden" id="exam_id_edit" name="exam_id" >
                        <div class="col-sm-9 col-lg-6 controls">
                            <input  type="text" class="form-control" name="exam_type" id="exam_type_edit" placeholder="Tipo di prestazione"  />
                            <div class="error" id="err_exam_type_edit"><?php echo form_error('exam_type'); ?></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Tempo di attesa : <span class="error">*</span> </label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input  type="number" class="form-control"  name="official_waiting_days" id="official_waiting_days_edit" placeholder="Tempo di attesa"  />
                            <div class="error" id="err_off_wait_day_edit"><?php echo form_error('official_waiting_days'); ?></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Costo della prestazione : <span class="error">*</span>  </label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input  type="number" class="form-control"  name="price" id="price_edit" placeholder="Costo della prestazione"  />
                            <div class="error" id="err_price_edit"><?php echo form_error('price'); ?></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="update_exam" id="btn_exam_edit" ><i class="fa fa-check"></i>Aggiorna</button>
                        <button class="btn" type="button" data-dismiss="modal">Ignora</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>





<div aria-hidden="false" style="display: none;" id="model_add" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Add Esame</b></h3>
            </div>
            <form method="post" action="<?php echo base_url();?>exam/add" >
                <div class="modal-body">
                   <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Tipo di prestazione : <span class="error">*</span> </label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input  type="text" class="form-control" name="exam_type" id="exam_type_add" placeholder="Tipo di prestazione"  />
                            <div class="error" id="err_exam_type_add"><?php echo form_error('exam_type'); ?></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Tempo di attesa : <span class="error">*</span> </label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input  type="number" class="form-control"  name="official_waiting_days" id="official_waiting_days_add" placeholder="Tempo di attesa"  />
                            <div class="error" id="err_off_wait_day_add"><?php echo form_error('official_waiting_days'); ?></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Costo della prestazione : <span class="error">*</span>  </label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <input  type="number" class="form-control"  name="price" id="price_add" placeholder="Costo della prestazione"  />
                            <div class="error" id="err_price_add"><?php echo form_error('price'); ?></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_add_exam" id="btn_exam_add" ><i class="fa fa-check"></i>Add Esame</button>
                        <button class="btn" type="button" data-dismiss="modal">Ignora</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>







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
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Exam Type </label>
                        <input type="hidden" id="card_type" name="card_type" >
                        <div class="col-sm-9 col-lg-6 controls">
                            <input readonly type="text" class="form-control" name="exam_type" id="exam_type" placeholder="Exam type"  />
                            <div class="error" id="err_member"></div>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Budget</label>
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" class="form-control"  name="cost" id="cost" placeholder="cost" readonly />
                        </div> 
                        <div class="col-sm-3 col-lg-1 controls">+</div> 
                        <div class="col-sm-6 col-lg-3 controls">
                            <input type="text" class="form-control"  name="budget" id="budget" placeholder="Add budget"  />
                            <div class="error" id="err_budget"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                <div class="clearfix"></div>
                </div>
                <div style="text-align:left;" class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit" name="btn_pay" id="btn_pay" ><i class="fa fa-check"></i>Update</button>
                        <button class="btn" type="button" data-dismiss="modal" onclick="window.location.href='<?php echo base_url();?>exam'">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">


$(document).on('click','#select_all_exam',function(){
        $('input[name="exam_id[]"]').prop('checked',$(this).is(':checked'))
    })
    $(document).on('click','#btn-assign-common',function(){
        var _this = $(this);

        if($('#common_name').val().trim()!=''|| $('input[name=r_common_name]:checked').val()){
            $('#common_name').removeClass('alert-danger');
            if(confirm('Are you sure to assign this selected exam this common name?')){
                $('#common_name').removeClass('alert-danger');
                var common_name =($('#common_name').val().trim()!='') ? $('#common_name').val():$('input[name=r_common_name]:checked').val();

                waitingDialog.show();
                $.ajax({
                    type: "POST",
                    url: base_url+'exam/update_exam_common_name',
                    data:$('input[name="exam_id[]"]:checked').serialize()+'&common_name='+common_name,
                    success: function(data){
                        window.location.href=window.location.href;
                        waitingDialog.hide();
                    },
                    error:function(){
                        waitingDialog.hide();
                    }

                });
            }
        }else{
            $('#common_name').addClass('alert-danger');
        }

        return false
    })


    $('#payment_type_csv').on('change',function(){
              var pay =$('#payment_type_csv').val();
              if(pay == 'paypal')
                $('.payment_div').hide();
              else
                $('.payment_div').show();
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
            var cost = $(obj).attr('data-budget');

            if(id.trim()=='' || type == '')
            {
              alert("something wrong");
            }
            else
            {
              $('#exam_id').val(id);
              $('#exam_type').val(type);
              $('#cost').val(cost);
            }
         
          }
         function geteditpop(obj){
            var id    = $(obj).attr('data-id');
            var type  = $(obj).attr('data-type');
            var day   = $(obj).attr('data-wait-day');
            var price = $(obj).attr('data-price');

            $('#exam_id_edit').val(id);
            $('#exam_type_edit').val(type);
            $('#official_waiting_days_edit').val(day);
            $('#price_edit').val(price);
          }

$('#btn_pay_exam_csv').on('click',function(){
   var file_name = $('#file_name').val();
   //var budget_csv = $('#budget_csv').val();
  // var payment_type = $('#payment_type_csv').val();
   $('#err_file').html('');
   $('#err_budget_csv').html('');

   var ext_a = file_name.substring(file_name.lastIndexOf('.') + 1);
   var flag = 1;

    if(file_name.trim()=='')
    {
        $('#err_file').html('Please select file');
        flag=0;
    }
    else
        if(!(ext_a == "txt" || ext_a == "csv" || ext_a == "text" || ext_a == "TEXT" || ext_a == "CSV" || ext_a == "TXT" || ext_a == "xls" || ext_a == "XLS" ))
    {
         $('#err_file').html('Only text, csv, text type file is allowed');
        flag=0;
    }
   /* if(budget_csv.trim() == '')
    {
        $('#err_budget_csv').html('Please enter budget.');
        flag = 0;
    }*/
  
    if(flag == 0)
        return false;
    else
        return true;
});


$('#btn_search').on('click',function(){
    var type = $('#txt-search').val();
   if(type.trim()=='')
   {
    $('#err_search').text("Please eneter exam type to search");
    return false;
   }
    return true;
})




</script>