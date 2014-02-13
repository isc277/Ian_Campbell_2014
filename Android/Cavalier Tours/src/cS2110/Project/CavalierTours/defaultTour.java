package cS2110.Project.CavalierTours;

import java.util.ArrayList;
import java.util.ListIterator;
import android.location.Location;

/**
 * stores the list of destinations in the default tour
 * 
 * @author Wes Edwards
 */
public class defaultTour {
	/**
	 * list of destinations in the tour
	 */
	private ArrayList<Location> Destinations;

	/**
	 * iterator for iteration through the tour destinations
	 */
	private ListIterator<Location> tourIterator;
	/**
	 * the first destination
	 */
	private String StartDestination = "Start Destination";
	/**
	 * holds whatever the next destination is on the tour at any time
	 */
	private Location currentDestination;

	/**
	 * fills the destination list with the default destinations
	 */
	public defaultTour() {
		String tj1Name = "Thomas Jefferson Statue #1";
		String chapelName = "Chapel";
		String poesRoomName = "Edgar Allen Poe's Room";
		String ickerusStatueName = "Icarus Statue";
		String newcombName = "Newcomb Hall";
		String whisperingWallName = "The Whispering Wall";
		String ampitheatreName = "Ampitheater";
		String homerName = "Homer Statue";
		String tj2Name = "Thomas Jefferson Statue #2";
		String rotundaName = "The Rotunda";

		Location tj1 = new Location(tj1Name);
		tj1.setLatitude(38.036046);
		tj1.setLongitude(-78.503172);
		Location chapel = new Location(chapelName);
		chapel.setLatitude(38.036245);
		chapel.setLongitude(-78.504446);
		Location poesRoom = new Location(poesRoomName);
		poesRoom.setLatitude(38.035391);
		poesRoom.setLongitude(-78.504988);
		Location ickerusStatue = new Location(ickerusStatueName);
		ickerusStatue.setLatitude(38.036384);
		ickerusStatue.setLongitude(-78.505785);
		Location newcomb = new Location(newcombName);
		newcomb.setLatitude(38.035738);
		newcomb.setLongitude(-78.506402);
		Location whisperingWall = new Location(whisperingWallName);
		whisperingWall.setLatitude(38.034969);
		whisperingWall.setLongitude(-78.506742);
		Location ampitheatre = new Location(ampitheatreName);
		ampitheatre.setLatitude(38.033574);
		ampitheatre.setLongitude(-78.505758);
		Location homer = new Location(homerName);
		homer.setLatitude(38.033253);
		homer.setLongitude(-78.50468);
		Location tj2 = new Location(tj2Name);
		tj2.setLatitude(38.033866);
		tj2.setLongitude(-78.504822);
		Location rotunda = new Location(rotundaName);
		rotunda.setLatitude(38.035472);
		rotunda.setLongitude(-78.503484);

		Destinations = new ArrayList<Location>();

		Destinations.add(tj1);
		Destinations.add(chapel);
		Destinations.add(poesRoom);
		Destinations.add(ickerusStatue);
		Destinations.add(newcomb);
		Destinations.add(whisperingWall);
		Destinations.add(ampitheatre);
		Destinations.add(homer);
		Destinations.add(tj2);
		Destinations.add(rotunda);

		tourIterator = Destinations.listIterator();
		currentDestination = tourIterator.next();

	}

	/**
	 * iterates to the next destination
	 */
	public void nextDestination() {
		if (tourIterator.hasNext()) {
			currentDestination = tourIterator.next();
		}
	}

	/**
	 * gets the current destination
	 * @return the current destination
	 */
	public Location getDestination() {
		return currentDestination;
	}

	/**
	 * returns the distance between the phone and the next destination
	 * @param current the current location
	 * @return distance to the next destination as a float
	 */
	public float Distance(Location current) {
		return current.distanceTo(currentDestination);
	}

	/**
	 * returns the list of destinations
	 * @return the list of destinations
	 */
	public ArrayList<Location> getDestinations() {
		return this.Destinations;
	}

}
