/**
 * 
 */
package com.studentdata.services;

import java.io.IOException;
import java.util.List;

import javax.transaction.HeuristicMixedException;
import javax.transaction.HeuristicRollbackException;
import javax.transaction.RollbackException;
import javax.transaction.SystemException;
import javax.ws.rs.Consumes;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

import com.studentdata.common.DaoFactory;
import com.studentdata.common.DataMessage;
import com.studentdata.common.DataReader;
import com.studentdata.common.JsonHelper;
import com.studentdata.dao.DataDao;

/**
 * @author TonyPhan
 *
 */
@Path("/DataService")
public class DataService implements IDataService{
	
	
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
		
		result = "Data saved!";
		return Response.status(201).entity(result).build();				
	}
	
	
}
