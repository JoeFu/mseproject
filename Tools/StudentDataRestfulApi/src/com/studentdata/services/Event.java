package com.studentdata.services;

import java.sql.Timestamp;

public class Event extends GenericBusinessObject {

  private static final long serialVersionUID = 1L;
  private String id;
  private String name;
  private String description;
  private int fKComponentId;
  private int fKEventTypeId;
  private String fKUserId;
  private float grade;
  private float maxGrade;
  private Timestamp startDate;
  private Timestamp dueDate;
  private String repositoryVersion;
  private String courseName;
  private String semester;
  private int schoolYear;
  private Timestamp eventTime;
  private String context;
  private String prefix;
  private Integer datasourcetype;
  private String assignmentName;
  
  public String getId() {
    return id;
  }
  
  public String getName() {
    return name;
  }
  
  public String getDescription() {
    return description;
  }
  
  public int getComponenId() {
    return fKComponentId;
  }
  
  public int getEventTypeId() {
    return fKEventTypeId;
  }
  
  public String getUserId() {
    return fKUserId;
  }
  
  public float getGrade() {
    return grade;
  }
  
  public float getMaxGrade() {
    return maxGrade;
  }
  
  public Timestamp getStartDate() {
    return startDate;
  }
  
  public Timestamp getDueDate() {
    return dueDate;
  }
  
  public String getRepositoryVersion() {
    return repositoryVersion;
  }
  
  public String getCourseName() {
    return courseName;
  }
  
  public String getSemester() {
    return semester;
  }
  
  public int getSchoolYear() {
    return schoolYear;
  }
  
  public Timestamp getEventTime() {
    return eventTime;
  }
  
  public String getContext() {
    return context;
  }
  
  public String getPrefix() {
    return prefix;
  }
  
  public Integer getDatasourcetype() {
    return datasourcetype;
  }
  
  public String getAssignmentName() {
    return assignmentName;
  }
  
  public void setId(String id) {
    this.id = id;
  }
  
  public void setName(String name) {
    this.name = name;
  }
  
  public void setDescription(String description) {
    this.description = description;
  }
  
  public void setComponentId(int componentId) {
    this.fKComponentId = componentId;
  }
  
  public void setEventTypeId(int eventTypeId) {
    this.fKEventTypeId = eventTypeId;
  }
  
  public void setUserId(String userId) {
    this.fKUserId = userId;
  }
  
  public void setGrade(float grade) {
    this.grade = grade;
  }
  
  public void setMaxGrade(float maxGrade) {
    this.maxGrade = maxGrade;
  }
  
  public void setStartDate(Timestamp startDate) {
    this.startDate = startDate;
  }
  
  public void setDueDate(Timestamp dueDate) {
    this.dueDate = dueDate;
  }
  
  public void setRepositoryVersion(String repositoryVersion) {
    this.repositoryVersion = repositoryVersion;
  }
  
  public void setCourseName(String courseName) {
    this.courseName = courseName;
  }
  
  public void setSemester(String semester) {
    this.semester = semester;
  }
  
  public void setSchoolYear(int schoolYear) {
    this.schoolYear = schoolYear;
  }
  
  public void setEventTime(Timestamp eventTime) {
    this.eventTime = eventTime;
  }
  
  public void setContext(String context) {
    this.context = context;
  }
  
  public void setPrefix(String prefix) {
    this.prefix = prefix;
  }
  
  public void setDatasourcetype(Integer datasourcetype) {
    this.datasourcetype = datasourcetype;
  }
  
  public void setAssignmentName(String assignmentName) {
    this.assignmentName = assignmentName;
  }
}
