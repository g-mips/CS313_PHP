<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $result = "";
        
        if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["cPassword"])) {
            $pass  = sha1($_POST["password"]);
            $user  = $_POST["username"];
            $email = $_POST["email"];
            
            if (!ctype_alnum($user)) {
                $result = "Username can only contain numbers and/or letters.";
            } else if (strlen($user) > 30) {
                $result = "Username cannot exceed 30 characters.";
            } else if ($_POST["password"] !== $_POST["cPassword"]) {
                $result = "Passwords do not match.";
            } else {
                require ('/php-project/database/databaseConnect.php');
                try {
                    $db = loadDatabase();

                    $statement = $db->prepare("INSERT INTO users (user_date, user_email, user_name, user_pass, user_type) VALUES(?, ?, ?, ?, ?)");

                    $statement->bindParam(1, 'NOW()');
                    $statement->bindParam(2, $email);
                    $statement->bindParam(3, $user);
                    $statement->bindParam(4, $pass);
                    $statement->bindParam(5, 0);

                    $statement->exec();

                    $result = "User Registered!";
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