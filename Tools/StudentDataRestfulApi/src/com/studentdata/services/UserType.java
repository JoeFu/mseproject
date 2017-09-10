package com.studentdata.services;

/**
 * @author TonyPhan. This class represents the type of User object.
 *
 */
public class UserType extends GenericBusinessObject {  
  private static final long serialVersionUID = 1L;
  private Integer id;
  private String type;
  private String description;
  
  public Integer getId() {
    return id;
  }
  
  public String getType() {
    return type;
  }
  
  public String getDescription() {
    return description;
  }
  
  public void setId(Integer id) {
    this.id = id;
  }
  
  public void setType(String type) {
    this.type = type;
  }
  
  public void setDescription(String description) {
    this.description = description;
  }
}
