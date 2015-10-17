<section>
    <?php
            require "../database/databaseConnect.php";
            $db = loadDatabase();

            if ($db !== null) {
                echo 'hi';
            }
    ?>
</section>