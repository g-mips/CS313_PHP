<!--action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"-->
<form name="signupForm" ng-submit="signupForm.$valid && register()" novalidate>
    Username: <input ng-model="username" type="text" name="username" required/><br />
    Password: <input ng-model="password" type="password" name="password" required/><br />
    Confirm Password: <input ng-model="cPassword" type="password" name="cpassword" required/><br />
    Email: <input ng-model="email" type="email" name="email" required/><br />

    <input type="submit" name="submit" value="Register" ng-disabled="signupForm.$invalid" />
</form>

<section>
    <h1>{{submissionResult}}</h1>
</section>