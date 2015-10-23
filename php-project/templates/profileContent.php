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
                <li><a ng-class="{ active:profile.isTabSet(1) }" href ng-click="profile.setTab(1)">Info</a></li>
                <li><a ng-class="{ active:profile.isTabSet(2) }" href ng-click="profile.setTab(2)">Forum</a></li>
                <li><a ng-class="{ active:profile.isTabSet(3) }" href ng-click="profile.setTab(3)">Change Password</a></li>
            </ul>
            <div id="Content_Area">
                <div ng-show="profile.isTabSet(1)">
                    <p>Type of user:
                        <?php
                            if ($user["user_type"] == 0) {
                                echo "Standard";
                            } else if ($user["user_type"] == 1) {
                                echo "Moderator";
                            } else {
                                echo "Administrator";
                            }
                        ?>
                    </p>
                    <p>Date of account creation:
                        <?php
                            echo $user["user_date"];
                        ?>
                    </p>
                </div>
                <div ng-show="profile.isTabSet(2)">
                    <p>Topics:
                        <?php
                            $topics = $db->query("SELECT * FROM topics WHERE topic_author = '" . $user["user_id"] . "'");
                            
                            echo $topics->rowCount();
                        ?>
                    </p>
                    <p>Posts:
                        <?php
                            $posts = $db->query("SELECT * FROM posts WHERE post_author = '" . $user["user_id"] . "'");
                            
                            echo $posts->rowCount();
                        ?>
                    </p>
                </div>
                <div ng-show="profile.isTabSet(3)">
                    <p>
                        <form name="changePassword" ng-submit="changePassword.$valid && profile.changePassword('<?php echo $user["user_name"]; ?>')" novalidate>
                            <div>
                                <label for="OldPassword">Current Password </label>
                                <input id="OldPassword" ng-model="profile.oPassword" type="password" required/><br />
                            </div>
                            <div>
                                <label for="NewPassword">New Password </label>
                                <input id="NewPassword" ng-model="profile.nPassword" type="password" required/><br />
                            </div>
                            <div>
                                <label for="RetypeNewPassword">Retype New Password </label>
                                <input id="RetypeNewPassword" ng-model="profile.rnPassword" type="password" required/><br />
                            </div>
                            <div>
                                <input id="Submit" type="submit" name="submit" value="Change Password" ng-disabled="changePassword.$invalid" />
                            </div>
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <br style="clear: both;" />
</section>