package edu.radford.softeng16.iRU;

import android.os.Bundle;

import com.google.android.maps.GeoPoint;
import com.google.android.maps.MapActivity;
import com.google.android.maps.MapController;
import com.google.android.maps.MapView;

public class IRUMaps extends MapActivity {
	
	public void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.map);
        MapView mapView = (MapView) findViewById(R.id.mapview);
        mapView.setBuiltInZoomControls(true);
        MapController mapControl;
        mapControl = mapView.getController();
        mapControl.setZoom(17);
        
        int latitude = (int) (37.137484 * 1E6);
		int longitude = (int) (-80.550878 * 1E6);
		GeoPoint point = new GeoPoint(latitude, longitude);
		mapControl.setCenter(point);
    }


	protected boolean isRouteDisplayed() {
		return false;
	}

}
