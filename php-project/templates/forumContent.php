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
                    $tableNames = ["", "cat_name", "sub_cat_name", "topic_subject"];
                    $tableFks = ["", "", "sub_cat_cat", "topic_sub_cat"];
                    
                    // Holder for current page's ID and title.
                    $pageId = "";
                    $pageTitle = "";
                    $curId = "";
                    
                    // Holder for all IDs.
                    $ids = [""];
                    $idsTemp = [];
                    
                    // Holder for titles
                    $titles = ["Forum"];
                    $titlesTemp = [];
                    
                    // Figure out current page's ID.
                    if ($_SESSION['page'] > 0) {
                        $query = "SELECT * FROM " . $tables[$_SESSION['page']] . " WHERE " . $tableIds[$_SESSION['page']] .
                            " = " . $_SESSION['id'];
                        $results = $db->query($query);
                        $results->setFetchMode(PDO::FETCH_ASSOC);
                        $results = $results->fetch();
                        $pageId = $results[$tableIds[$_SESSION['page']]];
                        $pageTitle = $results[$tableNames[$_SESSION['page']]];
                        $curId = $results[$tableFks[$_SESSION['page']]];
                    }
                    
                    // Figure out all IDs in between page 0 and current page.
                    for ($index = 0; $index + 1 < $_SESSION['page']; $index++) {
                        $curTable = $_SESSION['page'] - $index;
                        $preTable = $_SESSION['page'] - $index - 1;
                        
                        $query = "SELECT * FROM " . $tables[$preTable] . " INNER JOIN " . $tables[$curTable] . " ON " . $tables[$curTable] . "."
                            . $tableFks[$curTable] . " = " . $tables[$preTable] . "." . $tableIds[$preTable] . " WHERE " .
                            $tables[$curTable] . "." . $tableFks[$curTable] . " = " . $curId;
                        
                        $results = $db->query($query);
                        $results->setFetchMode(PDO::FETCH_ASSOC);
                        $results = $results->fetch();
                        
                        $idsTemp[] = $results[$tableIds[$preTable]];
                        $titlesTemp[] = $results[$tableNames[$preTable]];
                        $curId = $results[$tableFks[$preTable]];
                    }

                    // Push on all IDs in between page 0 and current page.
                    for ($index = count($idsTemp) - 1; $index >= 0; $index--) {
                        $ids[] = "&id=" . $idsTemp[$index];
                        $titles[] = $titlesTemp[$index];
                    }
                    
                    // Push on current page's ID.
                    $ids[] = "&id=" . $pageId;
                    $titles[] = $pageTitle;
                    
                    echo "<nav id='ForumNav'>";
                    echo "<ul>";

                    for ($navIndex = 0; $navIndex <= $_SESSION['page']; $navIndex++) {
                        $tpage = "";
                        
                        if ($navIndex >= 2) {
                            $tpage = "&tpage=1";
                        }
                        
                        echo "<li><a href='forum.php?page=" . $navIndex . $ids[$navIndex] . $tpage . "'>" .
                            $titles[$navIndex] . "</a><span> -&gt;<span></li>";
                    }

                    echo "</ul>";
                    echo "</nav>";
                }
            } else {
                //header("Location: http://php-gshawm.rhcloud.com/php-project/forum.php?page=0");
                //exit();
            }
        }

        $db = loadDatabase();
        
        $dbIsGood = true;

        if ($db === null) {
            $dbIsGood = false;
        }

        createNavigationBar($db);
?>
    
    <section ng-if="<?php echo $dbIsGood ? 'true' : 'false'; ?>">
    
        <section ng-if="<?php echo ($_SESSION['page'] == 0) ? 'true' : 'false'; ?> || <?php echo !isset($_SESSION['page']) ? 'true' : 'false'; ?>">
            <h1 class="ForumTitle">Forum</h1>
            
            <?php
/*                $cats = $db->query("SELECT * FROM categories ORDER BY cat_order");

                // Categories Loop
                foreach ($cats as $cat) {
                    echo "<a class='ForumLink' href='/php-project/forum.php?page=1&id=" . $cat["cat_id"] . "'>";
                    echo "<section class='Cat'>";
                    echo "<h1 class='CatName'>" . $cat["cat_name"] . "</h1>";

                    displaySubCats($db, $cat["cat_id"]);

                    echo "</section>";
                    echo "</a>";
                }*/
            ?>
        </section>
    
        <section ng-if="<?php echo ($_SESSION['page'] == 1) ? 'true' : 'false'; ?> && <?php echo isset($_SESSION['id']) ? 'true' : 'false'; ?>">
            <?php
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
            ?>
        </section>
        
        <section ng-if="<?php echo ($_SESSION['page'] == 2) ? 'true' : 'false'; ?> && <?php echo isset($_SESSION['id']) ? 'true' : 'false'; ?>
                        && <?php echo ($_SESSION['tpage'] !== null) ? 'true' : 'false'; ?>">
            <?php
                $query = "SELECT sub_cat_name FROM sub_categories WHERE sub_cat_id = " . $_SESSION['id'];
                $titles = $db->query($query);
                $titles->setFetchMode(PDO::FETCH_ASSOC);
                $title = $titles->fetch();

                $query = "SELECT * FROM topics INNER JOIN sub_categories ON topics.topic_sub_cat = sub_categories.sub_cat_id WHERE sub_categories.sub_cat_id = " . $_SESSION['id'] . " AND topics.topic_pinned = 1 ORDER BY topics.topic_date";
                $pinnedTopics = $db->query($query);
                $pinnedTopics = $pinnedTopics->fetchAll();

                $query = "SELECT * FROM topics INNER JOIN sub_categories ON topics.topic_sub_cat = sub_categories.sub_cat_id WHERE sub_categories.sub_cat_id = " . $_SESSION['id'] . " AND topics.topic_pinned = 0 ORDER BY topics.topic_date";
                $nonPinnedTopics = $db->query($query);
                $nonPinnedTopics = $nonPinnedTopics->fetchAll();

            ?>
            
            <h1 class="ForumTitle"><?php echo $title["sub_cat_name"]; ?></h1>
            <h1 class="CatName">Threads</h1>

            <?php
                $startTopicIndex = (($_SESSION['tpage'] - 1) * 20);
                $endTopicIndex = $_SESSION['tpage'] * 20;

                $size = sizeof($pinnedTopics) + sizeof($nonPinnedTopics);

                if ($size < $startTopicIndex || $size > $endTopicIndex) {
                    // DISPLAY PAGE DOESN'T EXIST
                } else if ($size === 0) {
                    echo "<section>";
                    echo "<h2 class='SubCatName'>There are no topics! Please help this place by creating a thread!</h2>";
                    echo "<hr class='ForumLine'/>";
                    echo "</section>";
                } else {
                    for ($index = $startTopicIndex; $index < $endTopicIndex && $index < $size; $index++) {
                        $topic = $pinnedTopics[$index];

                        if ($index >= sizeof($pinnedTopics)) {
                            $topic = $nonPinnedTopics[$index];
                        }

                        echo "<a class='ForumLink' href='/php-project/forum.php?page=3&id=" . $topic["topic_id"] . "&tpage=1'>";
                        echo "<section class='SubCat'>";
                        echo "<h2 class='SubCatName'>" . $topic["topic_subject"] . "</h2>";
                        echo "<hr class='ForumLine'/>";
                        echo "</section>";
                        echo "</a>";
                    }
                }
            ?>
            
                <button ng-if="<?php echo $_SESSION['logged'] ? 'true' : 'false'; ?>" type="button" onclick="location.href='php-project/addThread.php'">Add Thread</button>

<!--                if ($_SESSION['logged']) {
                    echo "<button type='button' onclick='location.href=\"/php-project/addThread.php\"'>Add Thread</button>";
                }-->
        </section>
        
        <section ng-if="<?php echo ($_SESSION['page'] == 3) ? 'true' : 'false'; ?> && <?php echo isset($_SESSION['id']) ? 'true' : 'false'; ?>
                        && <?php echo isset($_SESSION['tpage']) ? 'true' : 'false'; ?>">
            <?php
                $query = "SELECT * FROM topics WHERE topic_id = " . $_SESSION['id'];
                $topics = $db->query($query);
                $topics->setFetchMode(PDO::FETCH_ASSOC);
                $topic = $topics->fetch();

                $query = "SELECT * FROM posts INNER JOIN topics ON posts.post_topic = topics.topic_id WHERE topics.topic_id = " .
                    $_SESSION['id'] . " ORDER BY posts.post_date";
                $posts = $db->query($query);
                $posts = $posts->fetchAll();

                $startPostIndex = (($_SESSION['tpage'] - 1) * 20);
                $endPostIndex = $_SESSION['tpage'] * 20;

                $size = sizeof($posts);
            ?>
            
            <h1 class="ForumTitle"><?php echo $topic["topic_subject"]; ?></h1>
            
            <?php
                if ($size < $startPostIndex || $size > $endPostIndex) {

                } else {
                    for ($index = $startPostIndex; $index < $endPostIndex && $index < $size; $index++) {
                        $post = $posts[$index];

                        $user = $db->query("SELECT * FROM users INNER JOIN posts ON users.user_id = posts.post_author WHERE posts.post_author = " . $post["post_author"]);
                        $user->setFetchMode(PDO::FETCH_ASSOC);
                        $user = $user->fetch();

                        echo "<section class='ContentContainer'>";
                        echo "<h1 class='User'>" . $user['user_name'] . "</h1>";
                        echo "<p class='SubCatDescription PostContent'>" . $post["post_content"] . "</p>";
                        echo "</section>";
                    }
                }
            ?>

            <section ng-if="<?php echo $_SESSION['logged'] ? 'true' : 'false'; ?>">
                <button type='button' ng-click='setReply(true)' ng-hide='isReplying'>Reply</button>

                <section ng-show='isReplying'>
                    <h1 class="Title">Reply</h1>
                    <form name='replyForm' ng-submit='replyForm.$valid' novalidate>
                        <div class='FormDiv'>
                            <textarea id='Content' name='content' ng-model='content' rows='30' cols='70' required></textarea><br />
                        </div>
                        <div class='FormDiv'>
                            <input id='Submit' type='submit' name='submit' value='Add Reply' ng-disable='replyForm.$invalid' />
                            <input id='Cancel' type='button' name='cancel' value='Cancel' ng-click='setReply(false)' />
                        </div>
                    </form>
                </section>
            </section>
        </section>
    </section>
    
<?php
        // If it is null, we need to handle it differently!
        /*if ($db !== null) {
            // Navigation bar
            createNavigationBar($db);

            // What page are we trying to access?
            if ($_SESSION['page'] == 0 || $_SESSION['page'] === null) {
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
            /*} else if ($_SESSION['id'] !== null) {
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
                    }*/
                /*} else if ($_SESSION['page'] == 2 && $_SESSION['tpage'] !== null) {
                    // Getting title of page.
                    $query = "SELECT sub_cat_name FROM sub_categories WHERE sub_cat_id = " . $_SESSION['id'];
                    $titles = $db->query($query);
                    $titles->setFetchMode(PDO::FETCH_ASSOC);
                    $title = $titles->fetch();

                    //
                    $query = "SELECT * FROM topics INNER JOIN sub_categories ON topics.topic_sub_cat = sub_categories.sub_cat_id WHERE sub_categories.sub_cat_id = " . $_SESSION['id'] . " AND topics.topic_pinned = 1 ORDER BY topics.topic_date";
                    $pinnedTopics = $db->query($query);
                    $pinnedTopics = $pinnedTopics->fetchAll();

                    $query = "SELECT * FROM topics INNER JOIN sub_categories ON topics.topic_sub_cat = sub_categories.sub_cat_id WHERE sub_categories.sub_cat_id = " . $_SESSION['id'] . " AND topics.topic_pinned = 0 ORDER BY topics.topic_date";
                    $nonPinnedTopics = $db->query($query);
                    $nonPinnedTopics = $nonPinnedTopics->fetchAll();

                    echo "<h1 class='ForumTitle'>" . $title["sub_cat_name"] . "</h1>";
                    echo "<h1 class='CatName'>Threads</h1>";

                    $startTopicIndex = (($_SESSION['tpage'] - 1) * 20);
                    $endTopicIndex = $_SESSION['tpage'] * 20;

                    $size = sizeof($pinnedTopics) + sizeof($nonPinnedTopics);

                    if ($size < $startTopicIndex || $size > $endTopicIndex) {
                        // DISPLAY PAGE DOESN'T EXIST
                    } else if ($size === 0) {
                        echo "<section>";
                        echo "<h2 class='SubCatName'>There are no topics! Please help this place by creating a thread!</h2>";
                        echo "<hr class='ForumLine'/>";
                        echo "</section>";
                    } else {
                        for ($index = $startTopicIndex; $index < $endTopicIndex && $index < $size; $index++) {
                            $topic = $pinnedTopics[$index];

                            if ($index >= sizeof($pinnedTopics)) {
                                $topic = $nonPinnedTopics[$index];
                            }

                            echo "<a class='ForumLink' href='/php-project/forum.php?page=3&id=" . $topic["topic_id"] . "&tpage=1'>";
                            echo "<section class='SubCat'>";
                            echo "<h2 class='SubCatName'>" . $topic["topic_subject"] . "</h2>";
                            echo "<hr class='ForumLine'/>";
                            echo "</section>";
                            echo "</a>";
                        }
                    }

                    if ($_SESSION['logged']) {
                        echo "<button type='button' onclick='location.href=\"/php-project/addThread.php\"'>Add Thread</button>";
                    }
                }*/ /*else if ($_SESSION['page'] == 3 && $_SESSION['tpage'] !== null) {
                    $query = "SELECT * FROM topics WHERE topic_id = " . $_SESSION['id'];
                    $topics = $db->query($query);
                    $topics->setFetchMode(PDO::FETCH_ASSOC);
                    $topic = $topics->fetch();

                    echo "<h1 class='ForumTitle'>" . $topic["topic_subject"] . "</h1>";

                    $query = "SELECT * FROM posts INNER JOIN topics ON posts.post_topic = topics.topic_id WHERE topics.topic_id = " .
                        $_SESSION['id'] . " ORDER BY posts.post_date";
                    $posts = $db->query($query);
                    $posts = $posts->fetchAll();

                    $startPostIndex = (($_SESSION['tpage'] - 1) * 20);
                    $endPostIndex = $_SESSION['tpage'] * 20;

                    $size = sizeof($posts);

                    if ($size < $startPostIndex || $size > $endPostIndex) {

                    } else {
                        for ($index = $startPostIndex; $index < $endPostIndex && $index < $size; $index++) {
                            $post = $posts[$index];

                            $user = $db->query("SELECT * FROM users INNER JOIN posts ON users.user_id = posts.post_author WHERE posts.post_author = " . $post["post_author"]);
                            $user->setFetchMode(PDO::FETCH_ASSOC);
                            $user = $user->fetch();

                            echo "<section class='ContentContainer'>";
                            echo "<h1 class='User'>" . $user['user_name'] . "</h1>";
                            echo "<p class='SubCatDescription PostContent'>" . $post["post_content"] . "</p>";
                            echo "</section>";
                        }
                    }

                    if ($_SESSION['logged']) {
                        echo "<button type='button' ng-click='setReply(true)' ng-hide='{{isReplying}}'>Reply</button>";

                        echo "<section ng-show='{{isReplying}}'>";
                        echo "<form name='replyForm' ng-submit='replyForm.\$valid' novalidate>";
                        echo "<div class='FormDiv'>";
                        echo "<label for='Content'>Content</label>";
                        echo "<textarea id='Content' name='content' ng-model='content' rows='30' cols='70' required></textarea><br />";
                        echo "</div>";
                        echo "<div class='FormDiv'>";
                        echo "<label></label>";
                        echo "<input id='Submit' type='submit' name='submit' value='Add Reply' ng-disable='replyForm.\$invalid' />";
                        echo "<input id='Cancel' type='button' name='cancel' value='Cancel' ng-click='setReply(false)' />";
                        echo "</div>";
                        echo "</form>";
                        echo "</section>";
                    }
                } else {
                    // DISPLAY PAGE DOESN'T EXIST
                }
            } else {
                // DISPLAY PAGE DOESN'T EXIST
            }
        }*/
    ?>
</section>