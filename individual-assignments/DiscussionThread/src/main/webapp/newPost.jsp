<%-- 
    Document   : newPost
    Created on : Nov 10, 2015, 3:53:07 PM
    Author     : Grant
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>New Post</title>
        
        <link rel="stylesheet" type="text/css" href="discussion.css" />
    </head>
    <body>
        <div>
            <h1>Enter a New Post</h1>
            
            <form method="post" action="CreatePost">
                <textarea id="Content" name="content" rows="20" cols="30" maxlength="500"></textarea>
                
                <br />
                
                <input type="submit" value="Submit" />
            </form>
            
            <p><a href="LoadPosts">View Posts</a></p>
        </div>
    </body>
</html>
