import java.awt.*;
import java.awt.event.*;
import java.util.ArrayList;
import java.util.Random;

import javax.swing.*;

/**
 * This class uses a GUI window to allow the user to show a subwindow and add
 * animated shapes to the subwindow. The main GUI will have a series of
 * checkboxes to allow the user to choose between one of three shapes to add.
 * 
 * @author Ian Campbell
 * 
 */
public class MultiShapeTest {
	public static void main(String[] args) {

		// This will define the main GUI.
		JFrame mainFrame = new JFrame();

		// These are the four buttons for the
		// main GUI
		JButton show = new JButton("Show");
		JButton add = new JButton("Add");
		JButton remove = new JButton("Remove");
		JButton exit = new JButton("Exit");

		// These are three checkboxes to allow the user
		// to select what they would like to add to the
		// subwindow. The Airplane box is automatically
		// checked, but can be unchecked.
		final JCheckBox airplane = new JCheckBox("Airplane");
		airplane.setSelected(true);
		final JCheckBox boat = new JCheckBox("Boat");
		final JCheckBox clock = new JCheckBox("Clock");

		// This is a panel with a FlowLayout() that will
		// hold the 4 buttons on the main GUI.
		JPanel mainButtons = new JPanel();
		mainButtons.setLayout(new FlowLayout());
		mainButtons.add(show);
		mainButtons.add(add);
		mainButtons.add(remove);
		mainButtons.add(exit);

		// This is another panel that will hold the checkboxes
		// in a FlowLayout() for the main GUI.
		JPanel checks = new JPanel();
		checks.setLayout(new FlowLayout());
		checks.add(airplane);
		checks.add(clock);
		checks.add(boat);

		// This sets the main GUI's layout to a border
		// Layout and adds the checkbox panel at the top
		// and the button panel at the bottom.
		mainFrame.setLayout(new BorderLayout());
		mainFrame.add(checks, BorderLayout.NORTH);
		mainFrame.add(mainButtons, BorderLayout.SOUTH);

		// This sets the close opetation to exit.
		mainFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

		// This packs the main GUI to the smallest size.
		mainFrame.pack();

		// This makes the main GUI visible.
		mainFrame.setVisible(true);

		// This is a JFrame that will define the
		// subwindow.
		final JFrame subWindow = new JFrame();

		// These are two buttons for the subwindow.
		JButton hide = new JButton("Hide");
		JButton exitSub = new JButton("Exit");

		// This a JPanel with a FlowLayout for the
		// two buttons.
		JPanel buttons = new JPanel();
		buttons.setLayout(new FlowLayout());
		buttons.add(hide);
		buttons.add(exitSub);

		// This is a new ShapeIcon with a width of 1300, and
		// a height of 650.
		final ShapeIcon shapeDraw = new ShapeIcon(ICON_WIDTH, ICON_HEIGHT);

		// This is a new label being created with
		// the ShapeIcon.
		final JLabel label = new JLabel(shapeDraw);

		// This sets the layout of the subWindow to
		// a BorderLayout, and adds the buttons to the
		// bottom and the label to the Center.
		subWindow.setLayout(new BorderLayout());
		subWindow.add(label, BorderLayout.CENTER);
		subWindow.add(buttons, BorderLayout.SOUTH);

		// This sets the close operation to dispose of the subwindow.
		subWindow.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);

		// This packs to subwindow to the smalles size.
		subWindow.pack();

		// This is an int to use with the timer times.
		final int DELAY = 100;

		// This creates a timer with a 100 millisecond
		// delay. This also creates an action listener
		// That will redraw the shapes on the subwindow
		// once every tenth of a second one place to the
		// right.
		final Timer times = new Timer(DELAY, new ActionListener() {
			public void actionPerformed(ActionEvent event) {
				ArrayList<MoveableShape> movers = new ArrayList<MoveableShape>(
						shapeDraw.getShapes());
				for (MoveableShape shape : movers) {
					shape.translate(1, 0);
				}
				label.repaint();
			}
		});

		// This is an ActionListener for the 'show' button
		// that will make the subWindow visible. It will
		// also start the timer if there are shapes on it.
		show.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				subWindow.setVisible(true);
				ArrayList<MoveableShape> shapes = new ArrayList<MoveableShape>(
						shapeDraw.getShapes());
				if (shapes.size() != 0) {
					times.start();
				}

			}
		});

		// This is a new ActionListener for the add button.
		// It will check all three of the checkboxes and
		// add whatever shapes were checked to shapeDraw.
		// It will also start the timer if not already going.
		add.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				boolean move = false;
				if (!subWindow.isVisible()) {
					subWindow.setVisible(true);
				}
				if (airplane.isSelected()) {
					final MoveableShape plane = new AirplaneShape(rando(),
							rando());
					shapeDraw.addShape(plane);
					move = true;
				}
				if (boat.isSelected()) {
					final MoveableShape boat = new BoatShape(rando(), rando());
					shapeDraw.addShape(boat);
					move = true;
				}
				if (clock.isSelected()) {
					final MoveableShape clock = new ClockShape(rando(), rando());
					shapeDraw.addShape(clock);
					move = true;
				}

				if (move) {
					times.start();
				}

			}
		});

		// This is an ActionListener for the remove button.
		// It will remove the last shape added if there
		// are any.
		remove.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				boolean keepGoing = shapeDraw.removeShape();
				if (!keepGoing) {
					times.stop();
					label.repaint();
				}
			}
		});

		// This is an ActionListener for the exit button.
		// It will just exit the program.
		exit.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				System.exit(0);
			}
		});

		// This is an AcitonListener for the hide button
		// on the subwindow. It will hide the window, but
		// not destroy it, and stop the animation timer.
		hide.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				subWindow.setVisible(false);
				times.stop();
			}
		});

		// This is an ActionListener for the exit button
		// on the subwindow. It will exit the subwindow and
		// stop all animation, but will not exit the whole
		// program. It will also remove any remaining
		// shapes from the shapeDraw Object.
		exitSub.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				subWindow.dispose();
				times.stop();
				boolean removes = true;
				while (removes) {
					removes = shapeDraw.removeShape();
				}
			}

		});

	}

	// These are two variable that define the size of
	// the subwindow.
	private static final int ICON_WIDTH = 1300;
	private static final int ICON_HEIGHT = 650;

	/**
	 * This returns a random integer between 0 and 450. This determines the
	 * random position of the shape added.
	 * 
	 * @return random integer.
	 */
	static int rando() {
		Random randomNums = new Random();
		return (int) (randomNums.nextDouble() * 450);
	}
}
