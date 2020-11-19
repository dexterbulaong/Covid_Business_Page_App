package com.example.covidApp.models;

import com.google.gson.annotations.SerializedName;

public class Users {
    @SerializedName("id") private int Id;
    @SerializedName("name") private String Name;

    public int getId() {
        return Id;
    }

    public String getName() {
        return Name;
    }
}
