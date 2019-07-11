package com.example.misra.myapplication;

import android.app.Fragment;
import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.media.RingtoneManager;
import android.net.Uri;
import android.os.Handler;
import android.support.v4.app.FragmentTransaction;
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

import static android.app.Notification.EXTRA_NOTIFICATION_ID;

public class DetailPelayan extends AppCompatActivity {

    PrefManager prefManager;
    BaseApiService mApiService;
    Handler handler = new Handler();
    Runnable refresh;
    private int notificationId = 1;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail);
        prefManager = new PrefManager(this);
        refresh = new Runnable() {
            @Override
            public void run() {
                handler.postDelayed(refresh,2000);


        mApiService = UtilsApi.getApiService();

        Button ambilbtn = findViewById(R.id.ambilbtn);


        TextView namauser = findViewById(R.id.namauser);
        namauser.setText(prefManager.getNamaUser());

        final TextView namadokter = findViewById(R.id.namadokter);
        namadokter.setText(prefManager.getNama(prefManager.getIndexNama()));

        final TextView txtempat = findViewById(R.id.tempat);
        final TextView txalamat = findViewById(R.id.alamat);
        final TextView txtotal = findViewById(R.id.total);
        final TextView txterpanggil = findViewById(R.id.terpanggil);
        final TextView txtmenunggu = findViewById(R.id.menunggu);
        final TextView txtnomor = findViewById(R.id.nomor);
        final TextView txtstatus = findViewById(R.id.status);



                Log.d("PLAYGROUND", "Details ID: " + getIntent().getIntExtra("EXTRA_DETAILS_ID", -1));


        mApiService.detailPelayanRequest(prefManager.getNamaUser(),prefManager.getHospitalUsername(prefManager.getIndexHospital()),prefManager.getNama(prefManager.getIndexNama()),prefManager.getHospitalSpesialis(prefManager.getIndexSpesialis())).enqueue(new Callback<ResponseBody>() {
            @Override
            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                if (response.isSuccessful()) {

                    try {
                        JSONObject jsonRESULTS = new JSONObject(response.body().string());

                        // jika sukses


                            // parsing data
                            String tempat = jsonRESULTS.getJSONObject(prefManager.getNama(prefManager.getIndexNama())).getString("tempat");
                            String alamat = jsonRESULTS.getJSONObject(prefManager.getNama(prefManager.getIndexNama())).getString("alamat");
                            String total = jsonRESULTS.getJSONObject(prefManager.getNama(prefManager.getIndexNama())).getString("total");
                            String terpanggil = jsonRESULTS.getJSONObject(prefManager.getNama(prefManager.getIndexNama())).getString("terpanggil");
                            String menunggu = jsonRESULTS.getJSONObject(prefManager.getNama(prefManager.getIndexNama())).getString("menuggu");
                            String nomor = jsonRESULTS.getJSONObject(prefManager.getNama(prefManager.getIndexNama())).getString("nomor");
                            String status = jsonRESULTS.getJSONObject(prefManager.getNama(prefManager.getIndexNama())).getString("status");


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

                mApiService.notifRequest(prefManager.getNamaUser(),prefManager.getHospitalUsername(prefManager.getIndexHospital()),prefManager.getNama(prefManager.getIndexNama()),prefManager.getHospitalSpesialis(prefManager.getIndexSpesialis())
                ).enqueue(new Callback<ResponseBody>() {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        try {
                            JSONObject jsonRESULTS = new JSONObject(response.body().string());

                            // Jika ambilbtn sudah di clikc

                            /*long[] pattern = {500,500,500,500,500,500,500,500,500};
                            Uri alarmSound = RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);*/

                            String notmsg = jsonRESULTS. getString("notmsg");
                            String isimsg = jsonRESULTS. getString("isimsg");
                            String pushnomor = jsonRESULTS. getString("pushnomor");


                            Intent detailsIntent = new Intent(DetailPelayan.this, DetailPelayan.class);
                            detailsIntent.putExtra("EXTRA_DETAILS_ID", 42);
                            PendingIntent detailsPendingIntent = PendingIntent.getActivity(
                                    DetailPelayan.this,
                                    0,
                                    detailsIntent,
                                    PendingIntent.FLAG_UPDATE_CURRENT
                            );
                            if(pushnomor != null ) {
                                NotificationCompat.Builder mBuilder = new NotificationCompat.Builder(DetailPelayan.this)
                                        .setSmallIcon(R.drawable.icon_logo)
                                        /*.setVibrate(pattern)
                                        .setSound(alarmSound)*/
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
                                mApiService.crudAmbilRequest(prefManager.getNamaUser(), prefManager.getNama(prefManager.getIndexNama()), prefManager.getHospitalUsername(prefManager.getIndexHospital()), prefManager.getHospitalSpesialis(prefManager.getIndexSpesialis())).enqueue(new Callback<ResponseBody>() {
                                    @Override
                                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                                        try {
                                            JSONObject jsonRESULTS = new JSONObject(response.body().string());

                                            // Jika ambilbtn sudah di clikc
                                            String msg = jsonRESULTS.getString("msg");
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
