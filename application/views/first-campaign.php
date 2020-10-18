<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-1.11.3.min.js'; ?>"></script>
<form id="frm_campaign" name="frm_campaign" action="" role="form" method="post" enctype="multipart/form-data">
    <!--section process start here-->

    <div class="process-step">
        <div class="container">
            <div class="process-bx">
                <div class="center-row">
                    <div class="step_process border-line">
                        <div class="active-step step_bor">
                            <div class="active_step normal_step"><img src="<?php echo base_url();?>assets/images/process.png" alt="" />
                            </div>
                        </div>
                        <div class="plan-detail left1">
                            <div class="step_title">1. Benvenuto</div>
                        </div>
                    </div>
                    <div class="bg_i">&nbsp;</div>
                    <div class=" step_process border-line">
                        <div class=" active_step step_bor">
                            <div class="active_step normal_step">2 
                            </div>
                        </div>
                        <div class="plan-detail left2">
                            <div class="step_title">2. La tua struttura</div>
                        </div>
                    </div>
                    <div class="bg_i">&nbsp; </div>
                    <div class="step_process">
                        <div class="step_bor">
                            <div class="normal_step">3</div>
                        </div>
                        <div class="plan-detail left3">
                            <div class="step_title">3. Pagamento</div>
                        </div>
                    </div>
                    <div class="bg_i">&nbsp; </div>
                    <div class="step_process">
                        <div class="step_bor">
                            <div class="normal_step">4</div>
                        </div>
                        <div class="plan-detail left3">
                            <div class="step_title">4. Termina</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--section process end here-->
    <!--step one start here-->
    <div class="container">
        <div class="step-bx">
            <div class="row">
                <div class="col-lg-12">
                    <div class="step3">
                        <h2>La tua struttura</h2>
                        <div class="cmt-step"> </div>

                        <div class="row">
                          <label  class="label-txt">1.Informazioni generali </label>
                          <div class="edit-div ">
                           <div class="col-lg-7">
                            <div class="location">
                            <div class="user_box">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Nome della struttura <b>*</b><span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <div class="user-box">
                                        <input type="text" name="ads_hospital" id="ads_hospital" class="input-address" placeholder="Nome della struttura" />
                                        <span class="text-danger" id="err_hospital"><?php echo form_error('ads_hospital'); ?></span>
                                    </div>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Indirizzo <b>*</b><span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <div class="user-box">
                                        <input type="text" name="ads_address" id="ads_address" class="input-address" placeholder="Indirizzo" />
                                        <span class="text-danger" id="err_address"><?php echo form_error('ads_address'); ?></span>
                                    </div>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Città <b>*</b><span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <input type="text" name="ads_city" id="ads_city" class="input-address" placeholder="Città" />
                                    <span class="text-danger" id="err_city"><?php echo form_error('ads_city'); ?></span>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Provincia <b>*</b><span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <input type="text" class="input-address" name="ads_province" id="ads_province" placeholder="Provincia"  />
                                    <span class="text-danger" id="err_province"><?php echo form_error('ads_province'); ?></span>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                            <!-- <div class="user_box">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Address Formatted <b>*</b><span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <div class="user-box">
                                        <input type="text" class="input-address" name="ads_address_format" id="ads_address_format" placeholder="Address Formatted" />
                                        <span class="text-danger" id="err_address_format"><?php echo form_error('ads_address_format'); ?></span>
                                    </div>
                                </div>
                                <div class="clr"></div>
                            </div> --> <div class="clr"></div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Telefono / CUP <b>*</b><span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <input type="text" class="input-address" name="ads_telephone" id="ads_telephone" maxlength="10" placeholder="Telefono / CUP" />
                                    <span class="text-danger" id="err_telephone"><?php echo form_error('ads_telephone'); ?></span>
                                </div>
                                <div class="clr"></div>
                            </div> <div class="clr"></div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Fax <span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <div class="user-box">
                                        <input type="text" class="input-address" id="ads_fax" name="ads_fax" placeholder="Fax" />
                                        <span class="text-danger" id="err_fax"><?php echo form_error('ads_fax'); ?></span>
                                    </div>
                                </div>
                                <div class="clr"></div>
                            </div> <div class="clr"></div>

                            <div class="user_box">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Sito internet <b>*</b><span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <input class="input-address" type="text" id="ads_website" name="ads_website" placeholder="ex www.abc.it/prenota" />
                                    <span class="text-danger" id="err_website"><?php echo form_error('ads_website'); ?></span>
                                </div>
                                <div class="clr"></div>
                            </div> <div class="clr"></div>
                            <div class="user_box">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt bro-bb">Logo <b>*</b><span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <div class="user-box">
                                     <!-- <input  type="file" name="ads_image" id="ads_image" />-->
                                     
                                     <div class="upload-block">
                                        <input type="file" style="visibility:hidden; height: 0;" name="ads_image" id="ads_image"/>
                                        <div class="input-group ">
                                            <input type="text" class="form-control file-caption  kv-fileinput-caption" disabled="disabled"/>
                                            <div class="btn btn-primary btn-file btn-gry">
                                                <a class="file" onclick="browseImage(this)">Sfoglia)</a>
                                            </div>
                                            <div class="btn btn-primary btn-file btn-file-remove remove" style="border-right:1px solid #fbfbfb !important;display:none;">
                                                        <a class="file" onclick="removeBrowsedImage(this)"><i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                            </div>
                                        </div>
                                   <span class="text-danger" id="err_image"><?php echo form_error('ads_image'); ?></span>
                                    </div>
                                    </div>
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="clr"></div>
                          </div></div> <div class="clr"></div>
                        </div>
                        <div class="raio1 "> <input class="radio_file" type="radio" name="add_type" id="add" value="add" checked> Aggiungi un esame</div>
                        <div class="raio1 "> <input class="radio_file" type="radio" name="add_type" id="by_file" value="by_file"> Aggiungi una lista di esami</div>
                        <label  class="label-txt">2. Decidi quanto spendere </label>
                            <div class="edit-div">
                               <div class="location col-lg-9" style="cursor:pointer;" id="edit_budget">
                                  <div class="loc-div">Il tuo budget</div>
                                  <div class="edit-pencil" ><a><i class="fa fa-pencil"></i></a></div>
                                  <input type="hidden" id="total_amount" value=0 >
                                  <div class="loc-address"><a id="total_amt">€ 100.00 al giorno max  </a> </div>
                                  <div class="clr"></div>
                               </div>
                               <div class="clr"></div>
                               <div class="location-hide" id="budget_div" style="display:none;">
                                  <div class="loc-div hidden-xs hidden-sm">&nbsp;</div>
                                  <div class="loc-address">
                                     <a href="#">Specifica quanto vuoi spendere al massimo ogni giorno. Ti verranno addebitati solo i click che riceverai sui tuoi risultati</b>  </a>
                                     <div class="div-radio">
                                    <div class="raio1"> <input type="radio" name="budget_type" id="single_budget" value="single_budget" checked> Budget singolo</div>
                                     <div class="raio1" id="budget_mult"> <input type="radio" name="budget_type" id="multiple_budget" value="multiple_budget"> Budget per prestazione</div>
                                     </div>
                                     <div id="price_min_mix">
                                     <div class="price-min-mix" style="margin-bottom: 10px;">
                                        <!--  <button class="inr-bx"> INR ₹</button>-->
                                        <div class="gry-bx select-style user-box inr-bx" style="margin-right: 0px;">
                                            <input type="text" name="currency" id="currency" placeholder="EURO" value="EURO" readonly class="input-address inr-input"/> 
                                           <!-- <select class="frm-select fnt" name="currency" id="currency">
                                              <?php if(count($getCurrency)>0)
                                                    {
                                                       foreach ($getCurrency as $currency)
                                                       { ?>
                                                           <option value="<?php echo $currency['currency_id'];?>"> <?php echo $currency['currency_code'];?></option>
                                              <?php    }
                                                    }
                                               ?>
                                           </select> -->
                                        </div>
                                        <input type="text" name="amount" id="amount" placeholder="10" class="input-address inr-input"/> 
                                        al giorno
                                        <div class="clr"></div>
                                        <span class="text-danger" id="err_amount"><?php echo form_error('amount'); ?></span>
                                     </div>
                                     <div class="gray-text">Puoi sempre cambiare il totale. La moneta (euro) utilizzata non può esseremodificata</div>
                                     <button class="bg-btn" id="save_amount" type="button" > Salva</button>
                                     <button class="bg-btn" id="cancel_amount" type="button"> Cancella</button>
                                 </div>
                                  </div>
                               </div>
                               <div class="clr"></div>
                            </div>
                        
                          <label  class="label-txt">3. Examinations</label>

                            <div class="edit-div" id="file_div" style="display:none;">
                                <div class="user_box">
                                    <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                        <label for="" class="label-txt bro-bb">File <b>*</b><span></span>
                                        </label>
                                    </div>
                                    <div class="col-sm-8 col-md-7 col-lg-7">
                                        <div class="user-box">
                                         <div class="upload-block">
                                            <input type="file" style="visibility:hidden; height: 0;" name="ads_file" id="ads_file"/>
                                            <div class="input-group ">
                                                <input type="text" class="form-control file-caption  kv-fileinput-caption" disabled="disabled"/>
                                                <div class="btn btn-primary btn-file btn-gry">
                                                    <a class="file" onclick="browseFile(this)">Browse...</a>
                                                </div>
                                                <div class="btn btn-primary btn-file btn-file-remove remove" style="border-right:1px solid #fbfbfb !important;display:none;">
                                                    <a class="file" onclick="removeBrowsedImage(this)"><i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                       <span class="text-danger" id="err_file"><?php echo form_error('ads_file'); ?></span>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                                <div class="clr"></div>
                            </div>
                          <div id="exam_div_file" >
                          <div class="edit-div exam_div" id="exam_div">
                            <div class="location" >
                              <div class="location" >
                              
                              <div class="user_box col-lg-6">
                               <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Tipo di prestazione<span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <div class="user-box">
                                      <input class="input-address exam_type" type="text" name="exam_type[]" id="exam_type" />
                                      <span class="text-danger err_exam_type" id="err_exam_type"><?php echo form_error('exam_type'); ?></span>
                                    </div>
                                </div>
                                <div class="clr"></div>
                                </div>
                            </div>
                          
                         <div class="user_box col-lg-6">
                               <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Tempo di attesa<span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <div class="user-box">
                                      <input class="input-address official_waiting_days" type="number" name="official_waiting_days[]" id="official_waiting_days" />
                                      <span class="text-danger err_official_waiting_days" id="err_official_waiting_days"><?php echo form_error('official_waiting_days'); ?></span>
                                    </div>
                                </div>
                                <div class="clr"></div>
                             </div>
                            </div>
                           
                            <div class="user_box col-lg-6">
                               <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Costo della prestazione<span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <div class="user-box">
                                      <input class="input-address exam_price" type="number" name="exam_price[]" id="exam_price" />
                                      <span class="text-danger err_exam_price" id="err_exam_price"><?php echo form_error('exam_price'); ?></span>
                                    </div>
                                </div>
                                <div class="clr"></div>
                               </div>
                            </div>
                                  
                            <div class="user_box col-lg-6" id="exam_budget_div" style="display:none;">
                               <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-5 col-lg-push-1">
                                    <label for="" class="label-txt">Budget<span>:</span>
                                    </label>
                                </div>
                                <div class="col-sm-8 col-md-7 col-lg-7">
                                    <div class="user-box">
                                      <input class="input-address exam_budget" onChange="chngamt(this)" type="number" name="exam_budget[]" id="exam_budget" />
                                      <span class="text-danger err_exam_budget" id="err_exam_budget"><?php echo form_error('exam_budget'); ?></span>
                                    </div>
                                </div>
                                <div class="clr"></div>
                            </div>
                        </div>
                        <div class="clr"></div>
                        </div>
                    </div>
                </div>
                   <div class="clr"></div>
                    <div class="user_box text-right " id="remove_btn" style="display:none;">  <button data-id="1" onclick="return remove_btn(this);" class="bg-btn remove_class" id="btn_remove1" type="button"> Remove Exam</button></div>
               
                <div class="user_box text-right" >  <button class="bg-btn" id="add_exam_div" type="button"> Aggiungi</button></div>
                 </div>
               <div class="clr"></div>
                <div class="m-top">
                    <button class="bg-btn" id="save_add_details" name="btn_step2" type="submit">Salva e continua</button>
                </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    <!--step one end here-->
</form>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMqS0pCvSx6yV0zJ1tAIWFSOQiq1yV16Y&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/store.min.js'; ?>"></script>
<script type="text/javascript">


function remove_btn(obj)
{
    if($('.exam_div').length>1)
    {

      $(obj).closest('.exam_div').remove();  
    }
        
}
$('.radio_file').click(function(){
  var type = $(this).val();
  if(type.trim() == 'by_file')
  {
    $('#exam_div_file').hide();
    $('#file_div').show(); 
    $('#budget_mult').hide();
    document.getElementById('single_budget').checked = true;   
    $('#price_min_mix').show();
    $('#exam_budget_div').hide();

 }
  else
  {
    $('#exam_div_file').show();
    $('#file_div').hide();
    $('#budget_mult').show();

  }
})



google.maps.event.addDomListener(window, 'load', function() {
        var places = new google.maps.places.Autocomplete(document
            .getElementById('ads_address'));
        google.maps.event.addListener(places, 'place_changed', function() {
            var place = places.getPlace();
            var address = place.formatted_address;
            var mesg = address;
            document.getElementById("ads_address").value = mesg;

        });
    });

    $('#edit_budget').on('click', function() {
        $('#budget_div').toggle('show');
        
    });

    $('#cancel_location').on('click', function() {
        $('#location_div').hide();
    });
    $('#cancel_keywords').on('click', function() {
        $('#keywords_div').hide();
    });
    $('#cancel_adv').on('click', function() {
        $('#advertise_div').hide();
    });
    $('#cancel_amount').on('click', function() {
        $('#budget_div').hide();
    });
    

    $('#save_amount').on('click', function() {
        var amount = $('#amount').val();
        if (amount == '') 
        {
            $('#err_amount').text('Please enter budget amount');
            return false;
        } 
        else 
        {
            $('#total_amt').text('$ '+amount+'.00 per day average');
            $('#budget_div').hide();
        }
    });

    $("input[type='radio'][name='budget_type']").on('change',function(){
        var budget_type = $(this).val();
        if(budget_type == 'multiple_budget')
        {
            $('#exam_budget_div').show(); 
            $('#price_min_mix').hide();
        }
        else if(budget_type == 'single_budget')
        {
            $('#price_min_mix').show();
            $('#exam_budget_div').hide();
        }
        
    });
    $(document).on('keydown', '#ads_telephone', function(e) {
        if((e.keyCode >= 65 && e.keyCode <= 122)  &&  !(e.keyCode >= 96 && e.keyCode <= 105) ) { 
            e.preventDefault();
        }
    });
    $(document).on('keydown', '#amount', function(e) {
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

    $('#save_add_details').on('click', function() {
        var ads_hospital = $('#ads_hospital').val();
        var ads_address  = $('#ads_address').val();
        var ads_city     = $('#ads_city').val();
        var ads_province = $('#ads_province').val();
        //var ads_address_format = $('#ads_address_format').val();
        var ads_telephone = $('#ads_telephone').val();
        var ads_fax      = $('#ads_fax').val();
        var ads_website  = $('#ads_website').val();
        var ads_image    = $('#ads_image').val();
        var ext_a = ads_image.substring(ads_image.lastIndexOf('.') + 1);
        var site_filter  = /^(http|https|ftp):\/\/(www+\.)?[a-zA-Z0-9]+\.([a-zA-Z]{2,4})\/?/;
        var amount = $('#amount').val();
        var exam_budget = $("input[type='radio'][name='budget_type']:checked").val();
        var type  = $("input[type='radio'][name='add_type']:checked").val();
        
        var flag = 1;

        if(ads_hospital == '')
        {
          $('#err_hospital').text('Please enter hospital name.');
          flag = 0;
        }
        else 
        {
          $('#err_hospital').text('');
        }
        if(ads_address == '')
        {
          $('#err_address').text('Please enter address.');
          flag = 0;
        }
        else 
        {
          $('#err_address').text('');
        }
        if(ads_city == '')
        {
          $('#err_city').text('Please enter city.');
          flag = 0;
        }
        else 
        {
          $('#err_city').text('');
        }
        if(ads_province == '')
        {
          $('#err_province').text('Please enter province.');
          flag = 0;
        }
        else 
        {
          $('#err_province').text('');
        }
        if(ads_telephone == '')
        {
          $('#err_telephone').text('Please enter telephone number.');
          flag = 0;
        }
        else 
        {
          $('#err_telephone').text('');
        }
       if(ads_website == '')
        {
          $('#err_website').text('Please enter hospital website');
          flag = 0;
        }
        else if(!site_filter.test(ads_website))
        {
          $('#err_website').text('Please enter valid website URL');
          flag = 0;
        }
        else 
        {
          $('#err_website').text('');
        }
        if(ads_image == '')
        {
          $('#err_image').text('Please select some image.');
          flag = 0;
        }
        if(ads_image!='')
        {       
          if(!(ext_a == "jpg" || ext_a == "jpeg" || ext_a == "gif" || ext_a == "png" || ext_a == "GIF" || ext_a == "JPG" || ext_a == "JPEG" || ext_a == "PNG"))
            {
                 $('#err_image').html('Only jpg, png, gif, jpeg type images is allowed');
                flag=0;
            }
         }
        else 
        {
          $('#err_image').text('');
        }
        if(exam_budget == 'single_budget')
        {
            if(amount == '')
            {
                $('#budget_div').show();
                $('#err_amount').text('Please enter budget amount');
                flag = 0;
            }
            else 
            {
                $('#budget_div').show();
                $('#err_amount').text('');
            }
        }
        /*alert(type);
        return false;*/
        if( type.trim() != 'by_file')
        {
            $('.exam_div').each(function(){
                var obj = $(this);
                var exam_type = $(this).closest('.exam_div').find('.exam_type').val();
                //var common_name = $(this).closest('.exam_div').find('.common_name').val();
                var official_waiting_days = $(this).closest('.exam_div').find('.official_waiting_days').val();
                //var reporting_waiting_days = $(this).closest('.exam_div').find('.reporting_waiting_days').val();
                var exam_price = $(this).closest('.exam_div').find('.exam_price').val();
                var exam_budget1 = $(this).closest('.exam_div').find('.exam_budget').val();
                
                if(exam_type == '')
                {
                    $(this).find('#err_exam_type').text('Please enter exam type');
                    flag = 0;
                }
                else 
                {
                    $(this).find('#err_exam_type').text('');
                }
               
                if(official_waiting_days == '' || official_waiting_days ==0 || official_waiting_days <0)
                {
                    $(this).find('#err_official_waiting_days').text('Please select official waiting days');
                    flag = 0;
                }
                else 
                {
                    $(this).find('#err_official_waiting_days').text('');
                }
               
                if(exam_price == '' || exam_price == 0 || exam_price < 0)
                {
                    $(this).find('#err_exam_price').text('Please select exam price ');
                    flag = 0;
                }
                else 
                {
                    $(this).find('#err_exam_price').text('');
                }
                if(exam_budget == 'multiple_budget')
                {
                    if(exam_budget1 == '' || exam_budget1 == 0 || exam_budget1 <0)
                    {
                        $(this).find('#err_exam_budget').text('Please enter exam budget');
                        flag = 0;
                    }
                    else 
                    {
                        $(this).find('#err_exam_budget').text('');
                    }
                }

            });
        }
        else
        {

            var file_name  = $('#ads_file').val();
            var ext_f = file_name.substring(file_name.lastIndexOf('.') + 1);
            if(file_name .trim() == '' )
            {
                $('#err_file').text('Please select file');
                flag =0;
            }
            else
            {
                if(!(ext_f == "csv" ||  ext_f == "CSV" || ext_f == "xls" || ext_f == "XLS" ))
                {
                     $('#err_file').html('Only excel,csv type file is allowed');
                    flag=0;
                }

            }
        }
        

        if(flag == 0)
        {
          return false;
        }
        else 
        {
          return true;
        }

    });


  $('#add_exam_div').on('click',function(){
      var exam_type             = $('.exam_div').last().find('#exam_type').val();
      //var common_name           = $('.exam_div').last().find('#common_name').val();
      var official_waiting_days = $('.exam_div').last().find('#official_waiting_days').val();
      //var reporting_waiting_days= $('.exam_div').last().find('#reporting_waiting_days').val();
      var exam_price            = $('.exam_div').last().find('#exam_price').val();
      var exam_budget           = $('.exam_div').last().find('#exam_budget').val();
      var flag                  = 1;
      var budget_type           = $("input[type='radio'][name='budget_type']:checked").val();

      if(exam_type == '')
      {
        $('.exam_div').last().find('#err_exam_type').text('Please enter exam type');
        flag = 0;
      }
      else 
      {
        $('.exam_div').last().find('#err_exam_type').text('');
      }
     
      if(official_waiting_days == '' || official_waiting_days <=0)
      {
        $('.exam_div').last().find('#err_official_waiting_days').text('Please select official waiting days');
        flag = 0;
      }
      else 
      {
        $('.exam_div').last().find('#err_official_waiting_days').text('');
      }
      
      if(exam_price == '' || exam_price == 0 || exam_price < 0)
      {
        $('.exam_div').last().find('#err_exam_price').text('Please select exam price.'); 
        flag = 0;
      }
      else 
      {
        $('.exam_div').last().find('#err_exam_price').text('');
      }
      if(budget_type == 'multiple_budget')
      {
        if(exam_budget == '' || exam_budget == 0 || exam_budget < 0)
        {
            $('.exam_div').last().find('#err_exam_budget').text('Please select exam budget');
            flag = 0;
        }
        else 
        {
            $('.exam_div').last().find('#err_exam_budget').text('');
        }
      }
      if(flag == 0)
      {
        return false;
      }
      if(flag == 1)
      {
        //alert();
        $('.exam_div').last().find('#remove_btn').show();
        $('#exam_div').clone(true,true).find("input:text").val('').end().insertAfter("div.exam_div:last"); 
        $('.exam_div').last().find('#official_waiting_days').val('');
        //$('.exam_div').last().find('#reporting_waiting_days').val('');
        $('.exam_div').last().find('#remove_btn').show();
        $('.exam_div').last().find('#exam_price').val('');
      }
      
  });

function chngamt(ref)
{
    var exam_budget = $(ref).val();
    var total_amount = $('#total_amount').val();
    var total = 0;
    $('.exam_div').each(function(){
    var obj = $(this);
    var exam_budget1 = $(this).closest('.exam_div').find('.exam_budget').val();
    total = parseInt(total) + parseInt(exam_budget1);
    $('#total_amt').text('$ '+total+'.00 per day average');
    });

}  
    
    
    /*file upload demo*/

        function browseImage(ref)
        {
          var upload_block = $(ref).closest('div.upload-block');
          $(upload_block).find('input[type="file"]').trigger('click');
        }

        function browseFile(ref)
        {
          var upload_block = $(ref).closest('div.upload-block');
          $(upload_block).find('input[type="file"]').trigger('click');
        }
        function removeBrowsedImage(ref)
        {
          var upload_block = $(ref).closest('div.upload-block');
          
          $(upload_block).find('input.file-caption').val("");
          $(upload_block).find("div.btn-file-remove").hide();
          $(upload_block).find('input[type="file"]').val("");
        }

        $(document).ready(function()
        {
          // This is the simple bit of jquery to duplicate the hidden field to subfile
          $('div.upload-block').find('input[type="file"]').change(function()
          {
            var upload_block = $(this).closest('div.upload-block');
            if($(this).val().length>0)
            {
              $(upload_block).find("div.btn-file-remove").show();

            }

            $(upload_block).find('input.file-caption').val($(this).val());
          });
          
        });
  
    
    
</script>
