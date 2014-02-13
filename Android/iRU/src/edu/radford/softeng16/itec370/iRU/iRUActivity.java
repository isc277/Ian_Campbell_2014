package edu.radford.softeng16.itec370.iRU;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class iRUActivity extends Activity {
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main2);
        
        final Button ruMap = (Button) findViewById(R.id.button1);
        ruMap.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				setContentView(R.layout.rumap);
			}
		});
        
        final Button ruDining = (Button) findViewById(R.id.button2);
        ruDining.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				setContentView(R.layout.main);
				
			}
		});
    }
}