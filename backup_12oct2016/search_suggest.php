<?php
$dbhost = 'localhost';
$dbuser = 'medscann_scrappe';
$dbpass = 'HM#q[g755J{#';
$dbname = 'medscann_scrapper';
 
try {
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
}
catch(PDOException $e) {
    echo $e->getMessage();
}
 
$return_arr = array();
 
if ($conn)
{
    $ac_term = "%".$_GET['term']."%";

	$list = explode(' ',$ac_term);
	$sql_add = '';
	$sqlOption = $sqlOption_type = array();
	foreach($list as  $keyword){
		$sqlOption[] = "city LIKE '%".addslashes($keyword)."%'";
		$sqlOption_type[] = "common_name LIKE '%".addslashes($keyword)."%'";
	}
	$sql_add .= " ".join(' AND ',$sqlOption)." ";
	$sql_add_type .= " ".join(' AND ',$sqlOption_type)." ";
	$sql_add_type = str_replace('%%', '%', $sql_add_type);
	if ($_GET['type'] == 'city') {
	    //$query = "SELECT distinct(city) FROM tblstructure where city like :term";
	    $query = "SELECT distinct(province) FROM tblstructure where $sql_add";
	    $result = $conn->prepare($query);
	    //$result->bindValue(":term",$ac_term);
	    $result->execute();
	     
	    /* Retrieve and store in array the results of the query.*/
	    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		array_push($return_arr,$row['province']);
	    }
	} else {
	    //$query = "SELECT distinct(exam_type) FROM tblexamination where exam_type like :term";
	    //$query = "SELECT distinct(exam_type) FROM tblexamination where $sql_add_type";
	    $query = "SELECT distinct(common_name) FROM tblexamination where $sql_add_type";
	    $result = $conn->prepare($query);
	    //$result->bindValue(":term",$ac_term);
	    $result->execute();
	     
	    /* Retrieve and store in array the results of the query.*/
	    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		array_push($return_arr,$row['common_name']);
	    }
	    /*
	    echo '<pre>';
	    print_r($return_arr);
	    echo '</pre>';
	    exit;
	    */
	}

}
//$return_arr = array('A.O. DESENZANO POLIAMBULATORIO OSPEDALE DI DESENZANO', 'A.O. DESENZANO AMBULATORIO DI LENO');
echo json_encode($return_arr);
?>
