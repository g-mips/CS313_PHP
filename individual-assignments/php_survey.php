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
		<form action="results.php" method="post">
			<h1>Gaming Survey</h1>
			
			<div>
				<h3>Do you consider yourself to be a gamer?</h3>
				<input type="radio" name="gamer" value="0">Yes</input><br>
				<input type="radio" name="gamer" value="1">No</input><br>
				
				<h3>What gender are you?</h3>
				<select name="gender">
					<option value="2">Male</option>
					<option value="3">Female</option>
				</select>
				
				<h3>Where do you live currently?</h3>
				<select name="live">
					<option value="4">North America</option>
					<option value="5">South America</option>
					<option value="6">Europe</option>
					<option value="7">Asia</option>
					<option value="8">Africa</option>
					<option value="9">Australia</option>
				</select>
				
				<h3>What consoles do you own currently?</h3>
				<input type="checkbox" name="console[]" value="10">Xbox One</input><br>
				<input type="checkbox" name="console[]" value="11">PlayStation 4</input><br>
				<input type="checkbox" name="console[]" value="12">Wii U</input><br>
				<input type="checkbox" name="console[]" value="13">Xbox 360</input><br>
				<input type="checkbox" name="console[]" value="14">PlayStation 3</input><br>
				<input type="checkbox" name="console[]" value="15">Wii</input><br>
				<input type="checkbox" name="console[]" value="16">Xbox</input><br>
				<input type="checkbox" name="console[]" value="17">PlayStation 2</input><br>
				<input type="checkbox" name="console[]" value="18">Gamecube</input><br>
				<input type="checkbox" name="console[]" value="19">PlayStation</input><br>
				<input type="checkbox" name="console[]" value="20">Nintendo 64</input><br>
				<input type="checkbox" name="console[]" value="21">Super Nintendo</input><br>
				<input type="checkbox" name="console[]" value="22">Nintendo Entertainment System</input><br>
				<input type="checkbox" name="console[]" value="23">Other</input><br>
				<input type="checkbox" name="console[]" value="24">None</input><br>
				
				<h3>How many hours do you play video games a week on average?</h3>
				<input type="radio" name="hours" value="25">0 hours</input><br>
				<input type="radio" name="hours" value="26">Less than 5</input><br>
				<input type="radio" name="hours" value="27">5 - 10</input><br>
				<input type="radio" name="hours" value="28">10 - 20</input><br>
				<input type="radio" name="hours" value="29">20 - 30</input><br>
				<input type="radio" name="hours" value="30">Gaming is my job</input><br>
				
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