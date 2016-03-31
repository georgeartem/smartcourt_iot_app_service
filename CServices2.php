<?php

class CServices {

    private $connection;

    // constructor
    public function CServices() {
//connect to the database
        	$dbhost = "db.previousk.com";
			$dbuser = "georgeartem";
			$dbpass = "";
			$dbname = "smartcourt";
		
		$this-> connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
			if(mysqli_connect_errno()) {
				die("Database connection failed:" . mysqli_connect_error() . "(" . mysqli_connect_errno(). ")");
				}
		}

    public function getAllCourts() {
        
$response = array();
$locations = array();
$amenities = array();
		
		$query = "select location_id, locationname, lat, lng from locations";
		$result = mysqli_query($this-> connection, $query);
			if(!$result) { die("Database query failed.");}
			
		while ($row = mysqli_fetch_array($result)){
					// output data from each row
					$locationid=$row['location_id'];
					$name=$row['locationname'];
					$lat=$row['lat'];
					$lng=$row['lng'];
					// query amenities while in the loop for the specific row's amenities
					$amenitiesquery = "select name from locations l join location_amenities al on l.location_id = al.locationid join amenities a on a.amenitiesid = al.amenitiesid where locationname = '$name'";
						$amenitiesresult = mysqli_query($this->connection, $amenitiesquery);
							if(!$amenitiesresult) { die("Amenities query failed.");}
							while ($amenitiesrow = mysqli_fetch_array($amenitiesresult)){
								$amenity=$amenitiesrow['name'];
								$amenities[]= array($amenity);
							
								}
						
					$locations[] = array('locationid'=> $locationid, 'name' => $name, 'lat' =>$lat, 'lng' => $lng, 'amenities' =>$amenities);
				}
			$response['locations']= $locations;
            $finalJsonResponse = json_encode($response);
            
			echo $finalJsonResponse; //at the end print the resulting json structure

			//should return the following JSON structure....
			/*
			{"locations": 
			[{"locationId": "3334455","name": "Bellevue Tennis Academy","lat": "47.6239453","lng": "-122.1661779", "totalCourts": 5,"courtQuality": "good","netQuality": "excellent","amenities": ["restrooms","water"]}
			]}
			*/
	}

    public function getMyCourts() {
		
	$response = array();
	$locationsStatus = array();
		
		$query = " SELECT locationid, count(courtid) as 'occupied' from court_status c1 where (time = (select max(time) from court_status c2 where c2.courtid = c1.courtid)) and status='occupied' group by locationid";
		
		$result = mysqli_query($this->connection, $query);
			if(!$result) { die("Database query failed.");}
		while ($row = mysqli_fetch_array($result)){
					// output data from each row
					$locationid=$row['locationid'];
					$occupied=$row['occupied'];
		
				$locationsStatus[]= array('locationid'=>$locationid, 'occupied'=>$occupied);
		}
		$response['locationsStatus']= $locationsStatus;
		$finalJsonResponse = json_encode($response);
            
			echo $finalJsonResponse;
		//should return the following JSON structure... 
		/*
		{"locationsStatus": [
				{"locationId": "3334455", "occupied": 3},{"locationId": "1232111", "occupied": 1},{"locationId": "2762307","occupied": 2}
							]}
		*/
    }
	
	public function getMyFavorites($user){
		
		
		$response = array();
		$favoriteLocations = array();
		
		$query = "select locationid from favorites where userid = '$user'";
		
		$result = mysqli_query($this->connection, $query);
			if(!$result) { die("Database query failed.");}
		while ($row = mysqli_fetch_array($result)){
					// output data from each row
				$favoriteLocations[] = array($row['locationid']);
		}
		
		$response['favoriteLocations'] = $favoriteLocations;
		$finalJsonResponse = json_encode($response);
		
			echo $finalJsonResponse;
			
			
		//should return the following JSON structure... 
		/*
		{"favoriteLocations": ["8131278", "2762307", "1232111", "10924723"]}
		*/
	}

}
	
	


?>