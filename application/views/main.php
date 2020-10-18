<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title ?>  - <?php echo SITE_TITLE ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/js/datepicker/datepicker3.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/css/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css" rel="stylesheet" />

	<link href="<?php echo base_url() ?>assets/css/medscanner.css" rel="stylesheet" type="text/css" />
	

	<!-- WOW Slider -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/engine1/style.css" />
	<script type="text/javascript" src="<?php echo base_url() ?>assets/engine1/jquery.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/front_validation.js"></script>
	<script src="<?php echo base_url() ?>assets/js/wow.min.js"></script>
	
	
	
	<!-- Font Awesome & Animation -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome-4.5.0/css/font-awesome.min.css" />
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   <style type="text/css">
   .error{
	color:red;   	
   }
   </style>

</head>

<body class="pg-home">
	<div class="mn-block">
		<div class="container">
			<div class="row">
				<div class="col-sm-12"> <!-- Fixed navbar -->
					<!-- <nav class="navbar navbar-default navbar-fixed-top">
						<div class="container">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/img/logo.png" /></a>
							</div>
							<div id="navbar" class="navbar-collapse collapse">
								<ul class="nav navbar-nav navbar-right">
									<?php if($this->session->userdata('user')=='') {?>
									 <li><a href="<?php echo base_url() ?>ads">Adverties</a></li>
									 <?php } ?>
									<?php if(is_login(false)){ ?>
										<li> <a href="<?php echo base_url() ?>myaccount">Welcome <b><?php echo get_user_fullname(); ?></b></a></li>
										<?php if(is_admin()){ ?>
                                            <li> <a href="<?php echo base_url() ?>admin">  Pannello di controllo</a></li>
                                        <?php } ?>
									<?php }else{ ?>

										<li><a href="<?php echo base_url() ?>accesso">Accesso</a></li>
									<?php } ?>
								

									
									<?php if(is_login(false)){ ?>
										<li><a href="<?php echo base_url() ?>disconnessione">Disconnessione</a></li>
									<?php }?>
									<li role="presentation" class="dropdown "> 
										<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true"> Lingua <span class="caret"></span> </a> 
										<ul class="dropdown-menu"> 
											<li><a href="#"><img src="<?php echo base_url() ?>assets/img/Italy-Flag.png" alt='Italian'/> Italian</a></li> 
											<li><a href="#"><img src="<?php echo base_url() ?>assets/img/USA-Flag.png" alt='English'/> English</a></li> 
										</ul>
									 </li>



								</ul>
							</div>
						</div>
					</nav>
				</div> -->


				<nav class="navbar navbar-default navbar-fixed-top">
                     <div class="container">
                        <div class="navbar-header">
                           <!--                                <button aria-controls="navbar" aria-expanded="false" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button">-->
                           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           </button>
                           <a href="<?php echo base_url(); ?>" class="navbar-brand"><img src="<?php echo base_url()?>assets/img/logo.png" alt="logo" />
                           </a>
                        </div>
                        <div class="navbar-collapse hidden-xs" id="navbar">
                        	<?php if(is_login(false)){ 
                        		if(isset($this->session->userdata['logout_url']) && $this->session->userdata('logout_url') !='')
		                          {
		                            $url = $this->session->userdata('logout_url');
		                          }
		                          else 
		                          {
		                            $url = base_url().'disconnessione';
		                          }
		                       ?>
                           <ul class="nav navbar-nav navbar-right">
                              <li class="dropdown">
                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo get_user_fullname(); ?> <span class="caret"></span></a>
                                 <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url() ?>home/myaccount">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                                    <?php if($this->session->userdata('user')->role != 3){ ?>
                                    <li><a href="<?php echo base_url();?>ads/dashboard">Risultati <span class="glyphicon glyphicon-stats pull-right"></span></a></li> 
                                    <?php } ?>
                                    <!-- <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
                                    <li><a href="#">Favourites Snippets <span class="glyphicon glyphicon-heart pull-right"></span></a></li> -->
                                    <li><a href="<?php echo $url; ?>">disconnessione <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
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
                           } 

                           ?>
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
                     </div>
                  </nav>
               </div>
			</div>
		</div>
	</div>
	
<?php 
//print_r($this->session->userdata('user'));
	
  if($this->session->userdata('user')!=null)
	{
		if(!is_admin() && $this->session->userdata('user')->role == 2)
		{
			
			   if($this->session->userdata('user')->id != '')
			   {
			      $this->load->view('top_strip_login'); ?>
			      <div class="strip" style="margin-top: 30px;">
			 <?php   }   
			
		}
		
	}
	
 ?> 



<?php  echo $content ?>



<?php 
  if($this->session->userdata('user')!=null)
	{
		if(!is_admin() && $this->session->userdata('user')->role == 2)
		{
			
			   if($this->session->userdata('user')->id != '')
			   { ?>
			      </div>
			 <?php  
			  }   
			
		}
		
	}
	
 ?> 
</div>
	
	<div class="blue spacer-2">
		<div class="container">
			<div class="row">
				<!--<div class="col-sm-3">
					<div class="fl-links wow slideInUp">
						<h3>Esplora</h3>
						<ul>
							<li><a href="#">Esami Medici</a></li>
							<li><a href="#">Stutture sanitarie</a></li>
						</ul>
					</div>
				</div>-->
				<div class="col-sm-4">
					<div class="fl-links wow slideInUp">
						<h3>Prodotti in affiliazione</h3>
						<ul>
							<?php if(!is_login(false)){ ?>
							<li><a href="<?php echo base_url();?>ads">Proponi la tua struttura</a></li>
							<?php }else{?>
							<li><a href="javascript:void(0);">Proponi la tua struttura</a></li>
							<?php } ?>
							<li><a href="<?php echo base_url('contattaci') ?>">Strumenti di analisi per affiliati</a></li>
							<li><a href="<?php echo base_url('contattaci') ?>">API & Widgets</a></li>
							<li><a href="<?php echo base_url('contattaci') ?>">Pubblicita</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="fl-links wow slideInUp">
						<h3>Societa</h3>
						<ul>
							<li><a href="<?php echo base_url('page/chi-siamo') ?>">Informazioni su Medscanner</a></li>
							<li><a href="<?php echo base_url('contattaci') ?>">Lavora con noi</a></li>
							<li><a href="<?php echo base_url('page/informativa-sui-cookie') ?>">Informativa sui cookie</a></li>
							<li><a href="<?php echo base_url('page/informativa-sulla-privacy') ?>">Informativa sulla privacy</a></li>
							<li><a href="<?php echo base_url('page/termini-di-servizio') ?>">Termini di servizio</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="fl-links wow slideInUp">
						<h3>Aiuto</h3>
						<ul>
							<li><a href="<?php echo base_url('contattaci') ?>">Contattaci</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="copyright ">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">Copyright 2016 medscanner.net. All Rights Reserved</div>
			</div>
		</div>
	</div>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-90406911-1', 'auto');
	  ga('send', 'pageview');
	
	</script>
	<!-- jQuery -->
	<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
	
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
	<script src="<?php echo base_url() ?>assets/js/custom.js"></script>   

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/waiting.bootstrap.js"></script>
	<script src="<?php echo base_url() ?>assets/js/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap-tagsinput.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-select.js"></script>

	<script type="text/javascript">
		
		var base_url ='<?php echo base_url() ?>';
		$(document).ready(function(){
			 $('.datepicker').datepicker({
			      autoclose: true
			    });
		})
	</script>
	<?php foreach ($scripts as $key => $script) { ?>
		<script src="<?php echo base_url() ?>assets/js/apps/<?php echo $script ?>"></script>
	<?php } ?>
	<!-- WOW Slider -->
	
	</body>
</html>
