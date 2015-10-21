<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
            // Standard form submission
            $result = "<h1>User Registered!</h1>";
            $result = "<h1>USER: " . $_POST["username"] . "</h1>" .
                "<h1>PASS: " . $_POST["password"] . "</h1>" .
                "<h1>EMAIL: " . $_POST["email"] . "</h1>";
        }
        else {
            print_r($_POST);
            $result = "<h1>Submission Error</h1>";
        }
        echo $result;
    }
?>