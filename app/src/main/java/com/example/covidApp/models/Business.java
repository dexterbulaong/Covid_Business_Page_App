package com.example.covidApp.models;

import com.google.gson.annotations.SerializedName;

public class Business {
    @SerializedName("business_id") private int Business_Id;
    @SerializedName("business_name") private String Business_Name;
    @SerializedName("business_address") private String Business_Address;
    @SerializedName("business_hours") private String Business_Hours;
    @SerializedName("business_type") private String Business_Type;
    @SerializedName("business_link") private String Business_Link;
    @SerializedName("entry_date") private String Entry_Date;
    @SerializedName("last_updated") private String Last_Updated;

    public int getId() {
        return Business_Id;
    }

    public String getName() {
        return Business_Name;
    }

    public String getAddress() {
        return Business_Address;
    }

    public String getHours() {
        return Business_Hours;
    }

    public String getType() {
        return Business_Type;
    }

    public String getLink() {
        return Business_Link;
    }

    public String getEntry() {
        return Entry_Date;
    }

    public String getUpdated() {
        return Last_Updated;
    }

}
