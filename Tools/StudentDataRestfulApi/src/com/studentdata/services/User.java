package com.studentdata.services;


/**
 * @author TonyPhan. This class represents the User object.
 *
 */
public class User extends GenericBusinessObject {
  private static final long serialVersionUID = 1L;
  private String id;
  private int fkUserTypeId;
  private String fkParentId;
  
  public String getId() {
    return id;
  }
  
  public int getUserTypeId() {
    return fkUserTypeId;
  }
  
  public String getParentId() {
    return fkParentId;
  }
  
  public void setId(String id) {
    this.id = id;
  }
  
  public void setUserTypeId(int userTypeId) {
    this.fkUserTypeId = userTypeId;
  }
  
  public void setParentId(String parentId) {
    this.fkParentId = parentId;
  }
}
