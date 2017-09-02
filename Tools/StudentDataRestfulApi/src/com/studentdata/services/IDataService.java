/**
 * 
 */
package com.studentdata.services;

import javax.ws.rs.core.Response;

/**
 * @author TonyPhan
 *
 */
public interface IDataService {
	Response addData(String dataMessageJson);
	Response addComponents();
	Response addEventTypes();
	Response addUserTypes();
	Response getEventTotal();	
}
