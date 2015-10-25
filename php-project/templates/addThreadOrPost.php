<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["subject"]) && isset($_POST["content"] && isset($_SESSION['id']) {
            echo "HI";
        }
    }
?>