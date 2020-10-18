<!DOCTYPE html>
<html>
  <head>
    <title>Med Scanner Search</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Custom CSS -->
	<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet" />
  
	<!-- WOW Slider -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/engine1/style.css" />
 
	
	<!-- Font Awesome & Animation -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/font-awesome-4.5.0/css/font-awesome.min.css" />
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
      table {
        font-size: 12px;
      }
      #map {
        width: 100%;
      }
      #map-filters{
         left: 1em;
   
        padding: 1px;
        position: absolute;
        top: 10.5em;
         z-index: 999999;
      }
      .pop-exam-detail{
        font-size:10px;
          border-bottom: 1px dashed;
      }

    </style>
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
                  <li><a  href="<?php echo $actual_link?>">Elenco</a></li>

                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div> 
  <div id="map-filters" style="width: 450px;">
		<?php $this->load->view('home/include/mapsearch-filter-view') ?>
  </div>
   <div id="map"></div>
   <script type="text/javascript">
   var base_url ='<?php echo base_url() ?>';
   var query_string="<?php echo $_SERVER['QUERY_STRING'] ?>";
   </script>
   
    <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
      <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/waiting.bootstrap.js"></script>
   <script src="<?php echo base_url() ?>assets/js/apps/search-map.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeOFHzed6hIPjqlCyzxuwtWhbklCZISM&callback=initMap"
        async defer></script>
		
	<?php /*?><script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxtpiZaR_8YXYhuNrXy39sEaDCeBM2UQE&callback=initMap"
        async defer></script><?php */?>	
	<?php /*?><script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYt_Xs2mWembJGnMKY_14dVdFumS3X21w&callback=initMap"
			async defer></script><?php */?>
	<style>
		#map-filters { top: 100px; }
		#map-filters .col-sm-6 { padding: 2px !important;  }
		.table tr td { padding: 2px !important; }
	</style>
  </body>
</html>
