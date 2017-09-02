package com.studentdata.tests;
import static org.junit.Assert.assertEquals;

import java.io.IOException;
import java.net.URISyntaxException;
import java.util.List;

import org.codehaus.jettison.json.JSONException;
import org.junit.Test;

import com.studentdata.common.ConfigurationManager;
import com.studentdata.common.DataMessage;
import com.studentdata.common.DataReader;
import com.studentdata.common.JsonHelper;
import com.sun.jersey.api.client.Client;
import com.sun.jersey.api.client.ClientResponse;
import com.sun.jersey.api.client.WebResource;

/**
 * 
 */

/**
 * @author TonyPhan
 *
 */
public class DataTest{
  
  @Test
  public void testSaveDataFromExcelFile() throws JSONException, URISyntaxException{
    ConfigurationManager.loadConfiguration();
    // Test with Moodle Forum data
    String filePath = "F:\\Adelaide\\University\\Semester1_2017\\MSE\\Project\\Data\\From Teacher\\ForumsData404.xls";
    int dataSourceType = 1;
    DataMessage dataMessage = new DataMessage();
    dataMessage.setFilePath(filePath);
    dataMessage.setDataSourceType(dataSourceType);
    String dataMessageJson = JsonHelper.parseDataMessageToJson(dataMessage);
    List<List<String>> dataHolder = null;
    switch(dataMessage.getDataSourceType()){
    case 1:
        dataHolder = DataReader.readDataFromExcel(dataMessage.getFilePath());           
        break;
    case 2:
        try {
            dataHolder = DataReader.readDataFromFile(dataMessage.getFilePath());
        } catch (IOException e1) {              
            e1.printStackTrace();
        }
        break;
    }
    
    // Add components firstly
    invokeRestfulApibyUrl(ConfigurationManager.ADD_COMPONENT_URL, "");

    // Add eventtypes secondly
    invokeRestfulApibyUrl(ConfigurationManager.ADD_EVENTTYPE_URL, "");
    
    // Add usertypes thirdly
    invokeRestfulApibyUrl(ConfigurationManager.ADD_USERTYPE_URL, "");   
    
    // Lastly add events
    String eventNum = invokeRestfulApibyUrl(ConfigurationManager.SAVE_DATA_URL, dataMessageJson);   
    
    assertEquals(dataHolder.size(), Integer.parseInt(eventNum));    
  }
  
  @Test
  public void testSaveDataFromTextFile() throws JSONException, URISyntaxException{
    ConfigurationManager.loadConfiguration();
    // Test with Moodle Forum data
    String filePath = "F:\\Adelaide\\University\\Semester1_2017\\MSE\\Project\\Data\\From Teacher\\history";
    int dataSourceType = 2;
    DataMessage dataMessage = new DataMessage();
    dataMessage.setFilePath(filePath);
    dataMessage.setDataSourceType(dataSourceType);
    String dataMessageJson = JsonHelper.parseDataMessageToJson(dataMessage);
    List<List<String>> dataHolder = null;
    switch(dataMessage.getDataSourceType()){
    case 1:
        dataHolder = DataReader.readDataFromExcel(dataMessage.getFilePath());           
        break;
    case 2:
        try {
            dataHolder = DataReader.readDataFromFile(dataMessage.getFilePath());
        } catch (IOException e1) {              
            e1.printStackTrace();
        }
        break;
    }
    
    // Add components firstly
    invokeRestfulApibyUrl(ConfigurationManager.ADD_COMPONENT_URL, "");

    // Add eventtypes secondly
    invokeRestfulApibyUrl(ConfigurationManager.ADD_EVENTTYPE_URL, "");
    
    // Add usertypes thirdly
    invokeRestfulApibyUrl(ConfigurationManager.ADD_USERTYPE_URL, "");   
    
    // Lastly add events
    String eventNum = invokeRestfulApibyUrl(ConfigurationManager.SAVE_DATA_URL, dataMessageJson);   
    
    assertEquals(dataHolder.size(), Integer.parseInt(eventNum));    
  }
  
  private String invokeRestfulApibyUrl(String url, String json){
    Client client = Client.create();
    WebResource webResource = client.resource(url);
    ClientResponse response = null;
    if (json == "")
      response = webResource.accept("application/json").type("application/json").post(ClientResponse.class);
    else
      response = webResource.accept("application/json").type("application/json").post(ClientResponse.class, json);
    if (response.getStatus() != 201) {
      throw new RuntimeException("Failed : HTTP error code : " + response.getStatus());
    }
    return response.getEntity(String.class);
  }
}
