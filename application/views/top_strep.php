<div class="profile-section">
     <div class="container">
        <div class="row">
           <div class="profile-tab collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul>
                 <li>
                    <a href="<?php echo base_url();?>">
                    <span>Home</span>
                    </a>
                 </li>
                 <li>
                    <a href="#">
                    <span>Benefits</span>
                    </a>
                 </li>
                 <li>
                    <a href="#">
                    <span>How It Works</span>
                    </a>
                 </li>
                 <li>
                    <a href="#">
                    <span>Costs</span>
                    </a>
                 </li>
                 
                 <?php if(!is_login(false)){ ?>
                 <li>
                    <a href="<?php echo base_url() ?>ads">
                    <span>Get started</span>
                    </a>
                 </li>
                 <?php } ?>
                 <li class="visible-xs">
                    <div class="navbar-collapse" id="navbar">
                    	<?php if(is_login(false)){ 
                        echo '<pre>';print_r($this->session->all_userdata());
                        ?>
                       <ul class="nav navbar-nav">
                          <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo get_user_fullname(); ?><span class="caret"></span></a>
                             <ul class="dropdown-menu">
                                <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                                <li><a href="dashboard">User stats <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                                <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
                                <li><a href="#">Favourites Snippets <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                                <li><a href="<?php echo base_url() ?>disconnessione">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                             </ul>
                          </li>
                       </ul>

                        <?php if(is_admin())
                           { ?>
                           	 <ul class="nav navbar-nav navbar-right">
                              <li class="dropdown">
                                 <a href="<?php echo base_url() ?>admin" class="dropdown-toggle" data-toggle="dropdown1"> Pannello di controllo<span class="caret1"></span></a>
                              </li>
                             </ul>
                           <?php }
                           }?>
                       <ul class="nav navbar-nav navbar-right">
                       	<?php if(!is_login(false)){ ?>
                          <li><a href="<?php echo base_url() ?>accesso">Accesso</a></li>
                          <?php } ?>
                          <li class="dropdown">
                             <a aria-expanded="true" aria-haspopup="true" href="#" data-toggle="dropdown" class="dropdown-toggle"> Lingua <span class="caret"></span></a> 
                             <ul class="dropdown-menu">
                                <li><a href="#"><img alt="" src="<?php echo base_url() ?>assets/img/Italy-Flag.png"> Italian</a></li>
                                <li><a href="#"><img alt="" src="<?php echo base_url() ?>assets/img/USA-Flag.png"> English</a></li>
                             </ul>
                          </li>
                       </ul>
                    </div>
                 </li>
              </ul>
           </div>
        </div>
     </div>
</div>