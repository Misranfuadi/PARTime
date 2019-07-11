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

import com.example.misra.myapplication.Adapter.SpesialisAdapter;
import com.example.misra.myapplication.Api.BaseApiService;
import com.example.misra.myapplication.Api.UtilsApi;

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

public class AmbilPelayan extends AppCompatActivity {

    PrefManager prefManager;
    BaseApiService mApiService;
    private RecyclerView recyclerView;
    private SpesialisAdapter mAdapter;
    ArrayList<Spesialis> spesialisArrayList = new ArrayList<>();




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ambil_pelayan);


        mApiService = UtilsApi.getApiService();
        prefManager=new PrefManager(this);

        recyclerView = findViewById(R.id.recycler_view);

        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.addItemDecoration(new DividerItemDecoration(this, LinearLayoutManager.VERTICAL));



        mApiService.ambilPelayanRequest(prefManager.getHospitalUsername(prefManager.getIndexHospital()),prefManager.getHospitalSpesialis(prefManager.getIndexSpesialis())).enqueue(new Callback<ResponseBody>() {
            @Override
            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {

                if (response.isSuccessful()) {

                    try {
                        JSONObject jsonRESULTS = new JSONObject(response.body().string());

                        JSONArray jsonArray = jsonRESULTS.getJSONArray(prefManager.getHospitalSpesialis(prefManager.getIndexSpesialis()));

                        for (int i = 0; i < jsonArray.length(); i++) {
                            JSONObject object = jsonArray.getJSONObject(i);
                            Spesialis spesialis = new Spesialis();
                            spesialis.setNama(object.getString("nama"));
                            spesialis.setTanggal(object.getString("tanggal"));
                            spesialis.setBuka(object.getString("buka"));
                            spesialis.setTutup(object.getString("tutup"));


                            spesialisArrayList.add(spesialis);
                            prefManager.setNama(spesialis.getNama(),i);
                            mAdapter = new SpesialisAdapter(spesialisArrayList);
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
                                prefManager.setIndexNama(position);
                                Intent intent = new Intent(getApplicationContext(), DetailPelayan.class);
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
        Intent intent=new Intent(this,TampilPelayan.class);
        startActivity(intent);
        finish();
    }
}
