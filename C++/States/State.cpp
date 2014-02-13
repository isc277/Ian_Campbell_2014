/*
	Ian Campbell (icampbell3)
	ITEC 320 - Project 2_1
	4/26/12
	State.cpp
	This file implements State.h for use with project2_1.cpp.
*/

#include <iostream>
#include <stdlib.h>
#include <string>
#include "State.h"

using namespace std;

/*
	The default constructor initializes the strings to "" and the
	integers to 0.  It will also set all 4 of the neighbor pointers
	to NULL.
*/
State::State(){
	name = "";
	resource = "";
	resourceQuantity = 0;
	resourcePrice = 0;
	for (int i = 0; i < 4; i++){
		neighbors[i] = NULL;
	}
}

/*
	This constructor will set the name to a parameter, initializes 
	the other string to "" and the integers to 0.  It will also set 
	all 4 of the neighbor pointers to NULL.
*/
State::State(string name){
	name = name;
	resource = "";
	resourceQuantity = 0;
	resourcePrice = 0;
	for (int i = 0; i < 4; i++){
		neighbors[i] = NULL;
	}
}

/*
	This is the deconstructor.  It will go through and delete all
	of the neighbor pointers.
*/
State::~State(){
	for (int i = 0; i < 4; i++){
		delete neighbors[i];
	}
}

/*
	This will set the name variable.
*/
void State::setName(string s){
	name = s;
}

/*
	This will set the resource variable.
*/
void State::setResource(string s){
	resource = s;
}

/*
	This will set the resourceQuantity variable.
*/
void State::setResourceQuantity(int x){
	resourceQuantity = x;
}

/*
	This will set the resourcePrice variable.
*/
void State::setResourcePrice(int x){
	resourcePrice = x;
}

/*
	This will add a new neighbor to the neighbors array.
*/
void State::addNeighbor(State *s, int index){
	neighbors[index] = s;
}

/*
	This will return the name variable
*/
string State::getName(){
	return name;
}

/*
	This will return the resource variable
*/
string State::getResource(){
	return resource;
}

/*
	This will return the resourceQuantity variable
*/
int State::getResourceQuantity(){
	return resourceQuantity;
}

/*
	This will return the resourcePrice variable
*/
int State::getResourcePrice(){
	return resourcePrice;
}

/*
	This will return a pointer to a neighbor at a specific
	index.
*/
State* State::getNeighbor(int index){
	return neighbors[index];
}