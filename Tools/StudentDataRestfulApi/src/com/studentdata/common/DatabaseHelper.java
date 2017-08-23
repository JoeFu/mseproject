package com.studentdata.common;
import java.net.UnknownServiceException;
import java.sql.Timestamp;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.concurrent.ThreadLocalRandom;
import java.util.concurrent.TimeUnit;

import javax.swing.text.DateFormatter;
import javax.transaction.HeuristicMixedException;
import javax.transaction.HeuristicRollbackException;
import javax.transaction.RollbackException;
import javax.transaction.SystemException;
import javax.transaction.Transaction;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;

import com.studentdata.entities.Event;
import com.studentdata.entities.User;


public class DatabaseHelper {
//	private static int getComponentId(String compName){
//		int id = 0;
//		switch(compName){
//			case "System":
//				id = 1;
//			case "File":
//				id = 2;
//			case "Forum":
//				id = 3;
//			case "Choice":
//				id = 4;
//			case "Quiz":
//				id = 5;
//			case "mod_course":
//				id = 6;
//			case "mod_discussion":
//				id = 7;
//		}
//		return id;
//	}
//	
//	private static int getEventTypeId(String context){
//		int eventTypeId = 1; // by default
//		if (context.startsWith("Course:")){
//			eventTypeId = 1;
//		}
//		if (context.startsWith("File:") || context.startsWith("Page:") || context.startsWith("Folder:") || context.startsWith("URL:")){
//			eventTypeId = 2; // Assignment
//		}
//		if (context.startsWith("Quiz:")){
//			eventTypeId = 3;
//		}
//		if (context.startsWith("Forum:")){
//			eventTypeId = 4;
//		}
//		return eventTypeId;		
//	}
	
	
	public static void updateEvent(){
		SessionFactory sessFactory = null;
		try{
    		sessFactory = HibernateHelper.getSessionFactory();
    		Session session = sessFactory.openSession();
        	Query query = session.createQuery("from Event where DataSourceType = :dataSourceType ");
        	query.setParameter("dataSourceType", 2);
    		//Query query = session.createQuery("from Event");
        	List list = query.list();
        	for(int i = 0; i < list.size(); i++){
        		Event event = (Event)list.get(i);
        		long eventTimeTimestamp = event.getEventTime().getTime();
        		Calendar cal = Calendar.getInstance();
        		cal.setTimeInMillis(eventTimeTimestamp);
        		int eventTimeDay = cal.get(Calendar.DATE);
        		int eventTimeYear = cal.get(Calendar.YEAR);
        		int eventTimeMonth = cal.get(Calendar.MONTH);
        		
        		long startDateTimestamp = event.getStartDate().getTime();
        		cal = Calendar.getInstance();
        		cal.setTimeInMillis(startDateTimestamp);
        		int startDateDay = cal.get(Calendar.DATE);
        		int startDateYear = cal.get(Calendar.YEAR);
        		int startDateMonth = cal.get(Calendar.MONTH);
        		
        		if (eventTimeDay == startDateDay && eventTimeYear == startDateYear && eventTimeMonth == startDateMonth){
                	org.hibernate.Transaction tr = session.beginTransaction();
            		query = session.createQuery("update Event set EventTime =:eventTime where Id = :id and DataSourceType = :dataSourceType ");
            		query.setParameter("eventTime", event.getDueDate());
            		query.setParameter("id", event.getId());
            		query.setParameter("dataSourceType", 2);
            		int result = query.executeUpdate(); 
            		System.out.println("Event " + i);
            		tr.commit();        			
        		}
        	}        	
    	}catch(Exception ex){
    		System.out.println(ex.getMessage());
    	}
		finally{
    		sessFactory.close();
    	}               		
    	System.out.println("Successfully updated");             
	}
	
//	public static void saveToDatabase(List<List<String>> dataHolder, int dataSourceType) throws SecurityException, RollbackException, HeuristicMixedException, HeuristicRollbackException, SystemException{
//		SessionFactory sessFactory = null;
//    	try{
//    		sessFactory = HibernateHelper.getSessionFactory();
//    		Session session = sessFactory.openSession();
//        	org.hibernate.Transaction tr = session.beginTransaction();
//        	switch(dataSourceType){
//        	case 1:
//                for(int i = 0; i < dataHolder.size(); i++){
//                	if (i == 0) {
//                		continue;
//                	}        	
//                	List<String> list = dataHolder.get(i);
//                	Event event = getEvent(i, list, dataSourceType);
//                	session.save(event);            	
//                	System.out.println("Row " + i);
//                }
//        		break;
//        	case 2:
//                for(int i = 0; i < dataHolder.size(); i++){
//                	List<String> list = dataHolder.get(i);
//                	Event event = getEvent(i, list, dataSourceType);
//                	session.save(event);            	
//                	System.out.println("Row " + i);
//                }        		
//        		break;
//        	}
//            tr.commit();
//    	}finally{
//    		sessFactory.close();
//    	}               		
//    	System.out.println("Successfully inserted");             
//	}
	
	public static void saveToUser(List<List<String>> dataHolder, int dataSourceType) throws SecurityException, RollbackException, HeuristicMixedException, HeuristicRollbackException, SystemException{
		List<String> userIds = new ArrayList<String>();
		for(int i = 0; i < dataHolder.size(); i++){
			if (i == 0) continue;
			List list = dataHolder.get(i);			
			int j = 0;
			switch(dataSourceType){
			case 1:
				j = 1;
				break;
			case 2:
				j = 0;
				break;
			}
			if (!userIds.contains(list.get(j).toString()))
				userIds.add(list.get(j).toString());
		}
				
		SessionFactory sessFactory = null;
    	try{
    		sessFactory = HibernateHelper.getSessionFactory();
    		Session session = sessFactory.openSession();
    		org.hibernate.Transaction tr = session.beginTransaction();
            for(int i = 0; i < userIds.size(); i++){
            	User user = new User();
            	user.setId(userIds.get(i));
            	user.setUserTypeId(1);
            	session.save(user);            	
            	System.out.println("Row " + i);
            }    	        	    
            tr.commit();
    	}catch(Exception e){
    		e.printStackTrace();
    	}
    	finally{
    		sessFactory.close();
    	}               		
    	System.out.println("Successfully inserted");             		
	}
	
	public static List<Event> getEventsByUserId(String userId){
		List<Event> events = new ArrayList<Event>();
		SessionFactory sessFactory = null;
    	try{
    		sessFactory = HibernateHelper.getSessionFactory();
    		Session session = sessFactory.openSession();
    		 Query query = session.createQuery("from Event where fKUserId = :fKUserId");
    		 query.setParameter("fKUserId", userId);
    		 events = query.list();
    		 System.out.println(events);
    	}catch(Exception e){
    		
    	}finally{
    		sessFactory.close();
    	}               		
		return events;
	}	
}
