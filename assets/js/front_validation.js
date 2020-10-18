  $(document).ready(function() {

    $("#user_email").on('keyup',function(){
    var filter =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                 
    var email = $("#user_email").val();
    if(email!="" && filter.test(email))
    {
        $.ajax({

          url  : base_url+'ajax/checkemaildup',
          data : {email:email},
          type : 'post',
          success : function(resp){
            if(resp=="error")
            {
              $('.exist_email').show();
              $('#email_value').val('invalid');
              $('#btn_step1').hide();
              $('.login_btn').show();
            }
            if(resp=="success")
            {
              $('#email_value').val('valid');
              $('.exist_email').hide('');
              $('#btn_step1').show();
              $('.login_btn').hide();
            }
          }
 
        });
    }
    else
    {
      $('#err_email').html('Please enter a valid email.');
      return false;
    }

    
});

$("#normal_user_email").on('keyup',function(){
    var filter =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                 
    var email = $("#normal_user_email").val();
    if(email!="")
    {
        $.ajax({

          url  : base_url+'ajax/checkemaildup',
          data : {email:email},
          type : 'post',
          success : function(resp){
            if(resp=="error")
            {
              $('#err_email').html('Email id already exist');
              $('#email_value').val('invalid');
            }
            if(resp=="success")
            {
              $('#email_value').val('valid');
              $('#err_email').html('');
            }
          }
 
        });
    }
    else
    {
      $('#err_email').html('Please enter a valid email.');
      return false;
    }

    
});

 $('#btn_normal_register').on('click', function(e) {
     
  var fname           = $('#fname').val();
  var lname           = $('#lname').val();
  var dob             = $('#dob').val();
  var password        = $('#password').val();
  var conf_password   = $('#conf_password').val();
  var email           = $('#normal_user_email').val();
  var email_value     = $('#email_value').val();
  var filter =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  $('#err_fname').html('');
  $('#err_lname').html('');
  $('#err_pass').html('');
  $('#err_dob').html('');
  $('#err_conf_pass').html('');
  $('#err_email').html('');
  var flag = 1;

  if(fname.trim()=="")
  {
     $('#err_fname').html('Please enter first name.');
     flag =0;
  }
  if(lname.trim()=="")
  {
     $('#err_lname').html('Please enter last name');
     flag =0;
  }
  if(password.trim()=="")
  {
     $('#err_pass').html('Please enter password');
     flag =0;
  }
  else if(password.indexOf(' ')>0)
  {
    $('#err_pass').html('Please dont enter white space in password');
     flag =0;
  }
  else if(password.length < 6)
  {
    alert('in');
     $('#err_pass').html('Password length at least 6 character');
     flag =0;
  }
  else if(conf_password.trim()=="")
  {
    $('#err_conf_pass').html('Please enter confirm password');
    flag =0;
  }
  else if(password != conf_password)
  {
    $('#err_pass').html('Confirm password should be same as password');
    flag =0;
  }
 
  if(dob.trim()=="")
  {
     $('#err_dob').html('Please date of birth');
     flag =0;
  }
  if(!filter.test(email))
  {
     $('#err_email').html('Please valid email');
     flag =0;
  }
  else if(email_value != 'valid')
  {
     $('#err_email').html('Email id already exist');
     flag =0;
  }
  

  if(flag==1)
   return  true;
  else  
   return false;

});




 $('#btn_register_user').on('click', function(e) {
      
  var country   = $('#country').val();
  var state     = $('#state').val();
  var city      = $('#city').val();
  var bill_address = $('#bill_address').val();
  var name        = $('#name').val();
  var postal_code = $('#postal_code').val();
  //var timezone    = $('#timezone').val();
  var pay_type    = $('#pay_type').val();

  $('#err_country').html('');
  $('#err_state').html('');
  $('#err_city').html('');
  $('#err_bill_address').html('');
  $('#err_name').html('');
  //$('#err_timezone').html('');
  //$('#err_promocode').html('');
 
   
  $('#err_postal_code').html('');
  var flag = 1;

  if(country.trim()=="")
  {
     $('#err_country').html('Please select country');
     flag =0;
  }
  if(state.trim()=="")
  {
     $('#err_state').html('Please select state');
     flag =0;
  }
  if(city.trim()=="")
  {
     $('#err_city').html('Please select city');
     flag =0;
  }
  if(bill_address.trim()=="")
  {
     $('#err_bill_address').html('Please enter address');
     flag =0;
  }
  /*if(business_name.trim()=="")
  {
     $('#err_business_name').html('Please enter business name');
     flag =0;
  }*/
  if(name.trim()=="")
  {
     $('#err_name').html('Please enter name.');
     flag =0;
  }
  if(postal_code.trim()=="")
  {
     $('#err_postal_code').html('Please enter postal code');
     flag =0;
  }
  if(pay_type=='credit')
  {
    var num = $('#card_number').val();
    var cvv = $('#cvv').val();
    var exp_date = $('#exp_date').val();
    var holder_name = $('#holder_name').val();
    $('#err_card_number').html('');
    $('#err_cvv').html('');
    $('#err_holder_name').html('');
    $('#err_exp_date').html('');
    if(num=='')
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
   return  true;
  else  
   return false;

});


$('#btn_exam_add').click(function()
{
    var exam_type             = $('#exam_type_add').val();
    var official_waiting_days = $('#official_waiting_days_add').val();
    var price                 = $('#price_add').val();
    //var budget_add            = $('#budget_add').val();
   // var payment_type_add    = $('#payment_type_add').val();*/

    $('#err_price_add').html('');
    $('#err_exam_type_add').html('');
    $('#err_off_wait_day_add').html('');
    $('#err_budget_add').html('');
    var flag = 1;
    //return true;
    
    if(exam_type.trim()=='')
    {
      $('#err_exam_type_add').html('Please enter exam type');
      flag =0;  
    }
    if(price.trim()=='')
    {
      $('#err_price_add').html('Please enter price');
      flag =0;  
    }
   
    if(official_waiting_days.trim()=='')
    {
      $('#err_off_wait_day_add').html('Please enter official waiting days');
      flag =0;  
    }
  

    if(flag==1)
      return true;
    else
      return false;
});
$('#btn_exam_edit').click(function()
{
    var exam_type             = $('#exam_type_edit').val();
    var official_waiting_days = $('#official_waiting_days_edit').val();
    var price                 = $('#price_edit').val();

    $('#err_price_edit').html('');
    $('#err_exam_type_edit').html('');
    $('#err_off_wait_day_edit').html('');
    var flag = 1;
    //return true;
    
    if(exam_type.trim()=='')
    {
      $('#err_exam_type_edit').html('Please enter exam type');
      flag =0;  
    }
    if(price.trim()=='')
    {
      $('#err_price_edit').html('Please enter price');
      flag =0;  
    }
   
    if(official_waiting_days.trim()=='')
    {
      $('#err_off_wait_day_edit').html('Please enter official waiting days');
      flag =0;  
    }
    

    if(flag==1)
        return true;
    else
        return false;
})



$('#btn_pay').on('click', function(e) {
      
  var budget   = $('#budget').val();
  var payment_type   = $('#payment_type').val();
  $('#err_budget').html('');
  var flag = 1;

  if(budget.trim()=="")
  {
     $('#err_budget').html('Please enter budget');
     flag =0;
  }
  else if(budget <= 0)
  {
     $('#err_budget').html('Please enter valid  budget');
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
    if(num=='')
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
          flag=0;
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
   return  true;
  else  
   return false;

});





 $("#getRecords").on('change',function()
 {
   var data = $('#getRecords').val();
   document.forms["dashboard"].submit()
});

 $("#duration").on('change',function()
 {
   var data = $('#duration').val();
   document.forms["examination_form"].submit()
});

/* Billing details update by Jai(12-Sept-2016)*/
$('#btn_update_billing_details').on('click', function(e) {
      
  var country   = $('#country').val();
  var state     = $('#state').val();
  var city      = $('#city').val();
 // var business_name = $('#business_name').val();
  var postal_code = $('#postal_code').val();
  //var timezone    = $('#timezone').val();

  $('#err_country').html('');
  $('#err_state').html('');
  $('#err_city').html('');
  //$('#err_business_name').html('');
  //$('#err_timezone').html('');
  $('#err_postal_code').html('');

  var flag = 1;

  if(country.trim()=="")
  {
     $('#err_country').html('Please select country');
     flag =0;
  }
  if(state.trim()=="")
  {
     $('#err_state').html('Please select state');
     flag =0;
  }
  if(city.trim()=="")
  {
     $('#err_city').html('Please select city');
     flag =0;
  }
 /* if(timezone.trim()=="")
  {
     $('#err_timezone').html('Please select timezone');
     flag =0;
  }
  if(business_name.trim()=="")
  {
     $('#err_business_name').html('Please enter business name');
     flag =0;
  }*/
  if(postal_code.trim()=="")
  {
     $('#err_postal_code').html('Please enter postal code');
     flag =0;
  }

  if(flag==1)
  {
    return  true;
  }
  else  
  {
    return false;
  }

});

/* Change Password By Jai(12-Sept-2016)*/
$('#btn_update_password').on('click', function(e) {

  var currentpassword   = $('#currentpassword').val();
  var newpassword       = $('#newpassword').val();
  var confirmpassword   = $('#confirmpassword').val();
  var user_type   = $('#user_type').val();
 
  $('#err_currentpassword').html('');
  $('#err_newpassword').html('');
  $('#err_confirmpassword').html('');
  
  var flag = 1;

  if(user_type.trim() == 0)
  {
    if(currentpassword.trim()=="")
    {
       $('#err_currentpassword').html('Please enter current password');
       flag =0;
    }
  }
  if(newpassword.trim()=="")
  {
     $('#err_newpassword').html('Please enter new password');
     flag =0;
  }
  else if(newpassword.length<6 || newpassword.length>20)
  {
     $('#err_newpassword').html('Please enter valid new password greater than 6 and less than 20');
     flag =0;
  }

  if(confirmpassword.trim()=="")
  {
     $('#err_confirmpassword').html('Please enter confirm password');
     flag =0;
  }
  else if(newpassword.trim()!= confirmpassword.trim())
  {
     $('#err_confirmpassword').html('Please enter correct confirm password');
     flag =0;
  }  
  if(flag==1)
   return  true;
  else  
   return false;

});

/* Update My Profile By Jai(12-Sept-2016)*/
$('#btn_myaccount').on('click', function() {
     
  var firstname   = $('#firstname').val();
  var lastname    = $('#lastname').val();
  var email       = $('#email').val();
  var dob         = $('#dob').val();
  var gender      = $('input[name=gender]:checked').val(); 
  var filter      = /^[  a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
  var name_filter = /^[a-zA-Z .]*$/;

  $('#err_firstname').html('');
  $('#err_lastname').html('');
  $('#err_email').html('');
  $('#err_dob').html('');
  $('#err_gender').html('');
  
  var flag = 1;

  if(firstname.trim()=="")
  {
     $('#err_firstname').html('Please enter firstname');
     flag =0;
  }
  if((firstname.length>40) || (!name_filter.test(firstname)))
  {
     $('#err_firstname').html('Please enter valid firstname');
     flag =0;
  }  
  if(lastname.trim()=="")
  {
     $('#err_lastname').html('Please enter lastname');
     flag =0;
  }
  if((lastname.length>40) || (!name_filter.test(lastname)))
  {
     $('#err_lastname').html('Please enter valid lastname');
     flag =0;
  }  
  if(email.trim()=="")
  {
     $('#err_email').html('Please enter email');
     flag =0;
  }
  if(!filter.test(email))
  {
     $('#err_email').html('Please valid enter email');
     flag =0;
  }
  if(dob.trim()=="")
  {
     $('#err_dob').html('Please enter date of birth');
     flag =0;
  }  
  if(gender==undefined)
  {
     $('#err_gender').html('Please select your gender');
     flag =0;
  }
  if(flag==1)
   return  true;
  else  
   return false;

});



$('#btn_step1').click(function(){
  var email_value = $('#email_value').val();
  var filter =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  $('#err_user_email').text("");
  var email = $("#user_email").val();
  if(email!="" && filter.test(email))
  {
    if(email_value =="valid")
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  else
  {
    $('#err_user_email').text("Please enter valid email.");
     return false;

  }

});



$("#country").on('change',function(){
                 
    var id = $("#country").val();
        $.ajax({

          url  : base_url+'ajax/getState',
          data : {id:id},
          type : 'post',
          success : function(resp){
            $('#state').html(resp);           
          }
 
        });
  
});
$("#state").on('change',function(){
                 
    var id = $("#state").val();
        $.ajax({

          url  : base_url+'ajax/getCity',
          data : {id:id},
          type : 'post',
          success : function(resp){
            $('#city').html(resp);           
          }
 
        });
  
});

$("#pay_type").on('change',function(){
  var type = $("#pay_type").val();
  if(type.trim()=='paypal')
    $('.credit_div').hide();
  else
    $('.credit_div').show();
});


$(document).on('keydown', '#postal_code,#card_number,#cvv', function(e){
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
});

  $(document).on('keydown', '#price,#budget,#budget_add,#budget_csv,.exam_budget', function(e) {
        // Allow: backspace, delete, tab, escape, enter and .

        var str = $(this).val();

        var count = 0;
        for (var i = 0; i < str.length; i++) {
            var index_of_sub = str.indexOf('.', i);

            if (index_of_sub > -1) {
                count++;
                i = index_of_sub;
            }
        }

        if (count >= 1) {

            if (e.keyCode == 190 || e.keyCode == 110)
                e.preventDefault();
            else {
                var sub_str = str.substring(str.lastIndexOf('.') + 1);

                if (sub_str.length >= 2) {
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
                        // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true)) {
                        // let it happen, don't do anything
                        return;
                    } else
                        e.preventDefault();
                }
            }
        }
        if (e.shiftKey === true) {
            e.preventDefault();
        }
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything

            return;
        }

        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || (e.keyCode > 105 && e.keyCode != 110))) {
            e.preventDefault();
        }
    });


/*Function to remove exam*/
  $(document).on('click',"#tbl-exams .btn-remove-exam1",function(){
        var _this = $(this);
        if(confirm('Are you sure to remove this exam?')){
            waitingDialog.show();
            $.ajax({
                type: "POST",
                url: base_url+'exam/remove_exam',
                data:{id:_this.attr('data-id')},
                success: function(data){
                    if(data==1){
                        _this.parent().parent().parent().remove();
                        _this.parent().parent().parent().remove();
                    }
                    waitingDialog.hide();
                },
                error:function(){
                    waitingDialog.hide();
                }

            });
        }
        return false;
    })
/*Function To remove structure/hospital*/
  $(document).on('click',"#tbl-hospitals .btn-remove-structure",function(){
        var _this = $(this);

        if(confirm('Are you sure to remove this hospital?')){
            waitingDialog.show();
            $.ajax({
                type: "POST",
                url: base_url+'hospital/remove_structure',
                data:{id:_this.attr('data-id')},
                success: function(data){
                    if(data==1){
                        _this.parent().parent().parent().remove();
                    }
                    waitingDialog.hide();
                },
                error:function(){
                    waitingDialog.hide();
                }

            });
        }
        return false;
    });

  /*Function to search hospitals*/
  $(document).on('click',"#btn-search-structure",function(){

        var url =base_url+'dashboard?q='+$("#txt-search").val();

        if(url!=undefined){
            waitingDialog.show();
            $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data){
                            var obj = jQuery.parseJSON(data);
                            $("#result-pagination").html(obj.pagination_links);
                            resulStructurestHTML(obj.structures);
                            waitingDialog.hide();
                        }

                    });
        }
        return false;
    })

  function resulStructurestHTML(structures){
  var html='';

  $.each(structures,function(i, item){
    var tr ='<tr>'+
        ' <td>'+item.hospital+'</td> '+
        ' <td>'+item.address+'</td> '+
        ' <td>'+item.telephone+'</td> '+
        ' <td>'+item.email+'</td> '+
        ' <td>'+item.website+'</td> '+
        ' <td>'+
        ' <div class="btn-group">'+
                '<a href="'+base_url+'hospital/edit/'+item.id+'" type="button" data-id="'+item.id+'" class="btn btn-primary btn-sm">Edit</a>'+
                '<a href="'+base_url+'exam?structure='+item.id+'" type="button" data-id="'+item.id+'" class="btn btn-info btn-sm">Exams</a>'+
        '   <button type="button" data-id="'+item.id+'" class="btn btn-remove-structure btn-danger btn-sm">Delete</button>'+
                '   </div>'+
        ' </td> '+
        '</tr>';
    html = html+tr;

  })

  $("#tbl-hospitals tbody").html(html);
  
}

$(document).on('click',"#btn-search1",function(){

        var url =base_url+'exam?q='+$("#txt-search").val();

        if(url!=undefined){
            waitingDialog.show();
            $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data){
                            var obj = jQuery.parseJSON(data);
                            $("#result-pagination").html(obj.pagination_links);
                            resulExamsHTML(obj.exams);
                            waitingDialog.hide();
                        }

                    });
        }
        return false;
    })
function resulExamsHTML(exams){
    var html='';
    $.each(exams,function(i, item){
        var tr =' <tr>'+
                '    <td><input type="checkbox" name="exam_id[]" value="'+item.id +'"></td>'+
                '    <td>'+
                '        <div>'+item.exam_type +'</div>'+
                '        <i>'+item.hospital +'</i>'+
                '    </td>'+
                '    <td>'+item.budget_amount +'</td>'+
                '    <td>'+((item.official_waiting_days==null) ? 0 : item.official_waiting_days ) +'</td>'+
              
                '    <td>'+((item.price==null) ? 0 : item.price) +'</td>'+
                '    <td>'+
                '        <div class="btn-group">'+
                '            <a href="'+base_url+'exam/examReviews/'+item.id+'" type="button"  class="btn btn-success btn-approve-review btn-sm">Reviews</a>'+
                '            <a href="javascript:void(0);" type="button" data-id="'+item.id+'" data-type="'+item.exam_type+'" data-wait-day="'+item.official_waiting_days+'" data-price="'+item.price+'" class="btn btn-primary btn-sm"  data-target="#model2" data-toggle="modal" onclick="return geteditpop(this);">Edit</a>'+
                '            <button type="button" data-id="'+item.id+'"  class="btn btn-remove-exam btn-danger btn-sm">Delete</button>'+
                '        </div>'+
                '    </td>'+
                '</tr> '; 

        
        html = html+tr;

    })

    $("#tbl-exams tbody").html(html);
    
}

/*Hospital Pagination*/
$(document).on('click',"#hospitals ul.pagination li a",function(){
    var _this = $(this);
    var url = _this.attr('href');

    if(url!=undefined){
      waitingDialog.show();
      $.ajax({
            type: "GET",
            url: url,
            success: function(data){
              var obj = jQuery.parseJSON(data);
              $("#result-pagination").html(obj.pagination_links);
                            resulStructurestHTML(obj.structures);
              waitingDialog.hide();
            }

          });
    }
    return false;
  });

/*Exam Pagination*/
$(document).on('click',"#exam ul.pagination li a",function(){
        var _this = $(this);
        var url = _this.attr('href');

        if(url!=undefined){
            waitingDialog.show();
            $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data){
                            var obj = jQuery.parseJSON(data);
                            $("#result-pagination").html(obj.pagination_links);
                            resulExamsHTML(obj.exams);
                            waitingDialog.hide();
                        }

                    });
        }
        return false;
    })

/*Assign common name to exam*/
$(document).on('click','#btn-do-assign',function(){
        if($('input[name="exam_id[]"]:checked').size()==0){
            alert('Please select an exam to update common name....');
            return false;
        }else{
            $("#modal-assign-common").modal('show');
        }
    })


// Order pagination 
$(document).on('click',"#myorder ul.pagination li a",function(){
        var _this = $(this);
        var url = _this.attr('href');

        if(url!=undefined){
            waitingDialog.show();
            $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data){
                            var obj = jQuery.parseJSON(data);
                            $("#result-pagination").html(obj.pagination_links);
                            resulorderHTML(obj.transaction);
                            waitingDialog.hide();
                        }

                    });
        }
        return false;
    })


function resulorderHTML(transaction){
    var html='';
    $.each(transaction,function(i, item){
    var rr = item.transaction_date;
    var res = rr.split(" ");
    var today = new Date(res[0]);
    var dd = today.getDate();
    if(dd<=9)
      dd = "0"+dd;
    var mm = today.getMonth()+1;//January is 0!`
    if(mm<=9)
      mm = "0"+mm;
    var yyyy = today.getFullYear(); 
    var date = yyyy+"-"+mm+"-"+dd;

     if(item.next_pay_date == '' || item.next_pay_date == '0000-00-00' || item.next_pay_date == null )
            var str_dd = "-";
        else
            var str_dd = item.next_pay_date;

      
       if(item.payment_method == 'recurring' && item.status=='active')
        {
          var str ="Auto";
          var ss = '            <a href="'+base_url+'ads/cancel_order/'+item.id+'" type="button"  class="btn btn-danger btn-sm">Cancella</a>';
        }
        else
        {
          var str = "Manual"
          var ss =' ';
        }
        if(item.payment_method == 'recurring' && item.status!='')
        {
          var status1 = '';
          if(item.status == 'active')
            var status1 = "";
          else if(item.status == "cancelled")
            status1 = "Cancella";
          else 
              status1 = item.status;


           var ss1 = '            <a href="javascript:void(0);"   class="btn btn-success btn-sm">'+status1+'</a>';
            var ss2 = '            <a href="'+base_url+'ads/order_view/'+item.id+'" type="button"  class="btn btn-primary btn-sm">Vedi</a>';
        }
        else
        {
          var ss1='';
           var ss2 = '';
        }
                    
       var tr =' <tr>'+
                '    <td><input type="checkbox" name="trans[]" value="'+item.id +'"></td>'+
                '    <td>'+
                '       <div>'+item.type +'</div>'+
                '    </td>'+
                '    <td>'+str +'</td>'+
                '    <td>'+date +'</td>'+
                '    <td>'+item.no_of_cycle +'</td>'+
                '    <td>'+str_dd +'</td>'+
                '    <td>'+item.amount +'</td>'+
                '    <td>'+
                '        <div class="btn-group">'+ss2+ss1+ss+
                '        </div>'+
                '    </td>'+
                '</tr> '; 

        
        html = html+tr;

    })

    $("#tbl-order tbody").html(html);
    
}

