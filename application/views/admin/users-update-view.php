<div class="page-title">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">Administrator</div>
      </div>
    </div>
  </div>
<div class="spacer">
  <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo $this->session->flashdata('verify_msg'); ?>
                    </div>
                </div>
                <div class="row">
                <?php echo $this->session->flashdata('msg'); ?>
                    <form class="form-horizontal col-md-6" method="post" role="form">
                        <div class="step3">
                        <h2>Update User Profile</h2>
                        <div class="user_box">
                            <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">First Name <span> : </span> <b>*</b></label>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <input type="text" id="firstname" name="firstname" value="<?php echo ucfirst($user->firstname); ?>" placeholder="First Name" class="input-address" autofocus>
                                <span class="text-danger" id="err_firstname"><?php echo form_error('firstname'); ?></span>
                            </div>
                             <div class="clr"></div> 
                        </div>
                        <div class="user_box">
                            <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Last Name <span> : </span> <b>*</b></label>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <input type="text" id="lastname" name="lastname" value="<?php echo ucfirst($user->lastname); ?>" placeholder="Last Name" class="input-address" >
                                <span class="text-danger" id="err_lastname"><?php echo form_error('lastname'); ?></span>
                            </div>
                             <div class="clr"></div> 
                        </div>
                      <!--   <div class="user_box">
                            <label for="firstName" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Middle Name</label>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <input type="text" id="middlename" name="middlename" value="<?php echo  $user->middlename; ?>" placeholder="Middle Name" class="input-address" >
                            </div>
                             <div class="clr"></div> 
                        </div> -->
                        <div class="user_box">
                            <label for="email" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Email</label>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <input type="email" readonly value="<?php echo  $user->email; ?>" class="form-control">
                            </div>
                             <div class="clr"></div> 
                        </div>
                       
                        <div class="user_box">
                            <label for="birthDate" class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Date of Birth <span> : </span> <b>*</b></label>
                            <div class="col-sm-8 col-md-7 col-lg-7">
                                <input type="date" id="dob" name="dob" value="<?php echo  $user->dob; ?>" placeholder="Y-m-d" class="input-address datepicker">
                                <span class="text-danger" id="err_dob"><?php echo form_error('dob'); ?></span>
                            </div>
                             <div class="clr"></div> 
                        </div>
                 
                        <div class="user_box">
                            <label class="col-sm-4 col-md-3 col-lg-5 col-lg-push-1 label-txt">Gender <span> : </span> <b>*</b></label>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="radio-inline">
                                            <input type="radio" id="femaleRadio" name="gender"  <?php echo ($user->gender=='Female') ? "checked" :"" ?> value="Female">Female
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="radio-inline">
                                            <input type="radio" id="maleRadio" <?php echo ($user->gender=='Male') ? "checked" :"" ?> name="gender"  value="Male">Male
                                        </label>
                                    </div>
                                   
                                </div>
                                 <span class="text-danger" id="err_gender"><?php echo form_error('gender'); ?></span>
                            </div>
                             <div class="clr"></div> 
                        </div> <!-- /.user_box -->
                       
                  
                        <div class="user_box">
                            <div class="col-sm-8 col-md-7 col-lg-7 col-sm-offset-3">
                                <button type="submit" class="bg-btn" id="update_user" name="update_user">Update</button>
                                <button class="bg-btn" type="button" name="btn_update_cancel" id="btn_update_cancel" onclick="location.href='<?php echo base_url();?>admin'">Cancel</button>
                            </div>
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

    /* Update My Profile By Jai(12-Sept-2016)*/
$('#update_user').on('click', function() {
     
  var firstname   = $('#firstname').val();
  var lastname    = $('#lastname').val();
  var dob         = $('#dob').val();
  var gender      = $('input[name=gender]:checked').val(); 
  var name_filter = /^[a-zA-Z .]*$/;

  $('#err_firstname').html('');
  $('#err_lastname').html('');
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
  </script>