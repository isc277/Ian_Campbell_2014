package cS2110.Project.CavalierTours;

import java.util.ArrayList;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

/**
 * @author Ian Campbell
 * This activity runs the coordinate based tour using a GPS listener
 * and interactive displays to allow the user to see their location, 
 * the next location on the tour, and change their location (for testing
 * purposes).
 */
public class TourActivity extends Activity {
	/**
	 * creates a defaultTour, which contains all of the stops along the tour
	 */
	final defaultTour uvaTour = new defaultTour();
	/**
	 * Takes the list of destinations from the defaultTour and stores them
	 * into a local ArrayList for use within the activity
	 */
	ArrayList<Location> tourDestinations = uvaTour.getDestinations(); 
	/**
	 * This creates a temporary location which is set to the first stop on 
	 * the tour.
	 */
	Location tempLocation = tourDestinations.get(0);
	
	int count = 0;

	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		
		//Set Content View to the main page containing the latitude and longitude
		// for the current and next locations.
		setContentView(R.layout.mainlatlong_layout);
		
		//Calls next location to set the coordinates for the next location to the
		//	screen
		updateNextLocation(null);
		
		//Creates a location manager using GPS to track the phone's location
		LocationManager locationManager;
		String context = Context.LOCATION_SERVICE;
		locationManager = (LocationManager) getSystemService(context);
		String provider = LocationManager.GPS_PROVIDER;
		
		//Creates a local variable to set the phone's current location on the 
		//	display
		Location currentLocation = locationManager
				.getLastKnownLocation(provider);
		updateWithNewLocation(currentLocation);
		
		//Creates a new location listener to track the phone's movements via
		//	GPS.  
		LocationListener myLocationListener = /**
		 * @author isc7a
		 *This location listener updates the two functions each time the GPS changes locations
		 */
		new LocationListener() {
			public void onLocationChanged(Location arg0) {
				updateWithNewLocation(arg0);
				updateNextLocation(arg0);

			}

			/**
			 * tells what to do when the provider is disabled (for this application,
			 * it does absolutely nothing)
			 * 
			 * @see android.location.LocationListener#onProviderDisabled(java.lang.String)
			 */
			public void onProviderDisabled(String provider) {
			}

			/**
			 * tells what to do when the provider is enabled (for this application,
			 * it does absolutely nothing)
			 * 
			 * @see android.location.LocationListener#onProviderEnabled(java.lang.String)
			 */
			public void onProviderEnabled(String provider) {
			}

			/**
			 * tells what to do when the status changes (since this listener does
			 * the same thing regardless of status, this method does nothing)
			 * 
			 * @see android.location.LocationListener#onStatusChanged(java.lang.String,
			 *      int, android.os.Bundle)
			 */
			public void onStatusChanged(String provider, int status, Bundle extras) {
			}

		};
		locationManager.requestLocationUpdates(provider, 0, 0,
				myLocationListener);

		//This button is used to override the GPS feature and input coordinates
		//	manually.  This is a feature used for testing purposes
		Button changeLocation = (Button) findViewById(R.id.widget110);
		changeLocation.setOnClickListener(new OnClickListener() {

			public void onClick(View v) {
				try {
					EditText currentLat = (EditText) findViewById(R.id.widget29);
					EditText currentLong = (EditText) findViewById(R.id.widget30);
					String current = "current";
					double latitude = Double.parseDouble(currentLat.getText()
							.toString());
					double longitude = Double.parseDouble(currentLong.getText()
							.toString());

					Location currentLoc = new Location(current);
					currentLoc.setLatitude(latitude);
					currentLoc.setLongitude(longitude);
					updateNextLocation(currentLoc);
					
				} catch (Exception e) {

					Toast.makeText(TourActivity.this,
							"Coordinates need to be doubles!!!",
							Toast.LENGTH_LONG).show();

				}
			}

		});


	}

	/**
	 * This function takes in a location and updates the GUI to display the new
	 * current location.
	 */
	private void updateWithNewLocation(Location location) {
		EditText myLat = (EditText) findViewById(R.id.widget29);
		EditText myLong = (EditText) findViewById(R.id.widget30);
		if (location != null) {
			myLat.setText(Double.toString(location.getLatitude()));
			myLong.setText(Double.toString(location.getLongitude()));
		} else
			return;
	}

	/**
	 * This function takes in a location and checks with the next location
	 * to determine whether the user is 'hot, warm, or cold.'  It also checks
	 * to see if the phone has reached the next destination, and updates the GUI's
	 * accordingly.
	 */
	private void updateNextLocation(Location location) {
		double distance = 1000;
		TextView nextLat = (TextView) findViewById(R.id.widget37);
		TextView nextLong = (TextView) findViewById(R.id.widget38);
		ImageView hotCold = (ImageView) findViewById(R.id.widget111);
		nextLat.setText(Double.toString(tempLocation.getLatitude()));
		nextLong.setText(Double.toString(tempLocation.getLongitude()));
		if (count != 0){
			distance = location.distanceTo(tempLocation);
		}
		if (location != null) {
				if (distance < 50){
					if (distance < 20){
						if (distance < 4){
							if (tourDestinations.size() != 1) {
								String temp = tempLocation.getProvider();
								tourDestinations.remove(tempLocation);
								tourDestinations.trimToSize();
								tempLocation = tourDestinations.get(0);
								nextLat.setText(Double.toString(tempLocation
										.getLatitude()));
								nextLong.setText(Double.toString(tempLocation
										.getLongitude()));
								Toast.makeText(TourActivity.this,
										"Congratulations you made it to " + temp +
										" Continue to " + tempLocation.getProvider(),
										Toast.LENGTH_LONG).show();
							} else{
								setContentView(R.layout.finish_layout);
							}
						} else {
							hotCold.setImageResource(R.color.black);
							hotCold.setImageResource(R.drawable.hot);
						}
					} else {
						hotCold.setImageResource(R.color.black);
						hotCold.setImageResource(R.drawable.warm);
					} 
				} else {
					hotCold.setImageResource(R.color.black);
					hotCold.setImageResource(R.drawable.cold);
				}
		}
		count++;
	}
}
