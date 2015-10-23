<?php
    session_start();

    if ($_SESSION['user'] !== null) {
        require ('../database/databaseConnect.php');
        $db = loadDatabase();
        $user = $db->query("SELECT * FROM users WHERE user_name = '" . $_SESSION['user'] . "' LIMIT 1");

        if ($user !== false && $user->rowCount() === 1) {
            $user->setFetchMode(PDO::FETCH_ASSOC);
            $user = $user->fetch();
        } else {
            header('Location: http://php-gshawm.rhcloud.com/php-project/php_index.php');
            exit();
        }
    } else {
        header('Location: http://php-gshawm.rhcloud.com/php-project/php_index.php');
        exit();
    }
?>
<section>
    <h1 class="Title"><?php echo $user["user_name"] . "'s Profile"; ?></h1>
    
    <div>
        <div></div>
        <div id="Tabs">
            <ul class="nav nav-pills">
                <li><a ng-class="{ active:profile.isTabSet(1) }" href ng-click="setTab(1)">Info</a></li>
                <li><a ng-class="{ active:profile.isTabSet(2) }" href ng-click="setTab(2)">Forum</a></li>
                <li><a ng-class="{ active:profile.isTabSet(3) }" href ng-click="setTab(3)">Change Password</a></li>
            </ul>
            <div id="Content_Area">
                <div ng-show="profile.isTabSet(1)">
                    <p>This is the text for tab 1</p>
                </div>
                <div ng-show="profile.isTabSet(2)">
                    <p>This is the text for tab 2.</p>
                </div>
                <div ng-show="profile.isTabSet(3)">
                    <p>This is the text for tab 3.</p>
                </div>
            </div>
        </div>
    </div>
    <br style="clear: both;" />
</section>