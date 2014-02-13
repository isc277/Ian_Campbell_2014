package edu.radford.icampbell3.vendingMachine;

import java.util.ArrayList;

/**
 * This class will control the Basic functions of the Vending Machine, while
 * using the Product and ProductQueue classes.
 * 
 * @author Ian Campbell
 * 
 */

public class VendingSystem {

	// Two final variable arrays. These control what
	// kinds of products can be put into the drink
	// machine. This makes the code very reusable,
	// and easily altered. For instance to change
	// a product or its price only these arrays
	// need to be altered. Nowhere else in the code
	// would a problem arise.
	final String[] DRINKS = { "Coca-Cola", "Diet Coke", "Dr. Pepper",
			"Diet Dr. Pepper", "Cherry Coke", "MelloYello", "Coke Zero",
			"Orange Fanta" };
	final int[] COST = { 75, 75, 75, 75, 75, 75, 75, 75 };

	// An ArrayList of ProductQueues.
	private ArrayList<ProductQueue> QUEUES;

	// All the ProductQueues. This simulates
	// a vending machine with space for 8 separate
	// items.
	private ProductQueue vendQueue0;
	private ProductQueue vendQueue1;
	private ProductQueue vendQueue2;
	private ProductQueue vendQueue3;
	private ProductQueue vendQueue4;
	private ProductQueue vendQueue5;
	private ProductQueue vendQueue6;
	private ProductQueue vendQueue7;

	/**
	 * The default constructor. This initializes the ArrayList and all 8
	 * ProductQueues, then it adds all 8 ProductQueues in order to the
	 * ArrayList.
	 */
	VendingSystem() {
		QUEUES = new ArrayList<ProductQueue>();
		vendQueue0 = new ProductQueue();
		vendQueue1 = new ProductQueue();
		vendQueue2 = new ProductQueue();
		vendQueue3 = new ProductQueue();
		vendQueue4 = new ProductQueue();
		vendQueue5 = new ProductQueue();
		vendQueue6 = new ProductQueue();
		vendQueue7 = new ProductQueue();

		QUEUES.add(vendQueue0);
		QUEUES.add(vendQueue1);
		QUEUES.add(vendQueue2);
		QUEUES.add(vendQueue3);
		QUEUES.add(vendQueue4);
		QUEUES.add(vendQueue5);
		QUEUES.add(vendQueue6);
		QUEUES.add(vendQueue7);

	}

	/**
	 * This method allows products to be purchased from the vending machine if
	 * there is product in the specific ProductQueue, and enough money was
	 * entered.
	 * 
	 * @param i
	 *            The ProductQueue to remove the product
	 * @param money
	 *            The amount of money inserted
	 * @return Returns a Product, and one of two pre-defined fake Products in
	 *         case the machine is sold out or the user did not enter enough
	 *         money.
	 */
	public Product purchase(int i, int money) {
		if (COST[i] <= money) {
			if (!QUEUES.get(i).isEmpty()) {
				return QUEUES.get(i).vend();
			} else {
				Product blank = new Product("Empty", 0);
				return blank;
			}
		} else {
			Product poor = new Product("Nope", 0);
			return poor;
		}
	}

	/**
	 * This allows someone to restock the machine, and keep the software
	 * up-to-date.
	 * 
	 * @param i
	 *            This will determine which Product to be added.
	 * @return Returns true if the product was added successfully.
	 */
	public boolean addProduct(int i) {
		Product p = new Product(DRINKS[i], COST[i]);
		try {
			QUEUES.get(i).add(p);
			return true;
		} catch (QueueFullException q) {
			return false;
		}
	}

	/**
	 * This is a helper function to allow a maintenance person to remove
	 * Products from the system without purchasing them.
	 * 
	 * @param i
	 *            The Product to be removed
	 * @return Returns true if the Product was removed successfully.
	 */
	public boolean removeProduct(int i) {
		return QUEUES.get(i).remove();
	}

}
