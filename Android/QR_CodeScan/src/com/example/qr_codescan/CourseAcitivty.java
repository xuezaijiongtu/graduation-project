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
import org.apache.http.client.methods.HttpGet;
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
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;
import android.widget.AdapterView.OnItemSelectedListener;

public class CourseAcitivty extends Activity {
	String url = "http://121.14.161.216:8018/getInfo.php";
	String subUrl = "http://121.14.161.216:8018/formSubmit.php";
	String u_id;
	Spinner courseView;
	Spinner classlistView;
	String curlesson;
	String curClass;
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.course);
		u_id = getIntent().getStringExtra("user_id");
		courseView = (Spinner)findViewById(R.id.course);
		classlistView = (Spinner)findViewById(R.id.classlist);
		getListProcess gl = new getListProcess();
		gl.execute("");
	}
	public static String getRequest(String url)  
	        throws Exception  
	    {  
			DefaultHttpClient httpClient= new DefaultHttpClient();  
	          
	        try{  
	            HttpGet get = new HttpGet(url);  
	            HttpResponse httpResponse = httpClient.execute(get);  
	            if (httpResponse.getStatusLine()  
	                .getStatusCode() == 200)  
	            {  
	                String result = EntityUtils  
	                    .toString(httpResponse.getEntity());  
	                return result;  
	            }  
	        }catch(Exception e){  
	            e.printStackTrace();  
	            return "-200";  
	        }finally{  
	            httpClient.getConnectionManager().shutdown();  
	        }  
	  
	        return null;  
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
	public class getListProcess extends AsyncTask<String,Integer,String>{

		@Override
		protected String doInBackground(String... params) {
			String retSrc = null;
			try {
				retSrc = getRequest(url);
			} catch (Exception e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			return retSrc;
		}
		protected void onPostExecute(String result) {
			if(result != null){
				try {
					Log.e("course", result);
					JSONObject data = new JSONObject(result);
					JSONArray lesson = data.getJSONArray("lesson");
					JSONArray classes = data.getJSONArray("class");
					String lessonArr [] = new String[lesson.length()];
					String classArr [] = new String[classes.length()];
					for(int i = 0 ; i < lesson.length(); i++){
						lessonArr[i] = lesson.get(i).toString();
					}
					for(int i = 0 ; i < classes.length(); i++){
						classArr[i] = classes.get(i).toString();
					}
					ArrayAdapter< String> courseAdapter =new ArrayAdapter< String>( CourseAcitivty.this, 
							android.R.layout.simple_spinner_item,
							lessonArr);
					courseView.setAdapter(courseAdapter);
					courseView.setOnItemSelectedListener(new itemSelect("lesson", lessonArr));
					ArrayAdapter< String> classlistAdapter =new ArrayAdapter< String>( CourseAcitivty.this, 
							android.R.layout.simple_spinner_item,
							classArr);
					classlistView.setAdapter(classlistAdapter);
					classlistView.setOnItemSelectedListener(new itemSelect("classlist", classArr));
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					Toast.makeText(CourseAcitivty.this, "失败！", 1000).show();
				}
			}else{
				Toast.makeText(CourseAcitivty.this, "失败！", 1000).show();
			}
		}
	}
	public class subProcess extends AsyncTask<String,Integer,String>{

		@Override
		protected String doInBackground(String... params) {
			String retSrc = null;
			try {
				Map<String ,String> map = new HashMap<String ,String>();
				map.put("lesson", curlesson);
				map.put("class", curClass);
				map.put("userid", u_id);
				retSrc = postRequest(subUrl, map);
			} catch (Exception e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			return retSrc;
		}
		protected void onPostExecute(String result) {
			if(result != null){
				JSONObject data;
				try {
					data = new JSONObject(result);
					String record_id = data.getString("record_id");
					Intent intent = new Intent();
					intent.putExtra("user_id", u_id);
					intent.putExtra("record_id", record_id);
					intent.setClass(CourseAcitivty.this, MainActivity.class);
					startActivity(intent);
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				
			}
		}
	}
	class itemSelect implements OnItemSelectedListener{
		String k;
		String a[];
		public itemSelect(String key, String arr[]){
			k = key;
			a = arr;
		}
		@Override
		public void onItemSelected(AdapterView<?> av, View v, int position,
				long arg3) {
			// TODO Auto-generated method stub
			if(k.equals("lesson")){
				curlesson = a[position];
			}else if(k.equals("classlist")){
				curClass = a[position];
				subProcess sp = new subProcess();
				sp.execute("");
			}
		}

		@Override
		public void onNothingSelected(AdapterView<?> av) {
			// TODO Auto-generated method stub
			
		}
		
	}
}
