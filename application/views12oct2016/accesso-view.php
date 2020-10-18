<div class="spacer header-content">
  <div class="container">

  <div class="col-md-4 "></div>
  <div class="col-md-4 centered login-box-body" style="margin:0 auto;">
    <p class="login-box-msg">Inserisci le tue credenziali:</p>
    <?php echo $this->session->flashdata('msg'); ?>
    <?php echo $err_msg ?>
    <form  method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
       
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        
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
          <button type="submit" class="btn btn-primary btn-block btn-flat">Accedi</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- O -</p>
      <a href="<?php echo base_url('hauth/login/Facebook') ?>" class="btn btn-block btn-social btn-facebook btn-flat fb-btn"><i class="fa fa-facebook"></i> Accedi con  Facebook</a>
      <a href="<?php echo base_url('hauth/login/Google') ?>" class="btn btn-block btn-social btn-google btn-flat gplus-btn"><i class="fa fa-google-plus"></i> Accedi con Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="#" data-toggle="modal" style="color:#fff;" data-target="#reset-modal" >Ho dimenticato la password</a><br>
    <a href="<?php echo base_url() ?>registration" style="color:#fff;"  class="text-center">Registrati</a>
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