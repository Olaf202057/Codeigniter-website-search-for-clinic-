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
               <div class="step_bor">
                  <div class="normal_step">2</div>
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
         <?php if($this->session->flashdata('success')!='') {?>
            <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
            <?php } else if($this->session->flashdata('error')!=''){?>
            <div class="alert alert-danger text-center"><?php echo $this->session->flashdata('error');?></div>
         <?php } ?>
         <div class="col-lg-6">
            <div class="step1">
               <h2>Benvenuto in Medscanner!</h2>
               <div class="cmt-step">Ti aiuteremo a registrarti e ad indicizzare la tua
               struttura in pochi passi. <a href="#">Skip the guided set-up.</a>
               </div>
               <form method="get" action="">
               <div class="user_box">
                  <label for="" class="label-txt">Qual’è il tuo indirizzo email?</label>
                  <input type="hidden" class="input-address" name="email_value" id="email_value" value="valid"/>
                  <input type="text" class="input-address" name="user_email" id="user_email"/>
                  <div class="email-bx exist_email" style="display:none;">This email is already associated with an AdWords account. to create a new 
                     account enter a different email address . To sign in to your existing account, click 
                     Continue
                  </div>
                  <span class="text-danger" id="err_user_email"></span>
                  <br>
                  <a href="<?php echo base_url();?>accesso" class="bg-btn continue_btn login_btn" style="display:none;">Continua</a>
                  <button type="submit" class="bg-btn continue_btn" id="btn_step1" name="btn_step1">Continua</button>
               </div>
             </form>
            </div>
         </div>
      </div>
   </div>
</div>

