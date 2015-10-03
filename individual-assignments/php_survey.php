<?php
session_start();

if (!ini_set("session.gc_maxlifetime", "24000")) {
	throw new Exception("Failed to set execution time");
}

if (isset($_SESSION["did_survey"]) && $_SESSION["did_survey"] == true) {
	header( 'Location: http://php-gshawm.rhcloud.com/individual-assignments/results.php' );
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Survey</title>
		<link rel="stylesheet" href="../css/php_survey.css">
	</head>
	<body>
		<form action="" method="post">
			<h1>Gaming Survey</h1>
			
			<div>
				<h3>Do you consider yourself to be a gamer?</h3>
				<input type="radio" name="gamer" value="yes">Yes</input><br>
				<input type="radio" name="gamer" value="no">No</input><br>
				
				<h3>What gender are you?</h3>
				<select name="gender">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				
				<h3>Where do you live currently?</h3>
				<select name="live">
					<option value="North America">North America</option>
					<option value="South America">South America</option>
					<option value="Europe">Europe</option>
					<option value="Asia">Asia</option>
					<option value="Africa">Africa</option>
					<option value="Austrailia">Austrailia</option>
				</select>
				
				<h3>What consoles do you own currently?</h3>
				<input type="checkbox" name="console[]" value="Xbox One">Xbox One</input><br>
				<input type="checkbox" name="console[]" value="PlayStation 4">PlayStation 4</input><br>
				<input type="checkbox" name="console[]" value="Wii U">Wii U</input><br>
				<input type="checkbox" name="console[]" value="Xbox 360">Xbox 360</input><br>
				<input type="checkbox" name="console[]" value="PlayStation 3">PlayStation 3</input><br>
				<input type="checkbox" name="console[]" value="Wii">Wii</input><br>
				<input type="checkbox" name="console[]" value="Xbox">Xbox</input><br>
				<input type="checkbox" name="console[]" value="PlayStation 2">PlayStation 2</input><br>
				<input type="checkbox" name="console[]" value="Gamecube">Gamecube</input><br>
				<input type="checkbox" name="console[]" value="PlayStation">PlayStation</input><br>
				<input type="checkbox" name="console[]" value="Nintendo 64">Nintendo 64</input><br>
				<input type="checkbox" name="console[]" value="Super Nintendo">Super Nintendo</input><br>
				<input type="checkbox" name="console[]" value="Nintendo Entertainment System">Nintendo Entertainment System</input><br>
				<input type="checkbox" name="console[]" value="Other">Other</input><br>
				
				<h3>How many hours do you play video games a week on average?</h3>
				<input type="radio" name="hours" value="0 hours">0 hours</input><br>
				<input type="radio" name="hours" value="Less than 5">Less than 5</input><br>
				<input type="radio" name="hours" value="5 - 10">5 - 10</input><br>
				<input type="radio" name="hours" value="10 - 20">10 - 20</input><br>
				<input type="radio" name="hours" value="20 - 30">20 - 30</input><br>
				<input type="radio" name="hours" value="Gaming is my job">Gaming is my job</input><br>
				
				<br>
				
				<input class="button" type="submit" value="Submit">
				<input id="SeeResults" class="button" type="button" value="See Results">
				
				<script type="text/javascript">
					document.getElementById("SeeResults").onclick = function () {
						location.href = "http://php-gshawm.rhcloud.com/individual-assignments/results.php";
					};
				</script>
			</div>
		</form>
	</body>
</html>