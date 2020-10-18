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
 
if ($conn)
{
	$exam_ids = $_GET['exam_ids'];
	$query = "SELECT s.id, e.id as eid, s.hospital, s.address, s.city, s.province, s.telephone, s.website, e.official_waiting_days FROM tblstructure s, tblexamination e where e.id IN (".$exam_ids.") AND s.id=e.struct_id LIMIT 10";
	$result = $conn->prepare($query);
	$result->execute();
	     
	/* Retrieve and store in array the results of the query.*/
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		$address = trim($row['address']).' '.trim($row['city']).' '.trim($row['province']);
		$address = addslashes(trim($address));
		if ($address != '') {
			$address_line = '[\''.addslashes(trim($row['hospital'])).'\', \''.addslashes(trim($address)).'\', \'Phone: '.addslashes(trim($row['telephone'])).'<br>Website: '.addslashes(trim($row['website'])).'<br>Waiting Time: '.addslashes(trim($row['official_waiting_days'])).' days\']';
			array_push($return_arr,$address_line);
		}
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
  <div id="map" style="height: 344px;width: 310px;"></div>

  <script type="text/javascript">
    var locations = [
      <?=$address_list?>
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 7,
      center: new google.maps.LatLng(45.36592,10.2154913),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();
    var geocoder = new google.maps.Geocoder();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      geocodeAddress(locations[i]);
    }

function geocodeAddress(location) {
  geocoder.geocode( { 'address': location[1]}, function(results, status) {
  //alert(status);
    if (status == google.maps.GeocoderStatus.OK) {

      //alert(results[0].geometry.location);
      map.setCenter(results[0].geometry.location);
      //createMarker(results[0].geometry.location,location[0]+"<br>"+location[1]);
      createMarker(results[0].geometry.location,location[0]+"<br>"+location[2]);
    }
    else
    {
      alert("some problem in geocode" + status);
    }
  }); 
}

function createMarker(latlng,html){
  var marker = new google.maps.Marker({
    position: latlng,
    map: map
  }); 

  google.maps.event.addListener(marker, 'click', function() { 
    infowindow.setContent(html);
    infowindow.open(map, marker);
  });
}
  </script>
</body>
</html>
