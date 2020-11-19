package com.example.covidApp.api;

import com.example.covidApp.models.DefaultResponse;
import com.example.covidApp.models.LoginResponse;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface API {


    @FormUrlEncoded
    @POST("createuser")
    Call<DefaultResponse> createUser(
            @Field("user_email") String user_email,
            @Field("user_password") String user_password,
            @Field("business_name") String business_name
    );

    @FormUrlEncoded
    @POST("userlogin")
    Call<LoginResponse> userLogin(
            @Field("user_email") String user_email,
            @Field("user_password") String user_password
    );

}
