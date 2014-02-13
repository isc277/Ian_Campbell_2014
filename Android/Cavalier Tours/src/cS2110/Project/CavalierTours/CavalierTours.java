package cS2110.Project.CavalierTours;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.Toast;

/**
 * @author Ian Campbell
 *	This activity is the main menu.  It contains radio buttons to start both
 *	GPS activities (by map and by coordinates).
 */
public class CavalierTours extends Activity {


	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.main_layout);
		
		//Button used to start tour by coordinates
		final Button startTour = (Button) findViewById(R.id.widget38);
		startTour.setOnClickListener(new OnClickListener() {
			public void onClick(View v) {
				Intent i = new Intent(CavalierTours.this, TourActivity.class);
				startActivity(i);
			}
		});
		
		//Button used to start tour using Maps
		final Button startMaps = (Button) findViewById(R.id.widget37);
		startMaps.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				Intent i = new Intent(CavalierTours.this, CavalierMaps.class);
				startActivity(i);
			}
			
		});
		
		//Information button used to provide user with more information about
		//application
		final Button button1 = (Button) findViewById(R.id.widget92);
		button1.setOnClickListener(new OnClickListener() {
			public void onClick(View v) {
				Toast
						.makeText(
								CavalierTours.this,
								"Cavalier Tours designed and created by:"
										+ "Andrew Dawson, Wes Edwards,				A.J. Mehalic and Ian Campbell"
										+ "			Cavalier Tours Version Alpha"
										+ "                                        "
										+ "Designed using Android SDK v.2.1.0",
								Toast.LENGTH_LONG).show();
			}
		});
		
		//Information button used to provide user with instructions on how the
		//	tour should be taken around UVa
		final Button helpButton = (Button) findViewById(R.id.widget35);
		helpButton.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				Toast.makeText(CavalierTours.
						this, "Instructions: To take a tour around grounds, " +

						"try to make your current location the same as the next tour " +

						"stop. As you get closer, the droid icon will change color to" +

						" indicate how hot,warm or cold you are. Alternatively, you " +

						"can look at the map view and see where the next locaiton is " +

						"with the pointing arrow and location points on the map.", Toast.LENGTH_LONG).show();
				
			}
			
		});

	}
}
