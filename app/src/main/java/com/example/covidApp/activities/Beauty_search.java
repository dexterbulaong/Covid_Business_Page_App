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
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.covidApp.R;
import com.example.covidApp.api.RetrofitClient;
import com.example.covidApp.models.Business;
import com.example.covidApp.models.Business_Adapter;
import com.example.covidApp.models.Category_Response;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Beauty_search extends Fragment {
    //    LinearLayout linearLayout;
    private RecyclerView recyclerView;
    private Business_Adapter adapter;
    private List<Business> businessList;



    @Nullable
    @Override
    public View onCreateView(
            LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState
    ) {
        View v = inflater.inflate(R.layout.beauty_layout, container, false);

        Call<Category_Response> call = RetrofitClient.getInstance().getApi().getBusinesses("Hair and Beauty");

        call.enqueue(new Callback<Category_Response>() {
            @Override
            public void onResponse(Call<Category_Response> call, Response<Category_Response> response) {
                businessList = response.body().getBusinesses();
                LinearLayout ll = (LinearLayout) v.findViewById(R.id.dyn_layout);

                for(int i = 0; i < businessList.size(); i++) {
                    Button btn = new Button(getContext());
                    btn.setText(businessList.get(i).getName());
                    btn.setId(i);
                    ll.addView(btn);

                    int index = i;
                    btn.setOnClickListener(new View.OnClickListener() {
                        public void onClick(View v) {

                            /* This is where it will transition to the template business page*/
                            Bundle bundle = new Bundle();
                            bundle.putString("business_name", businessList.get(index).getName());
                            NavHostFragment.findNavController(Beauty_search.this)
                                    .navigate(R.id.action_beauty_search_to_Business_Temp, bundle);

                        }
                    });

                }
            }

            @Override
            public void onFailure(Call<Category_Response> call, Throwable t) {

            }
        });

        return v;
    }

    @Override
    public void onViewCreated(@NonNull View view, Bundle savedInstanceState) {

        super.onViewCreated(view, savedInstanceState);


    }
}