package com.example.covidApp.activities;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.navigation.fragment.NavHostFragment;

import com.example.covidApp.R;
import com.example.covidApp.api.RetrofitClient;
import com.example.covidApp.models.Business;
import com.example.covidApp.models.Business_Display_Response;
import com.example.covidApp.models.Category_Response;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Business_Screen_Template extends Fragment {
    private Business business;

    @Nullable
    @Override
    public View onCreateView(
            LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState
    ) {
        String business_name = this.getArguments().getString("business_name");
        View v = inflater.inflate(R.layout.pets_layout, container, false);

        Call<Business_Display_Response> call = RetrofitClient.getInstance().getApi().getBusinessByName(business_name);

        call.enqueue(new Callback<Business_Display_Response>() {
            @Override
            public void onResponse(Call<Business_Display_Response> call, Response<Business_Display_Response> response) {
                business = response.body().getBusiness();
                TextView name = (TextView) v.findViewById(R.id.Business_Name);
                name.setText(business.getName());

            }

            @Override
            public void onFailure(Call<Business_Display_Response> call, Throwable t) {

            }
        });

        return v;
    }

    @Override
    public void onViewCreated(@NonNull View view, Bundle savedInstanceState) {

        super.onViewCreated(view, savedInstanceState);

    }



}
