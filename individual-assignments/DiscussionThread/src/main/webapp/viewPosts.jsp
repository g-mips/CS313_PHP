<%-- 
    Document   : viewPosts
    Created on : Nov 10, 2015, 3:51:20 PM
    Author     : Grant
--%>

<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        
        <link rel="stylesheet" type="text/css" href="discussion.css" />
    </head>
    <body>
        <div>
            <h1>Posts</h1>
            <main>
                <c:forEach var="post" items="${posts}">
                    <section>
                        <aside>${post.user} - ${post.date}</aside>
                        <aside>${post.post}</aside>
                    </section>
                </c:forEach>
                <p><a href="CreatePostc">Add a Post</a></p>
            </main>
        </div>
    </body>
</html>
