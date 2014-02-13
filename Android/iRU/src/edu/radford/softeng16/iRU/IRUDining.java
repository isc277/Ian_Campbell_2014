package edu.radford.softeng16.iRU;

import java.util.Calendar;

import android.app.Activity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

public class IRUDining extends Activity {
	
	public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.dining);
        
        String[] daysOfWeek = {"", "Sunday", "Monday", "Tuesday", 
        		"Wednesday", "Thursday", "Friday", "Saturday"};
        String[] months = {"January", "February", "March", "April", "May",
        		"June", "July", "August", "September", "October", "November",
        		"December"};
        String tempRetVal = "Dining Hours for Today: \n";
        final Calendar today = Calendar.getInstance();
        tempRetVal += daysOfWeek[today.get(Calendar.DAY_OF_WEEK)];
        tempRetVal += " ";
        tempRetVal += months[today.get(Calendar.MONTH)];
        tempRetVal += " ";
        tempRetVal += today.get(Calendar.DATE);
        tempRetVal += ", ";
        tempRetVal += today.get(Calendar.YEAR);
        final String retVal = tempRetVal;
        
        
        final EditText hours = (EditText) findViewById(R.id.editText1);
        hours.setText(retVal);
        
        //final Button menu = (Button) findViewById(R.id.button1);
        
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(
        		this, R.array.spinner_array, android.R.layout.simple_spinner_item );
        adapter.setDropDownViewResource( android.R.layout.simple_spinner_dropdown_item );
        
        Spinner s = (Spinner) findViewById(R.id.spinner1);
        s.setAdapter(adapter);
        
        s.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            
        	public void onItemSelected(AdapterView<?> parent, View arg1,
					int pos, long arg3) {
        		//Toast.makeText(parent.getContext(), "The planet is " +
        		          //pos, Toast.LENGTH_LONG).show();
        		
        		switch (pos){
        			case 0:
        				hours.setText(retVal);
        				switch ((int) today.get(Calendar.DAY_OF_WEEK)){
        					case 7:
        					case 1:
        						hours.append("\n\nBrunch:  10:30am-2:00pm" + 
        								"\nDinner:  4:15pm-7:15pm");
        						break;
        						
        					case 2:
        					case 3:
        					case 4:
        					case 5:
        					case 6:
        						hours.append("\n\nBreakfast:  7:00am-10:30am" +
        							"\nLunch:  11:00am-2:30pm" +
									"\nDinner:  4:15pm-7:15pm");
        						break;
        						
        				}
        				break;
        				
        			case 1:
        				hours.setText(retVal);
        				switch ((int) today.get(Calendar.DAY_OF_WEEK)){
        					case 7:
        					case 1:
        						hours.append("\n\nClosed");
        						break;
    						
        					case 2:
        					case 3:
        					case 4:
        					case 5:
        						hours.append("\n\n7:00am-8:00pm");
        						break;
        					
        					case 6:
        						hours.append("\n\n7:00am-3:00pm");
        						break;
        				}
        				break;
        				
        			case 2:
        				hours.setText(retVal);
        				switch (today.get(Calendar.DAY_OF_WEEK)){
        					case 7:
        						hours.append("\n\nClosed");
        						break;
        						
        					case 1:
        						hours.append("\n\n1:00pm-5:00pm");
        						break;
        						
        					case 2:
        					case 3:
        					case 4:
        					case 5:
        						hours.append("\n\n8:00am-11:30pm");
        						break;
        					
        					case 6:
        						hours.append("\n\n8:00am-3:00pm");
        						break;
    					
        				}
        				break;
        				
        			case 3:
        				hours.setText(retVal);
        				switch (today.get(Calendar.DAY_OF_WEEK)){
        					case 7:
        					case 1:
        						hours.append("\n\nClosed");
        						break;
						
        					case 2:
        					case 3:
        					case 4:
        					case 5:
        						hours.append("\n\n7:30am-12:00am");
        						break;
    					
        					case 6:
        						hours.append("\n\n7:30am-1:00am");
        						break;
        				}
        				break;
        				
        			case 4:
        				hours.setText(retVal);
        				switch (today.get(Calendar.DAY_OF_WEEK)){
        					case 7:
        					case 1:
        						hours.append("\n\nClosed");
        						break;
					
        					case 2:
        					case 3:
        					case 4:
        					case 5:
        					case 6:
        						hours.append("\n\nLunch:  11:00am-2:00pm" +
        								"\nDinner:  5:00pm-8:00pm");
        						break;
					
        				}
        				
        				break;
        				
        			case 5:
        				hours.setText(retVal);
        				switch (today.get(Calendar.DAY_OF_WEEK)){
        					case 7:
        					case 1:
        						hours.append("\n\n12:00pm-8:00pm");
        						break;
				
        					case 2:
        					case 3:
        					case 4:
        					case 5:
        					case 6:
        						hours.append("\n\n11:00am-8:00pm");
        						break;
        				}
        				break;
        				
        			case 6:
        				hours.setText(retVal);
        				switch (today.get(Calendar.DAY_OF_WEEK)){
        					case 7:
        					case 1:
        						hours.append("\n\nClosed");
        						break;
				
        					case 2:	
        					case 3:
        					case 4:
        					case 5:
        						hours.append("\n\n11:00am-8:00pm");
        						break;
        						
        					case 6:
        						hours.append("\n\n11:00am-3:00pm");
        						break;
        				}
        				break;
        				
        			case 7:
        				hours.setText(retVal);
        				switch (today.get(Calendar.DAY_OF_WEEK)){
	        				case 7:
	    					case 1:
	    					case 2:
	    					case 3:
	    					case 4:
	    					case 5:
	    					case 6:
	    						hours.append("\n\n11:00am-10:00pm");
	    						break;
        				}
        				break;
        				
        			case 8:
        				hours.setText(retVal);
        				switch (today.get(Calendar.DAY_OF_WEEK)){
	        				case 7:
	        					hours.append("\n\n12:00pm-12:00am");
	        					break;
	        					
	    					case 1:
	    						hours.append("\n\n12:00pm-1:00am");
	        					break;
	    						
	    					case 2:
	    					case 3:
	    					case 4:
	    					case 5:
	    					case 6:
	    						hours.append("\n\n11:00am-8:00pm");
	    						break;
        				}
        				break;
        				
        			case 9:
        				hours.setText(retVal);
        				switch (today.get(Calendar.DAY_OF_WEEK)){
	        				case 7:
	        					hours.append("\n\n10:00am-10:00pm");
	        					break;
	        					
	    					case 1:
	    						hours.append("\n\n9:00am-10:00pm");
	        					break;
	    						
	    					case 2:
	    					case 3:
	    					case 4:
	    					case 5:
	    					case 6:
	    						hours.append("\n\n7:00am-10:00pm");
	    						break;
        				}
        				break;
        				
        			case 10:
        				hours.setText(retVal);
        				switch (today.get(Calendar.DAY_OF_WEEK)){
	        				case 7:
	        					hours.append("\n\nClosed");
	        					break;
	        					
	    					case 1:
	    						hours.append("\n\n12:00pm-7:00pm");
	        					break;
	    						
	    					case 2:
	    					case 3:
	    					case 4:
	    					case 5:
	    						hours.append("\n\n10:30am-8:00pm");
	    						break;
	    						
	    					case 6:
	    						hours.append("\n\n10:30am-7:00pm");
	    						break;
        				}
        				break;
        				
        			case 11:
        				hours.setText(retVal);
        				switch (today.get(Calendar.DAY_OF_WEEK)){
	        				case 7:
	        					hours.append("\n\n12:00pm-12:00am");
	        					break;
	        					
	    					case 1:
	    						hours.append("\n\n12:00pm-1:00am");
	        					break;
	    						
	    					case 2:
	    					case 3:
	    					case 4:
	    					case 5:
	    					case 6:
	    						hours.append("\n\n11:00am-9:00pm");
	    						break;
        				}
        				break;
        				
        			default:
        				break;
        		}
        		
				
			}
        	
            public void onNothingSelected(AdapterView<?> parent) {
            	//do nothing
            }
			
        });
        
        
	}

}
