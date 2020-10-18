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
<div class="spacer">
  <div class="container">
                <div class="row">
                 <?php $this->load->view('user-menu'); ?>  
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo $this->session->flashdata('verify_msg'); ?>
                    </div>
                </div>
             <?php if($this->session->flashdata('success')!='') {?>
              <div class="alert alert-success text-center"><?php echo $this->session->flashdata('success');?></div>
              <?php } else if($this->session->flashdata('error')!=''){?>
              <div class="alert alert-danger text-center"><?php echo $this->session->flashdata('error');?></div>
              <?php } ?>
        
                <?php echo $this->session->flashdata('msg'); ?>
                <div class="row">
                    <form class="form-horizontal col-md-6" method="post" role="form" action="<?php echo base_url();?>home/myaccount">
                        <h2>Account</h2>
                        <div class="step3">
                        <?php if((isset($user_info)) && (count($user_info)>0)){?>
                        <div class="user_box">
                            <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Nome <span> : </span> <b>*</b></label>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <input type="text" class="input-address"  name="firstname" id="firstname" value="<?php echo ucfirst($user_info[0]['firstname']);?>" placeholder="Nome" class="form-control">
                                 <span class="text-danger" id="err_firstname"><?php echo form_error('firstname'); ?></span>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="user_box">
                            <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Cognome <span> : </span> <b>*</b></label>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <input type="text" class="input-address" name="lastname" id="lastname" value="<?php echo ucfirst($user_info[0]['lastname']); ?>" placeholder="Cognome" class="form-control" >
                                 <span class="text-danger" id="err_lastname"><?php echo form_error('lastname'); ?></span>
                            </div>
                             <div class="clr"></div>
                        </div>
                        <div class="user_box">
                            <label for="email" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Email <span> : </span> <b>*</b></label>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <input type="text" id="email" class="input-address" name="email" value="<?php echo $user_info[0]['email']; ?>" class="form-control" placeholder="Indirizzo email">
                                 <span class="text-danger" id="err_email"><?php echo form_error('email'); ?></span>
                            </div>
                             <div class="clr"></div>
                        </div>
                       
                        <div class="user_box">
                            <label for="birthDate" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Data di nascita <span> : </span> <b>*</b></label>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <input type="text" class="input-address datepicker form-control" name="dob" id="dob" value="<?php echo $user_info[0]['dob'] ?>" placeholder="gg/mm/aaaa">
                                 <span class="text-danger" id="err_dob"><?php echo form_error('dob'); ?></span>
                            </div>
                             <div class="clr"></div>
                        </div>
                 
                        <div class="user_box">
                            <label class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Sesso <span> : </span> <b>*</b></label>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="radio-inline">
                                            <input type="radio" id="femaleRadio" name="gender"  <?php echo ($user_info[0]['gender']=='Female') ? "checked" :"" ?> value="Female">Femmina
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="radio-inline">
                                            <input type="radio" id="maleRadio" <?php echo ($user_info[0]['gender']=='Male') ? "checked" :"" ?> name="gender"  value="Male">Maschio
                                        </label>
                                    </div>
                                </div>
                                <span class="text-danger" id="err_gender"><?php echo form_error('gender'); ?></span>
                            </div>
                             <div class="clr"></div>
                        </div> <!-- /.form-group -->
                       
                        <?php }?>
                        <div class="user_box">
                            <div class="col-sm-9 col-sm-offset-3">
                                 <button type="submit" class="bg-btn btn_myaccount" name="btn_myaccount" id="btn_myaccount">Aggiorna</button>
                                 <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>ads/dashboard'">Ignora</button> 
                            </div>
                             <div class="clr"></div>
                        </div>
                        </div>
                    </form> <!-- /form -->
                 </div>
        </div> <!-- ./container -->
</div>

<script type="text/javascript">
    $(function () {
      $("#dob").datepicker({
         dateFormat: 'Y-m-d'
      });
  });


    /*---Seema(29-June-2016)--validate duplicate email id*/
$('#email').blur(function(){
//alert('test');
  var email = $('#email').val();
  $.ajax({

    url : base_url+'ajax/dup_emailaddress',
    data: {email:email},
    type:'POST',
    success:function(res)
    {
      if($.trim(res)=='exist')
      {
         $('#err_email').html('Email already exist');
         return false;
      } else { return true; }
    }
  });
});

</script>