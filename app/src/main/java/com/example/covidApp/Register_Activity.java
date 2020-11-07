package com.example.covidApp;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatCallback;
import androidx.navigation.fragment.NavHostFragment;

import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import java.io.IOException;

import okhttp3.ResponseBody;
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

                if(TextUtils.isEmpty(user_email)){
                    reg_email.setError("Email Required");
                }
                if(TextUtils.isEmpty(user_password)){
                    reg_pass.setError("Password Required");
                }
                if(user_password.length() < 4){
                    reg_pass.setError("Password must be greater than 4 characters");
                    //return;
                }
                else {
                    Toast.makeText(Register_Activity.this, "Successful Registration", Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(Register_Activity.this, Register_Business.class);
                    startActivity(intent);
                }
                Call<ResponseBody> call = RetrofitClient
                        .getInstance()
                        .getApi()
                        .createUser(user_email, user_password, business_name);


                call.enqueue(new Callback<ResponseBody>() {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        try {
                            String s = response.body().string();
                            Toast.makeText(Register_Activity.this, s, Toast.LENGTH_LONG).show();
                        } catch (IOException e) {
                            e.printStackTrace();
                        }

                    }

                    @Override
                    public void onFailure(Call<ResponseBody> call, Throwable t) {
                        Toast.makeText(Register_Activity.this, t.getMessage(), Toast.LENGTH_LONG).show();
                    }
                });

            }

        });
    }

}