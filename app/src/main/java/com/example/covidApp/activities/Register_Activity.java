package com.example.covidApp.activities;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.example.covidApp.R;
import com.example.covidApp.models.DefaultResponse;
import com.example.covidApp.api.RetrofitClient;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Register_Activity extends AppCompatActivity {
    private EditText reg_name, reg_email, reg_pass;
    private Button rButton;
    ProgressBar progressBar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_);

        reg_name = findViewById(R.id.r_Name);
        reg_email = findViewById(R.id.log_email);
        reg_pass = findViewById(R.id.log_pass);
        rButton = findViewById(R.id.log_button);



        rButton.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                String user_email = reg_email.getText().toString().trim();
                String user_password = reg_pass.getText().toString().trim();
                String business_name = reg_name.getText().toString().trim();

                if (TextUtils.isEmpty(user_email)) {
                    reg_email.setError("Email Required");
                }
                if (TextUtils.isEmpty(user_password)) {
                    reg_pass.setError("Password Required");
                }
                if (user_password.length() < 4) {
                    reg_pass.setError("Password must be greater than 4 characters");
                    //return;
                }

                Call<DefaultResponse> call = RetrofitClient
                        .getInstance()
                        .getApi()
                        .createUser(user_email, user_password, business_name);

                call.enqueue(new Callback<DefaultResponse>() {
                    @Override
                    public void onResponse(Call<DefaultResponse> call, Response<DefaultResponse> response) {

                        if (response.code() == 201) {
                            DefaultResponse dr = response.body();
                            Toast.makeText(Register_Activity.this, dr.getMsg(), Toast.LENGTH_LONG).show();
                        }
                        else if(response.code() == 422) {
                            Toast.makeText(Register_Activity.this, "User already exists", Toast.LENGTH_LONG).show();

                        }
                    }

                    @Override
                    public void onFailure(Call<DefaultResponse> call, Throwable t) {

                    }
                });
            }
        });
    }

}