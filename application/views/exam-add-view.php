<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.payment.js"></script>
<script type="text/javascript" src="https://js.iugu.com/v2"></script>

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
            <form class="form-horizontal col-md-6" method="post" role="form">
                <div class="step3">
                <h2>Add Exam</h2>
                
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Exam Type <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text"  name="exam_type" id="exam_type_add" placeholder="Exam type" class="input-address">
                        <span class="text-danger" id="err_exam_type_add"><?php echo form_error('exam_type'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Official waiting days <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="number" name="official_waiting_days" id="official_waiting_days_add" placeholder="Official waiting days" class="form-control input-address" >
                        <span class="text-danger" id="err_off_wait_day_add"><?php echo form_error('official_waiting_days'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Price <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="number" name="price" id="price_add" placeholder="Price" class="form-control input-address" >
                        <span class="text-danger" id="err_price_add"><?php echo form_error('price'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                  <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Budget <span> : </span> <b>*</b></label>
                  <div class="col-sm-8 col-md-7 col-lg-7">
                      <input type="text" name="budget" id="budget_add" placeholder="Budget" class="form-control input-address" >
                      <span class="text-danger" id="err_budget_add"><?php echo form_error('reported_waiting_days'); ?></span>
                  </div>
                  <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">How To Pay <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <select  class="form-control"  name="payment_method" id="payment_method_add">
                          <option value="automatic">Automatic payments (recommended)</option>
                          <option value="manual">Manual</option>
                        </select>
                    </div>
                    <div class="clr"></div>
                </div>
                 <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">What you pay with <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                         <select  class="form-control"  name="payment_type" id="payment_type_add">
                            <option value="credit">Credit Card</option>
                            <option value="paypal">Paypal</option>
                          </select>
                        
                    </div>
                    <div class="clr"></div>
                </div>

                <div class="payment_div">
                   <div class="user_box">
                      <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt"></label>
                      <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="hidden" name="card_type" id="card_type"/>
                          <input type="text" name="card_number" id="card_number_add" placeholder="Card Number" class="form-control input-address cc-number" >
                          <span class="text-danger" id="err_card_number_add"><?php echo form_error('reported_waiting_days'); ?></span>
                      </div>
                      <div class="clr"></div>
                  </div>

                 <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt"></label>
                    <div class="col-sm-8 col-md-7 col-lg-4">
                        <input type="text"  name="exp_date" id="exp_date_add" placeholder="MM/YY" class="form-control input-address cc-exp" >
                        <span class="text-danger" id="err_exp_date_add"><?php echo form_error('exp_date'); ?></span>
                    </div>
                    <div class="col-sm-8 col-md-7 col-lg-3">
                        <input type="text" name="cvv" id="cvv_add" placeholder="CVV" class="form-control input-address cc-cvc" >
                        <span class="text-danger" id="err_cvv_add"><?php echo form_error('cvv'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt"></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="holder_name" id="holder_name_add" placeholder="Cardholder name" class="form-control input-address" >
                        <span class="text-danger" id="err_holder_name_add"><?php echo form_error('holder_name'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
              </div>
              <div class="user_box">
                <div class="col-sm-9 col-sm-offset-3">
                  <button type="submit" class="bg-btn" name="btn_add_exam" id="btn_exam_add">Add</button>
                  <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>exam'">Cancel</button>
                </div>
              </div>
            </div>
            </form> <!-- /form -->
        </div>
    </div> <!-- ./container -->
</div>
<script type="text/javascript">



 $('.cc-number').payment('formatCardNumber');
 $('.cc-exp').payment('formatCardExpiry');
 $('.cc-cvc').payment('formatCardCVC');

 $('#payment_type_add').on('change',function(){
              var pay =$('#payment_type_add').val();
              if(pay == 'paypal')
                $('.payment_div').hide();
              else
                $('.payment_div').show();
           });

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
  





/*
$('#btn_add_exam').click(function(){
  alert('pp');
var exam_type             = $('#exam_type').val();
var common_name           = $('#common_name').val();
var official_waiting_days = $('#official_waiting_days').val();
var reported_waiting_days = $('#reported_waiting_days').val();
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
if(common_name.trim()=='')
{
  $('#err_common_name').html('Please enter common name.');
  flag =0;  
}
if(official_waiting_days.trim()=='')
{
  $('#err_off_wait_day').html('Please enter official waiting days.');
  flag =0;  
}
if(reported_waiting_days.trim()=='')
{
  $('#err_repo_wait_day').html('Please enter reported waiting days.');
  flag =0;  
}

if(flag==1)
    return true;
else
    return false;
});
*/



</script>

