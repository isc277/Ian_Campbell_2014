package edu.radford.icampbell3.vendingMachine;

import javax.swing.JOptionPane;

/**
 * This is a Demonstration of the use of the VendingSystem class. This demo also
 * creates, defines, and implements a GUI for the Vending Machine.
 * 
 * @author Ian Campbell
 * 
 */
public class VendingMachineDemo {

	/**
	 * This is the main function to call to start the Vending Machine.
	 * 
	 * @param args
	 */
	public static void main(String[] args) {

		// Local Variables for the Vending Machine
		// A VendingSystem to control all of the
		// Vending Machine functions
		VendingSystem system = new VendingSystem();
		// An input string for GUI use
		String input = new String();
		// An integer that will store the amount of
		// money inserted as cents.
		int money = 0;
		// a boolean variable to use with the do-while
		// loop
		boolean running = true;
		// another boolean variable to break out of all
		// the loops once a final action is committed
		boolean breakBool = false;

		// This for loop populates 4 of the 8 ProductQueues
		// in the VendingSystem halfway (10 Products).
		for (int i = 0; i < 10; i++) {
			system.addProduct(0);
			system.addProduct(2);
			system.addProduct(4);
			system.addProduct(6);
		}

		// A JOptionPane to show the user the 8 drink types
		// and their price.
		JOptionPane.showMessageDialog(null, "Coca-Cola drink machine."
				+ "\nAll drinks are $0.75. \nChoices are:  \nCoca-Cola        "
				+ "  Diet Coke\nDr. Pepper         Diet Dr. Pepper \n"
				+ "Cherry Coke       Mello Yello\nCoke Zero        "
				+ " Orange Fanta");

		// This is a Do-While loop, which will encompass all
		// of the Interface actions.
		do {

			// This is a JOptionPane that will ask for input from
			// the user, which is equivalent to money. This drink
			// machine will accept dollars, quarters, dimes, and
			// nickels.
			input = JOptionPane.showInputDialog("Total money input is "
					+ toMoney(money) + ".  Please input 'Dollar' (Dollar "
					+ "$1.00)\n, 'Q'(Quarter $0.25), 'D' (Dime $0.10), "
					+ ", 'N' (Nickel 0.05),\n or input 'Select' to "
					+ "make drink selection");

			// This will allow the user to hit cancel and exit the
			// system
			if (input == null) {
				break;
			}
			// This will take the input and change it to lower case
			// , which will allow multiple allowable entries.
			input = input.toLowerCase();

			// If a quarter is input 25 will be added to money
			if (input.equals("q")) {
				money += 25;

				// If a dime is input 10 will be added to money
			} else if (input.equals("d")) {
				money += 10;

				// If a nickel is input 5 will be added to money
			} else if (input.equals("n")) {
				money += 5;

				// If a dollar is input 100 will be added to money
			} else if (input.equals("dollar")) {
				money += 100;

				// If the user enters 'login' it will take them
				// to a maintenance screen to add and remove
				// Products from the machine.
			} else if (input.equals("login")) {
				// local variable to use with a while loop
				boolean login = true;
				// This will store how many times the user entered
				// and incorrect login
				int test = 0;

				// This while loop will allow the user to enter a
				// login to get into the system
				while (login) {
					// This will create a JOptionPane to get the
					// username of the operator.
					String j = (JOptionPane
							.showInputDialog("Welcome to the operator's"
									+ " screen.\nPlease input username:"));

					// This will allow the user to hit cancel
					if (j == null)
						break;

					// This will increment the test variable
					test++;

					// This will put the username to all lowercase
					j = j.toLowerCase();

					// This if statement checks to make sure the login
					// is valid. Only 'icampbell3' and 'hlee3' are valid.
					if (j.equals("icampbell3") || j.equals("hlee3")) {
						// This is a local variable for use with another
						// while loop.
						boolean rightLogin = true;

						// This while loop will ask the operator what
						// they want to do.
						while (rightLogin) {
							// This is an input pane asking if the operator
							// would like to 'add' or 'remove' products from
							// the system.
							String opInput = JOptionPane
									.showInputDialog("Hello user "
											+ j + ".\nPlease input 'add' or 'remove' to"
											+ "\n add or remove drinks from the system.");

							// This allows the user to hit cancel to exit
							if (opInput == null) {
								break;
							}

							// This changes the input to all lowercase
							opInput = opInput.toLowerCase();

							// This looks for the correct input of 'add'
							if (opInput.equals("add")) {
								// local variable to use with the adding
								// while loop
								boolean add = true;

								// The adding while loop, will allow the
								// operator to add drinks until they exit
								// by hitting the cancel button.
								while (add) {
									// This asks the operator to enter which
									// drink they would like to add.
									String addDrink = JOptionPane
											.showInputDialog("Select"
													+ " which drink to add.\n1-Coca-Cola \n2-Diet Coke "
													+ "\n3-Dr. Pepper \n4-Diet Dr. Pepper "
													+ "\n5-Cherry Coke \n6-Mello Yello \n7-Coke Zero "
													+ "\n8-Orange Fanta \nPlease input the number"
													+ " of your choice.");

									// This if statement allows the user to hit
									// cancel
									if (addDrink == null) {
										break;
									}

									// This checks to make sure of proper input
									// in the input box
									if (addDrink.equals("1")
											|| addDrink.equals("2")
											|| addDrink.equals("3")
											|| addDrink.equals("4")
											|| addDrink.equals("5")
											|| addDrink.equals("6")
											|| addDrink.equals("7")
											|| addDrink.equals("8")) {

										// This will take the string input and
										// create
										// an int variable from it.
										int select = Integer.parseInt(addDrink);

										// This will try to add a product to the
										// system, and return true if
										// successful.
										boolean adder = system
												.addProduct(select);

										// This will let the user know the add
										// was
										// successfull
										if (adder == true) {
											JOptionPane.showMessageDialog(null,
													"Drink Added"
															+ "Successfully");

											// This will let the user know there
											// was a
											// problem and that drink is fully
											// stocked.
										} else {
											JOptionPane
													.showMessageDialog(
															null,
															"That Drink is "
																	+ "completely stocked.");

										}

										// This will tell the user they had
										// incorrect input for
										// the type of drink to add.
									} else {
										JOptionPane.showMessageDialog(null,
												"Incorrect Input.\n"
														+ "Please Try Again.");
									}
								}

								// This will check to see if the user wants to
								// enter the removing portion of the maintenance
								// screen.
							} else if (opInput.equals("remove")) {
								// A local variable to use with the removing
								// while loop.
								boolean remove = true;

								// The removing while loop, which will allow the
								// operator to remove drinks from the system.
								while (remove) {
									// This will ask the user to select which
									// drink product
									// they would like to remove.
									String removeDrink = JOptionPane
											.showInputDialog("Select"
													+ " which drink to add.\n1-Coca-Cola \n2-Diet Coke "
													+ "\n3-Dr. Pepper \n4-Diet Dr. Pepper "
													+ "\n5-Cherry Coke \n6-Mello Yello \n7-Coke Zero "
													+ "\n8-Orange Fanta \nPlease input the number"
													+ " of your choice.");

									// This will allow the user to hit the
									// cancel
									// button if they want to exit.
									if (removeDrink == null) {
										break;
									}

									// This makes sure the drink selected was a
									// proper
									// input
									if (removeDrink.equals("1")
											|| removeDrink.equals("2")
											|| removeDrink.equals("3")
											|| removeDrink.equals("4")
											|| removeDrink.equals("5")
											|| removeDrink.equals("6")
											|| removeDrink.equals("7")
											|| removeDrink.equals("8")) {

										// This creates an int from the String
										// input
										int select = Integer
												.parseInt(removeDrink);

										// This attempts to remove the drink
										// from
										// the system.
										boolean remover = system
												.removeProduct(select);

										// This will let the user know if the
										// drink
										// was removed.
										if (remover == true) {
											JOptionPane.showMessageDialog(null,
													"Drink Removed"
															+ " Successfully");

											// This will let the user know if
											// there are
											// no drinks to remove from the
											// system.
										} else {
											JOptionPane
													.showMessageDialog(
															null,
															"There are none "
																	+ "of these drinks in the machine.");

										}

										// This lets the user know if they did
										// not
										// put in a correct drink
									} else {
										JOptionPane.showMessageDialog(null,
												"Incorrect Input.\n"
														+ "Please Try Again.");
									}
								}

								// This lets the user know if the input to
								// select
								// which function they would like to know is not
								// valid.
							} else {
								JOptionPane.showMessageDialog(null,
										"Incorrect Input.\n"
												+ "Please Try Again.");
							}
						}

						// This will allow the user to reenter the login
						// information
					} else {
						if (test < 5) {
							JOptionPane.showMessageDialog(null,
									"That is not a correct"
											+ " username.  Please try again.");

							// If the user enters an incorrect name into the
							// login screen more than 5 times it will kick them
							// out.
						} else {
							JOptionPane
									.showMessageDialog(
											null,
											"You have entered an"
													+ " incorrect login too many times.");
							break;
						}
					}
				}

				// If the user inputs 'select' they can go to a screen
				// to make their drink selection
			} else if (input.equals("select")) {
				// This is a local variable to help with
				// the selection while loop.
				boolean selection = true;

				// The selection loop. This will allow the user to
				// select drinks, and will dispense them if enough
				// money was inserted.
				while (selection) {
					// A JOptionPane giving the list of drinks.
					String j = (JOptionPane
							.showInputDialog("Make Selection "
									+ "from the list:\n1-Coca-Cola \n2-Diet Coke \n3-Dr. Pepper "
									+ "\n4-Diet Dr. Pepper \n5-Cherry Coke \n6-Mello Yello "
									+ "\n7-Coke Zero \n8-Orange Fanta \nPlease input the number"
									+ " of your choice."));

					// This will allow the user to exit by hitting
					// cancel
					if (j == null)
						break;

					// This if statement checks to make sure the user
					// input was valid.
					if (j.equals("1") || j.equals("2") || j.equals("3")
							|| j.equals("4") || j.equals("5") || j.equals("6")
							|| j.equals("7") || j.equals("8")) {

						// This parses the string input to an integer
						int select = Integer.parseInt(j);

						// This creates a new Product object by trying
						// to purchase one through the Vending Machine
						// System
						Product p = new Product(system.purchase(select - 1,
								money));

						// This checks to make sure the user had entered enough
						// money.
						if (p.getName().equals("Nope")) {
							// This will let the user know not enough money
							// was inserted and give change back.
							JOptionPane
									.showMessageDialog(
											null,
											"I'm sorry, but you"
													+ "did not insert enough money.\nYour change is "
													+ toMoney(money) + ".");

							// This will break out of all the loops
							// after this action is complete.
							breakBool = true;
							break;

							// This checks to see if the product was sold out.
						} else if (p.getName().equals("Empty")) {
							// This will let the user know the product was
							// sold out, and give back change.
							JOptionPane
									.showMessageDialog(
											null,
											"I'm sorry, but we "
													+ "are sold out of that drink.\nYour change is "
													+ toMoney(money) + ".");

							// This will break out of all the loops
							// after this action is complete.
							breakBool = true;
							break;

							// This will check to see if the drink was
							// dispensed properly
						} else {
							// This will let the user know their selection
							// was successful, and let them know what they
							// bought, and give back change.
							JOptionPane.showMessageDialog(null,
									"Here is your drink." + "\nYou selected a "
											+ p.getName() + ", \nand your"
											+ " change is "
											+ toMoney(money - 75)
											+ "\nThank you.");

							// This will break out of all the loops
							// after this action is complete.
							breakBool = true;
							break;
						}

						// This will tell the user their drink selection was
						// not valid.
					} else {
						JOptionPane
								.showMessageDialog(
										null,
										"Oops.  There seems to be a"
												+ " problem with your selection.\nPlease Try Again.");
					}
				}

				// This lets the user know their input was not valid,
				// and asks them to try again.
			} else {
				JOptionPane.showMessageDialog(null,
						"Oops.  There seems to be a problem"
								+ " with your input." + "\nPlease Try Again.");
			}

			// This statement breaks out of the loop if
			// a selection took place.
			if (breakBool) {
				running = false;
			}
		} while (running == true);

	}

	/**
	 * This is a function, which will take the integer representation of cents
	 * and return a string in the format '$X.XX'.
	 * 
	 * @param i
	 *            The integer representation of cents.
	 * @return Returns a string representing money in the form '$X.XX'
	 */
	private static String toMoney(int i) {
		// Creates a new empty string
		String retString = new String("");

		// If i is 0 then return '0.00'
		if (i == 0) {
			return "$0.00";
		}

		// This adds the first part of the
		// string, which is a '$'
		retString = retString + "$";

		// This if statement adds the first part of
		// the string.
		if (i % 100 == 0) {
			retString = retString + Integer.toString(i / 100);
			retString = retString + ".00";

			// This will create the second part of the
			// string.
		} else {
			retString = retString + Integer.toString(i / 100);
			retString = retString + ".";
			retString = retString + Integer.toString(i - ((i / 100) * 100));
		}

		// This returns the String that was created
		return retString;
	}

}
