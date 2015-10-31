<?php
    session_start();

    // Was it sent through submission?
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $result = "";
        
        // Are the username and password set?
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            require ('../database/databaseConnect.php');

            $db = loadDatabase();
            $users = $db->query("SELECT * FROM users WHERE user_name = '" . $_POST["username"] . "'");
            
            // Does the user name exist?
            if ($users === false || $users->rowCount() === 0) {
                // Yes we know that it's just the username that is incorrect, but we don't want the user to know that.
                echo "Username or Password is incorrect!";
            } else {
                $users->setFetchMode(PDO::FETCH_ASSOC);
                $user = $users->fetch();
                
                require ('../database/password.php');
                
                // Was the password put in correctly?
                if (password_verify($_POST["password"], $user["user_pass"])) {
                    $_SESSION["logged"] = true;
                    $_SESSION["user"] = $_POST["username"];
                    
                    echo "SUCCESS";
                } else {
                    echo "Username or Password is incorrect!";
                }
            }            
        } else {
            echo "Submission Error";
        }
    }
?>