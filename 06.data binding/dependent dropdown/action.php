<?php 
	// Include the database config file 
	include_once 'dbConfig.php';

	// Get country id through state name

	$countryId = $_POST['countryId'];

	if (!empty($countryId)) {
		// Fetch state name base on country id
		$query = "SELECT * FROM states WHERE country_id = {$countryId}";

		$result = $con->query($query);

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo '<option value="'.$row['id'].'">'.$row['state_name'].'</option>'; 
			}
		}else{
			echo '<option value="">State not available</option>'; 
		}
	}elseif (!empty($_POST['stateId'])) {
		$stateId = $_POST['stateId']; 
		// Fetch city name base on state id

		$query = "SELECT * FROM cities WHERE state_id = {$stateId}";

		$result = $con->query($query);

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				 echo '<option value="'.$row['id'].'">'.$row['city_name'].'</option>'; 
			}
		}else{
			echo '<option value="">City not available</option>'; 
		}
	}

?>