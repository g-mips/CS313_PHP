<section>
    <?php
            require "../database/databaseConnect.php";
            $db = loadDatabase();

            if ($db !== null) {
                $items = $db->query("SELECT * FROM categories");
                //var_dump($db);
                var_dump($items);
            }
    ?>
</section>