import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;

public class WebServer {
	public static void main(String[] args) throws IOException {
		ServerSocket serverSocket = null;
		try {
			serverSocket = new ServerSocket(80);

			while (true) {
				Socket clientSocket = serverSocket.accept();
				Thread thread = new Thread(new WebTask(clientSocket));
				thread.start();
			}
		} catch (IOException ioe) {
			System.err.println("Server error (500): " + ioe.getMessage());
		} finally {
			serverSocket.close();
		}
	}

}
