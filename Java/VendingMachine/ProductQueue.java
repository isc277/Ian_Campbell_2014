package edu.radford.icampbell3.vendingMachine;

import java.util.LinkedList;

/**
 * This is a class which will store a Queue of Products in a Linked List and
 * will provide functions to use this queue with the given vending machine.
 * 
 * @author Ian Campbell
 * 
 */
public class ProductQueue {

	// Private field of the ProductQueue.
	// This is a LinkedList, which will store
	// all of the Products.
	private LinkedList<Product> vendingQueue;

	/**
	 * This is a default constructor that will simply initialize the LinkedList.
	 */
	ProductQueue() {
		vendingQueue = new LinkedList<Product>();
	}

	/**
	 * This method will allow Products to be added to the ProductQueue.
	 * 
	 * @param p
	 *            The product to be added
	 * @return returns a boolean value, true if the add was successful, and
	 *         false if not.
	 * @throws QueueFullException
	 *             Throws exceptions to limit the size of the Queue to 20
	 *             products.
	 */
	public boolean add(Product p) throws QueueFullException {
		if (vendingQueue.size() >= 20)
			throw new QueueFullException();
		else {
			vendingQueue.add(p);
			return true;
		}
	}

	/**
	 * This will return the first item of the LinkedList.
	 * 
	 * @return Returns the first product in the Queue.
	 */
	public Product vend() {
		if (vendingQueue.size() == 0) {
			return null;
		} else {
			return vendingQueue.pop();
		}
	}

	/**
	 * This will return the size of the queue
	 * 
	 * @return size of queue
	 */
	public int size() {
		return vendingQueue.size();
	}

	/**
	 * This will return whether or not the queue is empty.
	 * 
	 * @return True if empty, false otherwise
	 */
	public boolean isEmpty() {
		return vendingQueue.isEmpty();
	}

	/**
	 * This is a function to remove items without returning them.
	 * 
	 * @return true if successful remove, false otherwise
	 */
	public boolean remove() {
		if (vendingQueue.size() == 0) {
			return false;
		} else {
			vendingQueue.remove();
			return true;
		}
	}
}
