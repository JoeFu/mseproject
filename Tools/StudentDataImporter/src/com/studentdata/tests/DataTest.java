package com.studentdata.tests;

import com.studentdata.common.ConfigurationManager;
import com.studentdata.common.DataMessage;
import com.studentdata.common.DataReader;
import com.studentdata.common.JsonHelper;
import com.sun.jersey.api.client.Client;
import com.sun.jersey.api.client.ClientResponse;
import com.sun.jersey.api.client.WebResource;

import static org.junit.Assert.assertEquals;
import java.io.IOException;
import java.net.URISyntaxException;
import java.util.List;

import org.codehaus.jettison.json.JSONException;
import org.junit.Test;

/**
 * @author TonyPhan. This class is used to test methods related to importing data.
*/
public class DataTest {
  
  @Test
  public void testSaveDataFromExcelFile() throws JSONException, URISyntaxException, 
        IOException {
    int dataSourceType = 1;
    List<List<String>> dataHolder = getDataByDatasource(dataSourceType);    
    String eventNum = getEventNumberByDatasourceType(dataSourceType);
    assertEquals(dataHolder.size(), Integer.parseInt(eventNum));    
  }
  
  @Test
  public void testSaveDataFromTextFile() throws JSONException, URISyntaxException, IOException {
    int dataSourceType = 2;
    List<List<String>> dataHolder = getDataByDatasource(dataSourceType);    
    String eventNum = getEventNumberByDatasourceType(dataSourceType);
    assertEquals(dataHolder.size(), Integer.parseInt(eventNum));    
  }
  
  @Test
  public void testGetEventTotal() throws JSONException, URISyntaxException, IOException {
    // Load configuration first
    ConfigurationManager.loadConfiguration();
    
    // Retrieve the total number of events from database.
    int total = 0;
    int dataSourceType = 1;
    List<List<String>> dataHolder = null; 
    dataHolder = getDataByDatasource(dataSourceType);
    if (dataHolder != null) {
      total += dataHolder.size();
    }
    dataSourceType = 2;
    dataHolder = getDataByDatasource(dataSourceType);
    if (dataHolder != null) {
      total += dataHolder.size();
    }
    String eventTotal = invokeRestfulApibyUrl(ConfigurationManager.GET_EVENT_URL, "");
    assertEquals(total - 1, Integer.parseInt(eventTotal));
  }
  
  private String getFilePathByDatasourceType(int dataSourceType) {
    String filePath = "";
    switch (dataSourceType) {
      case 1:
        filePath = "F:\\Adelaide\\University\\Semester1_2017"
            + "\\MSE\\Project\\Data\\From Teacher\\ForumsData404.xls";        
        break;        
      case 2:
        filePath = "F:\\Adelaide\\University\\Semester1_2017"
            + "\\MSE\\Project\\Data\\From Teacher\\history";        
        break;
      default:
        break;
    }
    return filePath;
  }
  
  private String buildDataMessage(int dataSourceType) {
    DataMessage dataMessage = new DataMessage();
    String filePath = "";
    filePath = getFilePathByDatasourceType(dataSourceType);
    dataMessage.setFilePath(filePath);
    dataMessage.setDataSourceType(dataSourceType);   
    String dataMessageJson = "";
    dataMessageJson = JsonHelper.parseDataMessageToJson(dataMessage);
    return dataMessageJson;
  }
  
  private List<List<String>> getDataByDatasource(int dataSourceType) throws IOException {
    List<List<String>> dataHolder = null;
    String filePath = "";
    filePath = getFilePathByDatasourceType(dataSourceType);
    switch (dataSourceType) {
      case 1:
        dataHolder = DataReader.readDataFromExcel(filePath);        
        break;
      case 2:
        dataHolder = DataReader.readDataFromFile(filePath);        
        break;
      default:
        dataHolder = DataReader.readDataFromExcel(filePath);
        break;
    }
    return dataHolder;
  }
  
  private String invokeRestfulApibyUrl(String url, String json) {
    Client client = Client.create();
    WebResource webResource = client.resource(url);
    ClientResponse response = null;
    if (json == "") {
      response = webResource.accept("application/json")
          .type("application/json").post(ClientResponse.class);
    } else {
      response = webResource.accept("application/json")
          .type("application/json").post(ClientResponse.class, json);
    }      
    if (response.getStatus() != 201) {
      throw new RuntimeException("Failed : HTTP error code : " + response.getStatus());
    }
    return response.getEntity(String.class);
  }
  
  private String getEventNumberByDatasourceType(int dataSourceType) throws IOException {
    // Test with Moodle Forum data
    
    ConfigurationManager.loadConfiguration();
    // Add components firstly
    invokeRestfulApibyUrl(ConfigurationManager.ADD_COMPONENT_URL, "");

    // Add eventtypes secondly
    invokeRestfulApibyUrl(ConfigurationManager.ADD_EVENTTYPE_URL, "");
    
    // Add usertypes thirdly
    invokeRestfulApibyUrl(ConfigurationManager.ADD_USERTYPE_URL, "");   
    
    // Lastly add events
    String dataMessageJson = "";
    dataMessageJson = buildDataMessage(dataSourceType);    
    String eventNum = invokeRestfulApibyUrl(ConfigurationManager.SAVE_DATA_URL, dataMessageJson);   
    return eventNum;
  }
}
