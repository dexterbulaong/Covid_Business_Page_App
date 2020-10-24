package com.example.covidApp;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.navigation.fragment.NavHostFragment;

public class Categ_main extends Fragment {

    @Override
    public View onCreateView(
            LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState
    ) {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.category_layout, container, false);
    }

    public void onViewCreated(@NonNull View view, Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        view.findViewById(R.id.to_beauty).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                NavHostFragment.findNavController(Categ_main.this)
                        .navigate(R.id.action_CategNav_to_beauty_search);
            }
        }
        );

        view.findViewById(R.id.to_government).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                NavHostFragment.findNavController(Categ_main.this)
                        .navigate(R.id.action_CategNav_to_govern_search2);
            }
        }
        );

        view.findViewById(R.id.to_grocery).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                NavHostFragment.findNavController(Categ_main.this)
                        .navigate(R.id.action_CategNav_to_groc_search);
            }
        }
        );

        view.findViewById(R.id.to_pets).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                NavHostFragment.findNavController(Categ_main.this)
                        .navigate(R.id.action_CategNav_to_pets_search);
            }
        }
        );

        view.findViewById(R.id.to_restaur).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                NavHostFragment.findNavController(Categ_main.this)
                        .navigate(R.id.action_CategNav_to_restaurant_search);
            }
        }
        );

        view.findViewById(R.id.to_retail).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                NavHostFragment.findNavController(Categ_main.this)
                        .navigate(R.id.action_CategNav_to_retail_search);
            }
        }
        );

        view.findViewById(R.id.to_sports).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                NavHostFragment.findNavController(Categ_main.this)
                        .navigate(R.id.action_CategNav_to_sports_search);
            }
        }
        );

        view.findViewById(R.id.to_ware).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                NavHostFragment.findNavController(Categ_main.this)
                        .navigate(R.id.action_CategNav_to_warehouse_search);
            }
        }
        );

        view.findViewById(R.id.back_to_home).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                NavHostFragment.findNavController(Categ_main.this)
                        .navigate(R.id.action_CategNav_to_MainHome);
            }
        }
        );
        
    }
}