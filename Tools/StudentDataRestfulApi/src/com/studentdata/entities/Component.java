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
@Table(name = "Component")
public class Component extends GenericEntity{

  /**
   * 
   */
  private static final long serialVersionUID = 1L;
  
  @Id
  @Column(name = "id")
  @GeneratedValue  
  private Integer id;
  
  @Column(name = "name")  
  private String name;
  
  public Component(){}
  
  public Integer getId(){
    return id;
  }
  
  public String getName(){
    return name;
  }
  
  public void setId(Integer id){
    this.id = id;
  }
  
  public void setName(String name){
    this.name = name;
  }
}
