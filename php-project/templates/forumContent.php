<?php
    session_start();
?>
<section id="Forum">
    <?php
        require "../database/databaseConnect.php";

        /*function displaySubCats($cat) {
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
        }*/

        $db = loadDatabase();

        // If it is null, we need to handle it differently!
        if ($db !== null) {

            // What page are we trying to access?
            if ($_SESSION['page'] == 0 || $_SESSION['page' === null]) {
                $cats = $db->query("SELECT * FROM categories ORDER BY cat_order");
                echo "<h1 class='ForumTitle'>Forum</h1>";

                // Categories Loop
                foreach ($cats as $cat) {
                    echo "<a class='ForumLink' href='/php-project/forum.php?page=1&id=" . $cat["cat_id"] . "'>";
                    echo "<section class='Cat'>";
                    echo "<h1 class='CatName'>" . $cat["cat_name"] . "</h1>";

                    //displaySubCats($cat);
                    
                    echo "</section>";
                    echo "</a>";
                }
            } else if ($_SESSION['id'] !== null) {
                if ($_SESSION['page'] == 1) {
                    $cat = $db->query("SELECT * FROM categories WHERE cat_id = " . $_SESSION['id']);
                    echo $cat;
                    //echo "<h1 class='ForumTitle'>" . $cat["cat_name"] . "</h1>";

                    //displaySubCats($cat);
                } else if ($_SESSION['page'] == 2) {

                } else if ($_SESSION['page'] == 3 && $_SESSION['tpage'] !== null) {

                }
            }
        }
    ?>
</section>