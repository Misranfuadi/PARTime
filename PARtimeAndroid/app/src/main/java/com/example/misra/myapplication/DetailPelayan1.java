package com.example.misra.myapplication;

import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.os.Handler;
import android.support.v4.app.NotificationCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.misra.myapplication.Action.PrefManager;
import com.example.misra.myapplication.Api.BaseApiService;
import com.example.misra.myapplication.Api.UtilsApi;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class DetailPelayan1 extends AppCompatActivity {

    PrefManager prefManager;
    BaseApiService mApiService;
    Handler handler = new Handler();
    Runnable refresh;
    private int notificationId = 1;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail1);
        prefManager = new PrefManager(this);
        refresh = new Runnable() {
            @Override
            public void run() {
                handler.postDelayed(refresh,2000);


                mApiService = UtilsApi.getApiService();

                Button ambilbtn = findViewById(R.id.ambilbtn);


                TextView namauser = findViewById(R.id.namauser);
                namauser.setText(prefManager.getNamaUser());

                final TextView namaloket = findViewById(R.id.namaloket);
                namaloket.setText(prefManager.getTypeLoket(prefManager.getIndexTypeLoket()));




                final TextView txtempat = findViewById(R.id.tempat);
                final TextView txalamat = findViewById(R.id.alamat);
                final TextView txtotal = findViewById(R.id.total);
                final TextView txterpanggil = findViewById(R.id.terpanggil);
                final TextView txtmenunggu = findViewById(R.id.menunggu);
                final TextView txtnomor = findViewById(R.id.nomor);
                final TextView txtstatus = findViewById(R.id.status);

                Log.d("PLAYGROUND", "Details ID: " + getIntent().getIntExtra("EXTRA_DETAILS_ID", -1));

                mApiService.detailPelayanRequest1(prefManager.getNamaUser(),prefManager.getBankingUsername(prefManager.getIndexBanking()),prefManager.getTypeLoket(prefManager.getIndexTypeLoket())).enqueue(new Callback<ResponseBody>() {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        if (response.isSuccessful()) {

                            try {
                                JSONObject jsonRESULTS = new JSONObject(response.body().string());

                                // parsing data
                                String tempat = jsonRESULTS.getJSONObject(prefManager.getTypeLoket(prefManager.getIndexTypeLoket())).getString("tempat");
                                String alamat = jsonRESULTS.getJSONObject(prefManager.getTypeLoket(prefManager.getIndexTypeLoket())).getString("alamat");
                                String total = jsonRESULTS.getJSONObject(prefManager.getTypeLoket(prefManager.getIndexTypeLoket())).getString("total");
                                String terpanggil = jsonRESULTS.getJSONObject(prefManager.getTypeLoket(prefManager.getIndexTypeLoket())).getString("terpanggil");
                                String menunggu = jsonRESULTS.getJSONObject(prefManager.getTypeLoket(prefManager.getIndexTypeLoket())).getString("menuggu");
                                String nomor = jsonRESULTS.getJSONObject(prefManager.getTypeLoket(prefManager.getIndexTypeLoket())).getString("nomor");
                                String status = jsonRESULTS.getJSONObject(prefManager.getTypeLoket(prefManager.getIndexTypeLoket())).getString("status");


                                txtempat.setText(tempat);
                                txalamat.setText(alamat);
                                txtotal.setText(total);
                                txterpanggil.setText(terpanggil);
                                txtmenunggu.setText(menunggu);
                                txtnomor.setText(nomor);
                                txtstatus.setText(status);



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

                mApiService.notifRequest1(prefManager.getNamaUser(),prefManager.getBankingUsername(prefManager.getIndexBanking()),prefManager.getTypeLoket(prefManager.getIndexTypeLoket())).enqueue(new Callback<ResponseBody>() {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        try {
                            JSONObject jsonRESULTS = new JSONObject(response.body().string());

                            // Jika ambilbtn sudah di clikc

                           /* long[] pattern = {500,500,500,500,500,500,500,500,500};
                            Uri alarmSound = RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);
                            */
                            String notmsg = jsonRESULTS. getString("notmsg");
                            String isimsg = jsonRESULTS. getString("isimsg");
                            String pushnomor = jsonRESULTS. getString("pushnomor");



                            Intent detailsIntent = new Intent(DetailPelayan1.this, DetailPelayan1.class);
                            detailsIntent.putExtra("EXTRA_DETAILS_ID", 42);
                            PendingIntent detailsPendingIntent = PendingIntent.getActivity(
                                    DetailPelayan1.this,
                                    0,
                                    detailsIntent,
                                    PendingIntent.FLAG_UPDATE_CURRENT
                            );
                            if(pushnomor != null ) {
                                NotificationCompat.Builder mBuilder = new NotificationCompat.Builder(DetailPelayan1.this)
                                        .setSmallIcon(R.drawable.icon_logo)
                                        .setContentTitle(notmsg)
                                        .setLights(Color.WHITE, 500, 500)
                                        .setAutoCancel(true)
                                        .setContentIntent(detailsPendingIntent)
                                        .setContentText(isimsg);
                                NotificationManager notificationManager = (NotificationManager) getSystemService(NOTIFICATION_SERVICE);
                                notificationManager.notify(notificationId, mBuilder.build());
                            }




                        } catch (JSONException e) {
                            e.printStackTrace();
                        } catch (IOException e) {
                            e.printStackTrace();
                        }

                    }

                    @Override
                    public void onFailure(Call<ResponseBody> call, Throwable t) { }
                });

                ambilbtn.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        mApiService.crudAmbilRequest1(prefManager.getNamaUser(),prefManager.getBankingUsername(prefManager.getIndexBanking()),prefManager.getTypeLoket(prefManager.getIndexTypeLoket())).enqueue(new Callback<ResponseBody>() {
                            @Override
                            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                                try {
                                    JSONObject jsonRESULTS = new JSONObject(response.body().string());

                                    // Jika ambilbtn sudah di clikc
                                    String msg = jsonRESULTS. getString("msg");
                                    Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_SHORT).show();

                                } catch (JSONException e) {
                                    e.printStackTrace();
                                } catch (IOException e) {
                                    e.printStackTrace();
                                }
                            }



                            @Override
                            public void onFailure(Call<ResponseBody> call, Throwable t) {

                            }
                        });
                    }
                });

            }
        };handler.post(refresh);
    }
}
