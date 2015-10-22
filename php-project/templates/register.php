<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $result = "";
        
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["cPassword"])) {
            if (!ctype_alnum($_POST["username"])) {
                $result = "Username can only contain numbers and/or letters.";
            } else if (strlen($_POST["username"]) > 30) {
                $result = "Username cannot exceed 30 characters.";
            } else if ($_POST["password"] !== $_POST["cPassword"]) {
                $result = "Passwords do not match.";
            } else {
                require ('../database/databaseConnect.php');
                try {
                    console.log("LOADING DB");
                    $db = loadDatabase();
                    console.log("DB LOADED");
                    
                    $exists = $db->query("SELECT user_name FROM users WHERE user_name = '" . $_POST["username"] . "' LIMIT 1");
                    if ($exists === false || $exists->rowCount === 1) {
                        $exists = $mysqli->query("SELECT email from users WHERE email = '" . $_POST["email"] . "' LIMIT 1");
                        if ($exists === false || $exists->num_rows === 1) {
                            $result = "Username and Email already exist!";
                        } else {
                            $result = "Username already exist!";
                        }
                    } else {
                        $exists = $db->query("SELECT user_email FROM users WHERE user_email = '" . $_POST["email"] . "' LIMIT 1");
                        if ($exists === false || $exists->rowCount === 1) {
                            $result = "Email is already bound to a Username.";
                        } else {
                            $statement = $db->prepare("INSERT INTO users (user_date, user_email, user_name, user_pass, user_type) VALUES(NOW(), ?, ?, ?, ?)");
                            console.log("STATEMENT PREPARED");

                            $pass  = null;
                            $user  = null;
                            $email = null;
                            $type  = null;

                            $statement->bindParam(1, $email);
                            $statement->bindParam(2, $user);
                            $statement->bindParam(3, $pass);
                            $statement->bindParam(4, $type);

                            $pass  = sha1($_POST["password"]);
                            $user  = $_POST["username"];
                            $email = $_POST["email"];
                            $type = 0;

                            $statement->exec();

                            $result = "User Registered!";
                        }
                    }
                } catch (PDOException $e) {
                    $result = $e->getMessage();
                }
            }
        }
        else {
            $result = "Submission Error";
        }
        
        echo $result;
    }
?>