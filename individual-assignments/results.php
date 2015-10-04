<?php
session_start();

// gamer, gender, live, console, hours
if($_SERVER['REQUEST_METHOD'] == "POST") {
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
			// Read XML
			$doc = new DOMDocument();
			$doc->load('results.xml');
			$root = $doc->getElementsByTagName('results')->item(0);
			
			// Are we requesting page with POST?
			if($_SERVER['REQUEST_METHOD'] == "POST") {
				// Read POST values and update XML
				$root->childNodes->item((int)$_POST["gamer"])->nodeValue += 1;
				$root->childNodes->item((int)$_POST["gender"])->nodeValue += 1;
				$root->childNodes->item((int)$_POST["live"])->nodeValue += 1;
				$root->childNodes->item((int)$_POST["hours"])->nodeValue += 1;
				
				$consoles = $_POST["console"];
				foreach ($consoles as $console) {
					$root->childNodes->item((int)$console)->nodeValue += 1;
				}
				
				$doc->getElementsByTagName("numPeople")->item(0)->nodeValue += 1;
				$doc->save('results.xml');
			}
			
			// Display Results
			echo '<h1>Results</h1>';
			if ($doc->getElementsByTagName("numPeople")->item(0)->nodeValue == 0) {
				echo '<div>' .
					 '	<h3>No one has taken the survey yet. Come back later.</h3>' .
					 '</div>';
			} else {
				$textArray = Array(' are gamers.<br>', ' are not gamers.<br>', ' are male.<br>', ' are female.<br>', ' live in North America.<br>',
								   ' live in South America.<br>', ' live in Europe.<br>', ' live in Asia.<br>', ' live in Africa.<br>', ' live in Australia.<br>',
								   ' own an Xbox One.<br>', ' own a PlayStation 4.<br>', ' own a Wii U.<br>', ' own an Xbox 360.<br>', ' own a PlayStation 3.<br>',
								   ' own a Wii.<br>', ' own an Xbox.<br>', ' own a PlayStation 2.<br>', ' own a Gamecube.<br>', ' own a PlayStation.<br>',
								   ' own a Nintendo 64.<br>', ' own a Super Nintendo.<br>', ' own a Nintendo Entertainment System.<br>', ' own a different console.<br>',
								   ' don\'t own a console.<br>', ' play 0 hours a week.<br>', ' play less than 5 hours a week.<br>', ' play 5 - 10 hours a week.<br>',
								   ' play 10 - 20 hours a week.<br>', ' play 20 - 30 hours a week.<br>', ' say that gaming is their job.<br>');
				
				/*$textIndex = 0;
				foreach ($root->childNodes as childNode) {
					$childNode->nodeValue . $textArray[$textIndex];
					$textIndex += 1;
				}
				*/		
				echo '<div>' .
					 '	<h3>This survey is currently out of ' . $doc->getElementsByTagName("numPeople")->item(0)->nodeValue . ' person(s).</h3>' .
					 '	<p>' .
					 $root->childNodes->item(0)->nodeValue . ' are gamers.<br>' .
					 $root->childNodes->item(1)->nodeValue . ' are not gamers.<br>' .
					 $root->childNodes->item(2)->nodeValue . ' are male.<br>' .
					 $root->childNodes->item(3)->nodeValue . ' are female.<br>' .
					 $root->childNodes->item(4)->nodeValue . ' live in North America.<br>' .
					 $root->childNodes->item(5)->nodeValue . ' live in South America.<br>' .
					 $root->childNodes->item(6)->nodeValue . ' live in Europe.<br>' .
					 $root->childNodes->item(7)->nodeValue . ' live in Asia.<br>' .
					 $root->childNodes->item(8)->nodeValue . ' live in Africa.<br>' .
					 $root->childNodes->item(9)->nodeValue . ' live in Australia.<br>' .
					 $root->childNodes->item(10)->nodeValue . ' own an Xbox One.<br>' .
					 $root->childNodes->item(11)->nodeValue . ' own a PlayStation 4.<br>' .
					 $root->childNodes->item(12)->nodeValue . ' own a Wii U.<br>' .
					 $root->childNodes->item(13)->nodeValue . ' own an Xbox 360.<br>' .
					 $root->childNodes->item(14)->nodeValue . ' own a PlayStation 3.<br>' .
					 $root->childNodes->item(15)->nodeValue . ' own a Wii.<br>' .
					 $root->childNodes->item(16)->nodeValue . ' own an Xbox.<br>' .
					 $root->childNodes->item(17)->nodeValue . ' own a PlayStation 2.<br>' .
					 $root->childNodes->item(18)->nodeValue . ' own a Gamecube.<br>' .
					 $root->childNodes->item(19)->nodeValue . ' own a PlayStation.<br>' .
					 $root->childNodes->item(20)->nodeValue . ' own a Nintendo 64.<br>' .
					 $root->childNodes->item(21)->nodeValue . ' own a Super Nintendo.<br>' .
					 $root->childNodes->item(22)->nodeValue . ' own a Nintendo Entertainment System.<br>' .
					 $root->childNodes->item(23)->nodeValue . ' own a different console.<br>' .
					 $root->childNodes->item(24)->nodeValue . ' don\'t own a console.<br>' .
					 $root->childNodes->item(25)->nodeValue . ' play 0 hours a week.<br>' .
					 $root->childNodes->item(26)->nodeValue . ' play less than 5 hours a week.<br>' .
					 $root->childNodes->item(27)->nodeValue . ' play 5 - 10 hours a week.<br>' .
					 $root->childNodes->item(28)->nodeValue . ' play 10 - 20 hours a week.<br>' .
					 $root->childNodes->item(29)->nodeValue . ' play 20 - 30 hours a week.<br>' .
					 $root->childNodes->item(30)->nodeValue . ' say that gaming is their job.<br>' .
					 '   </p>' .
					 '</div>';
					 
			}
		?>
	</body>
</html>