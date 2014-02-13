import java.awt.Color;
import java.awt.Graphics2D;
import java.awt.Polygon;
import java.awt.geom.Ellipse2D;
import java.awt.geom.Rectangle2D;

/**
 * This is a class that implements MoveableShape. It will be able to draw and
 * translate a Clock.
 * 
 * @author Ian Campbell
 * 
 */
public class AirplaneShape implements MoveableShape {

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
	AirplaneShape(int x, int y) {
		this.x = x;
		this.y = y;
	}

	/**
	 * This will draw the given shape at the specific place set by x and y.
	 */
	public void draw(Graphics2D g2) {

		// These are two arrays containing the x and y coordinates
		// for the polygon that will define the wings.
		int[] xWings = { (x + 180), (x + 85), (x + 55), (x + 125), (x + 55),
				(x + 85) };
		int[] yWings = { (y + 100), (y + 200), (y + 200), (y + 100), y, y };

		// These are two arrays containing the x and y coordinates
		// for the polygon that will define the tail.
		int[] xTail = { x, (x + 25), (x + 40), (x + 40), (x + 25), x, (x + 15) };
		int[] yTail = { (y + 50), (y + 50), (y + 80), (y + 120), (y + 150),
				(y + 150), (y + 100) };

		// This uses the above arrays to create the wing polygon
		Polygon wings = new Polygon(xWings, yWings, 6);

		// This uses the above arrays to create the tail polygon
		Polygon tail = new Polygon(xTail, yTail, 7);

		// This is a rectangle and a circle that will define
		// the body and the nose of the airplane.
		Rectangle2D.Double body = new Rectangle2D.Double(x + 40, y + 80, 140,
				40);
		Ellipse2D.Double nose = new Ellipse2D.Double(x + 160, y + 80, 40, 40);

		// This will set the color and fill the tail of
		// the plane.
		g2.setColor(Color.GREEN);
		g2.fillPolygon(tail);

		// This will set the color and fill the wings of
		// the plane.
		g2.setColor(Color.YELLOW);
		g2.fillPolygon(wings);

		// This will set the color and fill the body of
		// the airplane.
		g2.setColor(Color.BLUE);
		g2.fill(nose);
		g2.fill(body);
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
