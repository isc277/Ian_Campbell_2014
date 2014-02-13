import java.awt.Color;
import java.awt.Graphics2D;
import java.awt.Polygon;
import java.awt.geom.Rectangle2D;

/**
 * This is a class that implements MoveableShape. It will be able to draw and
 * translate a Boat.
 * 
 * @author Ian Campbell
 * 
 */
public class BoatShape implements MoveableShape {

	// Two private members holding the x and y position
	// of the topmost corner of all parts of the drawing.
	private int x;
	private int y;

	/**
	 * This is a constructor that takes in values for x and y.
	 * 
	 * @param x
	 *            Value for x.
	 * @param y
	 *            Value for y.
	 */
	BoatShape(int x, int y) {
		this.x = x;
		this.y = y;
	}

	/**
	 * This will draw the given shape at the specific place set by x and y.
	 */
	public void draw(Graphics2D g2) {
		// These are two arrays containing the x and y coordinates
		// for the polygon that will define the body of the boat.
		int[] xBodyPoints = { (x + 0), (x + 15), (x + 185), (x + 200) };
		int[] yBodyPoints = { (y + 170), (y + 200), (y + 200), (y + 170) };

		// These are two arrays containing the x and y coordinates
		// for the polygon that will define the sail of the boat.
		int[] xSailPoints = { (x + 40), (x + 160), (x + 160) };
		int[] ySailPoints = { (y + 130), (y + 130), (y + 10) };

		// This uses the above arrays to create the body polygon
		Polygon body = new Polygon(xBodyPoints, yBodyPoints, 4);

		// This uses the above arrays to create the sail polygon
		Polygon sail = new Polygon(xSailPoints, ySailPoints, 3);

		// This defines a small rectangle that will be the mast
		// for the sail.
		Rectangle2D.Double mast = new Rectangle2D.Double((x + 155), (y + 130),
				5, 40);

		// This sets the color and fills the body.
		g2.setColor(Color.BLUE);
		g2.fillPolygon(body);

		// This sets the color and fills the sail.
		g2.setColor(Color.YELLOW);
		g2.fillPolygon(sail);

		// This sets the color and fills the mast.
		g2.setColor(Color.GREEN);
		g2.fill(mast);

	}

	/**
	 * This will translate the shape by dx and dy.
	 * 
	 * @param dx
	 *            Value to change x by
	 * @param dy
	 *            Value to change y by
	 */
	public void translate(int dx, int dy) {
		// This if statement establishes if the polygon
		// is off the screen and resets it if it is.
		if ((x + dx) > 1300) {
			x = 0;
		} else {
			x += dx;
			y += dy;
		}
	}

}
