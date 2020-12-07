package com.example.covidApp.activities;

import android.os.Build;
import android.os.Bundle;
import android.text.Html;
import android.text.method.LinkMovementMethod;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.annotation.RequiresApi;
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
        View v = inflater.inflate(R.layout.business_temp, container, false);

        Call<Business_Display_Response> call = RetrofitClient.getInstance().getApi().getBusinessByName(business_name);

        call.enqueue(new Callback<Business_Display_Response>() {
            @RequiresApi(api = Build.VERSION_CODES.N)
            @Override
            public void onResponse(Call<Business_Display_Response> call, Response<Business_Display_Response> response) {
                business = response.body().getBusiness();
                TextView name = (TextView) v.findViewById(R.id.Business_Name);
                name.setText(business.getName());

                TextView dataList = (TextView) v.findViewById(R.id.Hours_List);
                dataList.setText("Business Hours :\n" + business.getHours());


                TextView address = (TextView) v.findViewById(R.id.Address);
                address.setText("Address:\n" + business.getAddress());

                TextView website = (TextView) v.findViewById(R.id.Weblink);
                website.setMovementMethod(LinkMovementMethod.getInstance());
                website.setText(business.getLink());

                TextView update = (TextView) v.findViewById(R.id.Updated);
                update.setText("Page last updated: " + business.getUpdated());
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
