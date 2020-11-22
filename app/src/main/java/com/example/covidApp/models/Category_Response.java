package com.example.covidApp.models;

import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class Category_Response  {
    private boolean error;
    private List<Business> businesses;

    public Category_Response(boolean error, List<Business> businesses) {
        this.error = error;
        this.businesses = businesses;
    }

    public boolean isError() {
        return error;
    }

    public List<Business> getBusinesses() {
        return businesses;
    }

}
