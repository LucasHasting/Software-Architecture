
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;

public class EchoServer {

    public static void main(String[] args) throws IOException {

        ServerSocket serverSocket = new ServerSocket(111);

        Socket clientSocket = serverSocket.accept();

        // objects that communicate through the socket
        PrintWriter out = new PrintWriter(
                clientSocket.getOutputStream(), true);
        BufferedReader in = new BufferedReader(
                new InputStreamReader(
                        clientSocket.getInputStream()));

        out.println("connection made");

        String inputLine = null;
        while ((inputLine = in.readLine()) != null) {
            inputLine = inputLine.toUpperCase();
            
            // debug: sent to console
            System.out.println(inputLine);

            out.println(inputLine);

            if (inputLine.equals("BYE")) {
                break;
            }
        }

        out.close();
        in.close();
        clientSocket.close();
        serverSocket.close();
    }

}
