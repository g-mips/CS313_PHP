<h1 class="Title">Login</h1>

<form name="loginForm" ng-submit="loginForm.$valid && login()" novalidate>
    <div>
        <label for="Username">Username </label>
        <input id="Username" ng-model="username" type="text" name="username" required/><br />
    </div>
    <div>
        <label for="Password">Password </label>
        <input id="Password" ng-model="password" type="password" name="password" required/><br />
    </div>
    <div>
        <input id="Submit" type="submit" name="submit" value="Login" ng-disabled="loginForm.$invalid" />
    </div>
</form>

<section>
    <h1 id="Results">{{submissionResult}}</h1>
</section>