/**
 * 
 */
package com.studentdata.services;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import javax.transaction.HeuristicMixedException;
import javax.transaction.HeuristicRollbackException;
import javax.transaction.RollbackException;
import javax.transaction.SystemException;
import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

import com.studentdata.common.DaoFactory;
import com.studentdata.common.DataMessage;
import com.studentdata.common.DataReader;
import com.studentdata.common.JsonHelper;
import com.studentdata.common.ObjectMapper;
import com.studentdata.dao.DataDao;

/**
 * @author TonyPhan
 *
 */
@Path("/DataService")
public class DataService implements IDataService{
	
  @Path("/getEvents")
  @GET
  @Produces(MediaType.APPLICATION_JSON)
  public Response getEventTotal(){
    DataDao dataDao = DaoFactory.getInstance().createReportDao();
    int eventTotal = dataDao.getEventTotal();    
    return Response.status(201).entity(eventTotal).build();
  }
	
	@Path("/addData")
	@POST	
	@Consumes(MediaType.APPLICATION_JSON)
	public Response addData(String dataMessageJson){
		DataMessage dataMessage = JsonHelper.parseJsonToDataMessage(dataMessageJson);
		String result = "";
		if (dataMessage == null){
			result = "Invalid DataMessage!";
			return Response.status(201).entity(result).build();			
		}
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
				
		if (dataHolder == null)
		{
			result = "Can't read data from file!";
			return Response.status(201).entity(result).build();			
		}

		DataDao dataDao = DaoFactory.getInstance().createReportDao();
		try {
			dataDao.saveToDatabase(dataHolder, dataMessage.getDataSourceType());
		} catch (SecurityException | RollbackException | HeuristicMixedException | HeuristicRollbackException
				| SystemException e) {			
			e.printStackTrace();
		}		
		return Response.status(201).entity(dataHolder.size()).build();				
	}
	
	@Path("/addComponents")
    @POST   
    @Consumes(MediaType.APPLICATION_JSON)	
	public Response addComponents(){
      DataDao<Component> dataDao = DaoFactory.getInstance().createReportDao();
      int total = dataDao.getComponentTotal();
      if (total > 0)
        return Response.status(201).entity(total).build();
      
      try {
        int compNum = 0;
        List<com.studentdata.entities.Component> components = new ArrayList<com.studentdata.entities.Component>();
        for(int i = 1; i < 8; i++){
          Component component = buildComponent(i);
          components.add(ObjectMapper.toEntityComponent(component));
          compNum = i;
        }          
        dataDao.saveComponents(components);
        return Response.status(201).entity(compNum).build();
      } catch (SecurityException e) {          
          e.printStackTrace();
      }     
      return null;
	}
	
	private Component buildComponent(int id){	  
      Component component = new Component();
      component.setId(id);
      switch(id){
        case 1:
          component.setName("System");
          break;
        case 2:
          component.setName("File");
          break;
        case 3:
          component.setName("Forum");
          break;
        case 4:
          component.setName("Choice");
          break;
        case 5:
          component.setName("Quiz");
          break;
        case 6:
          component.setName("mod_course");
          break;
        case 7:
          component.setName("mod_discussion");
          break;          
      }              
	  return component;
	}
}
