import java.awt.Color;
import java.awt.Graphics2D;
import java.awt.geom.Ellipse2D;

/**
 * This is a class that implements MoveableShape. It will be able to draw and
 * translate a Clock.
 * 
 * @author Ian Campbell
 * 
 */
public class ClockShape implements MoveableShape {

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
	ClockShape(int x, int y) {
		this.x = x;
		this.y = y;
	}

	/**
	 * This will draw the given shape at the specific place set by x and y.
	 */
	public void draw(Graphics2D g2) {
		// This is an array of Strings to use for the
		// numbers on the face of the clock.
		String[] times = { "1", "2", "3", "4", "5", "6", "7", "8", "9", "10",
				"11", "12" };

		// These ellipses will define the outer and inner circles
		// for the clock.
		Ellipse2D.Double outer = new Ellipse2D.Double(x, y, 200, 200);
		Ellipse2D.Double inner = new Ellipse2D.Double(x + 20, y + 20, 160, 160);

		// This will set the color and fill the outer circle.
		g2.setColor(Color.GREEN);
		g2.fill(outer);

		// This will set the color and fill the inner circle.
		g2.setColor(Color.BLUE);
		g2.fill(inner);

		// The next lines will set the color and draw the numbers
		// and hands on the clock face.
		g2.setColor(Color.YELLOW);
		g2.drawString(times[11], (x + 93), (y + 33));
		g2.drawString(times[0], (x + 135), (y + 44));
		g2.drawString(times[1], (x + 161), (y + 68));
		g2.drawString(times[2], (x + 171), (y + 102));
		g2.drawString(times[3], (x + 161), (y + 136));
		g2.drawString(times[4], (x + 137), (y + 165));
		g2.drawString(times[5], (x + 98), (y + 178));
		g2.drawString(times[6], (x + 60), (y + 165));
		g2.drawString(times[7], (x + 34), (y + 139));
		g2.drawString(times[8], (x + 24), (y + 102));
		g2.drawString(times[9], (x + 34), (y + 68));
		g2.drawString(times[10], (x + 59), (y + 44));
		g2.drawLine((x + 100), (y + 100), (x + 100), (y + 40));
		g2.drawLine((x + 100), (y + 40), (x + 88), (y + 52));
		g2.drawLine((x + 100), (y + 40), (x + 112), (y + 52));
		g2.drawLine((x + 100), (y + 100), (x + 140), (y + 100));
		g2.drawLine((x + 140), (y + 100), (x + 128), (y + 88));
		g2.drawLine((x + 140), (y + 100), (x + 128), (y + 112));
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
