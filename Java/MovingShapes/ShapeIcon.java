import java.awt.*;
import java.util.*;
import javax.swing.*;

/**
 * An icon that contains an ArrayList of shapes that implement the interface
 * MoveableShape.
 */
public class ShapeIcon implements Icon {

	// Three private members of the class. An int
	// to store the width, another to store the height,
	// and an ArrayList of shapes.
	private int width;
	private int height;
	private ArrayList<MoveableShape> shapes;

	/**
	 * A constructor that takes in values for the height and width. Also
	 * initializes the ArrayList.
	 * 
	 * @param width
	 *            The value for width
	 * @param height
	 *            The value for height
	 */
	public ShapeIcon(int width, int height) {
		this.width = width;
		this.height = height;
		shapes = new ArrayList<MoveableShape>();
	}

	/**
	 * This is a variable that will add a Moveable shape to the ArrayList of
	 * shapes.
	 * 
	 * @param shape
	 *            The shape to add to 'shapes'
	 */
	public void addShape(MoveableShape shape) {
		shapes.add(shape);
	}

	/**
	 * This will remove the last shape added to the ArrayList.
	 * 
	 * @return returns false if the ArrayList has 0 or 1 items, and true
	 *         otherwise.
	 */
	public boolean removeShape() {
		if (shapes.size() == 0) {
			return false;
		} else if (shapes.size() == 1) {
			shapes.remove(shapes.size() - 1);
			return false;
		} else {
			shapes.remove(shapes.size() - 1);
			return true;
		}
	}

	/**
	 * Returns the width
	 * 
	 * @return returns width.
	 */
	public int getIconWidth() {
		return width;
	}

	/**
	 * Returns the height.
	 * 
	 * @return returns height.
	 */
	public int getIconHeight() {
		return height;
	}

	/**
	 * Returns the ArrayList of shapes.
	 * 
	 * @return returns pointer to ArrayList
	 */
	public ArrayList<MoveableShape> getShapes() {
		return shapes;
	}

	/**
	 * This paints the shapes onto the screen.
	 */
	public void paintIcon(Component c, Graphics g, int x, int y) {
		Graphics2D g2 = (Graphics2D) g;
		for (int i = 0; i < shapes.size(); i++) {
			shapes.get(i).draw(g2);
		}
	}

}
