package com.example.covidApp.models;

import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class Business_Display_Response  {
    private boolean error;
    private Business business;

    public Business_Display_Response(boolean error, Business business) {
        this.error = error;
        this.business = business;
    }

    public boolean isError() {
        return error;
    }

    public Business getBusiness() {
        return business;
    }

}