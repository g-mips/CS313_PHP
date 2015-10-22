<?php
    session_start();
?>
<!DOCTYPE html>
<html ng-app="kacologoApp" ng-controller="MainCtrl as main" ng-init="setPage('HOME')">
	<header ng-controller="HomeCtrl as home"></header>
	<body>
        <navigator></navigator>
        <content></content>
        <footer-links></footer-links>
	</body>
</html>