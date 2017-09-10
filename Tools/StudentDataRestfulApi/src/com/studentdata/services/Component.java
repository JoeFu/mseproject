package com.studentdata.services;

/**
 * @author TonyPhan. The Component class of business layer which is one of DTO class.
 *
 */
public class Component extends GenericBusinessObject {

  private static final long serialVersionUID = 1L;
  private Integer id;
  private String name;
  
  public Integer getId() {
    return id;
  }
  
  public String getName() {
    return name;
  }
  
  public void setId(Integer id) {
    this.id = id;
  }
  
  public void setName(String name) {
    this.name = name;
  }
}
