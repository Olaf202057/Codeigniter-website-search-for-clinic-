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
		$sqlOption_type[] = "exam_type LIKE '%".addslashes($keyword)."%'";
		$sqlOption_type2[] = "common_name LIKE '%".addslashes($keyword)."%'";
	}
	$sql_add .= " ".join(' AND ',$sqlOption)." ";
	$sql_add_type .= " (".join(' AND ',$sqlOption_type).") OR (".join(' AND ',$sqlOption_type2).") ";
	
	if ($_GET['type'] == 'city') {
	    //$query = "SELECT distinct(city) FROM tblstructure where city like :term";
	    $query = "SELECT distinct(city) FROM tblstructure where $sql_add";
	    $result = $conn->prepare($query);
	    $result->bindValue(":term",$ac_term);
	    $result->execute();
	     
	    /* Retrieve and store in array the results of the query.*/
	    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		array_push($return_arr,$row['city']);
	    }
	} else {
	    //$query = "SELECT distinct(exam_type) FROM tblexamination where exam_type like :term";
	    $query = "SELECT distinct(exam_type) FROM tblexamination where $sql_add_type";
	    $result = $conn->prepare($query);
	    $result->bindValue(":term",$ac_term);
	    $result->execute();
	     
	    /* Retrieve and store in array the results of the query.*/
	    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		array_push($return_arr,$row['exam_type']);
	    }
	}

}
//$return_arr = array('A.O. DESENZANO POLIAMBULATORIO OSPEDALE DI DESENZANO', 'A.O. DESENZANO AMBULATORIO DI LENO');
echo json_encode($return_arr);
?>
