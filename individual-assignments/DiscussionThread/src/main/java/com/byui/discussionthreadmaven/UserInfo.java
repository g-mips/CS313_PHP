/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.byui.discussionthreadmaven;

/**
 *
 * @author Grant
 */
public class UserInfo {
    private String user;
    private String post;
    private String date;

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getUser() {
        return user;
    }

    public void setUser(String user) {
        this.user = user;
    }

    public String getPost() {
        return post;
    }

    public void setPost(String post) {
        this.post = post;
    }

    public UserInfo(String user, String post, String date) {
        setUser(user);
        setPost(post);
        setDate(date);
    }
}
