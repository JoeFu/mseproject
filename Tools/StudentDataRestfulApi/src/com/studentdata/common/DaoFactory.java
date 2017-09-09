package com.studentdata.common;

import com.studentdata.dao.DataDao;
import com.studentdata.dao.EventDao;

/**
 * Created by TonyPhan
 * This class is the factory of data access classes which applies Singleton pattern
 */
public class DaoFactory {	
	private static DaoFactory daoFactory = new DaoFactory();
	private static DataDao dataDao = null;
	private static EventDao eventDao = null;
	/* A private Constructor prevents any other
	 * class from instantiating.
	*/
	private DaoFactory(){ }
	
	/* Static 'instance' method */
	public static DaoFactory getInstance( ) {
		return daoFactory;
   	}
	
	/* Create the report data access class */
	public DataDao createDataDao(){
		if (dataDao == null)
			return new DataDao();
		return dataDao;
	}
	
	public EventDao createEventDao(){
	  if (eventDao == null)
	    return new EventDao();
	  return eventDao;
	}
}
