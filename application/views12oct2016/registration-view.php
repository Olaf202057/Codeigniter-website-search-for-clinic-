<div class="spacer">
  <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo $this->session->flashdata('verify_msg'); ?>
                    </div>
                </div>
                <div class="row">
                    <form class="form-horizontal col-md-6" method="post" role="form">
                        <h2>Form di registrazione</h2>
                        <div class="form-group">
                            <label for="firstName" class="col-sm-3 control-label">Nome</label>
                            <div class="col-sm-9">
                                <input type="text"  name="firstname" value="<?php echo set_value('firstname'); ?>" placeholder="Nome" class="form-control" autofocus>
                                 <span class="text-danger"><?php echo form_error('firstname'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstName" class="col-sm-3 control-label">Cognome</label>
                            <div class="col-sm-9">
                                <input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" placeholder="Cognome" class="form-control" >
                                 <span class="text-danger"><?php echo form_error('lastname'); ?></span>
                            </div>
                        </div>

                        <input type="hidden" name="middlename" value="<?php echo set_value('middlename'); ?>" placeholder="Middle Name" class="form-control" >

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email" class="form-control">
                                 <span class="text-danger"><?php echo form_error('email'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                                 <span class="text-danger"><?php echo form_error('password'); ?></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Ripeti la password</label>
                            <div class="col-sm-9">
                                <input type="password" name="conf_password"  placeholder="Ripeti la password" class="form-control">
                                 <span class="text-danger"><?php echo form_error('conf_password'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birthDate" class="col-sm-3 control-label">Data di nascita</label>
                            <div class="col-sm-9">
                                <input type="date" name="dob" value="<?php echo set_value('date'); ?>" placeholder="gg/mm/aaaa" class="form-control datepicker">
                                 <span class="text-danger"><?php echo form_error('dob'); ?></span>
                            </div>
                        </div>
                 
                        <div class="form-group">
                            <label class="control-label col-sm-3">Sesso</label>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="radio-inline">
                                            <input type="radio" id="femaleRadio" name="gender" value="Female">Femmina
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="radio-inline">
                                            <input type="radio" id="maleRadio" checked="" name="gender"  value="Male">Maschio
                                        </label>
                                    </div>
                                   
                                </div>
                            </div>
                        </div> <!-- /.form-group -->
                       
                  
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">

                                <button type="submit" class="btn btn-primary btn-block">Registrati</button>
                                 <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                        </div>
                    </form> <!-- /form -->
                 </div>
        </div> <!-- ./container -->
</div>

