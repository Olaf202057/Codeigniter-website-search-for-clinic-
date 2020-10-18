

 
<!--step one start here-->
<div class="spacer">
<div class="container">
   <div class="">
    <div class="row">
      <?php $this->load->view('user-menu'); ?>  
       <?php if($this->session->flashdata('success')!='') {?>
            <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
            <?php } else if($this->session->flashdata('error')!=''){?>
            <div class="alert alert-danger text-center"><?php echo $this->session->flashdata('error');?></div>
         <?php } ?>
         <div class="col-lg-7">
            <form method="post" action="" enctype="multipart/form-data">
            <div class="step3">
               <h2>Indirizzo fatturazione</h2>
              
              <!--  <div class="cmt-step">Set your preference for when and how you'll pay for your ads. </div> -->
               <div class="row">
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Paese <span> : </span><b>*</b></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <div class="gry-bx select-style user-box">
                           <select class="frm-select fnt" name="country" id="country">
                              <option value="" >--- Seleziona un Paese ---</option>
                              <?php if(count($countries)>0)
                                    {
                                      foreach ($countries as $country)
                                     { ?>
                                     <option value="<?php echo $country['id'];?> " <?php if($billing_info[0]['country'] == $country['id']){ echo "selected='selected'";}?>><?php echo $country['name'];?></option>
                             <?php   }
                                    }?>
                           </select> <div class="clr"></div>
                           <span class="text-danger" id="err_country"><?php echo form_error('country'); ?></span>
                        </div>
                     </div>
                     <div class="clr"></div>
                  </div>
                  
                  <?php $states = $this->master_model->getRecords('states',array('country_id'=>$billing_info[0]['country']));//print_r($states); exit(); ?>
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Indirizzo <span> : </span><b>*</b></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <div class="gry-bx select-style user-box">
                           <select class="frm-select fnt" name="state" id="state">
                              <option value="">---Seleziona Indirizzo  ---</option>
                              <?php if(count($states)>0)
                                  {
                                    foreach ($states as $state)
                                    { ?>
                                      <option value="<?php echo $state['id'];?>" <?php if($billing_info[0]['state'] == $state['id']){ echo "selected='selected'";}?>><?php echo $state['name'];?></option>
                             <?php  }
                                  }?>
                           </select>
                           <div class="clr"></div>
                            <span class="text-danger" id="err_state"><?php echo form_error('state'); ?></span>
                        </div>
                     </div>
                     <div class="clr"></div>
                  </div>

                   <?php $cities = $this->master_model->getRecords('cities',array('state_id'=>$billing_info[0]['state']));//print_r($states); exit(); ?>
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Città <span> : </span> <b>*</b></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <div class="gry-bx select-style user-box">
                           <select class="frm-select fnt" name="city" id="city">
                              <option value="">--- Seleziona Città ---</option>
                              <?php if(count($cities)>0)
                                  {
                                    foreach ($cities as $city)
                                    { ?>
                                      <option value="<?php echo $city['id'];?>" <?php if($billing_info[0]['city'] == $city['id']){ echo "selected='selected'";}?>><?php echo $city['name'];?></option>
                             <?php  }
                                  }?>
                           </select> <div class="clr"></div>
                            <span class="text-danger" id="err_city"><?php echo form_error('city'); ?></span>
                        </div>
                     </div>
                     <div class="clr"></div>
                  </div>
                   <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Indirizzo <span> : </span> <b>*</b></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                          <div class="gry-bx select-style user-box">
                                  <input type="text" name="bill_address" id="bill_address" class="input-address" placeholder="Indirizzo" value="<?php echo $billing_info[0]['address']?>" />
                                  <span class="text-danger" id="err_bill_address"><?php echo form_error('bill_address'); ?></span>
                          </div>
                          <span class="text-danger" id="err_city"><?php echo form_error('city'); ?></span>
                      </div>
                     <div class="clr"></div>
                  </div>

                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">CAP <span> : </span><b>*</b></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="text" class="input-address" placeholder="Enter postal code" name="postal_code" id="postal_code" value="<?php if(isset($billing_info[0]['postal_code'])){echo $billing_info[0]['postal_code'];}?>"/>
                         <div class="clr"></div>
                         <span class="text-danger" id="err_postal_code"><?php echo form_error('postal_code'); ?></span>
                     </div>
                     <div class="clr"></div>
                  </div>
                
             
                
                  <div class="col-lg-push-5 col-sm-5 m-top">
                    <button class="bg-btn" type="submit" name="btn_update_billing_details" id="btn_update_billing_details">Aggiorna</button>
                    <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>ads/dashboard'">Ignora</button>
                   
                  </div>
               </div>
            </div>
         </form>
         </div>
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
            var value = address.split(",");
            count = value.length;
            country = value[count - 1];
            state = value[count - 2];
            city = value[count - 3];
            var z = state.split(" ");
            document.getElementById("selCountry").text = country;
            var i = z.length;
            document.getElementById("pstate").value = z[1];
            if (i > 2)
                document.getElementById("pzcode").value = z[2];
            document.getElementById("pCity").value = city;
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            var mesg = address;
            document.getElementById("bill_address").value = mesg;

        });
    });
</script>