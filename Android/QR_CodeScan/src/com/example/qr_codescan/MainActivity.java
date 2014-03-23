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

import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.os.Message;
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
						sendGet("http://121.14.161.145:8019/test.php", getStudentNumber);
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
	
	public static String sendGet(String url, String param) {
		String Msg = "";                          //返回信息
		Log.e("Error", "start thread");
		//先将参数放入List，再对参数进行URL编码
		List<BasicNameValuePair> params = new LinkedList<BasicNameValuePair>();
		params.add(new BasicNameValuePair("do", param));

		//对参数编码
		String allParam = URLEncodedUtils.format(params, "UTF-8");

		//baseUrl			
		String baseUrl = url;
		
		//将URL与参数拼接
		HttpGet getMethod = new HttpGet(baseUrl + "?" + allParam);
					
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

}
