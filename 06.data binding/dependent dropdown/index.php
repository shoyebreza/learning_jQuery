<?php 
	// Include the database config file 
	include_once 'dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dynamic Dependent Drop down in PHP using jQuery AJAX</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
	<body style="background: #fdfcfc">
		<div class="container">
		  <h2 style="text-align: center;">Dynamic Dependent Drop down in PHP using jQuery AJAX</h2><br><br>
		  	<form action="" method="post">
		  		<div class="col-md-3"></div>
			  	<div class="form-group col-md-6">
			  		<!-- Country dropdown -->

			    	<label for="country">Country</label>
			    	<select class="form-control" id="country">
			    		<option value="">Select Country</option>
			    		<?php 
			    			$query = "SELECT * FROM countries";
			    			$result = $con->query($query);
			    			if ($result->num_rows > 0) {
			    				while ($row = $result->fetch_assoc()) {
			    					echo "<option value='{$row["id"]}'>{$row['country_name']}</option>";
			    				}
			    			}else{
			    				echo "<option value=''>Country not available</option>"; 
			    			}
			    		?>
			     	</select><br>

			     	<!-- State dropdown -->
			    	<label for="country">State</label>
			    	<select class="form-control" id="state">
			     	    <option value="">Select State</option>
			    	</select><br>

			    	 <!-- City dropdown -->
			    	<label for="country">City</label>
			    	<select class="form-control" id="city">
			     	    <option value="">Select City</option>
			    	</select>

			  	</div>
			</form>
		</div>
	</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		// Country dependent ajax
		$("#country").on("change",function(){
			var countryId = $(this).val();
			if (countryId) {
				$.ajax({
					url :"action.php",
					type:"POST",
					cache:false,
					data:{countryId:countryId},
					success:function(data){
						$("#state").html(data);
						$('#city').html('<option value="">Select state</option>');
					}
				});
			}else{
				$('#state').html('<option value="">Select country</option>');
            	$('#city').html('<option value="">Select state</option>');
			}
		});

		// state dependent ajax
		$("#state").on("change", function(){
			var stateId = $(this).val();
			if (stateId) {
				$.ajax({
					url :"action.php",
					type:"POST",
					cache:false,
					data:{stateId:stateId},
					success:function(data){
						$("#city").html(data);
					}
				});
			}else{
            	$('#city').html('<option value="">Select state</option>');
			} 
		});
	});
</script>