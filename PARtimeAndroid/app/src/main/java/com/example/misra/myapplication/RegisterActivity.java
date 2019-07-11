package com.example.misra.myapplication;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.misra.myapplication.Api.BaseApiService;
import com.example.misra.myapplication.Api.UtilsApi;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class RegisterActivity extends AppCompatActivity {


    BaseApiService mApiService;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        final EditText nama = findViewById(R.id.nama);
        final EditText username = findViewById(R.id.username);
        final EditText password = findViewById(R.id.txtpassword);
        Button regbtn =  findViewById(R.id.regbtn);

        mApiService = UtilsApi.getApiService();

        regbtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (nama.getText().toString().isEmpty()) {
                    Toast.makeText(getApplicationContext(), "Nama tidak boleh kosong!", Toast.LENGTH_SHORT).show();
                } else if (username.getText().toString().isEmpty()) {
                    Toast.makeText(getApplicationContext(), "Username tidak boleh kosong!", Toast.LENGTH_SHORT).show();
                } else if (password.getText().toString().isEmpty()) {
                    Toast.makeText(getApplicationContext(), "Password tidak boleh kosong!", Toast.LENGTH_SHORT).show();
                } else {

                    mApiService.registerRequest(nama.getText().toString(),username.getText().toString(),password.getText().toString()).enqueue(new Callback<ResponseBody>() {

                        @Override
                        public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                            if (response.isSuccessful()) {
                                try {
                                    JSONObject jsonRESULTS = new JSONObject(response.body().string());

                                    // jika sukses
                                    if (jsonRESULTS.getString("msg").equals("Berhasil")) {

                                        Toast.makeText(getApplicationContext(), "Register Sukses", Toast.LENGTH_SHORT).show();
                                        Intent a = new Intent(getApplicationContext(),LoginActivity.class );
                                        startActivity(a);
                                        finish();


                                    } else {

                                        Toast.makeText(getApplicationContext(), "Username Sudah Terdaftar", Toast.LENGTH_SHORT).show();

                                    }

                                } catch (JSONException e) {
                                    e.printStackTrace();
                                } catch (IOException e) {
                                    e.printStackTrace();
                                }

                            }
                        }

                        @Override
                        public void onFailure(Call<ResponseBody> call, Throwable t) {

                        }
                    });
                }
            }
        });
    }
    public void onBackPressed(){

        Intent a = new Intent(getApplicationContext(),LoginActivity.class );
        startActivity(a);
        finish();
    }

}
