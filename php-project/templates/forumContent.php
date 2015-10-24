<?php
    session_start();
?>
<section id="Forum">
    <?php
        require "../database/databaseConnect.php";

        function displaySubCats($db, $id) {
            $sub_cats = $db->query("SELECT * FROM sub_categories INNER JOIN categories ON sub_categories.sub_cat_cat = categories.cat_id WHERE categories.cat_id = " . $id . " ORDER BY sub_categories.sub_cat_order");
            
            foreach ($sub_cats as $sub_cat) {
                echo "<a class='ForumLink' href='/php-project/forum.php?page=2&id=" . $sub_cat["sub_cat_id"] . "&tpage=1'>";
                echo "<section class='SubCat'>";
                echo "<h2 class='SubCatName'>" . $sub_cat["sub_cat_name"] . "</h2>";
                echo "<p class='SubCatDescription'>" . $sub_cat["sub_cat_description"] . "</p>";
                echo "<hr class='ForumLine'/>";
                echo "</section>";
                echo "</a>";
            }
        }

        function createNavigationBar($db) {
            if ($_SESSION['page'] <= 3 && $_SESSION['page'] >= 0) {
                if ($_SESSION['page'] > 0 && $_SESSION['id'] == null) {
                    echo "NO";
                    //header("Location: http://php-gshawm.rhcloud.com/php-project/forum.php?page=0");
                    //exit();
                } else {
                    // Set up for possible looping IDs.
                    $tables = ["", "categories", "sub_categories", "topics"];
                    $tableIds = ["", "cat_id", "sub_cat_id", "topic_id"];
                    $tableNames = ["", "cat_name", "sub_cat_name", "topic_name"];
                    $tableFks = ["", "", "sub_cat_cat", "topic_sub_cat"];
                    
                    // Holder for current page's ID and title.
                    $pageId = "";
                    $pageTitle = "";
                    
                    // Holder for all IDs.
                    $ids = [""];
                    $idsTemp = [];
                    
                    // Holder for titles
                    $titles = ["Forum"];
                    
                    // Figure out current page's ID.
                    /*if ($_SESSION['page'] > 0) {
                        $query = "SELECT * FROM " . $tables[$_SESSION['page']] . " WHERE " . $tableIds[$_SESSION['page']] . " = " $_SESSION['id'];
                        $results = $db->query($query);
                        $results->setFetchMode(PDO::FETCH_ASSOC);
                        $results = $results->fetch();
                        $pageId = $results[$tableIds[$_SESSION['page']]];
                        $pageTitle = $results[$tableNames[$_SESSION['page']]];
                    }*/
                    
                    // Figure out all IDs in between page 0 and current page.
                    for ($index = 0; $index + 1 < $_SESSION['page']; $index++) {
                        $curTable = $_SESSION['page'] - $index;
                        $preTable = $_SESSION['page'] - $index - 1;
                        
                        echo "DEX: " . $index . "<br />";
                        echo "CUR: " . $curTable . "<br />";
                        echo "PRE: " . $preTable . "<br />";
                        echo "TAB: " . $tables[$preTable] . "<br />";
                        
                        //$query = "SELECT * FROM " . $tables[$preTable] . " INNER JOIN " . $tables[$curTable] . " ON " . $tables[$curTable] . "." . tableFks[$curTable] . " = " . $tables[$preTable] . "." . $tableIds[$preTable];
                        
                        //echo $query . "<br />";
                        //$results = $db->query($query);
                        //$results->setFetchMode(PDO::FETCH_ASSOC);
                        //$results = $results->fetch();
                        
                        //$idsTemp[] = $results[$tableIds[$preTable]];
                    }

                    // Push on all IDs in between page 0 and current page.
                    for ($index = count($idsTemp) - 1; $index > 0; $index--) {
                        $ids[] = $idsTemp[$index];
                    }
                    
                    // Push on current page's ID.
                    $ids[] = $pageId;
                    
                    echo "<nav id='ForumNav'>";
                    echo "<ul>";

                    for ($navIndex = 0; $navIndex <= $_SESSION['page']; $navIndex++) {
                        $tpage = "";
                        
                        if ($navIndex === 3) {
                            $tpage = "&tpage=1";
                        }
                        
                        echo "<li><a href='forum.php?page=" . $navIndex . $ids[$navIndex] . $tpage . "'>" .
                            $titles[$navIndex] . "</a><span>-&gt;<span></li>";
                    }

                    echo "</ul>";
                    echo "</nav>";
                }
            } else {
                //header("Location: http://php-gshawm.rhcloud.com/php-project/forum.php?page=0");
                //exit();
            }
        }

        function run() {
            $db = loadDatabase();

            // If it is null, we need to handle it differently!
            if ($db !== null) {
                // Navigation bar
                createNavigationBar($db);
                
                // What page are we trying to access?
                if ($_SESSION['page'] == 0 || $_SESSION['page' === null]) {
                    $cats = $db->query("SELECT * FROM categories ORDER BY cat_order");
                    echo "<h1 class='ForumTitle'>Forum</h1>";

                    // Categories Loop
                    foreach ($cats as $cat) {
                        echo "<a class='ForumLink' href='/php-project/forum.php?page=1&id=" . $cat["cat_id"] . "'>";
                        echo "<section class='Cat'>";
                        echo "<h1 class='CatName'>" . $cat["cat_name"] . "</h1>";

                        displaySubCats($db, $cat["cat_id"]);

                        echo "</section>";
                        echo "</a>";
                    }
                } else if ($_SESSION['id'] !== null) {
                    if ($_SESSION['page'] == 1) {
                        $query = "SELECT * FROM categories WHERE cat_id = " . $_SESSION['id'];
                        $cat = $db->query($query);
                        
                        $index = 0;
                        foreach ($cat as $category) {
                            if ($index === 0) {
                                echo "<h1 class='ForumTitle'>" . $category["cat_name"] . "</h1>";
                                displaySubCats($db, $category["cat_id"]);
                                $index += 1;
                            }
                        }
                    } else if ($_SESSION['page'] == 2 && $_SESSION['tpage'] !== null) {
                        // Getting title of page.
                        $query = "SELECT sub_cat_name FROM sub_categories WHERE sub_cat_id = " . $_SESSION['id'];
                        $titles = $db->query($query);
                        $titles->setFetchMode(PDO::FETCH_ASSOC);
                        $title = $titles->fetch();
                        
                        //
                        $query = "SELECT * FROM topics INNER JOIN sub_categories ON topics.topic_sub_cat = " . $_SESSION['id'] . " AND topics.topic_pinned = 1 ORDER BY topics.topic_date";
                        $pinnedTopics = $db->query($query);
                        $pinnedTopics = $pinnedTopics->fetchAll();

                        $query = "SELECT * FROM topics INNER JOIN sub_categories ON topics.topic_sub_cat = " . $_SESSION['id'] . " AND topics.topic_pinned = 0 ORDER BY topics.topic_date";
                        $nonPinnedTopics = $db->query($query);
                        $nonPinnedTopics = $nonPinnedTopics->fetchAll();
                        
                        echo "<h1 class='ForumTitle'>" . $title["sub_cat_name"] . "</h1>";

                        $startTopicIndex = (($_SESSION['tpage'] - 1) * 20) + 1;
                        $endTopicIndex = $_SESSION['tpage'] * 20;
                        
                        if (sizeof($pinnedTopics) + sizeof($nonPinnedTopics) < $startTopicIndex) {
                            // DISPLAY PAGE DOESN'T EXIST
                        }                        
                    } else if ($_SESSION['page'] == 3 && $_SESSION['tpage'] !== null) {

                    } else {
                        // DISPLAY PAGE DOESN'T EXIST
                    }
                } else {
                    // DISPLAY PAGE DOESN'T EXIST
                }
            }
        }

        run();
    ?>
</section>