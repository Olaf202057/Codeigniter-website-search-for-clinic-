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
            <div class="col-md-6 col-md-offset-3"></div>
        </div>
        <div class="row">
          <?php if($this->session->flashdata('success')!='') {?>
          <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
          <?php } else if($this->session->flashdata('error')!=''){?>
          <div class="alert alert-danger text-center"><?php echo $this->session->flashdata('error');?></div>
          <?php } ?>
            <form class="form-horizontal col-md-6" action="" method="post" role="form">
                <div class="step3">
                <h2>Add Exam</h2>
                

                 <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Advertiser<span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <select  name="user" id="user" placeholder="exam type" class="form-control input-address">
                          <option value="" > --Select Advertiser---</option>
                          <?php if(count($users)>0)
                          {
                            foreach ($users as $user) 
                              { ?>
                                <option value="<?php echo $user['id'];?>" ><?php echo $user['firstname']." ".$user['lastname'] ;?> </option>
                          <?php } } ?>
                     
                        </select>
                        <span class="text-danger" id="err_user"><?php echo form_error('user'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>

                 <div class="user_box">
                    <label for="hospital" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Hospital<span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <select  name="hospital" id="hospital" placeholder="exam type" class="form-control input-address">
                          <option value="" > --Select Hospital---</option>
                        </select>
                          <span class="text-danger" id="err_hospital"><?php echo form_error('user'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>

                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Exam Type <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text"  name="exam_type" id="exam_type" placeholder="exam type" class="input-address">
                        <span class="text-danger" id="err_exam_type"><?php echo form_error('exam_type'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Common Name <span> : </span> </label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text"  name="common_name" id="common_name" placeholder="common name" class="form-control input-address" >
                        <span class="text-danger"id="err_common_name"><?php echo form_error('common_name'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Official waiting days <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="number" name="official_waiting_days" id="official_waiting_days" placeholder="official waiting days" class="form-control input-address" >
                        <span class="text-danger" id="err_off_wait_day"><?php echo form_error('official_waiting_days'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Reported waiting days <span> : </span> </label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="number" name="reported_waiting_days" id="reported_waiting_days" placeholder="reported waiting days" class="form-control input-address" >
                        <span class="text-danger" id="err_repo_wait_day"><?php echo form_error('reported_waiting_days'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Price <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="number" name="price" id="price" placeholder="price" class="form-control input-address" >
                        <span class="text-danger" id="err_price"><?php echo form_error('price'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
              

                <div class="user_box">
                    <div class="col-sm-9 col-sm-offset-3">
                      <button type="submit" class="bg-btn" name="btn_add_exam" id="btn_add_exam">Add</button>
                      <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>admin/exams'">Cancel</button>
                      <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>admin/exams'">Back</button>                      
                    </div>
                </div>
                </div>
            </form> <!-- /form -->
        </div>
    </div> <!-- ./container -->
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


})






 $(document).on('keydown', '#reported_waiting_days,#official_waiting_days', function(e){
        if(e.shiftKey === true)
        {
          e.preventDefault();
        }
        

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
           // let it happen, don't do anything

           return;
        }
      
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57) ) && (e.keyCode < 96 || (e.keyCode > 105 ))) {
           e.preventDefault();
        }
    });


  $(document).on('keydown', '#price', function(e){
        // Allow: backspace, delete, tab, escape, enter and .
       
         var  str = $("#price").val();
        
         var count =0;
         for (var i = 0; i < str.length; i++) {
            var index_of_sub = str.lastIndexOf('.', str);
            if (index_of_sub > -1) {
                count++;
                i = index_of_sub;
            }
        }
       
        if( count >=1)
        {
          if(e.keyCode==190 || e.keyCode==110)
            e.preventDefault();
          else
          {
            var sub_str =str.substring(str.lastIndexOf('.') + 1);
           
            if(sub_str.length>=2)
            {
              if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
               // Allow: Ctrl+A
              (e.keyCode == 65 && e.ctrlKey === true) ) {
                 // let it happen, don't do anything
              return;
              }
              else
                e.preventDefault();
            }
          }
        }
        if(e.shiftKey === true)
        {
          e.preventDefault();
        }
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13,190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
           // let it happen, don't do anything

           return;
        }
      
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57) ) && (e.keyCode < 96 || (e.keyCode > 105 && e.keyCode!=110))) {
           e.preventDefault();
        }
    });
  






$('#btn_add_exam').click(function(){
var exam_type             = $('#exam_type').val();
//var common_name           = $('#common_name').val();
var official_waiting_days = $('#official_waiting_days').val();
//var reported_waiting_days = $('#reported_waiting_days').val();
var price                 = $('#price').val();
var user                  = $('#user').val();
var hospital              = $('#hospital').val();

$('#err_price').html('');
$('#err_exam_type').html('');
$('#err_common_name').html('');
$('#err_off_wait_day').html('');
$('#err_repo_wait_day').html('');
$('#err_user').html('');
$('#err_hospital').html('');
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
/*if(common_name.trim()=='')
{
  $('#err_common_name').html('Please enter common name.');
  flag =0;  
}*/
if(official_waiting_days.trim()=='')
{
  $('#err_off_wait_day').html('Please enter official waiting days.');
  flag =0;  
}
/*if(reported_waiting_days.trim()=='')
{
  $('#err_repo_wait_day').html('Please enter reported waiting days.');
  flag =0;  
}*/
if(user.trim()=='')
{
  $('#err_user').html('Please select user');
  flag =0;  
}
if(hospital.trim()=='')
{
  $('#err_hospital').html('Please select hospital');
  flag =0;  
}

if(flag==1)
    return true;
else
    return false;
});




</script>

