<div class="spacer">
  <div class="container">
  <div class="col-md-4 "></div>
  <div class="col-md-4 centered login-box-body" style="margin:0 auto;">
    <p class="login-box-msg">Create new password</p>
    <?php echo $err_msg ?>
    <form  method="post">
      <div class="form-group has-feedback">
       <input type="password" class="form-control" name="password" placeholder="Password">
       
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="conf_password" placeholder=" ConfirmPassword">
        
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   
  </div>
  <div class="col-md-4 "></div>
  </div>
</div>

<!-- Modal -->
