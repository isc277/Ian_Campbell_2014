package cS2110.Project.CavalierTours;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Canvas;
import android.graphics.Matrix;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.Drawable;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;

import com.google.android.maps.GeoPoint;
import com.google.android.maps.ItemizedOverlay;
import com.google.android.maps.MapActivity;
import com.google.android.maps.MapController;
import com.google.android.maps.MapView;
import com.google.android.maps.OverlayItem;

/**
 * handles drawing the map itself and the events which occur during the tour
 * 
 * @author Andrew Dawson, Ian Campbell
 */
public class CavalierMaps extends MapActivity {
	/**
	 * handles movement of the map, such as centering, translating, and zooming
	 */
	private MapController mapController;
	/**
	 * the view which displays the actual map
	 */
	private MapView mapView;
	/**
	 * handles interactions with the GPS satellites, this information is then
	 * handled by the LocationHandler
	 */
	private LocationManager locationManager;
	/**
	 * list of the destinations in the tour
	 */
	private ArrayList<Location> destinations;
	/**
	 * the marker for the locations that are not the next destination
	 */
	private Drawable normalMarker;
	/**
	 * the marker for the next destination on the tour
	 */
	private Drawable nextMarker;

	/**
	 * initializes the map, map controllers, overlays, and starts listening GPS
	 * updates
	 * 
	 * @see com.google.android.maps.MapActivity#onCreate(android.os.Bundle)
	 */
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.main);

		mapView = (MapView) findViewById(R.id.mapview1);
		mapView.setBuiltInZoomControls(true);
		mapController = mapView.getController();
		mapController.setZoom(22);

		defaultTour tour = new defaultTour();
		destinations = tour.getDestinations();

		// set up the marker types
		normalMarker = this.getResources().getDrawable(R.drawable.marker);
		nextMarker = this.getResources().getDrawable(R.drawable.nextmarker);
		Drawable pointer = this.getResources().getDrawable(R.drawable.pointer);

		// overlay for all markers except for the next destination
		SitesOverlay itemizedOverlay = new SitesOverlay(normalMarker);

		// overlay for only the next destination
		SitesOverlay nextOverlay = new SitesOverlay(nextMarker);

		// add all tour destinations to the overlays
		for (int i = 0; i < destinations.size(); i++) {
			Location loc = destinations.get(i);
			int destLat = (int) (loc.getLatitude() * 1E6);
			int destLong = (int) (loc.getLongitude() * 1E6);
			GeoPoint point = new GeoPoint(destLat, destLong);
			OverlayItem overlayItem = new OverlayItem(point, "", "");

			if (i == 0) {
				nextOverlay.addOverlay(overlayItem);
				mapController.setCenter(point);
			} else
				itemizedOverlay.addOverlay(overlayItem);
		}
		// add the overlays on top of the map
		mapView.getOverlays().add(itemizedOverlay);
		mapView.getOverlays().add(nextOverlay);

		// initialize the location manager
		locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);

		locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0,
				0, new LocationHandler());
	}

	/**
	 * displays if there is route information attached to the MapActivity (this
	 * application does not use route information, so it always returns false)
	 * 
	 * @see com.google.android.maps.MapActivity#isRouteDisplayed()
	 * @return false
	 */
	protected boolean isRouteDisplayed() {
		return false;
	}

	/**
	 * listens for changes in GPS location and redraws the map and markers as
	 * the phone moves
	 */
	private class LocationHandler implements LocationListener {

		/**
		 * redraws the overlays and centers the map on the location of the user
		 * every time the phone recieves a GPS location update
		 * 
		 * @see android.location.LocationListener#onLocationChanged(android.location.Location)
		 */
		public void onLocationChanged(Location loc) {
			int latitude = (int) (loc.getLatitude() * 1E6);
			int longitude = (int) (loc.getLongitude() * 1E6);
			GeoPoint point = new GeoPoint(latitude, longitude);
			mapController.setCenter(point);

			List overlays = mapView.getOverlays();

			// first remove old overlay
			if (overlays.size() > 0) {
				for (Iterator iterator = overlays.iterator(); iterator
						.hasNext();) {
					iterator.next();
					iterator.remove();
				}
			}

			// move to location
			mapView.getController().animateTo(point);

			// draw all the locations in the current tour

			// overlay for all destinations except the next one
			SitesOverlay itemizedOverlay = new SitesOverlay(normalMarker);

			// overlay for only the next destination // destination
			SitesOverlay nextOverlay = new SitesOverlay(nextMarker);

			Location currentDest = destinations.get(0);

			// check to see if the you are at the next destination
			if (loc.distanceTo(currentDest) <= 4) {
				if (destinations.size() != 0){
					destinations.remove(0);
					destinations.trimToSize();
					currentDest = destinations.get(0);
				} else {
					setContentView(R.layout.finish_layout);
				}
			}

			for (int i = 0; i < destinations.size(); i++) {
				Location location = destinations.get(i);
				int destLat = (int) (location.getLatitude() * 1E6);
				int destLong = (int) (location.getLongitude() * 1E6);
				GeoPoint destpoint = new GeoPoint(destLat, destLong);
				OverlayItem overlayItem = new OverlayItem(destpoint, "", "");

				if (i == 0)
					nextOverlay.addOverlay(overlayItem);
				else
					itemizedOverlay.addOverlay(overlayItem);
			}

			Bitmap bitMap = BitmapFactory.decodeResource(getResources(),
					R.drawable.pointer);
			Matrix mat = new Matrix();
			mat.postRotate(loc.bearingTo(currentDest));
			Bitmap bitMapRotated = Bitmap.createBitmap(bitMap, 0, 0, bitMap
					.getWidth(), bitMap.getHeight(), mat, true);

			// create my overlay and show it
			SitesOverlay overlay = new SitesOverlay(new BitmapDrawable(
					bitMapRotated));
			OverlayItem item = new OverlayItem(point, "My Location", null);
			overlay.addOverlay(item);
			mapView.getOverlays().add(overlay);

			mapView.getOverlays().add(itemizedOverlay);
			mapView.getOverlays().add(nextOverlay);

			// redraw map
			mapView.postInvalidate();

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
	}

	/**
	 * overlay class for drawing markers on the map
	 */
	private class SitesOverlay extends ItemizedOverlay<OverlayItem> {
		/**
		 * list for all the items being overlaid on the map
		 */
		private List<OverlayItem> items = new ArrayList<OverlayItem>();
		/**
		 * the image that is being overlaid on the map
		 */
		private Drawable marker = null;

		/**
		 * creates the overlay and sets the given marker to display for all
		 * OverlayItems in the overlay
		 * 
		 * @param marker
		 *            the image displayed for every OverlayItem added
		 */
		public SitesOverlay(Drawable marker) {
			super(marker);
			this.marker = marker;
			populate();
		}

		/**
		 * adds an OverlayItem to this overlay
		 * 
		 * @param overlay
		 *            the OverlayItem being added
		 */
		public void addOverlay(OverlayItem overlay) {
			items.add(overlay);
			populate();
		}

		/**
		 * returns the OverlayItem stored at the given index
		 * 
		 * @see com.google.android.maps.ItemizedOverlay#createItem(int)
		 */
		@Override
		protected OverlayItem createItem(int i) {
			return items.get(i);
		}

		/**
		 * draws the overlay on the given MapView
		 * 
		 * @see com.google.android.maps.ItemizedOverlay#draw(android.graphics.Canvas,
		 *      com.google.android.maps.MapView, boolean)
		 */
		@Override
		public void draw(Canvas canvas, MapView mapView, boolean shadow) {
			super.draw(canvas, mapView, shadow);

			boundCenter(marker);
		}

		/**
		 * intended to use in handling click events on the map, but is not used
		 * for this application
		 * 
		 * @see com.google.android.maps.ItemizedOverlay#onTap(int)
		 * @return true
		 */
		@Override
		protected boolean onTap(int i) {
			return true;
		}

		/**
		 * returns the number of OverlayItems in the overlay
		 * 
		 * @see com.google.android.maps.ItemizedOverlay#size()
		 */
		@Override
		public int size() {
			return items.size();
		}
	}
}