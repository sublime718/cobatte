package com.cobatte.taxi;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class LoginActivity extends Activity{
	
	EditText id, passwd;				// ���̵�� ��й�ȣ �Է� â
	Button confirm, cancel, regist;				// Ȯ��, ���, ���� ��ư 
	messageStr ms;
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login);
        setTitle("�α���");
        
        id = (EditText)findViewById(R.id.id);
        passwd = (EditText)findViewById(R.id.passwd);
        
        confirm = (Button)findViewById(R.id.confirm);
        cancel = (Button)findViewById(R.id.cancel);
        regist = (Button)findViewById(R.id.regist);
        
        confirm.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				ms = new messageStr();
				SocketThread st = new SocketThread(ms);
				
				//if()
				
				Intent intent = new Intent(LoginActivity.this, MainMenuActivity.class);
				startActivity(intent);
				overridePendingTransition(R.anim.left_in, R.anim.left_out);
			}
		});
        
        cancel.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				id.setText("");
				passwd.setText("");
			}
		});
        
        regist.setOnClickListener(new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				
				Intent intent = new Intent(LoginActivity.this, RegisterActivity.class );
				startActivity(intent);
				overridePendingTransition(R.anim.left_in, R.anim.left_out);			
			}
		});
        
    }

	public void onBackPressed(){
		AlertDialog.Builder ab = null;
		ab = new AlertDialog.Builder( LoginActivity.this );
		ab.setMessage("���ø����̼��� �����Ͻðڽ��ϱ�?");
		ab.setPositiveButton(android.R.string.ok, new DialogInterface.OnClickListener() {
			
			@Override
			public void onClick(DialogInterface dialog, int which) {
				// TODO Auto-generated method stub
				finish();
			}
		});
		ab.setNegativeButton(android.R.string.cancel, null);
		ab.setTitle("�˸�");
		ab.show();
	}

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }
}