package com.studentdata.services;

/**
 * @author TonyPhan. This class represents the type of Event.
 *
 */
public class EventType extends GenericBusinessObject {

  private static final long serialVersionUID = 1L;
  private Integer id;
  private String name;
  private String description;
  
  public Integer getId() {
    return id;
  }
  
  public String getName() {
    return name;
  }
  
  public String getDescription() {
    return description;
  }
  
  public void setId(Integer id) {
    this.id = id;
  }
  
  public void setName(String name) {
    this.name = name;
  }
  
  public void setDescription(String description) {
    this.description = description;
  }
}
