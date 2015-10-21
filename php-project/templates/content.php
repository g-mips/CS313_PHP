<?php
    session_start();
?>
<section id="Content">
    <hr id="TopLine"/>
    
    <section ng-if="main.page === 'HOME'">
        <home-content ng-controller="HomeCtrl as home"></home-content>
    </section>
    
    <section ng-if="main.page === 'VIDEOS'">
        <videos-content ng-controller="VideosCtrl as videos"></videos-content>
    </section>
    
    <section ng-if="main.page === 'FORUM'">
        <forum-content ng-controller="ForumCtrl as forum"></forum-content>
    </section>
    
    <section ng-if="main.page === 'CONTACT'">
        <contact-content ng-controller="ContactCtrl as contact"></contact-content>
    </section>
    
    <section ng-if="main.page === 'SIGNUP'">
        <signup-content ng-controller="SignupCtrl as signup"></signup-content>
    </section>
    
    <hr id="BottomLine"/>
</section>