<?php
$dbhost = 'localhost';
$dbuser = 'medscann_scrappe';
$dbpass = 'HM#q[g755J{#';
$dbname = 'medscann_scrapper';

mysql_connect( $dbhost, $dbuser, $dbpass) or die ("Cannot connect database");
mysql_select_db( $dbname );

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf-8'");


$sqla = "SELECT id, address, city, province FROM tblstructure WHERE latitude='' AND map_api='0' ORDER BY id ASC LIMIT 1,1";
$resulta = mysql_query($sqla) or die ("Error in query : $sqla. ".mysql_error());
$howmanya = mysql_num_rows($resulta);
if ($howmanya > 0) {
	while ($rowa = mysql_fetch_array($resulta)) {
		$address = $rowa['address'].' '.$rowa['city'].' '.$rowa['province'];
		$address = str_replace('  ', ' ', $address);
		$address = str_replace('Comune MILANO', 'Milano, Italy', $address);
		$address = str_replace('Comune Milano', 'Milano, Italy', $address);
		$address = str_replace('Comune milano', 'Milano, Italy', $address);
		
		$gmap_array = geocode($address);
		print_r($gmap_array);
		if ($gmap_array[1] != '') {
			$sqlc = "UPDATE tblstructure SET latitude='".$gmap_array[0]."', longitude='".$gmap_array[1]."', address_formatted='".addslashes($gmap_array[2])."', map_api='1' WHERE id = '".$rowa['id']."'";
			$resultc = mysql_query($sqlc) or die ("Error in query: $sqlc. ".mysql_error());
			echo '<meta http-equiv="refresh" content="1">';
			exit;
		} else {
			$sqlc = "UPDATE tblstructure SET map_api='1' WHERE id = '".$rowa['id']."'";
			$resultc = mysql_query($sqlc) or die ("Error in query: $sqlc. ".mysql_error());
			echo '<meta http-equiv="refresh" content="3">';
			exit;
		}
	}
}



// function to geocode address, it will return false if unable to geocode address
function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
         
    }else{
        return false;
    }
}
?>
