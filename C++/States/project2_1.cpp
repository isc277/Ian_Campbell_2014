/*
	Ian Campbell (icampbell3)
	ITEC 320 - Project 2_1
	4/26/12
	project2_1.cpp
	This c++ project will take in information defining a 
	set of 'states' that will be connected through defining
	neighbors.  These states will be defined as a State, which
	is a class I created and defined in State.h and State.cpp.  
	Each of these states can contain a resource,
	but does not have to.  Once the user asks for a certain 
	resource the program will calculate the price for that
	resource and print out that price on the command line.
*/

#include <iostream>
#include <string>
#include <stdlib.h>
#include "State.h"

using namespace std;

//This is a function prototype that will calculate the price
int getPrice(State &state, string resource, int quantity);

/*
	Main function.  This function will do all of the input from
	the command line, and call the getPrice() function once the
	user asks for a certain resource.
*/
int main(void){
	//This string will be used to take in input
	string input;
	
	//This is an array of State objects that will hold all of hte
	//states.
	State states[100];
	
	//This is an int that will keep track of the number of states
	int count = 0;
	
	//This while loop will do take in all of the input, create and
	//assign variables and objects.
	while(cin >> input){
		//This if statement will determine what the input is asking of
		//the program
		if (input == "addState"){
			//This will take in the name of a state and put that to a
			//State object.
			string name;
			cin >> name;
			states[count].setName(name);
			count++;
			
		} else if (input == "addNeighbor"){
			//This will take in the name and relationship between two
			//neighbor states then assign the states to each other.
			string state;
			int stateIndex;
			string neighbor;
			int neighborIndex;
			string direction;
			cin >> state >> neighbor >> direction;
			
			//This for statement will go through all of the declared
			//States and determine which are neighbors using their names
			for(int i = 0; i < count; i++){
				if (state == states[i].getName()){
					stateIndex = i;
				}
				if (neighbor == states[i].getName()){
					neighborIndex = i;
				}
			}
			
			//This if else statement block will assign the states to each
			//other
			if (direction == "North"){
				states[stateIndex].addNeighbor(&states[neighborIndex], 0);
			} else if (direction == "West"){
				states[stateIndex].addNeighbor(&states[neighborIndex], 1);
			} else if (direction == "South"){
				states[stateIndex].addNeighbor(&states[neighborIndex], 2);
			} else if (direction == "East"){
				states[stateIndex].addNeighbor(&states[neighborIndex], 3);
			}
			
		} else if (input == "addResource"){
			//This will take in the state name, and add a resource name,
			//resource quantity and resource cost to the state
			string state;
			string resource;
			int quantity;
			int cost;
			cin >> state >> resource >> quantity >> cost;
			for(int i = 0; i < 5; i++){
				if (state == states[i].getName()){
					states[i].setResource(resource);
					states[i].setResourceQuantity(quantity);
					states[i].setResourcePrice(cost);
					break;
				}
			}
		} else if (input == "getPrice"){
			//This will take in the state, resource, and quantity
			//to buy then call the getPrice() function.
			string state;
			string resource;
			int quantity;
			int cost;
			cin >> state >> resource >> quantity;
			for(int i = 0; i < 5; i++){
				if (state == states[i].getName()){
					cost = getPrice(states[i], resource, quantity);
					cout << "Price for " << quantity << " of " 
						<< resource << " from " << state << " is " 
						<< cost << endl;
					break;
				}
			}
		}
	}
}


/*
	This function will take in a state, a resource name, and a quantity.
	Then the function will use the rules outlined to determine the price
	for said quantity of said resource.
*/	
int getPrice(State &state, string resource, int quantity){
	//This will be used to determine how many states have the wanted resource
	int premium = 0;
	
	//This is the value that will hold the cost
	double cost = 0;
	
	//This array will be used to get the 4 neighbors of a state.
	State neighbors[4];
	
	//This for loop will go through all of the neighbors of a state,
	//determine if they are actual states and assign them to the 
	//neighbors[] array.
	for (int i = 0; i < 4; i++){
		if (state.getNeighbor(i) != NULL){
			neighbors[i] = *state.getNeighbor(i);
		}
	}
	
	//This for loop will go through the neighbors and determine how
	//many neighbors have the resource.
	for (int i = 0; i < 4; i++){
		if (neighbors[i].getResource() == resource){
			premium++;
		}
	}
	
	//This outer if else statement will determine what the premium is
	//based on the number of neighbors that have a resource.
	if (premium <= 1){
		
		//This if else statement determines whether the central state has
		//the resource or not and uses that information to begin calculating
		//the price.
		if (state.getResourceQuantity() != 0){
			
			//This if else statement determines whether or not the state has 
			//enough of the resource to fill the order.
			if (state.getResourceQuantity() >= quantity){
				cost += quantity * .25 * state.getResourcePrice();
				cost += quantity * state.getResourcePrice();
				
			} else {
			
				//If the state does not have enough of the resource it will 
				//use all of the resource it has then import the rest from 
				//the neighboring states.
				cost += state.getResourceQuantity() * .25 
					* state.getResourcePrice();
				cost += state.getResourceQuantity() 
					* state.getResourcePrice();
				quantity -= state.getResourceQuantity();
				
				//This for loop will go through the neighbor states in a 
				//specific order until the quantity is met.  A similar 
				//process to above will be used (ie checking to see if a 
				//state has enough to finish the order then going through
				//the remaining states if there is not enough.
				for (int i = 0; i < 4; i++){
					if ((neighbors[i].getName() != "") && 
						(neighbors[i].getResource() == resource)){
						if (neighbors[i].getResourceQuantity() >= quantity){
							double tempCost = 0;
							tempCost += quantity * .25 
								* neighbors[i].getResourcePrice();
							tempCost += quantity 
								* neighbors[i].getResourcePrice();
							cost += tempCost + (tempCost * .1);
							break;
						} else {
							double tempCost = 0;
							tempCost +=  neighbors[i].getResourceQuantity() 
								* .25 * neighbors[i].getResourcePrice();
							tempCost += neighbors[i].getResourceQuantity() 
								* neighbors[i].getResourcePrice();
							cost += tempCost + (tempCost * .1);
							quantity -= neighbors[i].getResourceQuantity();
						}
					}
				}
			}
		} else {
		
			//This for loop will go through the neighbor states in a 
			//specific order until the quantity is met.  A similar 
			//process to above will be used (ie checking to see if a 
			//state has enough to finish the order then going through
			//the remaining states if there is not enough.
			for (int i = 0; i < 4; i++){
				if (neighbors[i].getName() != "" && 
					neighbors[i].getResource() == resource){
					if (neighbors[i].getResourceQuantity() >= quantity){
						double tempCost = 0;
						tempCost +=  quantity * .25 
							* neighbors[i].getResourcePrice();
						tempCost += quantity 
							* neighbors[i].getResourcePrice();
						cost += tempCost + (tempCost * .1);
						break;
					} else {
						double tempCost = 0;
						tempCost +=  neighbors[i].getResourceQuantity() 
							* .25 * neighbors[i].getResourcePrice();
						tempCost += neighbors[i].getResourceQuantity() 
							* neighbors[i].getResourcePrice();
						cost += tempCost + (tempCost * .1);
						quantity -= neighbors[i].getResourceQuantity();
					}
				}
			}
		}
	} else if (premium > 1 && premium <= 3){
	
		//This if else statement determines whether the central state has
		//the resource or not and uses that information to begin calculating
		//the price.
		if (state.getResourceQuantity() != 0){
		
			//This if else statement determines whether or not the state has 
			//enough of the resource to fill the order.
			if (state.getResourceQuantity() >= quantity){
				cost +=  quantity * state.getResourcePrice();
			} else {
			
				//If the state does not have enough of the resource it will 
				//use all of the resource it has then import the rest from 
				//the neighboring states.
				cost += state.getResourceQuantity() * state.getResourcePrice();
				quantity -= state.getResourceQuantity();
				
				//This for loop will go through the neighbor states in a 
				//specific order until the quantity is met.  A similar 
				//process to above will be used (ie checking to see if a 
				//state has enough to finish the order then going through
				//the remaining states if there is not enough.
				for (int i = 0; i < 4; i++){
					if ((neighbors[i].getName() != "") && 
						(neighbors[i].getResource() == resource)){
						if (neighbors[i].getResourceQuantity() >= quantity){
							double tempCost = 0;
							tempCost += quantity 
								* neighbors[i].getResourcePrice();
							cost += tempCost + (tempCost * .1);
							break;
						} else {
							double tempCost = 0;
							tempCost += neighbors[i].getResourceQuantity() 
								* neighbors[i].getResourcePrice();
							cost += tempCost + (tempCost * .1);
							quantity -= neighbors[i].getResourceQuantity();
						}
					}
				}
			}
		} else {
		
			//This for loop will go through the neighbor states in a 
			//specific order until the quantity is met.  A similar 
			//process to above will be used (ie checking to see if a 
			//state has enough to finish the order then going through
			//the remaining states if there is not enough.
			for (int i = 0; i < 4; i++){
				if (neighbors[i].getName() != "" && 
					neighbors[i].getResource() == resource){
					if (neighbors[i].getResourceQuantity() >= quantity){
						double tempCost = 0;
						tempCost += quantity * neighbors[i].getResourcePrice();
						cost += tempCost + (tempCost * .1);
						break;
					} else {
						double tempCost = 0;
						tempCost += neighbors[i].getResourceQuantity() 
							* neighbors[i].getResourcePrice();
						cost += tempCost + (tempCost * .1);
						quantity -= neighbors[i].getResourceQuantity();
					}
				}
			}
		}
	} else if (premium > 3){
	
		//This if else statement determines whether the central state has
		//the resource or not and uses that information to begin calculating
		//the price.
		if (state.getResourceQuantity() != 0){
		
			//This if else statement determines whether or not the state has 
			//enough of the resource to fill the order.
			if (state.getResourceQuantity() >= quantity){
				cost +=  quantity * .9 * state.getResourcePrice();
			} else {
			
				//If the state does not have enough of the resource it will 
				//use all of the resource it has then import the rest from 
				//the neighboring states.
				cost +=  state.getResourceQuantity() * .9 
					* state.getResourcePrice();
				quantity -= state.getResourceQuantity();
				
				//This for loop will go through the neighbor states in a 
				//specific order until the quantity is met.  A similar 
				//process to above will be used (ie checking to see if a 
				//state has enough to finish the order then going through
				//the remaining states if there is not enough.
				for (int i = 0; i < 4; i++){
					if ((neighbors[i].getName() != "") && 
						(neighbors[i].getResource() == resource)){
						if (neighbors[i].getResourceQuantity() >= quantity){
							double tempCost = 0;
							tempCost +=  quantity * .9 
								* neighbors[i].getResourcePrice();
							cost += tempCost + (tempCost * .1);
							break;
						} else {
							double tempCost = 0;
							tempCost +=  neighbors[i].getResourceQuantity() 
								* .9 * neighbors[i].getResourcePrice();
							cost += tempCost + (tempCost * .1);
							quantity -= neighbors[i].getResourceQuantity();
						}
					}
				}
			}
		} else {
		
			//This for loop will go through the neighbor states in a 
			//specific order until the quantity is met.  A similar 
			//process to above will be used (ie checking to see if a 
			//state has enough to finish the order then going through
			//the remaining states if there is not enough.
			for (int i = 0; i < 4; i++){
				if (neighbors[i].getName() != "" && 
					neighbors[i].getResource() == resource){
					if (neighbors[i].getResourceQuantity() >= quantity){
						double tempCost = 0;
						tempCost +=  quantity * .9 
							* neighbors[i].getResourcePrice();
						cost += tempCost + (tempCost * .1);
						break;
					} else {
						double tempCost = 0;
						tempCost +=  neighbors[i].getResourceQuantity() 
							* .9 * neighbors[i].getResourcePrice();
						cost += tempCost + (tempCost * .1);
						quantity -= neighbors[i].getResourceQuantity();
					}
				}
			}
		}
	}
	
	//This will return the cost, casting it to an int first.
	return (int) cost;
}
