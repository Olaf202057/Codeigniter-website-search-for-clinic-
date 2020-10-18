<?php $id   = $this->session->userdata('user')->id;
   
$info = $this->master_model->getRecords('users',array('id'=>$id));
if((isset($info)) && (count($info)>0))
{
  if($info[0]['role']==1)
  {?>
    <div class="page-title">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">Administrator</div>
      </div>
    </div>
  </div>
  <?php } 
  }?>
<style type="text/css">
    .file_button_container,
  .file_button_container input {
       height: 47px;
       width: 263px;
       cursor: pointer;
   }

   .file_button_container {
       background: transparent url(<?php echo base_url()?>assets/img/btn-button.png) left top no-repeat;
   }

   .file_button_container input {
       opacity: 0;
   }
</style>
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
               <h2>Cambia password</h2>
              
              <!--  <div class="cmt-step">Set your preference for when and how you'll pay for your ads. </div> -->
               <div class="row">
                  <?php if(($user[0]['password'] != ''))
                  { 
                    $flag =0 ?>
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Vecchia password <span> : </span> <b>*</b></label>
                     </div>
                     <input type="hidden" name="user_type" id="user_type" value="<?php echo $this->session->userdata('user')->id;?>">
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="password" class="input-address" name="currentpassword" id="currentpassword" value="" placeholder="Vecchia password" />
                        <span class="text-danger" id="err_currentpassword"><?php echo form_error('currentpassword'); ?></span>
                     </div>
                    <div class="clr"></div> 
                  </div>
                  <?php }else{
                    $flag =1;
                  }
                   ?>
               
                <input type="hidden" name="user_type" id="user_type" value="<?php echo $flag;?>">
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Nuova password<span> : </span><b>*</b></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="password" class="input-address" placeholder="Nuova password" name="newpassword" id="newpassword" value=""/>
                         <div class="clr"></div>
                         <span class="text-danger" id="err_newpassword"><?php echo form_error('newpassword'); ?></span>
                     </div>
                     <div class="clr"></div>
                  </div>
                  
                  <div class="user_box">
                     <div class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1">
                        <label for="" class="label-txt">Conferma password <span> : </span><b>*</b></label>
                     </div>
                     <div class="col-sm-8 col-md-7 col-lg-7">
                        <input type="password" class="input-address" placeholder="Conferma password" name="confirmpassword" id="confirmpassword" value=""/>
                         <div class="clr"></div>
                         <span class="text-danger" id="err_confirmpassword"><?php echo form_error('confirmpassword'); ?></span>
                     </div>
                     <div class="clr"></div>
                  </div>
                  <div class="col-lg-push-5 col-sm-5 m-top">
                    <button class="bg-btn" type="submit" name="btn_update_password" id="btn_update_password">Aggiorna</button>
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