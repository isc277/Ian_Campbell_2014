import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.JTextField;

/**
 * This class builds several GUIs to demonstrate the workings of the
 * AddressList class.  It allows the user to test and perform all 
 * of the tasks associated with the AddressList class.
 * 	
 * @author Ian Campbell (icampbell3)	date:  12/8/11
 *
 */
public class ListGUI {
	
	//This is a static AddressList variable.  It will be used
	//by all of the GUIs for the AddressList demo.
	static AddressList list = new AddressList();

	
	public static void main(String[] args) {
		
		//This JFrame will be the main window
		JFrame main = new JFrame();
		
		//This creates 6 buttons for main GUI window
		JButton add = new JButton("Add to List");
		JButton isEmpty = new JButton("Is the List Empty?");
		JButton reverse = new JButton("Reverse the List");
		JButton search = new JButton("Search the List");
		JButton display = new JButton("Display the List");
		JButton displayRev = new JButton("Display the List Reversed");
		JButton exit = new JButton("Exit");
		
		//This creates a JTextArea to display all of the results
		//of the functions of the AddressList.  This also will
		//disable the TextArea and set the color to black.
		final JTextArea text = new JTextArea(10, 25);
		text.setEnabled(false);
		Color black = new Color(0);
		text.setDisabledTextColor(black);
		
		//This creates a JPanel to add the buttons in a GridLayout.
		JPanel mainButtons = new JPanel();
		mainButtons.setLayout(new GridLayout(3, 2));
		mainButtons.add(add);
		mainButtons.add(isEmpty);
		mainButtons.add(reverse);
		mainButtons.add(search);
		mainButtons.add(display);
		mainButtons.add(displayRev);
		
		//This adds the JPanel and the JTextArea to the main JFrame
		//in a BorderLayout.
		main.setLayout(new BorderLayout());
		main.add(mainButtons, BorderLayout.NORTH);
		main.add(new JScrollPane(text), BorderLayout.CENTER);
		main.add(exit, BorderLayout.SOUTH);
		
		//This sets the default close operation, packs, sets the
		//location and sets the main JFrame visible.
		main.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		main.pack();
		main.setLocationRelativeTo(null);
		main.setVisible(true);
		
		//This is an action listener for the add button.
		add.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent arg0) {
				
				//This creates a new JFrame window.
				final JFrame add = new JFrame();
				
				//These JLabels will inform the user of how to work
				//the add JFrame.
				JLabel topLabel = new JLabel("Enter the Information for the" +
						" New List Entry Below:");
				JLabel nameLabel = new JLabel("Name:");
				JLabel numberLabel = new JLabel("Telephone Number:");
				JLabel emailLabel = new JLabel("Email:");
				JLabel addressLabel = new JLabel("Address:");
				JLabel dobLabel = new JLabel("Date of Birth:");
				
				//This creates 5 JTextFields for input for the AddressList
				final JTextField name = new JTextField(25);
				final JTextField number = new JTextField(25);
				final JTextField email = new JTextField(25);
				final JTextField address = new JTextField(25);
				final JTextField dob = new JTextField(25);
				
				JButton addFront = new JButton("Add to Front of List");
				JButton addBack = new JButton("Add to Back of List");
				JButton reset = new JButton("Reset");
				JButton cancel = new JButton("Cancel");
				
				//This creates a Panel for the JLabels, the JTextFields
				//and the buttons and adds them to a GridLayout.
				JPanel mainPanel = new JPanel();
				mainPanel.setLayout(new GridLayout(7, 2));
				mainPanel.add(nameLabel);
				mainPanel.add(name);
				mainPanel.add(numberLabel);
				mainPanel.add(number);
				mainPanel.add(emailLabel);
				mainPanel.add(email);
				mainPanel.add(addressLabel);
				mainPanel.add(address);
				mainPanel.add(dobLabel);
				mainPanel.add(dob);
				mainPanel.add(addFront);
				mainPanel.add(addBack);
				mainPanel.add(reset);
				mainPanel.add(cancel);
				
				//This adds the top JLabel, the JPanel and the cancel
				//button to the add JFrame using a BorderLayout.
				add.setLayout(new BorderLayout());
				add.add(topLabel, BorderLayout.NORTH);
				add.add(mainPanel, BorderLayout.CENTER);
				
				//This sets the add JFrame visible.
				add.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
				add.pack();
				add.setVisible(true);
				
				//This is an ActionListener for the add to front button.
				//It adds a new ListNode to the list using the user input.
				addFront.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent e) {
						list.addToFront(name.getText(), number.getText(), 
								email.getText(), address.getText(), 
								dob.getText());
					}
				});
				
				//This is an ActionListener for the add to back button.
				//It adds a new ListNode to the list using the user input.
				addBack.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent e) {
						list.addToBack(name.getText(), number.getText(), 
								email.getText(), address.getText(), 
								dob.getText());
					}
				});
				
				//This is an ActionListener to reset the JTextFields on the
				//search JFrame.
				reset.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent arg0) {
						name.setText("");
						number.setText("");
						email.setText("");
						address.setText("");
						dob.setText("");
					}
				});
				
				//This is an ActionListener for the cancel button.  It will
				//dispose of the add JFrame.
				cancel.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent e) {
						add.dispose();
					}
				});
			}
		});
		
		//This is an ActionListener for the isEmpty() function.  It calls the
		//function and displays the results into the JTextArea.
		isEmpty.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent e) {
				text.setText("");
				boolean empty = list.isEmpty();
				if (empty){
					text.setText("Empty");
				} else {
					text.setText("Not Empty");
				}
			}
		});
		
		//This is an ActionListener for the reverse button.  It will reverse
		//the list and set the list as the reversed list.
		reverse.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent e) {
				list = list.reverse();
				
			}
		});
		
		//This is an ActionListener for the search button.  It will create a
		//new GUI that will allow the user to enter information to search for
		//using the four search functions built into the AddressList class.
		search.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent e) {
				
				//This creates a new JFrame
				final JFrame search = new JFrame();
				
				//This creates two JLabels, two JTextFields, and five buttons
				//for the search JFrame.
				JLabel topLabel = new JLabel("<html>Enter the information " +
						"you would like to use to search the list, <br />and " +
						"then choose the button for how you want to search " +
						"the list.</html>");
				JLabel resultsLabel = new JLabel("Results:");
				final JTextField entry = new JTextField(25);
				final JTextField results = new JTextField(25);
				Color black = new Color(0);
				results.setDisabledTextColor(black);
				results.setEnabled(false);
				JButton numberByName = new JButton("Search for a Phone " + 
						"Number Using a Name");
				JButton emailByName = new JButton("Search for an Email " + 
					"Address Using a Name");
				JButton nameByNumber = new JButton("Search for a Name " + 
					"Using a Phone Number");
				JButton dobByName = new JButton("Search for a Date of " + 
					"Birth Using a Name");
				JButton reset = new JButton("Reset");
				JButton cancel = new JButton("Cancel");
				
				//This sets the layout of the search JFRame to a GridLayout
				//and adds all the components to the search JFrame.
				search.setLayout(new GridLayout(10, 1));
				search.add(topLabel);
				search.add(entry);
				search.add(resultsLabel);
				search.add(results);
				search.add(numberByName);
				search.add(emailByName);
				search.add(nameByNumber);
				search.add(dobByName);
				search.add(reset);
				search.add(cancel);
				
				//This sets the search JFrame visible
				search.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
				search.pack();
				search.setVisible(true);
				
				//This is an ActionListener to test the phoneNumberByName()
				//function.
				numberByName.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent e) {
						results.setText(list.phoneNumberByName(entry.getText()));
					}

				});
				
				//This is an ActionListener to test the emailByName()
				//function.
				emailByName.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent e) {
						results.setText(list.emailByName(entry.getText()));
					}
				});
				
				//This is an ActionListener to test the nameByPhoneNumber()
				//function.
				nameByNumber.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent e) {
						results.setText(list.nameByPhoneNumber(entry.getText()));
					}
				});
				
				//This is an ActionListener to test the dobByName()
				//function.
				dobByName.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent e) {
						results.setText(list.dobByName(entry.getText()));
					}
				});
				
				//This is an ActionListener to reset the JTextFields on the
				//search JFrame.
				reset.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent arg0) {
						entry.setText("");
						results.setText("");
					}
				});
				
				//This is an ActionListener to dispose of the search JFrame.
				cancel.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent e) {
						search.dispose();
					}
				});	
			}
		});
		
		//This is an ActionListener for the display button.  It will output the
		//toString() of the AddressList.
		display.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent e) {
				text.setText("");
				text.setText(list.toString());
			}
		});
		
		//This is an ActionListener for the displayRev button.  It will output the
		//reverseToString() of the AddressList.
		displayRev.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent e) {
				text.setText("");
				text.setText(list.reverseToString());
			}
		});
		
		//This is an ActionListener for the exit button.  It will exit the entire
		//program.
		exit.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent e) {
				System.exit(0);
				
			}
		});
		
	}
}
