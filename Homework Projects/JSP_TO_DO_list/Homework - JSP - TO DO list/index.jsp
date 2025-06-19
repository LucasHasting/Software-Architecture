<%@page import="java.util.ArrayList" %>

<html>
    <head>
        <title>
        Title in browser.
        </title>
    </head>
    <body>
    Add to shopping cart:
    <form action="index.jsp">
        <input name="itemid" type="text"/>
        <input type="submit" value="Add"/>
    </form>

    <!-- Read query string & parameter !-->

    TO DO:

    <%
    //get cart out of the session
    ArrayList<String> cart = (ArrayList<String>) session.getAttribute("cart");
    
    //if not found, create it
    if (cart == null) {
        cart = new ArrayList();
        session.setAttribute("cart", cart);
    }

    //save the item to the cart
    String item = request.getParameter("itemid");
    if (item != null) {
        cart.add(item);
    }

    //save the cart into the session
    session.setAttribute("cart", cart);

    //display the contents of the cart
    out.println("<ul>");
    for (String thing: cart) {
        out.println("<li>" + thing + "</li>");
    }
    out.println("</ul>");        
    %>
    </body>
</html>