package com.studentdata.services;

import com.studentdata.common.DaoFactory;
import com.studentdata.common.DataMessage;
import com.studentdata.common.DataReader;
import com.studentdata.common.JsonHelper;
import com.studentdata.common.ObjectMapper;
import com.studentdata.dao.DataDao;
import com.studentdata.entities.GenericEntity;

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

/**
 * @author TonyPhan. The DataService class which is used to save data into or retrieve data from database. 
 */
@Path("/DataService")
public class DataService implements IDataService {
  @Path("/getEvents")
  @GET
  @Produces(MediaType.APPLICATION_JSON)
  public Response getEventTotal() {
    DataDao dataDao = DaoFactory.getInstance().createDataDao();
    int eventTotal = dataDao.getTotalCountByType(1);
    return Response.status(201).entity(String.valueOf(eventTotal)).build();
  }
  
  @Path("/addData")
  @POST
  @Consumes(MediaType.APPLICATION_JSON)
  public Response addData(String dataMessageJson) {
    DataMessage dataMessage = JsonHelper.parseJsonToDataMessage(dataMessageJson);
    String result = "";
    if (dataMessage == null) {
      result = "Invalid DataMessage!";
      return Response.status(201).entity(result).build();
    }
    List<List<String>> dataHolder = null;
    switch(dataMessage.getDataSourceType()) {
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
      default:
        dataHolder = DataReader.readDataFromExcel(dataMessage.getFilePath());
        break;
    }
    if (dataHolder == null) {
      result = "Can't read data from file!";
      return Response.status(201).entity(result).build();
    }
    
    DataDao dataDao = DaoFactory.getInstance().createDataDao();
    try {
      dataDao.saveToDatabase(dataHolder, dataMessage.getDataSourceType());
    } catch (SecurityException | RollbackException | HeuristicMixedException 
        | HeuristicRollbackException | SystemException e) {
      e.printStackTrace();
    }
    return Response.status(201).entity(String.valueOf(dataHolder.size())).build();
  }
  
  @Path("/addComponents")
  @POST
  @Produces(MediaType.APPLICATION_JSON)
  @Consumes(MediaType.APPLICATION_JSON)
  public Response addComponents() {
    DataDao<Component> dataDao = DaoFactory.getInstance().createDataDao();
    int total = dataDao.getTotalCountByType(2);
    // If Component table had data, it is unnecessary to add more.
    if (total > 0) {
      return Response.status(201).entity(String.valueOf(total)).build();
    }
    
    try {
      int compNum = 0;
      List<GenericEntity> components = new ArrayList<com.studentdata.entities.GenericEntity>();
      for (int i = 1; i < 8; i++) {
        Component component = buildComponent(i);
        components.add(ObjectMapper.toEntityComponent(component));
        compNum = i;
      }
      dataDao.saveEntities(components);
      return Response.status(201).entity(String.valueOf(compNum)).build();
    } catch (SecurityException e) {
      e.printStackTrace();
    }
    return null;
  }
  
  @Path("/addEventTypes")
  @POST
  @Consumes(MediaType.APPLICATION_JSON)
  public Response addEventTypes() {
    DataDao<EventType> dataDao = DaoFactory.getInstance().createDataDao();
    int total = dataDao.getTotalCountByType(3);
    // If EventType table had data, it is unnecessary to add more.
    if (total > 0) {
      return Response.status(201).entity(String.valueOf(total)).build();
    }
    
    try {
      int compNum = 0;
      List<com.studentdata.entities.GenericEntity> eventTypes 
          = new ArrayList<com.studentdata.entities.GenericEntity>();
      for (int i = 1; i < 7; i++) {
        EventType eventType = buildEventType(i);
        eventTypes.add(ObjectMapper.toEntityEventType(eventType));
        compNum = i;
      }
      dataDao.saveEntities(eventTypes);
      return Response.status(201).entity(String.valueOf(compNum)).build();
    } catch (SecurityException e) {
      e.printStackTrace();
    }
    return null;
  }
  
  @Path("/addUserTypes")
  @POST
  @Consumes(MediaType.APPLICATION_JSON)
  public Response addUserTypes() {
    DataDao<Component> dataDao = DaoFactory.getInstance().createDataDao();
    int total = dataDao.getTotalCountByType(4);
    // If Component table had data, it is unnecessary to add more.
    if (total > 0) {
      return Response.status(201).entity(String.valueOf(total)).build();
    }
    
    try {
      int compNum = 0;
      List<com.studentdata.entities.GenericEntity> userTypes 
          = new ArrayList<com.studentdata.entities.GenericEntity>();
      for (int i = 1; i < 3; i++) {
        UserType userType = buildUserType(i);
        userTypes.add(ObjectMapper.toEntityUserType(userType));
        compNum = i;
      }
      dataDao.saveEntities(userTypes);
      return Response.status(201).entity(String.valueOf(compNum)).build();
    } catch (SecurityException e) {
      e.printStackTrace();
    }
    return null;
  }
  
  private Component buildComponent(int id) {
    Component component = new Component();
    component.setId(id);
    switch(id) {
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
  
  private EventType buildEventType(int id) {
    EventType eventType = new EventType();
    eventType.setId(id);
    switch (id) {
      case 1:
        eventType.setName("Course");
        eventType.setDescription("Events related to courses");
        break;
      case 2:
        eventType.setName("Assignment");
        eventType.setDescription("Events related to assignments");
        break;
      case 3:
        eventType.setName("Quiz");
        eventType.setDescription("Events related to quiz");
        break;        
      case 4:
        eventType.setName("Forum");
        eventType.setDescription("Events related to forum");
        break;
      case 5:
        eventType.setName("Marking");
        eventType.setDescription("Events related to marking");
        break;
      case 6:
        eventType.setName("Submission");
        eventType.setDescription("Events related to submission");
        break;
      default:
        eventType.setName("Course");
        eventType.setDescription("Events related to courses");        
        break;
    }
    return eventType;
  }
  
  private UserType buildUserType(int id) {
    UserType userType = new UserType();
    userType.setId(id);
    switch (id) {
      case 1:
        userType.setType("Student");
        userType.setDescription("Student");
        break;
      case 2:
        userType.setType("Teacher");
        userType.setDescription("Teacher");
        break;
      default:
        userType.setType("Student");
        userType.setDescription("Student");        
        break;
    }
    return userType;
  }
}
