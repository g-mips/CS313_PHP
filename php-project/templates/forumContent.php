<section>
    <?php require("../database/databaseConnect.php"); ?>

    <?php
            $db = loadDatabase();
            echo $db->exec("SELECT * FROM categories");
    ?>
</section>