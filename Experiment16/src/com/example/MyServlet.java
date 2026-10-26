/*
  GROUP NAME: ______________________________
  GROUP MEMBERS NAME AND ID:
    1. Bitanya Tigabe              (ID: 0248/15)
    2. Mohammed Elias              (ID: 0766/15)
    3. Awel Hussen                 (ID: 0178/15)
    4. Raeey Nega                  (ID: 5307/16)
    5. Hamdi Mohammes              (ID: 0505/15)
    6. Heyru Jemal                 (ID: 0546/15)
  Title of the program: MyServlet - a simple HTTP servlet used in
                         Experiment 16 (Ant compile and Tomcat deployment)
  Output (compilation): Compiles successfully; when requested, the servlet
                         returns "Hello from MyServlet!"
*/
package com.example;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.*;

public class MyServlet extends HttpServlet {
    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp)
            throws ServletException, IOException {
        resp.setContentType("text/plain");
        resp.getWriter().println("Hello from MyServlet!");
    }
}
