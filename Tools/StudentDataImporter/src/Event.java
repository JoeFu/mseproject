
import java.io.Serializable;
import java.sql.Date;
import java.sql.Timestamp;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;


@Entity
@Table(name = "Event")
public class Event implements Serializable{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;

	@Id
	//@GeneratedValue
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
	
	@Column(name="startDate")
	private Date startDate;
	
	@Column(name="dueDate")
	private Date dueDate;
	
	@Column(name="version")
	private String version;
	
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
	
	public String getId(){
		return id;
	}
	
	public String getName(){
		return name;
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
	
	public Date getStartDate(){
		return startDate;
	}
	
	public Date getDueDate(){
		return dueDate;
	}
	
	public String version(){
		return version;
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
	
	public void setStartDate(Date startDate){
		this.startDate = startDate;
	}
	
	public void setDueDate(Date dueDate){
		this.dueDate = dueDate;
	}
	
	public void setVersion(String version){
		this.version = version;
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
}
