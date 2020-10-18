<?php
$dbhost = 'localhost';
$dbuser = 'medscann_scrappe';
$dbpass = 'HM#q[g755J{#';
$dbname = 'medscann_scrapper';
 
try {
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  $conn -> exec("SET CHARACTER SET utf8");
}
catch(PDOException $e) {
    echo $e->getMessage();
}
 
$return_arr = array();
$lat_center = 45.36592;
$lon_center = 10.2154913;
			
if ($conn)
{
	$exam_ids = trim($_GET['exam_ids']);
	$query = "SELECT s.id, e.id as eid, s.hospital, s.address, s.latitude, s.longitude, s.city, s.province, s.telephone, s.website, e.official_waiting_days FROM tblstructure s, tblexamination e where e.id IN (".$exam_ids.") AND s.id=e.struct_id AND s.latitude!=''";
	$result = $conn->prepare($query);
	$result->execute();
	     
	/* Retrieve and store in array the results of the query.*/
	$kac = 1;
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	
		if ($kac == 1) {
			$lat_center = $row['latitude'];
			$lon_center = $row['longitude'];
		}
		$address = trim($row['address']).' '.trim($row['city']).' '.trim($row['province']);
		$address = addslashes(trim($address));
		if ($address != '') {
			$address_line = '[\'<a href="/map-search?exam_id='.$row['eid'].'" target="_top">'.addslashes(trim($row['hospital'])).'</a><br>Phone: '.addslashes(trim($row['telephone'])).'<br>Website: '.addslashes(trim($row['website'])).'<br>Waiting Time: '.addslashes(trim($row['official_waiting_days'])).' days\', '.trim($row['latitude']).', '.trim($row['longitude']).', '.$kac.']';
			array_push($return_arr,$address_line);
		}
		$kac++;
	}
} else {
	echo 'Database connection problem';
	exit;
}

if ($return_arr) {
	$address_list = implode(",\n" , $return_arr);
} else {
	echo 'No results';
	exit;
}
?>
<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYt_Xs2mWembJGnMKY_14dVdFumS3X21w&sensor=false"></script>
</head> 
<body>
  <div id="map" style="width: 500px; height: 400px;"></div>

  <script type="text/javascript">
  
    var locations = [
      <?=$address_list?>
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 7,
      center: new google.maps.LatLng(<?=$lat_center?>,<?=$lon_center?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      //if(i == 5) {
      //    marker.setAnimation(google.maps.Animation.DROP);
      //    marker.setIcon('http://maps.google.com/intl/en_us/mapfiles/ms/micons/purple.png');
      //}
      
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    
    var customControlDiv = document.createElement('div');
    var customControl = new CustomControl(customControlDiv, map);

    customControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(customControlDiv);

	function CustomControl(controlDiv, map) {

	    // Set CSS for the control border
	    var controlUI = document.createElement('div');
	    controlUI.style.backgroundColor = '#015289';
	    controlUI.style.borderStyle = 'solid';
	    controlUI.style.borderWidth = '1px';
	    controlUI.style.borderColor = '#015289';
	    controlUI.style.height = '14px';
	    controlUI.style.marginTop = '5px';
	    controlUI.style.marginLeft = '0px';
	    controlUI.style.paddingTop = '1px';
	    controlUI.style.cursor = 'pointer';
	    controlUI.style.textAlign = 'center';
	    controlUI.title = 'Clicca per vedere la mappa';
	    controlDiv.appendChild(controlUI);

	    // Set CSS for the control interior
	    var controlText = document.createElement('div');
	    controlText.style.fontFamily = 'Arial,sans-serif';
	    controlText.style.fontSize = '10px';
	    controlText.style.color = '#FFFFFF';
	    controlText.style.paddingLeft = '4px';
	    controlText.style.paddingRight = '4px';
	    controlText.style.marginTop = '0px';
	    controlText.innerHTML = 'Clicca per vedere la mappa';
	    controlUI.appendChild(controlText);

	    // Setup the click event listeners
	    google.maps.event.addDomListener(controlUI, 'click', function () {
		//alert('Custom control clicked');
		window.top.location.href = "http://medscanner.net/map-search?exam_id=<?=$exam_ids?>"; 
	    });
	}
  </script>
</body>
</html>

