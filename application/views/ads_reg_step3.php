<style type="text/css">.ui-datepicker-calendar { display: none; } </style>

<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.payment.js"></script>
<script type="text/javascript" src="https://js.iugu.com/v2"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/formatter.6641df236f87bc55a536292d8565c870.js"></script>
<div class="process-step">
   <div class="container">
      <div class="process-bx">
         <div class="center-row">
            <div class="step_process border-line">
               <div class="active-step step_bor">
                  <div class="active_step normal_step"><img src="<?php echo base_url() ?>assets/images/process.png" alt=""/></div>
               </div>
               <div class="plan-detail left1">
                  <div class="step_title">1. Benvenuto</div>
               </div>
            </div>
            <div class="bg_i">&nbsp;</div>
            <div class="step_process border-line">
               <div class="active-step step_bor">
                  <div class="active_step normal_step"><img src="<?php echo base_url() ?>assets/images/process.png" alt=""/></div>
               </div>
               <div class="plan-detail left2">
                  <div class="step_title">2. La tua struttura</div>
               </div>
            </div>
            <div class="bg_i">&nbsp; </div>
            <div class="step_process">
               <div class="active-step step_bor">
                  <div class="active_step normal_step">3</div>
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
         <div class="col-lg-7">
            <form method="post" action="" enctype="multipart/form-data">
            <div class="step3">
               <h2>Pagamento</h2>

               <div class="cmt-step">Completa le informazioni circa le modalità di pagamento </div>
               <div class="row">
                <input type="file" name="ads_image" id="ads_image" value="" style="display:none;" >
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Paese <b>*</b> <span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <div class="gry-bx select-style user-box">
                           <select class="frm-select fnt" name="country" id="country">
                              <option value="" >--- Seleziona un Paese ---</option>
                              <?php foreach ($countries as $country)
                               {?>
                               <option value="<?php echo $country['id'];?>"><?php echo $country['name'];?></option>
                             <?php }?>
                           </select> <div class="clr"></div>
                           <span class="text-danger" id="err_country"><?php echo form_error('country'); ?></span>
                        </div>
                     </div>
                     <div class="clr"></div>
                  </div>
                  <!-- <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Tax information<span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <div class="gry-bx select-style user-box">
                           <select class="frm-select fnt" name="tax_info" id="tax_info">
                              <option value="business">Business or partnership</option>
                              <option value="individual">Individual</option>
                           </select>

                        </div>
                     </div>
                     <div class="clr"></div>
                  </div> -->
                  <!-- <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Business Name<span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" class="input-address" name="business_name" id="business_name"/>
                        <span class="text-danger" id="err_business_name"><?php echo form_error('business_name'); ?></span>
                     </div>
                     <div class="clr"></div>
                  </div> -->
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Nome completo <b>*</b><span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" class="input-address" placeholder="Nome completo" name="name" id="name"/>
                         <div class="clr"></div>
                         <span class="text-danger" id="err_name"><?php echo form_error('name'); ?></span>
                     </div>
                     <div class="clr"></div>
                  </div>
                    <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Indirizzo <b>*</b><span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <div class="gry-bx select-style user-box">
                           <select class="frm-select fnt" name="state" id="state">
                              <option value="">--- Seleziona Indirizzo  ---</option>
                           </select>
                           <div class="clr"></div>
                            <span class="text-danger" id="err_state"><?php echo form_error('state'); ?></span>
                        </div>
                     </div>
                     <div class="clr"></div>
                  </div>
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Città <b>*</b><span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <div class="gry-bx select-style user-box">
                           <select class="frm-select fnt" name="city" id="city">
                              <option value="">--- Seleziona Città ---</option>
                           </select> <div class="clr"></div>
                            <span class="text-danger" id="err_city"><?php echo form_error('city'); ?></span>
                        </div>
                     </div>
                     <div class="clr"></div>
                  </div>
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Provincia <b>*</b><span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                              <div class="user-box">
                                  <input type="text" name="bill_address" id="bill_address" class="input-address" placeholder="Indirizzo" />
                                  <span class="text-danger" id="err_bill_address"><?php echo form_error('bill_address'); ?></span>
                              </div>
                     </div>
                     <div class="clr"></div>
                  </div>
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">CAP <b>*</b> <span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" class="input-address" placeholder="Inserisci il CAP" name="postal_code" id="postal_code"/> <div class="clr"></div>
                         <span class="text-danger" id="err_postal_code"><?php echo form_error('postal_code'); ?></span>
                     </div>
                     <div class="clr"></div>
                  </div>
                
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Modalità di pagamento <b>*</b>  <span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                       <div class="gry-bx select-style user-box">
                        <select class="frm-select fnt" name="pay_method" id="pay_method">
                           <option value="automatic">Pagamento automatico (raccomandato)</option> 
                           <option value="manual">Pagamento manuale</option>
                        </select>
                        </div>
                         <div class="info-section-open">
                           <div class="arrow-i"><img src="<?php echo base_url() ?>assets/images/arrow-t.png" alt=""/></div>
                           Il servizio è attivo da subito, e tu pagherai i costi dei click
                            ricevuti al raggiungimento del budget massimo stabilito o, in
                            caso questo non venga raggiunto, dopo 30 giorni dall’ultimo
                            pagamento.
                        </div>
                     </div>
                     <div class="clr"></div>
                  </div>
                   <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Metodo di pagamento <b>*</b> <span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                                    <div class="gry-bx select-style user-box">
                        <select class="frm-select fnt" name="pay_type" id="pay_type">
                           <option value="credit">Carta di credito</option>
                           <option value="paypal">Paypal</option>
                        </select>
                         </div>
                     </div>
                     <div class="clr"></div>
                  </div>

                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <!-- <label for="" class="label-txt">What you pay with <span>:</span></label> -->
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7 credit_div">
                       <div class="row">
                           <div class="col-lg-12  user_box">
                         <input class="input-address  cc-number" type="text" placeholder="Numero di carta" name="card_number" id="card_number"/>
                        <span class="text-danger" id="err_card_number"><?php echo form_error('card_number'); ?></span>
                           </div>
                        <div class="col-lg-6  user_box">
                            <input  name= "exp_date" id="exp_date"class="input-address cc-exp date-picker" type="text" placeholder=" MM/AAAA"/>
                            <span class="text-danger" id="err_exp_date"><?php echo form_error('exp_date'); ?></span>
                           </div>
                           <div class="col-lg-6  user_box">
                            <input name= "cvv" id="cvv" class="input-address cc-cvc" type="text" placeholder="CVV"/>
                            <span class="text-danger" id="err_cvv"><?php echo form_error('cvv'); ?></span>
                           </div>
                        </div>
                        <input name="holder_name" id="holder_name" class="input-address " type="text" placeholder="Titolare della carta"/>
                        <input type="hidden" name="cart_type" id="card_type" >
                        <span class="text-danger" id="err_holder_name"><?php echo form_error('holder_name'); ?></span>
                     </div>
                     
                     <div class="clr"></div>
                  </div>
                   
                  <!-- <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Time Zone <span>:</span></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">

                        <div class="gry-bx select-style user-box">
                           <select class="frm-select fnt" name="timezone" id="timezone">
                            <option value="">--Select timezone--</option>
                    <?php  foreach ($idents as $aa) 
                          {
                             $date = new DateTime(null, new DateTimeZone($aa));
                             $d1 =$date->format('Y-m-d H:i:s');
                             ///$time = $aa.": ".$date= date('D, Y-d-F h:i A',strtotime($d1)) ;
                           ?>
                              <option value="<?php echo $aa;?>"><?php echo $aa;?></option>
                     <?php }?>
                           </select> <div class="clr"></div>
                            <span class="text-danger" id="err_timezone"><?php echo form_error('timezone'); ?></span>
                        </div>
                     </div>
                     <div class="clr"></div>
                  </div> -->
               
                  <div class="col-lg-push-5 col-sm-5 m-top">
                     <button class="bg-btn" type="submit" name="btn_register_user" id="btn_register_user">Salva e continua</button>
                  </div>
               </div>
            </div>
         </form>
         </div>
      </div>
   </div>
</div>





 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMqS0pCvSx6yV0zJ1tAIWFSOQiq1yV16Y&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/store.min.js'; ?>"></script>
<script type="text/javascript">



google.maps.event.addDomListener(window, 'load', function() {
        var places = new google.maps.places.Autocomplete(document
            .getElementById('bill_address'));
        google.maps.event.addListener(places, 'place_changed', function() {
            var place = places.getPlace();
            var address = place.formatted_address;
            var mesg = address;
            document.getElementById("bill_address").value = mesg;

        });
    });
</script>

<script type="text/javascript" src="<?php echo base_url().'assets/js/store.min.js'; ?>"></script>
<script type="text/javascript" >
 $('.cc-number').payment('formatCardNumber');
 $('.cc-exp').payment('formatCardExpiry');
 $('.cc-cvc').payment('formatCardCVC');

</script>


<!--step one end here-->

