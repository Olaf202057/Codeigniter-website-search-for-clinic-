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
            <div class="col-md-6 col-md-offset-3">
                <?php echo $this->session->flashdata('verify_msg'); 
                ?>
            </div>
        </div>
        <div class="row">
         <?php echo $this->session->flashdata('msg'); ?>
            <form class="form-horizontal col-md-6" method="post" role="form" action="">
                <div class="step3">
                <h2>Update Exam</h2>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Exam Type <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text"  name="exam_type" id="exam_type" value="<?php if((isset($exam))&&(count($exam)>0)){ echo ucfirst($exam->exam_type); } else { echo ""; }?>" placeholder="exam type" class="form-control input-address">
                        <span class="text-danger" id="err_exam_type"><?php echo form_error('exam_type'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Common Name <span> : </span> </label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text"  name="common_name" id="common_name" value="<?php if((isset($exam))&&(count($exam)>0)){ echo ucfirst($exam->common_name); } else { echo ""; }?>" placeholder="common name" class="form-control input-address" >
                        <span class="text-danger" id="err_common_name"><?php echo form_error('common_name'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Official waiting days <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="number" name="official_waiting_days" id="official_waiting_days" value="<?php if((isset($exam))&&(count($exam)>0)){ echo ucfirst($exam->official_waiting_days); } else { echo ""; }?>" placeholder="official waiting days" class="form-control input-address" >
                        <span class="text-danger" id="err_off_wait_day"><?php echo form_error('official_waiting_days'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Reported waiting days <span> : </span> </label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="number" name="reported_waiting_days" id="reported_waiting_days" value="<?php if((isset($exam))&&(count($exam)>0)){ echo ucfirst($exam->reported_waiting_days); } else { echo ""; }?>" placeholder="reported waiting days" class="form-control input-address" >
                        <span class="text-danger" id="err_repo_wait_day"><?php echo form_error('reported_waiting_days'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Price <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="number" name="price" id="price" value="<?php if((isset($exam))&&(count($exam)>0)){ echo ucfirst($exam->price); } else { echo ""; }?>" placeholder="price" class="form-control input-address" >
                        <span class="text-danger" id="err_price"><?php echo form_error('price'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
              

                <div class="user_box">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="bg-btn" id="update_exam" name="update_exam">Update</button>
                        <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>admin/exams'">Cancel</button>
                    </div>
                </div>
                </div>
            </form> <!-- /form -->
        </div>
    </div> <!-- ./container -->
</div>

<script>
$('#update_exam').click(function()
{
    var exam_type             = $('#exam_type').val();
   // var common_name           = $('#common_name').val();
    var official_waiting_days = $('#official_waiting_days').val();
   // var reported_waiting_days = $('#reported_waiting_days').val();
    var price                 = $('#price').val();

    $('#err_price').html('');
    $('#err_exam_type').html('');
    $('#err_common_name').html('');
    $('#err_off_wait_day').html('');
    $('#err_repo_wait_day').html('');
    var flag = 1;
    //return true;
    
    if(exam_type.trim()=='')
    {
      $('#err_exam_type').html('Please enter exam type.');
      flag =0;  
    }
    if(price.trim()=='')
    {
      $('#err_price').html('Please enter price.');
      flag =0;  
    }
   /* if(common_name.trim()=='')
    {
      $('#err_common_name').html('Please enter common name.');
      flag =0;  
    }*/
    if(official_waiting_days.trim()=='')
    {
      $('#err_off_wait_day').html('Please enter official waiting days.');
      flag =0;  
    }
   /* if(reported_waiting_days.trim()=='')
    {
      $('#err_repo_wait_day').html('Please enter reported waiting days.');
      flag =0;  
    }*/

    if(flag==1)
        return true;
    else
        return false;
});

</script>