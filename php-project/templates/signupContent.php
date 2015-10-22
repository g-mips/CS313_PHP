<h1 class="Title">Registration</h1>

<form name="signupForm" ng-submit="signupForm.$valid && register()" novalidate>
    <div>
        <label for="UserName">Username </label>
        <input id="UserName" ng-model="username" type="text" name="username" required/><br />
    </div>
    <div>
        <label for="Password">Password </label>
        <input id="Password" ng-model="password" type="password" name="password" required/><br />
    </div>
    <div>
        <label for="CPassword">Confirm Password </label>
        <input id="CPassword" ng-model="cPassword" type="password" name="cpassword" required/><br />
    </div>
    <div>
        <label id="Email">Email </label>
        <input ng-model="email" type="email" name="email" required/><br />
    </div>
    <div>
        <input type="submit" name="submit" value="Register" ng-disabled="signupForm.$invalid" />
    </div>
</form>

<section>
    <h1 id="Results">{{submissionResult}}</h1>
</section>