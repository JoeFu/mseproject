package com.studentdata.common;

/**
 * @author TonyPhan. This class is utilized to map from business object to entity object.
 *
 */
public class ObjectMapper {
  
  /**
   * Map from business Component object to entity Component object.
   */
  public static com.studentdata.entities.Component toEntityComponent(
      com.studentdata.services.Component businessComponent) {
    com.studentdata.entities.Component entityComponent = new com.studentdata.entities.Component();
    entityComponent.setId(businessComponent.getId());
    entityComponent.setName(businessComponent.getName());
    return entityComponent;
  }
  
  /**
   * Map from business EventType object to entity EventType object.
   */  
  public static com.studentdata.entities.EventType toEntityEventType(
      com.studentdata.services.EventType businessEventType) {
    com.studentdata.entities.EventType entityEventType = new com.studentdata.entities.EventType();
    entityEventType.setId(businessEventType.getId());
    entityEventType.setName(businessEventType.getName());
    return entityEventType;
  }
  
  /**
   * Map from business UserType object to entity UserType object.
   */ 
  public static com.studentdata.entities.UserType toEntityUserType(
      com.studentdata.services.UserType businessUserType) {
    com.studentdata.entities.UserType entityUserType = new com.studentdata.entities.UserType();
    entityUserType.setId(businessUserType.getId());
    entityUserType.setType(businessUserType.getType());
    entityUserType.setDescription(businessUserType.getDescription());
    return entityUserType;
  }  
}
