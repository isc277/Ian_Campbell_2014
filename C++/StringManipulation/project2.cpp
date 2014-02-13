/*
	Ian Campbell (icampbell3)
	ITEC 320 - Project #2
	4/13/12
	This file will take in a series of integers and strings representing
	1 or more football teams.  The program will then calculate each team's
	effectiveness using a predetermined formula and player skill ranks.
	The program will use this formula to determine the outcome between two 
	teams if they were to play each other.
*/

#include <iostream>
#include <string>

using namespace std;

//Function prototypes for a swap function and a playgame function
void swapPlayers(float team1[], int player1, float team2[], int player2);
void playGame(float team1[], string team1Name, float team2[], string team2Name);

//This struct will be used to hold the team name and an array which
//will hold the effectiveness of each player.
struct Team {
	string name;
	float playerArray[11];
};

//main function
int main(void){
	//These variables will be used throughout the
	//main function
	int numTeams;
	int player;
	string position;
	float skill;
	string command;
	
	//This will take in the number of teams and declare an array of
	//Teams
	cin >> numTeams;
	Team allTeams[numTeams];
	
	//This for loop will take in all the information for each team
	for (int i = 0; i < numTeams; i++){
		//This will get the Team name
		cin >> allTeams[i].name;
		
		//This inner for loop will get all 11 players, calculate their
		//effectiveness and add it to the Team.playerArray
		for (int j = 0; j < 11; j++){
			cin >> player >> position >> skill;

			if (position == "CR")
				allTeams[i].playerArray[j] = skill / 1.2;
			else if (position == "TC")
				allTeams[i].playerArray[j] = skill / 2.2;
			else if (position == "GD")
				allTeams[i].playerArray[j] = skill / 2.0;
			else if (position == "TE")
				allTeams[i].playerArray[j] = skill * 1.1;
			else if (position == "WR")
				allTeams[i].playerArray[j] = skill / 1.8;
			else if (position == "QB")
				allTeams[i].playerArray[j] = skill * 2.0;
			else if (position == "RB")
				allTeams[i].playerArray[j] = skill * 1.5;
		}
	}
	
	//This while loop will continue until the end of file. 
	//It will take in the swap and play commands and call
	//functions accordingly.
	while (cin >> command){
		//If the command is 'swap' the program will take in the
		//information regarding players and teams and then call
		//the swapPlayers function.
		if (command == "swap"){
			int team1, player1, team2, player2;
			cin >> team1 >> player1 >> team2 >> player2;
			team1 -= 1;
			team2 -= 1;
			player1 -= 1;
			player2 -= 1;
			swapPlayers(allTeams[team1].playerArray, player1, allTeams[team2].playerArray, player2);
			
		//If the command is 'play' the program will take in the two
		//team numbers and then call the playGame function.
		} else if (command == "play"){
			int team1, team2;
			cin >> team1 >> team2;
			team1 -= 1;
			team2 -= 1;
			playGame(allTeams[team1].playerArray, allTeams[team1].name, allTeams[team2].playerArray, allTeams[team2].name);
		}
	}
}

/*
	This function will take in two arrays representing a team of players
	and two player numbers.  The function will then swap the two players
	representing a trade.
	
	@param float team1[]	The array representing the first team in the swap
	@param int player1		The number of the player in team 1 to be swapped
	@param float team2[]	The array representing the second team in the swap
	@param int player2		The number of the player in team 2 to be swapped
*/
void swapPlayers(float team1[], int player1, float team2[], int player2){
	//This creates a temporary player for the swap.	
	float tempPlayer;
		
	//This will perform a traditional swap	
	tempPlayer = team1[player1];
	team1[player1] = team2[player2];
	team2[player2] = tempPlayer;
	
	//This outputs 'Swapping players'
	cout << "Swapping Players" << endl;
	
	//Return statement
	return;
}

/*
	This function will take in two arrays representing a team of players
	and two team names.  The function will sum up the effectiveness of each
	player to produce a team effectiveness.  Then the function will compare
	the two team effectivenesses, determine a winner and output the result.
	
	@param float team1[]	The array representing the first team in the game
	@param string team1Name	The name of the first team in the game 	
	@param float team2[]	The array representing the second team in the game
	@param string team2Name	The name of the second team in the game 
*/
void playGame(float team1[], string team1Name, float team2[], string team2Name){
	//Two floating point numbers to hold the sum of each teams' effectiveness
	float sum1 = 0; 
	float sum2 = 0;
	
	//This outputs the matchup
	cout << "Playing " << team1Name << " vs. " << team2Name << endl;
	
	//This for loop will add up the sums of all players' effectiveness for each team
	for (int i = 0; i < 11; i++){
		sum1 += team1[i];
		sum2 += team2[i];
	}
	
	//This outputs the Effectivenesses
	cout << "Team Effectiveness is:  " << sum1 << ", " << sum2 << endl;

	//This determines who wins the simulation by effectiveness and outputs
	//the result
	if (sum1 < sum2)
		cout << "Result " << team1Name << " beat " << team2Name << endl;
	else if (sum2 < sum1)
		cout << "Result " << team2Name << " beat " << team1Name << endl;
	else
		cout << "Result " << team1Name << " tie " << team2Name << endl;
	
	//Return statement
	return;
}