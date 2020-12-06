package com.example.covidApp.activities;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.covidApp.R;

public class LogActivity extends AppCompatActivity {
    private EditText lg_email, lg_pass;
    private Button lButton;
    private String userEmail = "@gmail.com";
    private String userPass = "1234";
    private int count = 5;
    boolean isValid = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_log);

        lg_email = findViewById(R.id.log_email);
        lg_pass = findViewById(R.id.log_pass);
        lButton = findViewById(R.id.log_button);

        lButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String inputEm = lg_email.getText().toString();
                String inputPass = lg_pass.getText().toString();

                if (inputEm.isEmpty() || inputPass.isEmpty()) {
                    Toast.makeText(LogActivity.this, "Please enter valid login info.", Toast.LENGTH_SHORT).show();
                } else {
                    isValid = verify(inputEm, inputPass);

                    if (!isValid) {
                        Toast.makeText(LogActivity.this, "Login info incorrect.", Toast.LENGTH_SHORT).show();

                    }
                    else {
                        Toast.makeText(LogActivity.this, "Successful Login", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(LogActivity.this, LoginSuccess.class);
                        startActivity(intent);

                    }
                }
            }

            });
        }
    private boolean verify(String email, String Pass){
        if(email.equals(userEmail) && Pass.equals(userPass)){
            return true;
        }
        return false;
    }
    }

