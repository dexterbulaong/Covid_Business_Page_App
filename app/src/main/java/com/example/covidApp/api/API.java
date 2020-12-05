package com.example.covidApp.api;

import com.example.covidApp.models.Business_Display_Response;
import com.example.covidApp.models.Category_Response;
import com.example.covidApp.models.DefaultResponse;
import com.example.covidApp.models.LoginResponse;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.Path;

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

    @GET("getbusinesses/{business_type}")
    Call<Category_Response> getBusinesses(
            @Path("business_type") String business_type
    );

    @GET("getbusiness/{business_id}")
    Call<Business_Display_Response> getBusinessById(
            @Path("business_id") String business_id
    );

    @GET("getbusinessbyname/{business_name}")
    Call<Business_Display_Response> getBusinessByName(
            @Path("business_name") String business_Name
    );

}
