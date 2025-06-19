import java.io.IOException;
import java.io.PrintWriter;
import java.net.Socket;

public class WebTask implements Runnable {
	private Socket clientSocket = null;

	public WebTask(Socket client) {
		this.clientSocket = client;
	}

	@Override
	public void run() {
		PrintWriter out;
		try {
			out = new PrintWriter(clientSocket.getOutputStream(), true);

			out.println("<html>Hello <b>CIS 476</b>" 
					+ "<br><i>from: My Multi-Threaded Server</i></br>" 
					+ "</html>");

			out.close();

		} catch (IOException e) {
			e.printStackTrace();
		}

	}

}
