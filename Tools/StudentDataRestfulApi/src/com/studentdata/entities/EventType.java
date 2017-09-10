package com.studentdata.entities;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;

/**
 * @author TonyPhan. The EventType class.
 *
 */
@Entity
@Table(name = "EventType")
public class EventType extends GenericEntity {
  
  private static final long serialVersionUID = 1L;
  
  @Id
  @Column(name = "id")
  @GeneratedValue  
  private Integer id;
  
  @Column(name = "name")  
  private String name;
  
  @Column(name = "description")  
  private String description;
  
  public EventType(){}
  
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
