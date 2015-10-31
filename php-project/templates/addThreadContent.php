<?php
    session_start();
?>
<section>
    <h1 class="Title">Add Thread</h1>
    <form name="addPostForm" ng-submit="addPostForm.$valid && addThread()" novalidate>
        <div class="FormDiv">
            <label for="Subject">Subject</label>
            <input id="Subject" ng-model="subject" type="text" name="subject" requred/><br />
        </div>
        <div class="FormDiv">
            <label for="Content"></label>
            <textarea id="Content" ng-model="content" name="content" rows="30" cols="70" required></textarea>
        </div>
        <div class="FormDiv">
            <label></label>
            <input id="Submit" type="submit" name="submit" value="Add Post" ng-disabled="addPostForm.$invalid" />
        </div>
        <div class="FormDiv">
            <h1 id="Results">{{submissionResult}}</h1>
        </div>
    </form>
</section>