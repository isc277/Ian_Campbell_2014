package edu.radford.icampbell3.vendingMachine;

/**
 * A user defined exception class. This will be thrown in the ProductQueue class
 * when a Queue is full, and the user tries to add to the Queue.
 * 
 * @author Ian Campbell
 * 
 */
public class QueueFullException extends Exception {

	/**
	 * This is a default constructor using the superclass constructor.
	 */
	QueueFullException() {
		super();

	}

}
