package edu.radford.icampbell3.vendingMachine;

/**
 * This is a basic object class that will contain the information necessary for
 * a vending machine product. This class contains two private fields, which
 * store the data for the product.
 * 
 * @author Ian Campbell
 * 
 */
public class Product {

	// Private fields, which define the
	// product used in the vending machine.
	// I am using an int for the cost representing
	// number of cents each product costs.
	private String name;
	private int cost;

	/**
	 * This is a basic constructor taking in two arguments and assigning them to
	 * the two private fields of this class.
	 * 
	 * @param name
	 *            Assigned to the name of the Product
	 * @param cost
	 *            Assigned to the cost of the Product
	 */
	public Product(String name, int cost) {
		super();
		this.name = name;
		this.cost = cost;
	}

	/**
	 * This is a copy constructor. It will take one product and create a new one
	 * from the given product.
	 * 
	 * @param p
	 *            A Product to copy
	 */
	Product(Product p) {
		super();
		this.name = p.getName();
		this.cost = p.getCost();
	}

	/**
	 * This is a getter function for the name of the product.
	 * 
	 * @return The name of the product in a String
	 */
	public String getName() {
		return name;
	}

	/**
	 * This is a getter function for the cost of the product.
	 * 
	 * @return The cost of the product as an int
	 */
	public int getCost() {
		return cost;
	}

}
