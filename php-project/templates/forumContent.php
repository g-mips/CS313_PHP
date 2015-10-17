<section>
    <?php require("../database/databaseConnect.php"); ?>

    <?php
            $db = loadDatabase();
            $items = $db->exec("SELECT * FROM categories");
    ?>
</section>