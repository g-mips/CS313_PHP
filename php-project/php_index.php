<?php
    session_start();
?>
<!DOCTYPE html>
<html ng-app="kacologoApp">
	<head>
        <title>Kacologo</title>
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="css/nav.css" />
        <link rel="stylesheet" href="css/footer.css" />
        <link rel="stylesheet" href="css/home.css" />

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
        <script src="js/addPost.js"></script>
    </head>
	<body ng-controller="MainCtrl as main" ng-init="main.page = 'HOME'">
        <navigator></navigator>
        <content></content>
        <footer-links></footer-links>
	</body>
</html>