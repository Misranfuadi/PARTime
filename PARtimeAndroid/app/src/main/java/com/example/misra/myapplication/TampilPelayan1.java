package com.example.misra.myapplication;

import android.app.ProgressDialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.DividerItemDecoration;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Toast;

import com.example.misra.myapplication.Action.PrefManager;
import com.example.misra.myapplication.Action.TouchListener;
import com.example.misra.myapplication.Adapter.Pelayan1Adapter;
import com.example.misra.myapplication.Adapter.SpesialisAdapter;
import com.example.misra.myapplication.Api.BaseApiService;
import com.example.misra.myapplication.Api.UtilsApi;
import com.example.misra.myapplication.Model.Pelayan1;
import com.example.misra.myapplication.Model.Spesialis;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TampilPelayan1 extends AppCompatActivity {

    PrefManager prefManager;
    BaseApiService mApiService;
    private RecyclerView recyclerView;
    private Pelayan1Adapter mAdapter;
    ArrayList<Pelayan1> pelayan1ArrayList = new ArrayList<>();



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tampil_pelayan1);


        mApiService = UtilsApi.getApiService();
        prefManager=new PrefManager(this);

        recyclerView = findViewById(R.id.recycler_view);

        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.addItemDecoration(new DividerItemDecoration(this, LinearLayoutManager.VERTICAL));



        mApiService.ambilPelayanRequest1(prefManager.getBankingUsername(prefManager.getIndexBanking())).enqueue(new Callback<ResponseBody>() {
            @Override
            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {

                if (response.isSuccessful()) {

                    try {
                        JSONObject jsonRESULTS = new JSONObject(response.body().string());

                        JSONArray jsonArray = jsonRESULTS.getJSONArray(prefManager.getBankingUsername(prefManager.getIndexBanking()));

                        for (int i = 0; i < jsonArray.length(); i++) {
                            JSONObject object = jsonArray.getJSONObject(i);
                            Pelayan1 pelayan1 = new Pelayan1();
                            pelayan1.setTypeLoket(object.getString("type_loket"));
                            pelayan1.setTanggal(object.getString("tanggal"));
                            pelayan1.setBuka(object.getString("buka"));
                            pelayan1.setTutup(object.getString("tutup"));


                            pelayan1ArrayList.add(pelayan1);
                            prefManager.setTypeLoket(pelayan1.getTypeLoket(),i);
                            mAdapter = new Pelayan1Adapter(pelayan1ArrayList);
                            mAdapter.notifyDataSetChanged();

                        }
                        recyclerView.setAdapter(mAdapter);
                        recyclerView.addOnItemTouchListener(new TouchListener(getApplicationContext(), recyclerView, new TouchListener.OnTouchActionListener() {
                            @Override
                            public void onLeftSwipe(View view, int position) {

                            }

                            @Override
                            public void onRightSwipe(View view, int position) {

                            }

                            @Override
                            public void onClick(View view, int position) {
                                prefManager.setIndexTypeLoket(position);
                                Intent intent = new Intent(getApplicationContext(), DetailPelayan1.class);
                                startActivity(intent);
                            }
                        }));

                    } catch (JSONException e) {
                        e.printStackTrace();
                        Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                    } catch (IOException e) {
                        e.printStackTrace();
                        e.printStackTrace();
                        Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
                    }
                }
            }


            @Override
            public void onFailure(Call<ResponseBody> call, Throwable t) {

            }
        });
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Intent intent=new Intent(this,BankingActivity.class);
        startActivity(intent);
        finish();
    }
}
