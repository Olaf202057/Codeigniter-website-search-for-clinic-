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
                <h2>Edit Your Budget</h2>
                
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Credito totale <span> : </span> </label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text"  name="acc_balance" id="acc_balance" placeholder="Account Balance" class="input-address" value="<?php echo $user[0]['balance_amount']; ?>" readonly>
                        <span class="text-danger" id="err_exam_type_add"><?php echo form_error('exam_type'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php if(count($pay_acc)>0)
                { ?>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Auto Pagamento <span> : </span> </label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="number" name="auto_payment" id="auto_payment" placeholder="Auto payment" class="form-control" value="<?php echo $pay_acc[0]['amount'];?>" readonly >
                        <span class="text-danger" id="err_auto_payment"><?php echo form_error('auto_payment'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <?php } ?>
                
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Aggiungi credito <span> : </span> <b>*</b></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="number" name="budget" id="budget" placeholder="Budget" class="form-control input-address" >
                        <span class="text-danger" id="err_budget"><?php echo form_error('budget'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
               
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Modalità di pagamento<span> : </span> </label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <select  class="form-control"  name="payment_method" id="payment_method">
                          <option value="automatic">Pagamento automatico (raccomandato)</option>
                          <option value="manual">Pagamento manuale</option>
                        </select>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Metodo di pagamento <span> : </span> </label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                         <select  class="form-control"  name="payment_type" id="payment_type">
                            <option value="credit">Carta di credito</option>
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
                          <input type="text" name="card_number" id="card_number" placeholder="Numero di carta" class="form-control input-address cc-number" >
                          <span class="text-danger" id="err_card_number"><?php echo form_error('reported_waiting_days'); ?></span>
                      </div>
                      <div class="clr"></div>
                  </div>

                 <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt"></label>
                    <div class="col-sm-8 col-md-7 col-lg-4">
                        <input type="text"  name="exp_date" id="exp_date" placeholder="MM/AAAA" class="form-control input-address cc-exp" >
                        <span class="text-danger" id="err_exp_date"><?php echo form_error('exp_date'); ?></span>
                    </div>
                    <div class="col-sm-8 col-md-7 col-lg-3">
                        <input type="text" name="cvv" id="cvv" placeholder="CVV" class="form-control input-address cc-cvc" >
                        <span class="text-danger" id="err_cvv"><?php echo form_error('cvv'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="user_box">
                    <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt"></label>
                    <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" name="holder_name" id="holder_name" placeholder="Titolare della carta" class="form-control input-address" >
                        <span class="text-danger" id="err_holder_name"><?php echo form_error('holder_name'); ?></span>
                    </div>
                    <div class="clr"></div>
                </div>
              </div>
              <div class="user_box">
                <div class="col-sm-9 col-sm-offset-3">
                  <button type="submit" class="bg-btn" name="btn_update_budget" id="btn_update_budget">Aggiorna</button>
                  <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>exam'">Ignora</button>
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

 $('#payment_type').on('change',function(){
              var pay =$('#payment_type').val();
              if(pay == 'paypal')
                $('.payment_div').hide();
              else
                $('.payment_div').show();
           });



  $(document).on('keydown', '#budget', function(e){
        // Allow: backspace, delete, tab, escape, enter and .
       
         var  str = $("#budget").val();
        
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
  






$('#btn_update_budget').click(function(){

var budget             = $('#budget').val();
var payment_type           = $('#payment_type').val();

$('#err_price').html('');
$('#err_budget').html('');

var flag = 1;
//return true;

if(budget.trim()=='')
{
  $('#err_budget').html('Please enter budget.');
  flag =0;  
}
if(budget.trim()== 0)
{
  $('#err_budget').html('Please enter valid budget.');
  flag =0;  
}
 if(payment_type=='credit')
  {
    var num = $('#card_number').val();
    var cvv = $('#cvv').val();
    var exp_date = $('#exp_date').val();
    var holder_name = $('#holder_name').val();
    $('#err_card_number').html('');
    $('#err_cvv').html('');
    $('#err_holder_name').html('');
    $('#err_exp_date').html('');
    if(num == '')
    {
      $('#err_card_number').html('Please enter card number');
      flag=0;
    }
    if(cvv=='')
    {
      $('#err_cvv').html('Please enter cvv number');
      flag=0;
    }
     if(exp_date=='')
    {
      $('#err_exp_date').html('Please enter expiry date');
      flag=0;
    }
    if(holder_name=='')
    {
      $('#err_holder_name').html('Please enter card holder name');
      flag=0;
    }
    var card_type ='';
     if(num!='')
     {
        if(!Iugu.utils.validateCreditCardNumber(num))
        {
          $('#err_card_number').html('Please enter valid card number');
          flag=0;
        }
        else
        {
          card_type = Iugu.utils.getBrandByCreditCardNumber(num);
          $('#card_type').val(card_type);
        }
     } 
     
     if(cvv!="")
     {
        if(!Iugu.utils.validateCVV(cvv,card_type))
        {
          $('#err_cvv').html('Please enter valid cvv number');
          flag=0;;
        }
     }
     if(exp_date !="" )
     {
        if(!Iugu.utils.validateExpirationString(exp_date))
        {
          $("#err_exp_date").html("Please enter valid expiry date");
          flag =0;
        }
      }
 }


if(flag==1)
    return true;
else
    return false;
});




</script>

