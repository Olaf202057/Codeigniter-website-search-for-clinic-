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
                    <?php if($this->session->flashdata('success')!='') {?>
                      <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
                      <?php } else if($this->session->flashdata('error')!=''){?>
                      <div class="alert alert-danger text-center"><?php echo $this->session->flashdata('error');?></div>
                      <?php } ?>

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
                            <a class="btn btn-primary btn-sm pull-right" id="btn-do-addExam" href="<?php echo base_url().'admin/add_exam/' ?>"  >Add Exam</a>
							<a class="btn btn-primary btn-sm pull-right" id="btn-do-addExam" href="<?php echo base_url().'admin/add_public_exam/' ?>"  >Add Public Exam</a>
                            <a class="btn btn-primary btn-sm pull-right" id="btn-do-addExam"  href="javascript:void(0);" data-target="#model3" data-toggle="modal">Add Exam By File </a>
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
                                <th style="width:200px;">Action</th>
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
                                          <?php if($exam->owner_id != 0){?>
                                             <a href="<?php echo base_url().'admin/exam_stats/'.$exam->id ?>" type="button" data-id="<?php echo $exam->id ?>" class="btn btn-success btn-approve-user btn-sm">Stats</a>
                                             <?php } ?>
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






<div aria-hidden="false" style="display: none;" id="model3" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel2"><b>Add Exam by CVS file</b></h3>
            </div>
            <form method="post" action="<?php echo base_url();?>admin/add_exam_csv" enctype="multipart/form-data" >
                <div class="modal-body">
                    <div class="form-group">
                    <label class="col-sm-3 col-lg-5 control-label" for="port">Advertiser</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <select class="form-control"  name="user" id="user" placeholder="Advertiser"  />
                               <option value=" ">-- Select Advertiser-- </option>
                               <?php if(count($users)>0){ 
                                foreach ($users as $user) { ?>
                                  <option value="<?php echo $user['id'];?>"><?php echo $user['firstname']." ".$user['lastname'];?></option>
                               <?php } }?>
                            <select>
                            <div class="error" id="err_user"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-5 control-label" for="port">Hospital</label>
                        <div class="col-sm-9 col-lg-6 controls">
                            <select type="text" class="form-control"  name="hospital" id="hospital" placeholder="Hospital"  />
                            <option value=" ">-- Select Hospital--</option>
                            </select>
                            <div class="error" id="err_hospital"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>  
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
                        <button class="btn btn-primary" type="submit" name="btn_exam_csv" id="btn_exam_csv" ><i class="fa fa-check"></i>Add Exam</button>
                        <button class="btn" type="button" data-dismiss="modal" onclick="window.location.href='<?php echo base_url();?>exam'">Cancel</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">


$('#user').on('change',function(){
 var user = $('#user').val();
 if(user.trim() =='')
 {
    $('#err_user').text('Please select user.');
    return false;
 }
    $.ajax({

      url  : base_url+'ajax/getHospital',
      data : {user:user},
      type : 'post',
      success : function(resp){
       $('#hospital').html(resp);
      }

    });

});

$('#btn_exam_csv').on('click',function(){
   var hospital = $('#hospital').val();
   var user = $('#user').val();
   var file_name = $('#file_name').val();
   var ext_a = file_name.substring(file_name.lastIndexOf('.') + 1);

   $('#err_user').html('');
   $('#err_hospital').html('');
   $('#err_file').html('');
   var flag = 1;

   if(hospital.trim()  == '')
   {
     $('#err_hospital').html('Please select hospital');
     flag =0;
   }
   if(user.trim() == '')
   {
        $('#err_user').html('Please select advertiser');
        flag = 0 ;
   }
   if(file_name!='')
   {

        if(!( ext_a == "csv" || ext_a == "CSV" || ext_a == "xls" || ext_a == "XLS" ))
        {
             $('#err_file').html('Only excel, csv type file is allowed');
            flag=0;
        }
   }
   else
   {
        $('#err_file').html('Please select file');
        flag =0;
   }

   if(flag == 0)
    return false;
   else
    return true;
})


</script>