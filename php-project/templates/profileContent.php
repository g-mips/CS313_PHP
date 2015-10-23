<?php
    session_start();
    require ('../database/databaseConnect.php');
    $db = loadDatabase();
    $test = "HEY";
?>
<section>
    <h1 class="Title"><?php echo $_SESSION['user'] . "'s Profile"; ?></h1>
    
    <div>
        <div><?php echo $test ?></div>
        <div></div>
    </div>
</section>