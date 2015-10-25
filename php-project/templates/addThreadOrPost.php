<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["subject"]) && isset($_POST["content"]) && isset($_SESSION['id']) && $_SESSION['logged']) {
            require ('../database/databaseConnect.php');
            
            $db = loadDatabase();
            
            $user = $db->query("SELECT * FROM users WHERE user_name = '" . $_SESSION['user'] . "' LIMIT 1");
            $user->setFetchMode(PDO::FETCH_ASSOC);
            $user = $user->fetch();
            
            $statement = $db->prepare("INSERT INTO topics (topic_author, topic_date, topic_pinned, topic_subject, topic_sub_cat) VALUES (?, NOW(), ?, ?, ?)");
            $author = null;
            $pinned = null;
            $subject = null;
            $subCat = null;
            
            $statement->bindParam(1, $author);
            $statement->bindParam(2, $pinned);
            $statement->bindParam(3, $subject);
            $statement->bindParam(4, $subCat);
            
            $author = $user["user_id"];
            $pinned = 0;
            $subject = $_POST["subject"];
            $subCat = $_SESSION['id'];
            
            $statement->execute();
            
            $id = $db->lastInsertId();
            
            $statement = $db->prepare("INSERT INTO posts (post_author, post_content, post_date, post_topic) VALUES (?, ?, NOW(), ?)");
            
            $statement->bindParam(1, $author);
            $statement->bindParam(2, $_POST["content"]);
            $statement->bindParam(3, $id);
            
            $statement->execute();
            
            echo "SUCCESS";
        }
    }
?>