package com.example.covidApp;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatCallback;
import androidx.navigation.fragment.NavHostFragment;

import android.os.Bundle;
import android.text.TextUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;

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
                String email = reg_email.getText().toString().trim();
                String password = reg_pass.getText().toString().trim();

                if(TextUtils.isEmpty(email)){
                    reg_email.setError("Email Required");
                }
                if(TextUtils.isEmpty(password)){
                    reg_pass.setError("Password Required");
                }
                if(password.length() < 4){
                    reg_pass.setError("Password must be greater than 4 characters");
                    return;
                }
            }
        });
    }

}