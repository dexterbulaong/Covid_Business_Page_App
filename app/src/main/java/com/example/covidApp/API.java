package com.example.covidApp;

import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface API {


    @FormUrlEncoded
    @POST("createuser")
    Call<ResponseBody> createUser(
            @Field("user_email") String user_email,
            @Field("password") String user_password,
            @Field("business_name") String business_name
    );
}
