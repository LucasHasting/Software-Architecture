import java.io.IOException;
import java.net.*;

public class Server{
    //does not require the exception to be caught
    public static void main(String args[]) throws IOException{
        System.out.println("Hello World");

        ServerSocket ss = new ServerSocket(80);

        ss.accept();

        System.out.println("connection established");
    }
    
}