package com.studentdata.common;

import com.studentdata.dao.DataDao;

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
	
	public DataDao createReportDao(){
		if (dataDao == null)
			return new DataDao();
		return dataDao;
	}
}
