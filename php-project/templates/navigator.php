<nav id="NavBar">
    <ul>
		<li>
			<a href="php_index.html">
				<img id="HeaderImage" src="images/controller-alone.png" />
			</a>
		</li>
		<li ng-class="{CurrentPage:main.isPageSet('HOME')}"><a href="php_index.html">HOME</a></li>
		<li ng-class="{CurrentPage:main.isPageSet('VIDEOS')}"><a href="videos.html">VIDEOS</a></li>
		<li ng-class="{CurrentPage:main.isPageSet('FORUM')}"><a href="forum.php?page=0">FORUM</a></li>
		<li ng-class="{CurrentPage:main.isPageSet('CONTACT')}"><a href="contact.html">CONTACT</a></li>
        <?php
            if ($_SESSION['logged']) {
                echo "<li ng-class=\"{CurrentPage:main.isPageSet('PROFILE')}\"><a href=\"profile.php\">PROFILE</a></li>";
                echo "<li ng-class=\"{CurrentPage:main.isPageSet('SIGNOUT')}\"><a href=\"signout.php\">SIGN OUT</a></li>";
            } else {
                echo "<li ng-class=\"{CurrentPage:main.isPageSet('SIGNUP')}\"><a href=\"signup.php\">SIGN UP</a></li>";
                echo "<li ng-class=\"{CurrentPage:main.isPageSet('LOGIN')}\"><a href=\"login.php\">LOG IN</a></li>";
            }
        ?>
    </ul>
</nav>