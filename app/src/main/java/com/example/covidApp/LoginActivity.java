package com.example.covidApp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class LoginActivity extends AppCompatActivity {
    private EditText usEmail;
    private EditText usPassword;
    private TextView Result;
    private Button Log;
    private int counter = 5;
    private String userEmail = "@gmail.com";
    private String userPass = "1234";
    private int count = 5;
    boolean isValid = false;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login_main);

        usEmail = findViewById(R.id.Email);
        usPassword = findViewById(R.id.Password);
        Result = findViewById(R.id.ett);
        Log = findViewById((R.id.logB));


        Log.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String inputEm = usEmail.getText().toString();
                String inputPass = usPassword.getText().toString();

                if(inputEm.isEmpty() || inputPass.isEmpty()){
                    Toast.makeText(LoginActivity.this, "Please enter valid login info.", Toast.LENGTH_SHORT).show();
                }
                else{
                    isValid = verify(inputEm, inputPass);

                    if(!isValid){
                        counter--;
                        Toast.makeText(LoginActivity.this, "Login info incorrect.", Toast.LENGTH_SHORT).show();
                        Result.setText("Login Attempts Remaining: " + counter);

                        if(counter == 0){
                            Log.setEnabled(false);
                        }
                    }
                    else {
                        Toast.makeText(LoginActivity.this, "Successful Login", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(LoginActivity.this, LogActivity.class);
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