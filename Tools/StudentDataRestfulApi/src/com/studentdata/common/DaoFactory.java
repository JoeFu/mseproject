package com.studentdata.common;

import com.studentdata.dao.DataDao;

/**
 * Created by TonyPhan
 * This class is the factory of data access classes which applies Singleton pattern
 */
public class DaoFactory {	
	private static DaoFactory daoFactory = new DaoFactory();
	private static DataDao dataDao = null;
	/* A private Constructor prevents any other
	 * class from instantiating.
	*/
	private DaoFactory(){ }
	
	/* Static 'instance' method */
	public static DaoFactory getInstance( ) {
		return daoFactory;
   	}
	
	/* Create the report data access class */
	public DataDao createReportDao(){
		if (dataDao == null)
			return new DataDao();
		return dataDao;
	}
}
