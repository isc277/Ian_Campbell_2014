package cS2110.Project.CavalierTours;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;

/**
 * @author Ian Campbell
 * This Activity is the first one to load that contains a Splash page
 *	which pops up when the application is first started and stays up for
 *	5 seconds.
 */
public class SplashPage extends Activity {
	
	/**
	 * This is a private variable which allows the handler to know when to stop
	 * the display of the splashpage and move to the next activity
	 */
	private static final int stopSplash = 0; 
	/**
	 * This is a private variable which tells the handler how long to display the
	 * splash page before moving to the next activity.
	 */
	private static final long splashTime = 5000; 

	/**
	 * This Handler provides the method by which the splash page is displayed.  It 
	 * also calls the next activity once the time limit is reached (5 seconds).
	 */
	private Handler splashHandler = new Handler() { 
		
		public void handleMessage(Message msg) { 
			switch (msg.what) { 
			case stopSplash: 
				Intent i = new Intent(SplashPage.this, CavalierTours.class);
				startActivity(i);
				break; 
			} 
		super.handleMessage(msg);
		}
	}; 
	
		public void onCreate(Bundle savedInstanceState) { 
			super.onCreate(savedInstanceState); 
			
			//Sets content view to the splash page
			setContentView(R.layout.splashpage); 
			
			//Creates new message and calls handler using message
			Message msg = new Message(); 
			msg.what = stopSplash; 
			splashHandler.sendMessageDelayed(msg, splashTime);
		}
}



