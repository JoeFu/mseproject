package com.studentdata.common;

import com.google.gson.Gson;

public class JsonHelper {
	public static DataMessage parseJsonToDataMessage(String jsonMessage){
    	Gson gson = new Gson();
    	DataMessage dataMessage = gson.fromJson(jsonMessage, DataMessage.class);			        	
		return dataMessage;
	}
	public static String parseDataMessageToJson(DataMessage dataMessage){
		Gson gson = new Gson();
		String json = gson.toJson(dataMessage);
		return json;
	}
}
