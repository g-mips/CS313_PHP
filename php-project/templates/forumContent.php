<?php
    session_start();
?>
<section id="Forum">
    <?php
            require "../database/databaseConnect.php";
            $db = loadDatabase();

            // If it is null, we need to handle it differently!
            if ($db !== null) {
                
                // What page are we trying to access?
                if ($_SESSION['page'] == 0 || $_SESSION['page' === null]) {
                    echo "<h1 class='ForumTitle'>Forum</h1>";
                    $cats = $db->query("SELECT * FROM categories ORDER BY cat_order");
                    
                    // Categories Loop
                    foreach ($cats as $cat) {
                        echo "<section class='Cat'>";
                        echo "<h1 class='CatName'>" . $cat["cat_name"] . "</h1>";

                        $sub_cats = $db->query("SELECT * FROM sub_categories INNER JOIN categories ON sub_categories.sub_cat_cat = categories.cat_id WHERE categories.cat_id = " . $cat["cat_id"] . " ORDER BY sub_categories.sub_cat_order");

                        foreach ($sub_cats as $sub_cat) {
                            echo "<a class='ForumLink' href=''>";
                            echo "<section class='SubCat'>";
                            echo "<h2 class='SubCatName'>" . $sub_cat["sub_cat_name"] . "</h2>";
                            echo "<p class='SubCatDescription'>" . $sub_cat["sub_cat_description"] . "</p>";
                            echo "<hr class='ForumLine'/>";
                            echo "</section>";
                            echo "</a>";
                        }
                        echo "</section>";
                    }
                }
            }
    ?>
</section>