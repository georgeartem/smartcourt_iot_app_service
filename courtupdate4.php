<?php
$dbhost = "db.previousk.com";
$dbuser = "georgeartem";
$dbpass = "Blahblah87";
$dbname = "smartcourt";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(mysqli_connect_errno()) {
		die("Database connection failed:" . mysqli_connect_error() . "(" . mysqli_connect_errno(). ")");
}

// database query for the most recent values ordered by each courtid at a given location. There are multiple queries for multiple locations
$query1 = "select status, time, courtid, locationid from courts c1 where (time = (select max(time) from courts c2 where c2.courtid = c1.courtid) AND locationid = 1)";

$query2 = "select status, time, courtid, locationid from courts c1 where (time = (select max(time) from courts c2 where c2.courtid = c1.courtid) AND locationid = 2)";

$result = mysqli_query($connection, $query1);
	if(!result) {
		die("Database query failed.");
	}
$result2 = mysqli_query($connection, $query2);
if(!result2) {
		die("Database query failed.");
	}

// return data to display on the page
//open the json file and then run the while loop.
// $query = "select status, time, courtid from courts c1 where time = (select max(time) from courts c2 where c2.courtid = c1.courtid)";
//////////////////////////////////////////////////////////////////////
////// ADD CODE TO SUPPORT MULTIPLE LOCATIONS IN WRITING THE JSON FILE

$response = array();
$data = array();
$data2 = array();
$file = fopen('/home/alexcurrier/previousk.com/smartcourt/api/courtdata.json.txt', 'w+');
 while ($row = mysqli_fetch_array($result)){
	 // output data from each row

	$status=$row['status'];
	$time=$row['time'];
	$courtid=$row['courtid'];
	$locationid=$row['locationid'];
	$data[] = array('status'=> $status, 'time' => $time, 'courtid' =>$courtid, 'locationid' => $locationid);
 }

  while ($row2 = mysqli_fetch_array($result2)){
	 // output data from each row


	$status2=$row2['status'];
	$time2=$row2['time'];
	$courtid2=$row2['courtid'];
	$locationid2=$row2['locationid'];
	$data2[] = array('status'=> $status2, 'time' => $time2, 'courtid' =>$courtid2, 'locationid' => $locationid2);
 }

 $response['data']= $data;
 $response['data2']= $data2; 
 var_dump($response);
 fwrite($file, json_encode($response));
 fclose($file);

mysqli_free_result($result);
mysqli_free_result($result2);

 mysqli_close($connection);
?>