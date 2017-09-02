/**
 * 
 */
package com.studentdata.common;

/**
 * @author TonyPhan
 *
 */
public class ObjectMapper {
  public static com.studentdata.entities.Component toEntityComponent(com.studentdata.services.Component businessComponent){
    com.studentdata.entities.Component entityComponent = new com.studentdata.entities.Component();
    entityComponent.setId(businessComponent.getId());
    entityComponent.setName(businessComponent.getName());
    return entityComponent;
  }
  
  public static com.studentdata.entities.EventType toEntityEventType(com.studentdata.services.EventType businessEventType){
    com.studentdata.entities.EventType entityEventType = new com.studentdata.entities.EventType();
    entityEventType.setId(businessEventType.getId());
    entityEventType.setName(businessEventType.getName());
    return entityEventType;
  }
  
  public static com.studentdata.entities.UserType toEntityUserType(com.studentdata.services.UserType businessUserType){
    com.studentdata.entities.UserType entityUserType = new com.studentdata.entities.UserType();
    entityUserType.setId(businessUserType.getId());
    entityUserType.setType(businessUserType.getType());
    entityUserType.setDescription(businessUserType.getDescription());
    return entityUserType;
  }
  
}
