package com.example.misra.myapplication.Action;

import android.content.Context;
import android.content.SharedPreferences;

public class PrefManager {

    // Shared preferences file name
    public static final String PREF_NAME = "PREF_PARTIME";
    private static final String CEK_SUDAH_LOGIN = "sessionLogin";
    private SharedPreferences pref;
    private SharedPreferences.Editor editor;
    private Context mContext;

    // context
    public PrefManager(Context context) {
        this.mContext = context;
        pref = mContext.getSharedPreferences(PREF_NAME, 0);
        editor = pref.edit();
    }

    // session login
    public boolean sessionLogin() {
        return pref.getBoolean(CEK_SUDAH_LOGIN, false);
    }

    public void setSudahLogin(boolean sudahLogin, String data) {
        editor.putBoolean(CEK_SUDAH_LOGIN, sudahLogin);

        //Data User Lokal
        editor.putString("namauser",data);

        editor.commit();
    }

    // ini method khusus pemanggilan button logout
    // karena logout tidak memerlukan data user;
    public void setSudahLogin(boolean sudahLogin) {
        editor.putBoolean(CEK_SUDAH_LOGIN, sudahLogin);
        editor.commit();
    }
    public String getNamaUser() {
        return pref.getString("namauser", "");
    }

    // -------------------------------------------------------- //

// Hospital
    public void setHospitalUsername(String username, int index){
        editor.putString("username"+index,username);

        editor.commit();
    }
    public String getHospitalUsername(int index) {
        return pref.getString("username"+index, "");
    }


    public void setHospitalSpesialis(String spesilis, int index){
        editor.putString("spesialis"+index,spesilis);

        editor.commit();
    }
    public String getHospitalSpesialis(int index) {
        return pref.getString("spesialis"+index, "");
    }

    public void setIndexHospital(int index){
        editor.putInt("uindex",index);

        editor.commit();
    }
    public Integer getIndexHospital() {
        return pref.getInt("uindex", 0);
    }

    public void setIndexSpesialis(int index){
        editor.putInt("spindex",index);

        editor.commit();
    }
    public Integer getIndexSpesialis() {
        return pref.getInt("spindex", '0');
    }


    public void setNama(String nama, int index){
        editor.putString("nama"+index,nama);

        editor.commit();
    }
    public String getNama(int index) {
        return pref.getString("nama"+index, "");
    }



    public void setIndexNama(int index){
        editor.putInt("namaindex",index);

        editor.commit();
    }
    public Integer getIndexNama() {
        return pref.getInt("namaindex", '0');
    }


    //------banking

    public void setBankingUsername(String username, int index){
        editor.putString("username"+index,username);

        editor.commit();
    }
    public String getBankingUsername(int index) {
        return pref.getString("username"+index, "");
    }

    public void setIndexBanking(int index){
        editor.putInt("uindex",index);
        editor.commit();
    }
    public Integer getIndexBanking() {
        return pref.getInt("uindex", 0);
    }



    public void setTypeLoket(String type_loket, int index){
        editor.putString("type_loket"+index,type_loket);

        editor.commit();
    }
    public String getTypeLoket(int index) {
        return pref.getString("type_loket"+index, "");
    }



    public void setIndexTypeLoket(int index){
        editor.putInt("type_loketindex",index);

        editor.commit();
    }
    public Integer getIndexTypeLoket() {
        return pref.getInt("type_loketindex", '0');
    }




    public void clear() {
        editor.clear();
        editor.commit();
    }
}
