<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form Handling, Team 2</title>
    </head>
    <body>
       <h1>Here is what you told us!</h1>
        Your name is: <?php echo $_POST["name"]; ?><br>
        Your email address is: <a href="mailto:<?php echo $_POST['email'] ?>" ><?php echo $_POST['email'] ?></a> <br>
        Your major is:  <?php echo $_POST["major"]; ?><br>

        You have visited:
        <?php
        $arr = $_POST["travel"];
        echo implode(", ", $arr) . "<br>";
        ?>

		You made these comments:
        <?php echo $_POST["comments"] ?>
    </body>
</html>
