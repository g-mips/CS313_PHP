/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.byui.discussionthreadmaven;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.PrintWriter;
import java.util.Properties;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author Grant
 */
@WebServlet(name = "SignIn", urlPatterns = {"/SignIn"})
public class SignIn extends HttpServlet {
    private final String DATA_DIRECTORY = System.getenv("OPENSHIFT_DATA_DIR");
    
    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet SignIn</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet SignIn at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        String correctUsername = "";
        String correctPassword = "";
        Properties prop = new Properties();
        InputStream input = null;
        
        
        try {
            if (DATA_DIRECTORY == null) {
                input = this.getClass().getResourceAsStream("users.properties");
                prop.load(input);
                
                correctPassword = prop.getProperty(username);
                if (correctPassword != null && correctPassword.equals(password)) {
                    request.getRequestDispatcher("newPost.jsp").forward(request, response);
                } else {
                    request.getRequestDispatcher("invalidLogin.jsp").forward(request, response);
                }
            } else {
                String path = DATA_DIRECTORY + "users";
                BufferedReader reader = new BufferedReader(new FileReader(path)); 

                String line;
                boolean foundUsername = false;

                // Read file line by line
                while ((line = reader.readLine()) != null) {
                    String usernameAndPassword[] = line.split(" ");
                    String masterUsername = usernameAndPassword[0];
                    String masterPassword = usernameAndPassword[1];

                    // Compare username and password to file contents
                    if (username.equals(masterUsername) && password.equals(masterPassword)) {
                        request.getSession().setAttribute("username", username);
                        request.getRequestDispatcher("newPost.jsp").forward(request, response);
                        foundUsername = true;
                        break;
                    }
                }

                // Did we fail finding the username and password given by the user?
                if (!foundUsername) {
                    request.getRequestDispatcher("invalidLogin.jsp").forward(request, response);
                }
            }
        } catch (IOException e) {
            System.out.println(e.getMessage());
        }
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
