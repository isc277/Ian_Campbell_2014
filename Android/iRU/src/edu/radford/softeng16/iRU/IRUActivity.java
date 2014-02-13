package edu.radford.softeng16.iRU;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class IRUActivity extends Activity {
    /** Called when the activity is first created. */
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        
        final Button maps = (Button) findViewById(R.id.maps);
        maps.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent newActivity = new Intent(IRUActivity.this, IRUMaps.class);
                IRUActivity.this.startActivity(newActivity);
            }
        });
        
        final Button sports = (Button) findViewById(R.id.sports);
        sports.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
            	Intent newActivity = new Intent(IRUActivity.this, IRUSports.class);
                IRUActivity.this.startActivity(newActivity);
            }
        });
        
        final Button dining = (Button) findViewById(R.id.dining);
        dining.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
            	Intent newActivity = new Intent(IRUActivity.this, IRUDining.class);
                IRUActivity.this.startActivity(newActivity);
            }
        });
        
        final Button activities = (Button) findViewById(R.id.activities);
        activities.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
            	Intent newActivity = new Intent(IRUActivity.this, IRUActivities.class);
                IRUActivity.this.startActivity(newActivity);
            }
        });
    }
}