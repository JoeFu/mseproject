/**
 * 
 */
package com.studentdata.entities;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;

/**
 * @author TonyPhan
 *
 */
@Entity
@Table(name = "UserType")
public class UserType extends GenericEntity{

  /**
   * 
   */
  private static final long serialVersionUID = 1L;

  @Id
  @Column(name = "id")
  @GeneratedValue  
  private Integer id;
  
  @Column(name = "type")  
  private String type;
  
  @Column(name = "description")  
  private String description;
  
  public UserType(){}
  
  public Integer getId(){
    return id;
  }
  
  public String getType(){
    return type;
  }
  
  public String getDescription(){
    return description;
  }
  
  public void setId(Integer id){
    this.id = id;
  }
  
  public void setType(String type){
    this.type = type;
  }
  
  public void setDescription(String description){
    this.description = description;
  }
}
