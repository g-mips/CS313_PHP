<?php
    session_start();
?>
<form name="addPostForm" ng-submit="addPostForm.$valid" novalidate>
    <div class="FormDiv">
        <label for="Subject">Subject</label>
        <input id="Subject" ng-model="subject" type="text" name="subject" requred/><br />
    </div>
    <div class="FormDiv">
        <label for="Content">Content</label>
        <textarea id="Content" rows="30" cols="70" required></textarea>
    </div>
    <div class="FormDiv">
        <label></label>
        <input id="Submit" type="submit" name="submit" value="Add Post" ng-disabled="addPostForm.$invalid" />
    </div>
</form>