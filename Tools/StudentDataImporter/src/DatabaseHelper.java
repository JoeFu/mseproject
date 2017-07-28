import java.net.UnknownServiceException;
import java.sql.Timestamp;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.List;

import javax.swing.text.DateFormatter;
import javax.transaction.HeuristicMixedException;
import javax.transaction.HeuristicRollbackException;
import javax.transaction.RollbackException;
import javax.transaction.SystemException;
import javax.transaction.Transaction;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;


public class DatabaseHelper {
	private static int getComponentId(String compName){
		int id = 0;
		switch(compName){
			case "System":
				id = 1;
			case "File":
				id = 2;
			case "Forum":
				id = 3;
			case "Choice":
				id = 4;
			case "Quiz":
				id = 5;
			case "mod_course":
				id = 6;
			case "mod_discussion":
				id = 7;
		}
		return id;
	}
	
	private static int getEventTypeId(String context){
		int eventTypeId = 1; // by default
		if (context.startsWith("Course:")){
			eventTypeId = 1;
		}
		if (context.startsWith("File:") || context.startsWith("Page:") || context.startsWith("Folder:") || context.startsWith("URL:")){
			eventTypeId = 2; // Assignment
		}
		if (context.startsWith("Quiz:")){
			eventTypeId = 3;
		}
		if (context.startsWith("Forum:")){
			eventTypeId = 4;
		}
		return eventTypeId;		
	}
	
	private static Event getEvent(int id, List list, int dataSourceType){
		Event event = new Event();
		switch(dataSourceType){
		case 1://Moodles
			event.setId(String.valueOf(id));
			event.setName(list.get(4).toString());
			event.setDescription(list.get(5).toString());
			event.setComponentId(getComponentId(list.get(3).toString()));
			event.setEventTypeId(getEventTypeId(list.get(2).toString()));
			event.setUserId(list.get(1).toString());
			float grade = (id%2==0) ? 60 : 70;
			event.setGrade(grade);		
			DateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd");
			DateFormatter formatter1 = new DateFormatter();
			formatter1.setFormat(dateFormat);
			
			event.setVersion(String.valueOf(id));
			event.setCourseName("MSE");
			event.setSemester("Semester 2");	
			event.setSchoolYear(2017);		
			String[] dateTimes = list.get(0).toString().split(", ");
			
			String strDate = (dateTimes[0].length() < 8) ? ("0" + dateTimes[0]):dateTimes[0];
			String strTime = dateTimes[1] + ".12.083 +04:30";
			DateTimeFormatter formatter = DateTimeFormatter.ofPattern("dd/MM/yy HH:mm.ss.SSS XXX");		
			LocalDateTime time = LocalDateTime.parse(strDate + " " +strTime, formatter);
			event.setEventTime(Timestamp.valueOf(time));
			String[] contexts = list.get(2).toString().split(":");
			event.setPrefix(contexts[0]);
			String context = "";
			for(int j = 1; j < contexts.length; j++)
				context += contexts[j];
			event.setContext(context);
			event.setDatasourcetype(1);
			
			break;
		case 2:
			event.setId(String.valueOf(id));
			String userId = list.get(0).toString();
			event.setUserId(userId);
			String repositoryId = list.get(1).toString();
			event.setRepository(repositoryId);
			event.setComponentId(7);
			String dateTime = list.get(2).toString();
			dateTimes = dateTime.split("-");
			strDate = dateTimes[0].substring(0, 2) + "/" + dateTimes[0].substring(2, 4) + "/" + dateTimes[0].substring(4, 6);
			strTime = dateTimes[1].substring(0, 2) + ":" + dateTimes[1].substring(2, 4) + "." + dateTimes[1].substring(4, 6)  + ".083 +04:30";
			formatter = DateTimeFormatter.ofPattern("dd/MM/yy HH:mm.ss.SSS XXX");
			time = LocalDateTime.parse(strDate + " " +strTime, formatter);
			event.setEventTime(Timestamp.valueOf(time));
			String eventStatus = list.get(3).toString();
			String[] parts = eventStatus.split("-");
			event.setName(parts[0]);
			if (parts.length > 1){
				event.setGrade(Float.parseFloat(parts[1]));
				event.setEventTypeId(5);
			}else
				event.setEventTypeId(6);
			event.setDatasourcetype(2);
			break;
		}
		//event.setDatasourcetype(1);//Moodles
		return event;
	}
	
	
	
	public static void saveToDatabase(List<List<String>> dataHolder, int dataSourceType) throws SecurityException, RollbackException, HeuristicMixedException, HeuristicRollbackException, SystemException{
		SessionFactory sessFactory = null;
    	try{
    		sessFactory = HibernateHelper.getSessionFactory();
    		Session session = sessFactory.openSession();
        	org.hibernate.Transaction tr = session.beginTransaction();
        	switch(dataSourceType){
        	case 1:
                for(int i = 0; i < dataHolder.size(); i++){
                	if (i == 0) {
                		continue;
                	}        	
                	List<String> list = dataHolder.get(i);
                	Event event = getEvent(i, list, dataSourceType);
                	session.save(event);            	
                	System.out.println("Row " + i);
                }
        		break;
        	case 2:
                for(int i = 0; i < dataHolder.size(); i++){
                	List<String> list = dataHolder.get(i);
                	Event event = getEvent(i, list, dataSourceType);
                	session.save(event);            	
                	System.out.println("Row " + i);
                }        		
        		break;
        	}
            tr.commit();
    	}finally{
    		sessFactory.close();
    	}               		
    	System.out.println("Successfully inserted");             
	}
	
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
