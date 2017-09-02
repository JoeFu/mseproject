package com.studentdata.services;

public class User extends GenericBusinessObject{

	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	
    private String id;
    
    private int fKUserTypeId;
    
    private String fKParentId;
    
    public String getId(){
        return id;
    }
    
    public int getUserTypeId(){
        return fKUserTypeId;
    }
    
    public String getParentId(){
        return fKParentId;
    }
    
    public void setId(String id){
        this.id = id;
    }
    
    public void setUserTypeId(int fKUserTypeId){
        this.fKUserTypeId = fKUserTypeId;
    }
    
    public void setParentId(String fKParentId){
        this.fKParentId = fKParentId;
    }
}
