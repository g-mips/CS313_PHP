<?php
session_start();

// gamer, gender, live, console, hours
if (isset($_POST["gamer"]) && isset($_POST["gender"]) &&
	isset($_POST["live"]) && isset($_POST["console"]) &&
	isset($_POST["hours"])) {
	$_SESSION["did_survey"] = true;
} else {
	$_SESSION["did_survey"] = false;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Survey</title>
		<link rel="stylesheet" href="../css/php_survey.css">
	</head>
	<body>
		<?php
			if ()
		?>
	</body>
</html>