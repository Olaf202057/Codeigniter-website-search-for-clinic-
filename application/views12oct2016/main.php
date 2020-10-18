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

	<!-- WOW Slider -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/engine1/style.css" />
	<script type="text/javascript" src="<?php echo base_url() ?>assets/engine1/jquery.js"></script>
	
	<!-- Font Awesome & Animation -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome-4.5.0/css/font-awesome.min.css" />
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="pg-home">
	<div class="mn-block">
		<div class="container">
			<div class="row">
				<div class="col-sm-12"> <!-- Fixed navbar -->
					<nav class="navbar navbar-default navbar-fixed-top">
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
										</ul> </li>

								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<?php echo $content ?>
	
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
							<li><a href="<?php echo base_url('contattaci') ?>">Proponi la tua struttura</a></li>
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
	
	<div class="copyright wow slideInUp">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">Copyright 2015 Spacex.com. All Rights Reserved</div>
			</div>
		</div>
	</div>
	
	<!-- jQuery -->
	<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url() ?>assets/js/wow.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
	<script src="<?php echo base_url() ?>assets/js/custom.js"></script>   

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/waiting.bootstrap.js"></script>
	<script src="<?php echo base_url() ?>assets/js/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap-tagsinput.js"></script>

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
