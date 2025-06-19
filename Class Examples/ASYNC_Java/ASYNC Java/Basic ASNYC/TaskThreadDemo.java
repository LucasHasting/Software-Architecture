public class TaskThreadDemo {
	//shared variable
	private static int winner = -1;
	
	//synchronized prevents a race condition
	public static synchronized void finish(int car) {
		if (winner == -1)
			winner = car;
	}
	
	public static void main(String[] args) {
		// Create tasks (code to the interface; not the implementation!)
		Runnable jr = new StockCar(88);
		Runnable gordon = new StockCar(24);
		Runnable jjohnson = new StockCar(48);

		// Create threads
		Thread thread1 = new Thread(jr);
		Thread thread2 = new Thread(gordon);
		Thread thread3 = new Thread(jjohnson);

		// Start threads
		thread1.start();
		thread2.start();
		thread3.start();
		
		synchronized (thread3) {
			try {
				thread3.wait();
			} catch(InterruptedException e) {
				e.printStackTrace();
			}
		}
		System.out.println("\nwinner is: " + winner);
		
	}
}
