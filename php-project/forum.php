<?php
    session_start();

    if (isset($_GET['page'])) {
        $_SESSION['page'] = (int)$_GET['page'];
    } else {
        $_SESSION['page'] = 0;
    }
    
    if (isset($_GET['id'])) {
        $_SESSION['id']   = (int)$_GET['id'];
    } else {
        $_SESSION['id'] = 0;
    }
    
    if (isset($_GET['tpage'])) {
        $_SESSION['tpage'] = (int)$_GET['tpage'];
    } else {
        $_SESSION['tpage'] = 1;
    }
?>
<!DOCTYPE html>
<html ng-app="kacologoApp">
	<head>
		<title>Kacologo</title>
		<link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="css/nav.css" />
        <link rel="stylesheet" href="css/footer.css" />
		<link rel="stylesheet" href="css/forum.css" />
        <link rel="stylesheet" href="css/form.css" />
        
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
        <script src="js/addThread.js"></script>
	</head>
	<body ng-controller="MainCtrl as main" ng-init="main.page = 'FORUM'">
        <navigator></navigator>
        <content></content>
        <footer-links></footer-links>
	</body>
</html>