package com.example.covidApp.models;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;


import com.example.covidApp.R;

import java.util.List;

public class Business_Adapter extends RecyclerView.Adapter<Business_Adapter.BusinessViewHolder> {

    private Context mCtx;
    private List<Business> businessList;

    public Business_Adapter(Context mCtx, List<Business> businessList) {
        this.mCtx = mCtx;
        this.businessList = businessList;
    }

    @NonNull
    @Override
    public BusinessViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(mCtx).inflate(R.layout.pets_layout, parent, false);
        return new BusinessViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull BusinessViewHolder holder, int position) {
        Business business = businessList.get(position);

        holder.business_id = business.getId();
        holder.business_name = business.getName();
    }

    @Override
    public int getItemCount() {
        return businessList.size();
    }

    class BusinessViewHolder extends RecyclerView.ViewHolder {

        String business_name;
        int business_id;
        Button business_link;

        public BusinessViewHolder(View itemView) {
            super(itemView);


        }
    }
}

