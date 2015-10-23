<?php
    session_start();

    if ($_SESSION['user'] !== null) {
        require ('../database/databaseConnect.php');
        $db = loadDatabase();
        $user = $db->query("SELECT * FROM users WHERE user_name = '" . $_SESSION['user'] . "' LIMIT 1");

        if ($user !== false && $user->rowCount === 1) {
            $user->setFetchMode(PDO::FETCH_ASSOC);
            $user = $user->fetch();
        } else {
            header('Location: http://php-gshawm.rhcloud.com/php-project/php_index.php');
            exit();
        }
    } else {
        header('Location: http://php-gshawm.rhcloud.com/php-project/php_index.php');
        exit();
    }
?>
<section>
    <h1 class="Title"><?php echo $user["user_name"] . "'s Profile"; ?></h1>
    
    <div>
        <div></div>
        <div></div>
    </div>
</section>