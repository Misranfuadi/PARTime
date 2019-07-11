package com.example.misra.myapplication;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;


import com.example.misra.myapplication.Action.PrefManager;
import com.google.firebase.messaging.RemoteMessage;

public class MainActivity extends AppCompatActivity {


    PrefManager prefManager;


    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        ImageView hospital = findViewById(R.id.hospital);
        ImageView banking = findViewById(R.id.banking);
        TextView logout = findViewById(R.id.logout);



        prefManager = new PrefManager(this);

        hospital.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent a = new Intent(getApplicationContext(),HospitalActivity.class );
                startActivity(a);
            }
        });

        banking.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent a = new Intent(getApplicationContext(),BankingActivity.class );
                startActivity(a);
            }
        });


        logout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                prefManager.setSudahLogin(false);
                prefManager.clear();
                Intent a = new Intent(getApplicationContext(),LoginActivity.class );
                startActivity(a);
                finish();
            }
        });
      //  TextView nama = findViewById(R.id.nama);
      //        nama.setText(sharedPreferences.getString("nama",""));
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Intent a = new Intent(Intent.ACTION_MAIN);
        a.addCategory(Intent.CATEGORY_HOME);
        a.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        startActivity(a);
    }
}
