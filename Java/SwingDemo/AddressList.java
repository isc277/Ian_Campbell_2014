/**
 * This class is a singly-linked list. It includes multiple methods most of
 * which are carried out using recursive helper methods. Also included in this
 * class is a private class, ListNode, which is used to carry out the Linked
 * List.
 * 
 * @author Ian Campbell (icampbell3)	date: 12/8/11
 */
public class AddressList {

	// These two private fields hold the head of the linked
	// list as well as a marker for the current list.
	private ListNode head;
	private ListNode current;

	/**
	 * This is a simple constructor. It just initializes the head and current
	 * fields to null.
	 */
	public AddressList() {
		this.head = null;
		this.current = null;
	}

	/**
	 * This function returns a boolean value, true if the list is empty and
	 * false if it is not.
	 * 
	 * @return Whether or not the list is empty
	 */
	public boolean isEmpty() {
		if (this.head == null) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * This method will add a new ListNode to the front of the linked list.
	 * 
	 * @param name
	 *            The name for the ListNode
	 * @param tel
	 *            The phone number for the ListNode
	 * @param email
	 *            The email for the ListNode
	 * @param address
	 *            The address for the ListNode
	 * @param dob
	 *            The dob for the ListNode
	 */
	public void addToFront(String name, String tel, String email,
			String address, String dob) {
		// This if statement checks to see if the head of the
		// list is null. If it is it creates a new node and
		// sets it as the head.
		if (head == null) {
			ListNode newHead = new ListNode(name, tel, email, address, dob);
			head = newHead;
			this.current = this.head;
		} else {
			// If the head is not null this will create a new
			// ListNode, set it as the head and set the head
			// as the next ListNode.
			ListNode newHead = new ListNode(name, tel, email, address, dob);
			newHead.setNext(this.head);
			this.head = newHead;
			this.current = this.head;
		}
	}

	/**
	 * This method will add a new ListNode to the back of the linked list.
	 * 
	 * @param name
	 *            The name for the ListNode
	 * @param tel
	 *            The phone number for the ListNode
	 * @param email
	 *            The email for the ListNode
	 * @param address
	 *            The address for the ListNode
	 * @param dob
	 *            The dob for the ListNode
	 */
	public void addToBack(String name, String tel, String email,
			String address, String dob) {
		// This checks to see if the head is null, if it is
		// this creates a new node and sets it as the head.
		// Otherwise it calls a helper function to do the
		// recursive part to find where to add the new node.
		if (this.head == null) {
			ListNode newHead = new ListNode(name, tel, email, address, dob);
			this.head = newHead;
			this.current = newHead;
			return;
		} else {
			addToBackHelper(this.head, name, tel, email, address, dob);
		}

	}

	/**
	 * This returns the Linked List as a formatted string.
	 * 
	 * @return The Linked List as a string
	 */
	public String toString() {
		if (this.head == null) {
			return "Empty";
		} else {
			return toStringHelper(this.head);
		}
	}

	/**
	 * This returns the Linked List as a string in reverse order.
	 * 
	 * @return The Linked List as a string in reverse order
	 */
	public String reverseToString() {
		if (this.head == null) {
			return "Empty";
		} else {
			return reverseToStringHelper(this.head);
		}
	}

	/**
	 * This returns an AddressList that is in reverse order from the original
	 * order.
	 * 
	 * @return The AddressList in reverse order
	 */
	public AddressList reverse() {
		if (this.head == null) {
			AddressList tempList = new AddressList();
			return tempList;
		} else {
			AddressList tempList = new AddressList();
			return reverseHelper(this.head, tempList);
		}
	}

	/**
	 * This returns the size of the linked list.
	 * 
	 * @return An int of the number of nodes in the list
	 */
	public int sizeOf() {
		if (this.head == null) {
			return 0;
		} else {
			return 1 + sizeOfHelper(this.head);
		}
	}

	/**
	 * This will search the AddressList for a name. Then it will return the
	 * phone number from the Node with that name. It will return
	 * "No matching data" if there is no match.
	 * 
	 * @param name
	 *            The name to search with
	 * @return The phone number with that name
	 */
	public String phoneNumberByName(String name) {
		if (this.head == null) {
			return "No matching data";
		} else if (this.head.getName().equals(name)) {
			return this.head.getTel();
		} else {
			return phoneNumberByNameHelper(this.head.next, name);
		}
	}

	/**
	 * This will search the AddressList for a name. Then it will return the
	 * email from the Node with that name. It will return "No matching data" if
	 * there is no match.
	 * 
	 * @param name
	 *            The name to search with
	 * @return The email with that name
	 */
	public String emailByName(String name) {
		if (this.head == null) {
			return "No matching data";
		} else if (this.head.getName().equals(name)) {
			return this.head.getEmail();
		} else {
			return emailByNameHelper(this.head.next, name);
		}
	}

	/**
	 * This will search the AddressList for a phone number. Then it will return
	 * the name from the Node with that number. It will return
	 * "No matching data" if there is no match.
	 * 
	 * @param name
	 *            The phone number to search with
	 * @return The name with that phone number
	 */
	public String nameByPhoneNumber(String tel) {
		if (this.head == null) {
			return "No matching data";
		} else if (this.head.getTel().endsWith(tel)) {
			return this.head.getName();
		} else {
			return nameByPhoneNumberHelper(this.head.next, tel);
		}
	}

	/**
	 * This will search the AddressList for a name. Then it will return the date
	 * of birth from the Node with that name. It will return "No matching data"
	 * if there is no match.
	 * 
	 * @param name
	 *            The name to search with
	 * @return The date of birth with that name
	 */
	public String dobByName(String name) {
		if (this.head == null) {
			return "No matching data";
		} else if (this.head.getName().equals(name)) {
			return this.head.getDob();
		} else {
			return dobByNameHelper(this.head.next, name);
		}
	}

	// Recursive Helper Functions:
	/**
	 * This is the add to back helper. It recursively steps through the
	 * AddressList until it finds the end. Then it adds the new Node at the end
	 * of the list.
	 */
	private void addToBackHelper(ListNode currentNode, String name, String tel,
			String email, String address, String dob) {
		if (currentNode.next == null) {
			ListNode newNode = new ListNode(name, tel, email, address, dob);
			currentNode.next = newNode;
		} else {
			addToBackHelper(currentNode.next, name, tel, email, address, dob);
		}
	}

	/**
	 * This is the toString() helper. It recursively steps through the
	 * AddressList and returns the toString() of each Node adding it to a
	 * recursive call of the rest of the AddressList.
	 * 
	 * @return This returns a String of the ListNodes
	 */
	private String toStringHelper(ListNode currentNode) {
		if (currentNode == null) {
			return "";
		} else {
			return currentNode.toString() + toStringHelper(currentNode.next);
		}
	}

	/**
	 * This is the reverseToString() helper. It recursively steps through the
	 * AddressList and returns the toString() of each Node adding it to a
	 * recursive call of the rest of the AddressList backwards. This will return
	 * the list in reverse order.
	 * 
	 * @return This returns a String of the ListNodes in reverse order.
	 */
	private String reverseToStringHelper(ListNode currentNode) {
		if (currentNode == null) {
			return "";
		} else {
			return reverseToStringHelper(currentNode.next)
					+ currentNode.toString();
		}
	}

	/**
	 * This is the reverse() helper. It recursively steps through the
	 * AddressList and adds the ListNodes to a new tempList in reverse order.
	 * Then it returns a new AddressList.
	 * 
	 * @return A new AddressList that is the original AddressList in reverse
	 *         order
	 */
	private AddressList reverseHelper(ListNode currentNode, AddressList list) {
		if (currentNode == null) {
			return null;
		} else {
			list.addToFront(currentNode.getName(), currentNode.tel,
					currentNode.email, currentNode.getAddr(),
					currentNode.getDob());
			reverseHelper(currentNode.next, list);
			return list;
		}
	}

	/**
	 * This steps through the list and adds one for each initialized Node. This
	 * will recursively add up the number of nodes in the AddressList.
	 * 
	 * @return The number of ListNodes in the AddressList
	 */
	private int sizeOfHelper(ListNode currentNode) {
		if (currentNode.next == null) {
			return 0;
		} else {
			return 1 + sizeOfHelper(currentNode.next);
		}
	}

	/**
	 * This is the phoneNumberByName() helper that will recursively step through
	 * the AddressList checking to see if any of the ListNodes match the name
	 * being searched.
	 */
	private String phoneNumberByNameHelper(ListNode currentNode, String name) {
		if (currentNode == null) {
			return "No matching data";
		} else if (currentNode.getName().equals(name)) {
			return currentNode.getTel();
		} else {
			return phoneNumberByNameHelper(currentNode.next, name);
		}
	}

	/**
	 * This is the emailByName() helper that will recursively step through the
	 * AddressList checking to see if any of the ListNodes match the name being
	 * searched.
	 */
	private String emailByNameHelper(ListNode currentNode, String name) {
		if (currentNode == null) {
			return "No matching data";
		} else if (currentNode.getName().equals(name)) {
			return currentNode.getEmail();
		} else {
			return emailByNameHelper(currentNode.next, name);
		}
	}

	/**
	 * This is the nameByPhoneNumber() helper that will recursively step through
	 * the AddressList checking to see if any of the ListNodes match the phone
	 * number being searched.
	 */
	private String nameByPhoneNumberHelper(ListNode currentNode, String tel) {
		if (currentNode == null) {
			return "No matching data";
		} else if (currentNode.getTel().equals(tel)) {
			return currentNode.getName();
		} else {
			return nameByPhoneNumberHelper(currentNode.next, tel);
		}
	}

	/**
	 * This is the dobByName() helper that will recursively step through the
	 * AddressList checking to see if any of the ListNodes match the name being
	 * searched.
	 */
	private String dobByNameHelper(ListNode currentNode, String name) {
		if (currentNode == null) {
			return "No matching data";
		} else if (currentNode.getName().equals(name)) {
			return currentNode.getDob();
		} else {
			return dobByNameHelper(currentNode.next, name);
		}
	}

	// Private ListNode class

	/**
	 * This is the private ListNode class used to populate the AddressList.
	 */
	private class ListNode {

		// These private fields hold a name, a telephone number, an
		// email, an address, a date of birth, and a pointer to the
		// next ListNode.
		private String name;
		private String tel;
		private String email;
		private String addr;
		private String dob;
		private ListNode next;

		/**
		 * This is a simple constructor. It takes a parameter for each String
		 * field.
		 * 
		 * @param name
		 *            The name for the ListNode
		 * @param tel
		 *            The phone number for the ListNode
		 * @param email
		 *            The email for the ListNode
		 * @param addr
		 *            The address for the ListNode
		 * @param dob
		 *            The dob for the ListNode
		 */
		private ListNode(String name, String tel, String email, String addr,
				String dob) {
			this.name = name;
			this.tel = tel;
			this.email = email;
			this.addr = addr;
			this.dob = dob;
			this.next = null;
		}

		/**
		 * This will return the name.
		 * 
		 * @return The name from the ListNode
		 */
		public String getName() {
			return this.name;
		}

		/**
		 * This will set the name.
		 */
		public void setName(String name) {
			this.name = name;
		}

		/**
		 * This will return the phone number.
		 * 
		 * @return The phone number from the ListNode
		 */
		public String getTel() {
			return this.tel;
		}

		/**
		 * This will set the phone number.
		 */
		public void setTel(String tel) {
			this.tel = tel;
		}

		/**
		 * This will return the email.
		 * 
		 * @return The email from the ListNode
		 */
		public String getEmail() {
			return this.email;
		}

		/**
		 * This will set the email.
		 */
		public void setEmail(String email) {
			this.email = email;
		}

		/**
		 * This will return the address.
		 * 
		 * @return The address from the ListNode
		 */
		public String getAddr() {
			return this.addr;
		}

		/**
		 * This will set the address.
		 */
		public void setAddr(String addr) {
			this.addr = addr;
		}

		/**
		 * This will return the date of birth.
		 * 
		 * @return The date of birth from the ListNode
		 */
		public String getDob() {
			return this.dob;
		}

		/**
		 * This will set the date of birth.
		 */
		public void setDob(String dob) {
			this.dob = dob;
		}

		/**
		 * This will return the next ListNode.
		 * 
		 * @return The next ListNode
		 */
		public ListNode getNext() {
			return this.next;
		}

		/**
		 * This will set the pointer to the next ListNode.
		 */
		public void setNext(ListNode next) {
			this.next = next;
		}

		/**
		 * This will return the ListNode in a specific format.
		 * 
		 * @return The information from the ListNode
		 */
		public String toString() {
			String retVal = "Name:  " + this.name + "\nTelephone Number:  "
					+ this.tel + "\nEmail Address:  " + this.email
					+ "\nAddress:  " + this.addr + "\nDate of Birth:  "
					+ this.dob + "\n\n";
			return retVal;
		}
	}
}
