<?php
    session_start();

    if ($_SESSION["logged"]) {
        $_SESSION["logged"] = false;
        $_SESSION["user"] = null;
    }

    header('Location: http://php-gshawm.rhcloud.com/php-project/php_index.php');
    exit();
?>