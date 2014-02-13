#ifndef STATE_H
#define STATE_H 1

/*
	Ian Campbell (icampbell3)
	ITEC 320 - Project 2_1
	4/26/12
	State.h
	This file defines a c++ class names State, which will
	be used with project2_1.cpp to hold all of the information
	regarding each state.
*/

#include <iostream>
#include <stdlib.h>
#include <string>

using namespace std;

class State{
	//The private members are two strings referring to
	//the name and resource of the state.  Also two
	//integers to hold the resource quantity and
	//the resource price.  The last member is an array
	//of State pointers for each of the 4 neighbors of
	//the state.
	private:
		string name;
		string resource;
		int resourceQuantity;
		int resourcePrice;
		State* neighbors[4];
		
	//The public members are all functions to to use the
	//State class.  Two constructors, a deconstructor,
	//and getters and setters for each of the private
	//members.
	public:
		State();
		State(string name);
		~State();
		void setName(string s);
		void setResource(string s);
		void setResourceQuantity(int x);
		void setResourcePrice(int x);
		void addNeighbor(State* s, int index);
		string getName();
		string getResource();
		int getResourceQuantity();
		int getResourcePrice();
		State* getNeighbor(int index);
};

#endif