<section>
    <?php
            require "../database/databaseConnect.php";
            $db = loadDatabase();

            if ($db !== null) {
                echo $db;
            }
    ?>
</section>