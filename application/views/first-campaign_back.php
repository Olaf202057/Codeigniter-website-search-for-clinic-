 <form id="frm_campaign" name="frm_campaign" action="" method="post">
 <!--section process start here-->
      <div class="process-step">
         <div class="container">
            <div class="process-bx">
               <div class="center-row">
                  <div class="step_process border-line">
                     <div class="active-step step_bor">
                        <div class="active_step normal_step"><img src="<?php echo base_url();?>assets/images/process.png" alt=""/></div>
                     </div>
                     <div class="plan-detail left1">
                        <div class="step_title">1. About Your Business</div>
                     </div>
                  </div>
                  <div class="bg_i">&nbsp;</div>
                  <div class=" step_process border-line">
                     <div class=" active_step step_bor">
                        <div class="active_step normal_step">2 <img src="<?php echo base_url();?>assets/images/process.png" alt=""/></div>
                     </div>
                     <div class="plan-detail left2">
                        <div class="step_title">2. Your First Campaign</div>
                     </div>
                  </div>
                  <div class="bg_i">&nbsp; </div>
                  <div class="step_process">
                     <div class="step_bor">
                        <div class="normal_step">3</div>
                     </div>
                     <div class="plan-detail left3">
                        <div class="step_title">3. Billing</div>
                     </div>
                  </div>
                  <div class="bg_i">&nbsp; </div>
                  <div class="step_process">
                     <div class="step_bor">
                        <div class="normal_step">4</div>
                     </div>
                     <div class="plan-detail left3">
                        <div class="step_title">4. Review</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--section process end here-->
      <!--step one start here-->
      <div class="container campaign">
         <div class="step-bx">
            <div class="row">
               <form method="post" action="">
               <div class="col-lg-8">
                  <div class="step1">
                     <h2>Your Ads</h2>
                     <div class="cmt-step">Create an ad to reach out to you your portential customers.</div>
                     <div class="user_box">
                        <label  class="label-txt">1. Choose where to target your customers</label>
                        <div class="edit-div">
                           <div class="location" style="cursor:pointer;" id="edit_location">
                              <div class="loc-div">Location</div>
                              <div class="edit-pencil" ><a><i class="fa fa-pencil"></i></a></div>
                              <div class="loc-address"><a id="location_name" href="javascript:void(0)">Enter location here </a> </div>
                           </div>
                           <div class="location-hide" id="location_div" style="display:none;">
                              <div class="loc-div hidden-xs hidden-sm">&nbsp;</div>
                              <div class="loc-address">
                                 <input name="area" id="area" type="text" class="input-address"/>
                                 <button class="bg-btn" id="save_location" type="button"> Save</button>
                                 <button class="bg-btn" id="cancel_location" type="button"> Cancel</button>
                              <span class="text-danger" id="err_area"><?php echo form_error('area'); ?></span>
                              </div>
                           </div>
                        </div>
                        <label  class="label-txt">2. Select what you want to advertise</label>
                        <div class="edit-div pdt-edit">
                           <div class="location" style="cursor:pointer;" id="edit_keywords">
                              <div class="loc-div" style="width:auto;">Keywords</div>
                              <div class="edit-pencil" ><a><i class="fa fa-pencil"></i></a></div>
                              <div class="loc-address" style="display:block"><a href="javascript:void(0);">Web Designer, Search Engine Optimization, App Development, Commercial Website Design
                                 E Commerce website Design, Web Hosting, Logo Design,PPC Management  </a> 
                              </div>
                           </div>
                           <!-- <div class="location-hide">
                              <div class="loc-address">
                                 <textarea name="adv_keywords_text" id="adv_keywords_text" class="des-address"></textarea>
                              </div>
                           </div> -->
                           <div class="location-hide" id="keywords_div" style="display:none;">
                              <div class="loc-address">
                                 <input type="text" name="adv_keywords" id="adv_keywords" class="input-address"/>
                                 <button class="bg-btn" id="save_keywords" type="button"> Save</button>
                                 <button class="bg-btn" id="cancel_keywords" type="button"> Cancel</button>
                                 <span class="text-danger" id="err_adv_keywords"><?php echo form_error('adv_keywords'); ?></span>
                              </div>
                           </div>
                        </div>
                        <label  class="label-txt">3. Write your ad </label>
                        <div class="edit-div">
                           <div class="location" style="cursor:pointer;" id="edit_adv">
                              <div class="loc-div">Your Ad Text</div>
                              <div class="edit-pencil"><a><i class="fa fa-pencil"></i></a></div>
                              
                           </div>
                           <div class="location-hide" id="advertise_div" style="display:none;">
                                <div class="ad-div">
                                 <div class="heading1"><a>web design - web design</a></div>
                                 <div class="heading2"><a> 
                                    <span class="ad-green">Ad</span>
                                    <span class="gree-add"> www.webwingtechnologies.com</span>
                                    </a>
                                 </div>
                                 <div class="ad-content">
                                    <a id="headline2_text"> Design services</a>
                                 </div>
                                 <div class="ad-content">
                                    <a id="description_text" href="#">Logo Design </a>
                                 </div>
                              </div>
                              <div class="loc-div hidden-xs hidden-sm">&nbsp;</div>
                              <div class="loc-address">
                                 <div class="user_box">
                                    <label class="label-txt" >Landing page</label>
                                    <input type="text" name="landing_pg" id="landing_pg" placeholder="www.webwingtechnologies.com" class="input-address"/>
                                    <span class="text-danger" id="err_landing_pg"><?php echo form_error('landing_pg'); ?></span>
                                    <div class="clr"></div>
                                 </div>
                                 <div class="user_box">
                                    <label class="label-txt" >Headline 1 </label>
                                    <input type="text" name="headline1" id="headline1" placeholder="web design" class="input-address"/>
                                    <span class="text-danger" id="err_headline1"><?php echo form_error('headline1'); ?></span>
                                    <div class="clr"></div>
                                 </div>
                                 <div class="user_box">
                                    <label class="label-txt" >Headline 2 </label>
                                    <input type="text" name="headline2" id="headline2" placeholder="web design" class="input-address"/>
                                    <span class="text-danger" id="err_headline2"><?php echo form_error('headline2'); ?></span>
                                    <div class="clr"></div>
                                 </div>
                                 <div class="user_box">
                                    <label class="label-txt" >Description  </label>
                                    <textarea class="des-address" name="description" id="description" cols="" rows=""></textarea>
                                    <span class="text-danger" id="err_description"><?php echo form_error('description'); ?></span>
                                    <div class="clr"></div>
                                 </div>
                                 <button class="bg-btn" id="save_advertise" type='button'> Save</button>
                                 <button class="bg-btn" id="cancel_adv" type="button"> Cancel</button>
                              </div>
                           </div>
                        </div>
                        <label  class="label-txt">4. Decide how much to spend </label>
                        <div class="edit-div">
                           <div class="location" style="cursor:pointer;" id="edit_budget">
                              <div class="loc-div">Your Budget</div>
                              <div class="edit-pencil" ><a><i class="fa fa-pencil"></i></a></div>
                              <div class="loc-address"><a>$ 100.00 per day average  </a> </div>
                           </div>
                           <div class="location-hide" id="budget_div" style="display:none;">
                              <div class="loc-div hidden-xs hidden-sm">&nbsp;</div>
                              <div class="loc-address">
                                 <a href="#">Specify how much, on average, you'd like to spend per day. <b>You're charged only when someone clicks your ad.</b>  </a>
                                 <div class="price-min-mix">
                                    <!--  <button class="inr-bx"> INR ₹</button>-->
                                    <div class="gry-bx select-style user-box inr-bx">
                                       <select class="frm-select fnt" name="currency" id="currency">
                                          <?php if(count($getCurrency)>0)
                                                {
                                                   foreach ($getCurrency as $currency)
                                                   { ?>
                                                       <option value="<?php echo $currency['currency_id'];?>"> <?php echo $currency['currency_code'];?></option>
                                          <?php    }
                                                }
                                           ?>
                                       </select>
                                    </div>
                                    <input type="text" name="amount" id="amount" placeholder="10" class="input-address inr-input"/> 
                                    per day
                                    <span class="text-danger" id="err_amount"><?php echo form_error('amount'); ?></span>
                                 </div>
                                 <div class="gray-text">You can always change the amount. The currency type (INR) will be set for your entire account and can't be changed.</div>
                                 <button class="bg-btn" id="save_amount" type="button" > Save</button>
                                 <button class="bg-btn" id="cancel_amount" type="button"> Cancel</button>
                              </div>
                           </div>
                        </div>
                        <button type="submit" class="bg-btn" name="btn_step2" id="btn_step2">Save &amp; Continue</button>
                     </div>
                  </div>
               </div>
               </form>
            </div>
         </div>
      </div>
      <!--step one end here-->
</form>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script type="text/javascript">
google.maps.event.addDomListener(window, 'load', function() {
    var places = new google.maps.places.Autocomplete(document
            .getElementById('area'));
    google.maps.event.addListener(places, 'place_changed', function() {
        var place = places.getPlace();
        var address = place.formatted_address;
        var  value = address.split(",");
        count=value.length;
        country=value[count-1];
        state=value[count-2];
        city=value[count-3];
        var z=state.split(" ");
        document.getElementById("selCountry").text = country;
        var i =z.length;
        document.getElementById("pstate").value = z[1];
        if(i>2)
        document.getElementById("pzcode").value = z[2];
        document.getElementById("pCity").value = city;
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        var mesg = address;
        document.getElementById("area").value = mesg;
       
    });
});

$('#edit_location').on('click',function(){
  $('#location_div').show();
  $('#keywords_div').hide();
  $('#advertise_div').hide();
  $('#budget_div').hide();
});
$('#edit_keywords').on('click',function(){
  $('#keywords_div').show();
  $('#location_div').hide();
  $('#advertise_div').hide();
  $('#budget_div').hide();
});
$('#edit_adv').on('click',function(){
  $('#advertise_div').show();
  $('#keywords_div').hide();
  $('#location_div').hide();
  $('#budget_div').hide();
});
$('#edit_budget').on('click',function(){
  $('#budget_div').show();
  $('#advertise_div').hide();
  $('#keywords_div').hide();
  $('#location_div').hide();
});

$('#cancel_location').on('click',function(){
  $('#location_div').hide();
});
$('#cancel_keywords').on('click',function(){
  $('#keywords_div').hide();
});
$('#cancel_adv').on('click',function(){
  $('#advertise_div').hide();
});
$('#cancel_amount').on('click',function(){
  $('#budget_div').hide();
});
$('#save_location').on('click',function(){
  var area = $('#area').val();
    if(area == '')
    {
      $('#err_area').text('Please enter your location');
      return false;
    }
    else 
    {
      $('#err_area').text('');
      $('#location_name').text(area);
      $('#location_div').hide();
    }
});

$('#save_advertise').on('click',function(){
  var landing_pg  = $('#landing_pg').val();
  var headline1   = $('#headline1').val();
  var headline2   = $('#headline2').val();
  var description = $('#description').val();
  var site_filter     = /^(http|https|ftp):\/\/(www+\.)?[a-zA-Z0-9]+\.([a-zA-Z]{2,4})\/?/;
  var flag = 1;
  if(landing_pg == '')
  {
    $('#err_landing_pg').text('Please enter URL of your website');
    flag = 0;
  }
  else if(!site_filter.test(landing_pg))
  {
    $('#err_landing_pg').text('Please enter valid URL');
    flag = 0;
  }
  else 
  {
    $('#err_landing_pg').text('');
  }
  if(headline1 == '')
  {
    $('#err_headline1').text('Please enter headline for your advertise');
    flag = 0;
  }
  else 
  {
    $('#err_headline1').text('');
  }
  if(headline2 == '')
  {
    $('#err_headline2').text('Please enter headline for your advertisement');
    flag = 0;
  }
  else 
  {
    $('#err_headline2').text('');
  }
  if(description == '')
  {
    $('#err_description').text('Please enter description');
    flag = 0;
  }
  else 
  {
    $('#err_description').text('');
  }

  if(flag == 0)
  {
    return false;
  }
  else 
  {
    $('#advertise_div').hide();
    return true;
  }
});

$('#save_amount').on('click',function(){
    var amount = $('#amount').val();
    if(amount == '')
    {
      $('#err_amount').text('Please enter budget amount');
      return false;
    }
    else 
    {
      $('#budget_div').hide();
    }
});

$('#save_keywords').on('click',function(){
    var adv_keywords = $('#adv_keywords').val();
    if(adv_keywords == '')
    {
      $('#err_adv_keywords').text('Please enter advertise keywords');
      return false;
    }
    else 
    {
      $('#keywords_div').hide();
    }
})

$(document).on('keydown', '#amount', function(e){
        // Allow: backspace, delete, tab, escape, enter and .
       
         var  str = $(this).val();
        
         var count =0;
         for (var i = 0; i < str.length; i++) {
            var index_of_sub = str.indexOf('.', i);

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



 $(document).on('keyup change','#landing_pg',function(){
    var landing_pg = $('#landing_pg').val();
    if(landing_pg == '')
    {
      $('.gree-add').text('www.example.com');  
    }
    else 
    {
      $('.gree-add').text(landing_pg);  
    }
    
 });
 $(document).on('keyup change','#headline1',function(){
    var headline1 = $('#headline1').val();
    if(headline1 == '')
    {
      $('.heading1').text('web design - web design');
    }
    else 
    {
      $('.heading1').text(headline1);  
    }
    
 });
 $(document).on('keyup change','#headline2',function(){
    var headline2 = $('#headline2').val();
    if(headline2 == '')
    {
      $('#headline2_text').text('Design Services');  
    }
    else 
    {
      $('#headline2_text').text(headline2);
    }
    
 });
$(document).on('keyup change','#description',function(){
    var description = $('#description').val();
    if(description == '')
    {
      $('#description_text').text('Logo Design');  
    }
    else 
    {
      $('#description_text').text(description);
    }
    
 });


$('#btn_step2').on('click',function(){
    var area = $('#area').val();
    var landing_pg  = $('#landing_pg').val();
    var headline1   = $('#headline1').val();
    var headline2   = $('#headline2').val();
    var description = $('#description').val();
    var site_filter     = /^(http|https|ftp):\/\/(www+\.)?[a-zA-Z0-9]+\.([a-zA-Z]{2,4})\/?/;
    var adv_keywords = $('#adv_keywords').val();
    var amount = $('#amount').val();
    var flag = 1;
    if(area == '')
    {
      $('#err_area').text('Please enter your location');
      $('#location_div').show();
      $('#area').focus();
      flag = 0;
    }
    else 
    {
      $('#err_area').text('');
      $('#location_div').hide();
    }
    if(landing_pg == '')
    {
      $('#err_landing_pg').text('Please enter URL of your website');
      $('#advertise_div').show();
      $('#landing_pg').focus();
      flag = 0;
    }
    else if(!site_filter.test(landing_pg))
    {
      $('#err_landing_pg').text('Please enter valid URL');
      $('#advertise_div').show();
      $('#landing_pg').focus();
      flag = 0;
    }
    else 
    {
      $('#err_landing_pg').text('');
    }
    if(headline1 == '')
    {
      $('#err_headline1').text('Please enter Headline for your Advertise');
      $('#advertise_div').show();
      $('#headline1').focus();
      flag = 0;
    }
    else 
    {
      $('#err_headline1').text('');
    }
    if(headline2 == '')
    {
      $('#err_headline2').text('Please enter headline for your advertisement');
      flag = 0;
    }
    else 
    {
      $('#err_headline2').text('');
    }
    if(description == '')
    {
      $('#err_description').text('Please enter description');
      $('#advertise_div').show();
      $('#description').focus();
      flag = 0;
    }
    else 
    {
      $('#err_description').text('');
    }
    if(adv_keywords == '')
    {
      $('#err_adv_keywords').text('Please enter advertise keywords');
      $('#keywords_div').show();
      $('#adv_keywords').focus();
      flag = 0;
    }
    else 
    {
      $('#keywords_div').hide();
    }
    if(amount == '')
    {
      $('#err_amount').text('Please enter budget amount');
      $('#budget_div').show();
      $('#amount').focus();
      flag = 0;
    }
    else 
    {
      $('#budget_div').hide();
    }
    if(flag == 0)
    {
      return false;
    }
    else 
    {
      $('#budget_div').hide();
      $('#advertise_div').show();
      $('#location_div').hide();
      return true;
    }
});
</script>