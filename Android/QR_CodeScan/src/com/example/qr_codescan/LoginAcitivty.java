package com.example.qr_codescan;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Properties;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.protocol.HTTP;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import android.app.Activity;
import android.content.ContentValues;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class LoginAcitivty extends Activity {
	String url = "http://121.14.161.216:8018/login.php";
	EditText user;
	EditText pwd;
	Button login;
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.login);
		user = (EditText)findViewById(R.id.user);
		pwd = (EditText)findViewById(R.id.pwd);
		login = (Button)findViewById(R.id.login);
		login.setOnClickListener(new OnClickListener(){

			@Override
			public void onClick(View arg0) {
				// TODO Auto-generated method stub
				dataProcess dp = new dataProcess();
				dp.execute("");
			}
			
		});
	}
	public static String postRequest(String url  
	        , Map<String ,String> rawParams)  
	    {  
			DefaultHttpClient httpClient= new DefaultHttpClient();  
	        try{  
	            HttpPost post = new HttpPost(url);  
	            List<NameValuePair> params = new ArrayList<NameValuePair>();  
	            for(String key : rawParams.keySet())  
	            {  
	                params.add(new BasicNameValuePair(key , rawParams.get(key)));  
	            }  
	            post.setEntity(new UrlEncodedFormEntity(  
	                params,HTTP.UTF_8));  
	            HttpResponse httpResponse = httpClient.execute(post);  
	            if (httpResponse.getStatusLine()  
	                .getStatusCode() == 200)  
	            {  
	                String result = EntityUtils  
	                    .toString(httpResponse.getEntity());  
	                return result;  
	            }  
	        }catch(Exception e){  
	            e.printStackTrace();  
	        }finally{  
	            httpClient.getConnectionManager().shutdown();  
	        }  
	        return null;  
	    }  
	public class dataProcess extends AsyncTask<String,Integer,String>{

		@Override
		protected String doInBackground(String... params) {
			String retSrc = null;
			String mUser = user.getText().toString();
			String mPwd = pwd.getText().toString();
			Map<String ,String> map = new HashMap<String ,String>();
			map.put("username", mUser);
			map.put("password", mPwd);
			retSrc = postRequest(url, map);
			return retSrc;
		}
		protected void onPostExecute(String result) {
			if(result != null){
				try {
					JSONObject data = new JSONObject(result);
					if(data.getBoolean("status")){
						Intent intent = new Intent();
						intent.putExtra("user_id", data.getString("userid"));
						intent.setClass(LoginAcitivty.this, CourseAcitivty.class);
						startActivity(intent);
					}
					Toast.makeText(LoginAcitivty.this, data.getString("msg"), 1000).show();
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					Toast.makeText(LoginAcitivty.this, "登录失败！", 1000).show();
				}
			}else{
				Toast.makeText(LoginAcitivty.this, "登录失败！", 1000).show();
			}
		}
	}
}
