package com.studentdata.common;

import com.google.gson.Gson;

/**
 * @author TonyPhan.
 * 
 */
public class JsonHelper {
  
  /**
   * Parse Json to DataMessage object.
   */  
  public static DataMessage parseJsonToDataMessage(String jsonMessage) {
    Gson gson = new Gson();
    DataMessage dataMessage = gson.fromJson(jsonMessage, DataMessage.class);
    return dataMessage;
  }
  
  /**
   * Parse DataMessage object to Json.
   */  
  public static String parseDataMessageToJson(DataMessage dataMessage) {
    Gson gson = new Gson();
    String json = gson.toJson(dataMessage);
    return json;
  }
}
