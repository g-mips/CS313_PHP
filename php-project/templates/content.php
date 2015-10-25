<?php
    session_start();
?>
<section id="Content">
    <hr id="TopLine"/>
    
    <section ng-if="main.page === 'HOME'" ng-controller="HomeCtrl as home">
        <home-content></home-content>
    </section>
    
    <section ng-if="main.page === 'VIDEOS'" ng-controller="VideosCtrl as videos">
        <videos-content></videos-content>
    </section>
    
    <section ng-if="main.page === 'FORUM'" ng-controller="ForumCtrl as forum">
        <forum-content></forum-content>
    </section>
    
    <section ng-if="main.page === 'CONTACT'" ng-controller="ContactCtrl as contact">
        <contact-content></contact-content>
    </section>
    
    <section ng-if="main.page === 'SIGNUP'" ng-controller="SignupCtrl as signup">
        <signup-content></signup-content>
    </section>
    
    <section ng-if="main.page === 'LOGIN'" ng-controller="LoginCtrl as login">
        <login-content></login-content>
    </section>
    
    <section ng-if="main.page === 'PROFILE'">
        <profile-content></profile-content>
    </section>
    
    <section ng-if="main.page === 'ADDPOST'" ng-controller="AddPostCtrl as addPost">
        <add-post-content></add-post-content>
    </section>
    
    <hr id="BottomLine"/>
</section>