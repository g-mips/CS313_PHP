<section>
    <?php
            require "../database/databaseConnect.php";
            $db = loadDatabase();

            // If it is null, we need to handle it differently!
            if ($db !== null) {
                $cats = $db->query("SELECT * FROM categories ORDER BY cat_order");
                
                foreach ($cats as $cat) {
                    echo "<h1 class='ForumCat'>" . $cat["cat_name"] . "</h1>";
                    
                    $sub_cats = $db->query("SELECT * FROM sub_categories INNER JOIN categories ON sub_categories.sub_cat_cat = categories.cat_id WHERE categories.cat_id = " . $cat["cat_name"] . " ORDER BY sub_categories.sub_cat_order");
                    
                    foreach ($sub_cats as $sub_cat) {
                        echo "<h2 class='ForumSubCat'>" . $sub_cat["sub_cat_name"] . "</h2>";
                        echo "<h3 class='SubCatDescription'>" . $sub_cat["sub_cat_description"] . "</h3>";
                    }
                }
            }
    ?>
</section>