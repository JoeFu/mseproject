package com.studentdata.services;

import javax.ws.rs.core.Response;

/**
 * @author TonyPhan. The interface of data service which contains all methods to access to database.
 *
 */
public interface IDataService {
  Response addData(String dataMessageJson);
  
  Response addComponents();
  
  Response addEventTypes();
  
  Response addUserTypes();
  
  Response getEventTotal();
}
