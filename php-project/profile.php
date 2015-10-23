<?php
    session_start();
    if (!$_SESSION["logged"]) {
        header('Location: http://php-gshawm.rhcloud.com/php-project/php_index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html ng-app="kacologoApp">
	<head>
		<title>Kacologo</title>
		<link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="css/nav.css" />
        <link rel="stylesheet" href="css/footer.css" />
        <link rel="stylesheet" href="css/home.css" />
        <link rel="stylesheet" href="css/profile.css" />
        <link rel="stylesheet" href="css/signup.css" />
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />-->
        
		<link rel="shortcut icon" href="images/controller-small.png">
        
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        
		<script src="js/main.js"></script>
        <script src="js/home.js"></script>
        <script src="js/videos.js"></script>
        <script src="js/forum.js"></script>
        <script src="js/contact.js"></script>
        <script src="js/signup.js"></script>
        <script src="js/login.js"></script>
        <script src="js/profile.js"></script>
	</head>
	<body ng-controller="MainCtrl as main" ng-init="main.page = 'PROFILE'">
        <navigator></navigator>
        <content></content>
        <footer-links></footer-links>
	</body>
</html>