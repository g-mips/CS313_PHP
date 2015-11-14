<%-- 
    Document   : signIn
    Created on : Nov 10, 2015, 3:53:27 PM
    Author     : Grant
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sign In</title>
        
        <link rel="stylesheet" type="text/css" href="discussion.css" />
    </head>
    <body>
        <div>
            <h1>Sign In</h1>
            <form method="post" action="SignIn">
                <label for="Username">Username</label>
                <input id="Username" name="username" type="text" /><br />
                <label for="Password">Password</label>
                <input id="Password" name="password" type="password" /><br />

                <input name="submit" type="submit" value="Submit"/>
            </form>
        </div>
    </body>
</html>
