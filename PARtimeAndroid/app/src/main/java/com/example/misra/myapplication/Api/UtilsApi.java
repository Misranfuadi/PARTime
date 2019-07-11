package com.example.misra.myapplication.Api;

public class UtilsApi {

    public static final String BASE_URL_API = "http://misran.imukal.com/android/API/";

    //DEKLARASI INTERFACE BaseAPIService
    public static BaseApiService getApiService() {
        return AndroidClient.getClient(BASE_URL_API).create(BaseApiService.class);
    }
}
