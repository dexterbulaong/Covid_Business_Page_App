package com.example.covidApp.models;

import com.google.gson.annotations.SerializedName;

public class Users {
    @SerializedName("business_id") private int Business_Id;
    @SerializedName("user_email") private String User_Email;
    @SerializedName("business_name") private String Name;

    public int getId() {
        return Business_Id;
    }

    public String getEmail() {
        return User_Email;
    }

    public String getName() {
        return Name;
    }


}
