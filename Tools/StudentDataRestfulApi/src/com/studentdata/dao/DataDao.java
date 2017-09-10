package com.studentdata.dao;

import com.studentdata.common.HibernateHelper;
import com.studentdata.entities.Component;
import com.studentdata.entities.Event;
import com.studentdata.entities.EventType;
import com.studentdata.entities.GenericEntity;
import com.studentdata.entities.User;

import java.sql.Timestamp;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.concurrent.ThreadLocalRandom;

import javax.swing.text.DateFormatter;
import javax.transaction.HeuristicMixedException;
import javax.transaction.HeuristicRollbackException;
import javax.transaction.RollbackException;
import javax.transaction.SystemException;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;
import org.hibernate.service.UnknownServiceException;

/** 
 * @author TonyPhan. The data access layer of data.
 * @param <T>: the generic parameter.
 */
public class DataDao<T> extends GenericDao<T> {
  
  @Override
  public void create(T entity) {
    super.save(entity);
  }
  
  @Override
  public void update(T entity) {
    
  }
  
  @Override
  public void delete(T entity) {
    
  }
  
  /** Get the total number of objects by type: 1: Event, 2: Component, 3: EventType, 4: UserType.
   * type: the type of object. For example: Event, Component, UserType, EventType.
   * @return: the total number of rows of object.
   */
  public int getTotalCountByType(int type) {
    SessionFactory sessFactory = null;
    try {
      sessFactory = HibernateHelper.getSessionFactory();
      Session session = sessFactory.openSession();
      Query query = null;
      switch (type) {
        case 1:
          query = session.createQuery("select count(*) from Event");
          break;
        case 2:
          query = session.createQuery("select count(*) from Component");
          break;
        case 3:
          query = session.createQuery("select count(*) from EventType");
          break;
        case 4:
          query = session.createQuery("select count(*) from UserType");
          break;
        case 5:
          query = session.createQuery("select count(*) from User");
          break;
        default:
          query = session.createQuery("select count(*) from Event");
          break;
      }
      Long result = (Long)query.uniqueResult();
      return result.intValue();
    } catch (Exception ex) {
      ex.printStackTrace();
    } finally {
      sessFactory.close();
    }
    return 0;
  }
  
  /** 
   * Save users into database.
   * dataHolder: the list of data to be saved.
   * dataSourceType: the type of data source. 1: Moodle Forum, 2: Web Submission.
   */  
  public void saveUsers(List<List<String>> dataHolder, int dataSourceType) 
      throws SecurityException, RollbackException, HeuristicMixedException, 
      HeuristicRollbackException, SystemException {
    List<String> userIds = new ArrayList<String>();
    for (int i = 0; i < dataHolder.size(); i++) {
      if (i == 0) {
        continue;
      }
      List list = dataHolder.get(i);
      int j = 0;
      switch (dataSourceType) {
        case 1:
          j = 1;
          break;
        case 2:
          j = 0;
          break;
        default:
          j = 1;
          break;
      }
      if (!userIds.contains(list.get(j).toString())) {
        userIds.add(list.get(j).toString());
      }
    }
    
    SessionFactory sessFactory = null;
    try {
      sessFactory = HibernateHelper.getSessionFactory();
      Session session = sessFactory.openSession();
      org.hibernate.Transaction tr = session.beginTransaction();
      for (int i = 0; i < userIds.size(); i++) {
        User user = new User();
        user.setId(userIds.get(i));
        user.setUserTypeId(1);
        if (!doesUserExist(session, user.getId())) {
          session.save(user);
          System.out.println("Row " + i);
        } else {
          System.out.println("User " + user.getId() + " existed.");
        }          
      }
      tr.commit();
    } catch (Exception e) {
      e.printStackTrace();
    } finally {
      sessFactory.close();
    }
    System.out.println("Successfully inserted");                    
  }
  
  /** 
   * Save events into database.
   * dataHolder: the list of data to be saved.
   * dataSourceType: the type of data source. 1: Moodle Forum, 2: Web Submission.
   */  
  public void saveToDatabase(List<List<String>> dataHolder, int dataSourceType) 
      throws SecurityException, RollbackException, HeuristicMixedException,
      HeuristicRollbackException, SystemException {
    saveUsers(dataHolder, dataSourceType);
    SessionFactory sessFactory = null;
    try {
      sessFactory = HibernateHelper.getSessionFactory();
      Session session = sessFactory.openSession();
      org.hibernate.Transaction tr = session.beginTransaction();
      switch (dataSourceType) {
        case 1:
          for (int i = 0; i < dataHolder.size(); i++) {
            if (i == 0) {
              continue;
            }
            List<String> list = dataHolder.get(i);
            Event event = getEvent(i, list, dataSourceType);
            if (!doesEventExist(session, event.getId())) {
              session.save(event);
              System.out.println("Row " + i);
            } else {
              System.out.println("Event " + event.getId() + " existed.");
            }
          }
          break;
        case 2:
          for (int i = 0; i < dataHolder.size(); i++) {
            List<String> list = dataHolder.get(i);
            Event event = getEvent(i, list, dataSourceType);
            if (!doesEventExist(session, event.getId())) {
              session.save(event);
              System.out.println("Row " + i);
            } else {
              System.out.println("Row " + i + " existed.");
            }
          }
          break;
        default:
          break;
      }
      tr.commit();
    } catch (Exception ex) {
      ex.printStackTrace();
    } finally {
      sessFactory.close();
    }
    System.out.println("Successfully inserted");
  }
  
  private boolean doesEventExist(Session session, String id) {
    try {
      Query query = session.createQuery("select count(*) from Event where Id = :Id");
      query.setParameter("Id", id);
      Long result = (Long)query.uniqueResult();
      return (result.intValue() > 0) ? true : false;
    } catch (Exception ex) {
      ex.printStackTrace();
    }
    return false;
  }
  
  private boolean doesUserExist(Session session, String id) {
    try {
      Query query = session.createQuery("select count(*) from User where Id = :Id");
      query.setParameter("Id", id);
      Long result = (Long)query.uniqueResult();
      return (result.intValue() > 0) ? true : false;
    } catch (Exception ex) {
      ex.printStackTrace();
    }
    return false;
  }
  
  private Event getEvent(int id, List list, int dataSourceType) {
    Event event = new Event();
    switch (dataSourceType) {
      case 1://Moodles
        event.setId(String.valueOf(id));
        event.setName(list.get(4).toString());
        event.setDescription(list.get(5).toString());
        event.setComponentId(getComponentId(list.get(3).toString()));
        event.setEventTypeId(getEventTypeId(list.get(2).toString()));
        event.setUserId(list.get(1).toString());
        float grade;
        float maxGrade;
        if (id % 2 == 0) {
          grade = 60;
          maxGrade = 80;
        } else {
          grade = 70;
          maxGrade = 100;
        }
        event.setGrade(grade);
        DateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd");
        DateFormatter formatter1 = new DateFormatter();
        formatter1.setFormat(dateFormat);
        event.setRepositoryVersion(String.valueOf(id));
        String[] dateTimes = list.get(0).toString().split(", ");
        String strDate = (dateTimes[0].length() < 8) ? ("0" + dateTimes[0]) : dateTimes[0];
        String strTime = dateTimes[1] + ".12.083 +04:30";
        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("dd/MM/yy HH:mm.ss.SSS XXX");
        LocalDateTime time = LocalDateTime.parse(strDate + " " + strTime, formatter);
        event.setEventTime(Timestamp.valueOf(time));
        String[] contexts = list.get(2).toString().split(":");
        event.setPrefix(contexts[0]);
        String context = "";
        for (int j = 1; j < contexts.length; j++) {
          context += contexts[j];
        }          
        event.setContext(context);
        event.setDatasourcetype(1);
        
        contexts = event.getContext().split(",");
        String semester1 = "Semester 1";
        String semester2 = "Semester 2";
        if ("Course".equals(event.getPrefix())) {
          event.setCourseName(contexts[0].trim());
        } else {
          event.setCourseName("MSE");//by default
        }
        
        long timestamp = event.getEventTime().getTime();
        Calendar cal = Calendar.getInstance();
        cal.setTimeInMillis(timestamp);
        int year = cal.get(Calendar.YEAR);
        int month = cal.get(Calendar.MONTH) + 1;
        if (month > 7) {
          event.setSemester(semester2);
          event.setContext(contexts[0] + ", " + semester2 + ", " + year);
          event.setSchoolYear(year);
          event.setAssignmentName("Assignment 2");
        } else {
          event.setSemester(semester1);
          event.setContext(contexts[0] + ", " + semester1 + ", " + year);
          event.setSchoolYear(year);
          event.setAssignmentName("Assignment 1");
        }
        Timestamp dueDate = new Timestamp(timestamp);
        dueDate.setMonth(month);
        break;
      case 2:
        semester1 = "Semester 1";
        semester2 = "Semester 2";
        event.setId(String.valueOf(id + 27966));
        String userId = list.get(0).toString();
        event.setUserId(userId);
        String repositoryId = list.get(1).toString();
        event.setRepositoryVersion(repositoryId);
        event.setComponentId(7);
        if (id % 2 == 0) {
          grade = 60;
          maxGrade = 100;
        } else {
          grade = 70;
          maxGrade = 100;
        }
        event.setGrade(grade);
        event.setMaxGrade(maxGrade);
        String dateTime = list.get(2).toString();
        dateTimes = dateTime.split("-");
        strDate = dateTimes[0].substring(0, 2) + "/" + dateTimes[0].substring(2, 4) 
            + "/" + dateTimes[0].substring(4, 6);
        int hour = ThreadLocalRandom.current().nextInt(1, 24);
        String strHour = "" + hour;
        if (hour < 10) {
          strHour = "0" + hour;
          strTime = strHour  + ":" + dateTimes[1].substring(2, 4) + "."
              + dateTimes[1].substring(4, 6)  + ".083 +04:30";
        } else {
          strTime = strHour  + ":" + dateTimes[1].substring(2, 4) + "." 
              + dateTimes[1].substring(4, 6)  + ".083 +04:30";
        }
        formatter = DateTimeFormatter.ofPattern("yy/MM/dd HH:mm.ss.SSS XXX");
        time = LocalDateTime.parse(strDate + " " + strTime, formatter);
        Timestamp startTimestamp = null; 
        startTimestamp = Timestamp.valueOf(time);
        String eventStatus = list.get(3).toString();
        String[] parts = eventStatus.split("-");
        event.setName(parts[0]);
        if (parts.length > 1) {
          event.setGrade(Float.parseFloat(parts[1]));
          event.setEventTypeId(5);
        } else {
          event.setEventTypeId(6);
        }
        event.setCourseName("MSE");//by default
        event.setDatasourcetype(2);
        timestamp = startTimestamp.getTime();
        cal = Calendar.getInstance();
        cal.setTimeInMillis(timestamp);
        year = cal.get(Calendar.YEAR);
        month = cal.get(Calendar.MONTH) + 1;
        if (month > 7) {
          event.setSemester(semester2);
          event.setSchoolYear(year);
          event.setAssignmentName("Assignment 2");
        } else {
          event.setSemester(semester1);
          event.setSchoolYear(year);
          event.setAssignmentName("Assignment 1");
        }
        event.setStartDate(startTimestamp);
        dueDate = new Timestamp(timestamp);
        dueDate.setMonth(month);
        event.setDueDate(dueDate);
        int diff = (int)(dueDate.getTime() - startTimestamp.getTime());
        float dayCount = (float) diff / (24 * 60 * 60 * 1000);
        float v = ThreadLocalRandom.current().nextFloat() * (dayCount - 1) + 1;
        Timestamp eventDate = new Timestamp(timestamp);
        eventDate.setDate(cal.get(Calendar.DATE) + (int)v);
        eventDate.setMonth(month);
        int hours = ThreadLocalRandom.current().nextInt(1, event.getDueDate().getHours() + 1);
        eventDate.setHours(hours);
        event.setEventTime(eventDate);
        break;
      default:
        break;
    }
    return event;
  }
  
  private static int getComponentId(String compName) {
    int id = 0;
    switch (compName) {
      case "System":
        id = 1;
        break;
      case "File":
        id = 2;
        break;
      case "Forum":
        id = 3;
        break;
      case "Choice":
        id = 4;
        break;
      case "Quiz":
        id = 5;
        break;
      case "mod_course":
        id = 6;
        break;
      case "mod_discussion":
        id = 7;
        break;
      default:
        id = 1;
        break;
    }
    return id;
  }
  
  private static int getEventTypeId(String context) {
    int eventTypeId = 1; // by default
    if (context.startsWith("Course:")) {
      eventTypeId = 1;
    }
    
    if (context.startsWith("File:") || context.startsWith("Page:") 
        || context.startsWith("Folder:") || context.startsWith("URL:")) {
      eventTypeId = 2; // Assignment
    }
    
    if (context.startsWith("Quiz:")) {
      eventTypeId = 3;
    }
    
    if (context.startsWith("Forum:")) {
      eventTypeId = 4;
    }
    return eventTypeId;
  }
  
  /** 
   * Save entities into database.
   * entities: the list of entities to be saved.
   */  
  public void saveEntities(List<GenericEntity> entities) {
    Session session = null;
    SessionFactory sessFactory = null;
    try {
      for (GenericEntity entity : entities) {
        sessFactory = HibernateHelper.getSessionFactory();
        session = sessFactory.openSession();
        org.hibernate.Transaction tr = session.beginTransaction();
        session.save(entity);
        tr.commit();
      }
    } catch (Exception ex) {
      ex.printStackTrace();
    } finally {
      sessFactory.close();
    }
  }
}
