<?php
    session_start();
    
    // Calling with a POST?
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $result = "";

        // Is everything set correctly?
        if (isset($_POST["oPassword"]) && isset($_POST["nPassword"]) && isset($_POST["rnPassword"]) && isset($_POST["username"])) {
            // Right person logged in?
            if ($_POST["username"] === $_SESSION["user"]) {
                require ('../database/password.php');
                require ('../database/databaseConnect.php');
                
                $db = loadDatabase();
                $result = "DB LOADED";
                
                $user = $db->query("SELECT * FROM users WHERE user_name = '" . $_SESSION["user"] . "' LIMIT 1");

                if ($user === false || $user->rowCount() === 0) {
                    $result = "User doesn't not exist.";
                } else {
                    $user->setFetchMode(PDO::FETCH_ASSOC);
                    $user = $user->fetch();
                    $result = "USER FETCHED";
                    
                    // Password correct?
                    if (password_verify($_POST["oPassword"], $user["user_pass"])) {
                        // Password not the same?
                        if ($_POST["nPassword"] !== $_POST["rnPassword"]) {
                            $result = "Passwords don't match!";
                        } else if ($_POST["nPassword"] === $_POST["oPassword"]) {
                            $result = "Old and new passwords cannot be the same.";
                        } else {
                            // Update password!
                            $password = password_hash($_POST["nPassword"], PASSWORD_DEFAULT);
                            $db->exec("UPDATE users SET user_pass='" . $password . "' WHERE user_id = " . $user["user_id"]);

                            $result = "Password changed!";
                        }
                    } else {
                        $result = "Incorrect password!";
                    }
                }
            } else {
                $result = "Username is different from who is logged in.";
            }
            
            
        } else {
            $result = "Submission Error";
        }

        echo $result;
    }
?>