<div class="spacer header-content">
  <div class="container">

  <div class="col-md-4 "></div>
  <div class="col-md-4 centered login-box-body" style="margin:0 auto;">
    <p class="login-box-msg">Inserisci le tue credenziali:</p>
    <?php echo $this->session->flashdata('msg'); ?>
    <?php echo $err_msg ?>
    <form  method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
       <span class="text-danger" id="err_email"><?php echo form_error('email'); ?></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <span class="text-danger" id="err_password"><?php echo form_error('password'); ?></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Ricordami
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="btn_login">Accedi</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- href="<?php echo base_url('hauth/login/Facebook') ?>"  href="<?php echo base_url('hauth/login/Google') ?>" -->
    <div class="social-auth-links text-center">
      <p>- O -</p>
      <a id="btn_fb_login"  class="btn btn-block btn-social btn-facebook btn-flat fb-btn"><i class="fa fa-facebook"></i> Accedi con  Facebook</a>
      <button class="btn btn-block btn-social btn-google btn-flat gplus-btn g-signin google-btn" 
        data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email "
        data-requestvisibleactions="http://schemas.google.com/AddActivity"
        data-clientId="966120681057-mgohb8b7rr643lg1js1ciqm4oorst2dj.apps.googleusercontent.com"
        data-accesstype="offline"
        data-callback="mycoddeSignIn"
        data-theme="dark"
        data-cookiepolicy="single_host_origin" class="btn btn-block btn-social btn-google btn-flat gplus-btn"><i class="fa fa-google-plus"></i> Accedi con Google+ </button>
    </div>
    <!-- /.social-auth-links -->

    <a href="#" data-toggle="modal" style="color:#fff;" data-target="#reset-modal" >Ho dimenticato la password</a><br>
    <a href="<?php echo base_url() ?>registration" style="color:#fff;"  class="text-center">Registrati</a>
   <!--  <a href="<?php echo base_url() ?>ads" style="color:#fff;"  class="text-center">Registrati</a> -->
  </div>
  <div class="col-md-4 "></div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="reset-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
      </div>
      <div class="modal-body">
        <form  method="post" id="frm-forgot-password">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email">
           
          </div>
   
        </form>
        <div class="msg"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="btn-forgot-password" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
  .fb-btn{
     background-color: #3b5998;
    color: #fff;
  }
  .gplus-btn{
     background-color: #d34836;
    color: #fff;
  }
</style>

<script src="https://plus.google.com/js/client:plusone.js"></script>
<script src="https://apis.google.com/js/api:client.js"></script>
<script type="text/javascript">

var site_url = '<?php echo base_url(); ?>';
/*Login With FB Script starts here*/
    /*Load Facebook Base URL*/
    window.fbAsyncInit = function() {
        //Initiallize the facebook using the facebook javascript sdk
        FB.init({
            appId: '<?php $this->config->load("facebook"); echo $this->config->item("appID");?>', // App ID 
            // appId:'963588753682463',
            cookie: true, // enable cookies to allow the server to access the session
            status: true, // check login status
            xfbml: true, // parse XFBML
            oauth: true //enable Oauth 
        });
    };
    //Read the baseurl from the config.php file
    (function(d) {
        
        var js, id = 'facebook-jssdk',
            ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = site_url+"assets/js/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));
    
    jQuery('#btn_fb_login').click(function(e) {
    e.preventDefault();
        FB.login(function(response) {
            if (response.authResponse) {
                FB.api('/me', 'get', {
                    fields: 'id,email,first_name,last_name,birthday'
                }, function(response) {
                    var email = response.email;
                    var fname = response.first_name;
                    var lname = response.last_name;
                    var userid =response.id;
                    FB.api('/me/picture?type=normal', function(response) {
                      
                        var site_url = "<?php echo base_url(); ?>";
                        var datastr = "email="+email+"&fname="+fname+"&lname="+lname+"&userid="+userid;
                        jQuery.ajax({
                            url: site_url + 'dashboard/fb_login',
                            type: 'POST',
                            data: datastr,
                            dataType:'json',
                            success: function(response) {
                             if (response.result == "success") 
                                {
                                    window.location.href = site_url+'home/myaccount';
                                }
                                else if(response.result == 'registration_error')
                                {
                                    $('#error_div_comm').text(response.message);
                                    $('#error_div_comm').show();
                                    $('#success_div').hide();
                                }
                                else if(response.result == "error")
                                {
                                     $('#error_div1_comm').text(response.message);
                                     $('#error_div1_comm').show();
                                     $('#success_div').hide();
                                }
                                else if(response.result == 'login_success')
                                {
                                    window.location.href = site_url+'home/myaccount';
                                }
                                
                                return false;
                            }
                        });
                    });
                    return false;
                });
            }
        }, {
            scope: 'public_profile,email'
        }); //permissions for facebook
      
    });

/*Login With FB Script Ends Here*/

/*Google Login Script Starts Here*/
var gpclass = (function(){
    
    //Defining Class Variables here
    var response = undefined;
    return {
        //Class functions / Objects
        
        mycoddeSignIn:function(response){
            if (response['status']['signed_in'] && response['status']['method'] == 'PROMPT') {
                  // User clicked on the sign in button. Do your staff here.
                  gapi.client.load('plus','v1',this.getUserInformation);
              }
            // The user is signed in
            else if (response['access_token']) {
            
                //Get User Info from Google Plus API
                //gapi.client.load('plus','v1',this.getUserInformation);
                
            } else if (response['error']) {
                // There was an error, which means the user is not signed in.
                //alert('There was an error: ' + authResult['error']);
            }
        },
        
        getUserInformation: function(){
            var request = gapi.client.plus.people.get( {'userId' : 'me'} );
            var rdo_val = $('input[name="customer_type1"]:checked').val();
            request.execute( function(profile) {
                var email = profile['emails'].filter(function(v) {
                    return v.type === 'account'; // Filter out the primary email
                })[0].value;
                var fName = profile.displayName;
                var datastr="&email="+email+"&name="+fName+'&user='+rdo_val;
                if(email!="" && fName!="")
                {
                    $.ajax({
                          url:site_url+'dashboard/gplogin',
                          type:'POST',
                          data:datastr,
                          dataType:'json',
                          success:function(response)
                          {
                            if (response.result == "success") 
                            {
                                window.location.href = site_url+'home/myaccount';
                            }
                            else if(response.result == 'registration_error')
                            {
                                $('#error_div').text(response.message);
                                $('#error_div').show();
                                $('#error_div').focus();
                                $('#success_div').hide();
                            }
                            else if(response.result == "error")
                            {
                                 //fbLogoutUser_alt();
                                 $('#error_div1').text(response.message);
                                 $('#error_div1').show();
                                 $('#error_div1').focus();
                                 $('#success_div').hide();
                                 //window.location.href = site_url;
                                 //window.location.reload();
                            }
                            else if(response.result == 'login')
                            {
                                $('#success_div').text(response.message);
                                $('#success_div').show();
                                $('#error_div').hide();
                                window.location.href = site_url+'home/myaccount';
                                //$('#logout_url').attr('href',response.logout_url);
                                //window.location.href = site_url;
                                 
                            }
                          }
                    });
                }
                
            });
        }
    
    }; //End of Return
    })();
    
    function mycoddeSignIn(gpSignInResponse){
        gpclass.mycoddeSignIn(gpSignInResponse);
    }
    function onStarted(args){
  console.log("started");
  console.log(args);
}
function onEnded(args){
  console.log("ended");
  console.log(args);
}
function onCallback(args){
  console.log("callback");
  console.log(args);
}
/*Google Login Script Ends Here*/


/*Login Validations*/
$('#btn_login').on('click',function(){
  var email     = $('#email').val();
  var password  = $('#password').val();
  var filter    = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var flag      = 1;

  if(email == '')
  {
    $('#email').attr('style','border:red solid 1px');
    $('#err_email').text('Please enter your email id');
    flag = 0;
  }
  else if(!filter.test(email))
  {
    $('#email').attr('style','border:red solid 1px');
    $('#err_email').text('Please enter a valid email id');
    flag = 0;
  }
  else 
  {
    $('#err_email').text('');
  }
  if(password == '')
  {
    $('#password').attr('style','border:red solid 1px');
    $('#err_password').text('Please enter password');
    flag = 0;
  }
  else 
  {
    $('#err_password').text('');
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
</script>