package com.example.qr_codescan;


import java.io.IOException;
import java.io.InputStream;
import java.util.LinkedList;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

public class MainActivity extends Activity {
	private final static int SCANNIN_GREQUEST_CODE = 1;
	public Handler mChildHandler;
	/**
	 * 显示扫描结果
	 */
	private TextView mTextView ;
	/**
	 * 显示扫描拍的图片
	 */
	private ImageView mImageView;
	

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		
		mTextView = (TextView) findViewById(R.id.result); 
		mImageView = (ImageView) findViewById(R.id.qrcode_bitmap);
		
		//点击按钮跳转到二维码扫描界面，这里用的是startActivityForResult跳转
		//扫描完了之后调到该界面
		Button mButton = (Button) findViewById(R.id.button1);
		mButton.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				Intent intent = new Intent();
				intent.setClass(MainActivity.this, MipcaActivityCapture.class);
				intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				startActivityForResult(intent, SCANNIN_GREQUEST_CODE);
			}
		});
		Button resultButton = (Button) findViewById(R.id.submitResult);
		resultButton.setOnClickListener(new View.OnClickListener() {
			    public void onClick(View v) {
			    	try{
			    		getRequest("http://jycheck.jyumcu.com/index.php/CheckApi/OnSetCheckRecord?record_id="+getIntent().getStringExtra("record_id"));
			    		Log.e("error", "http://jycheck.jyumcu.com/index.php/CheckApi/OnSetCheckRecord?record_id="+getIntent().getStringExtra("record_id"));
			    		//new AlertDialog.Builder(null).setTitle("标题").setMessage("简单消息框").setPositiveButton("确定", null).show();  
			    	} catch (Exception e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
				}
		});
	}
	
	/**
	 * 登陆操作
	 */
	protected void Login(Bundle savedInstanceState){
		
	}
	
	
	@Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        switch (requestCode) {
		case SCANNIN_GREQUEST_CODE:
			if(resultCode == RESULT_OK){
				Bundle bundle = data.getExtras();
				final String getStudentNumber = bundle.getString("result");
				Thread thread = new Thread(){
					public void run(){
						sendGet("http://jycheck.jyumcu.com/index.php/CheckApi/CheckAction", getStudentNumber, getIntent().getStringExtra("record_id"));
					}
				};
				try{
					thread.start();
					thread.join();
				}catch(Exception e){
					e.printStackTrace();
				}
				//显示扫描到的内容
				mTextView.setText("学生学号:"+getStudentNumber);
				//显示
				mImageView.setImageBitmap((Bitmap) data.getParcelableExtra("bitmap"));
			}
			break;
		}
    }
	
	public static String sendGet(String url, String studentNum, String record_id) {
		String Msg = "";                          //返回信息
		//baseUrl			
		String baseUrl = url;
		
		//将URL与参数拼接
		HttpGet getMethod = new HttpGet(baseUrl + "?student_id=10" + studentNum + "&record_id=" + record_id);			
		HttpClient httpClient = new DefaultHttpClient();

		try {
		    HttpResponse response = httpClient.execute(getMethod); //发起GET请求
		    int code = response.getStatusLine().getStatusCode();
		    if(code == 200){
		    	InputStream in = response.getEntity().getContent();
		    	Msg = in.toString();
		    }else{
		    	Msg = "error";
		    }
		} catch (ClientProtocolException e) {
			Log.e("Err", e.toString());
		} catch (IOException e) {
			Log.e("Error", e.toString());
		}
		return Msg;
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

}
