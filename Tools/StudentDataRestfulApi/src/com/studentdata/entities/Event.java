package com.studentdata.entities;

import java.sql.Timestamp;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;


@Entity
@Table(name = "Event")
public class Event extends GenericEntity{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;

    @Id
    @Column(name="id")	
	private String id;
	
    @Column(name="name")    
	private String name;
	
    @Column(name="description")    
	private String description;
	
    @Column(name="fKComponentId")    
	private int fKComponentId;
	
    @Column(name="fKEventTypeId")        
	private int fKEventTypeId;
	
    @Column(name="fKUserId")        
	private String fKUserId;
	
    @Column(name="grade")        
	private float grade;
	
    @Column(name="maxGrade")
	private float maxGrade;
		
    @Column(name="startDate")   
	private Timestamp startDate;
	
    @Column(name="dueDate")        
	private Timestamp dueDate;
	
    @Column(name="repositoryVersion")        
	private String repositoryVersion;
	
    @Column(name="courseName")        
	private String courseName;
	
    @Column(name="semester")        
	private String semester;
	
    @Column(name="schoolYear")        
	private int schoolYear;
	
    @Column(name="eventTime")        
	private Timestamp eventTime;
	
    @Column(name="context")        
	private String context;
	
    @Column(name="prefix")    
	private String prefix;
	
    @Column(name="datasourcetype")        
	private Integer datasourcetype;
		
    @Column(name="assignmentName")        
	private String assignmentName;
		
	public Event(){}
	
	public String getId(){
		return id;
	}
	
	public String getName(){
		return name;
	}
	
    public String getDescription(){
      return description;
    }
    
	public int getComponenId(){
		return fKComponentId;
	}
	
	public int getEventTypeId(){
		return fKEventTypeId;
	}
	
	public String getUserId(){
		return fKUserId;
	}
	
	public float getGrade(){
		return grade;
	}
	    
    public float getMaxGrade(){
      return maxGrade;
    }
        
	public Timestamp getStartDate(){
		return startDate;
	}
	
	public Timestamp getDueDate(){
		return dueDate;
	}
	
	public String getRepositoryVersion(){
		return repositoryVersion;
	}
	
	public String getCourseName(){
		return courseName;
	}

	public String getSemester(){
		return semester;
	}
	
	public int getSchoolYear(){
		return schoolYear;
	}
	
	public Timestamp getEventTime(){
		return eventTime;
	}
	
	public String getContext(){
		return context;
	}
	    
	public String getPrefix(){
		return prefix;
	}
	
	public Integer getDatasourcetype(){
		return datasourcetype;
	}
	
	public String getAssignmentName(){
		return assignmentName;
	}
	
	public void setId(String id){
		this.id = id;
	}
	
	public void setName(String name){
		this.name = name;
	}
	
	public void setDescription(String description){
		this.description = description;
	}
	
	public void setComponentId(int fKComponentId){
		this.fKComponentId = fKComponentId;
	}
	
	public void setEventTypeId(int fKEventTypeId){
		this.fKEventTypeId = fKEventTypeId;
	}
	
	public void setUserId(String fKUserId){
		this.fKUserId = fKUserId;
	}
	
	public void setGrade(float grade){
		this.grade = grade;
	}
	
	public void setMaxGrade(float maxGrade){
		this.maxGrade = maxGrade;
	}
	
	public void setStartDate(Timestamp startDate){
		this.startDate = startDate;
	}
	
	public void setDueDate(Timestamp dueDate){
		this.dueDate = dueDate;
	}
	
	public void setRepositoryVersion(String repositoryVersion){
		this.repositoryVersion = repositoryVersion;
	}
	
	public void setCourseName(String courseName){
		this.courseName = courseName;
	}
	
	public void setSemester(String semester){
		this.semester = semester;	
	}
	
	public void setSchoolYear(int schoolYear){
		this.schoolYear = schoolYear;
	}
	
	public void setEventTime(Timestamp eventTime){
		this.eventTime = eventTime;
	}
	
	public void setContext(String context){
		this.context = context;
	}
		
	public void setPrefix(String prefix){
		this.prefix = prefix;
	}
	
	public void setDatasourcetype(Integer datasourcetype){
		this.datasourcetype = datasourcetype;
	}
	
	public void setAssignmentName(String assignmentName){
		this.assignmentName = assignmentName;
	}
}
