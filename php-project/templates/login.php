<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $result = "";
        
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $result = "HERE";
            require ('../database/databaseConnect.php');

            $db = loadDatabase();
            $users = $db->query("SELECT * FROM users WHERE user_name = '" . $_POST["username"] . "'");
            
            if ($users === false || $users->rowCount() === 0) {
                // Yes we know that it's just the username that is incorrect, but we don't want the user to know that.
                $result = "Username or Password is incorrect!";
            } else {
                $users->setFetchMode(PDO::FETCH_ASSOC);
                $user = $users->fetch();
                
                $pass = sha1($_POST["password"]);
                if ($pass === $user["user_pass"]) {
                    $_SESSION["logged"] = true;
                    $_SESSION["user"] = $_POST["username"];
                    
                    header('Location: http://php-gshawm.rhcloud.com/php-project/php_index.html');
                    exit();
                } else {
                    $result = "Username or Password is incorrect!";
                }
            }            
        } else {
            $result = "Submission Error";
        }
        
        echo $result;
    }
?>