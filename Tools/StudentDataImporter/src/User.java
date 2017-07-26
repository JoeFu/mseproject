
import java.io.Serializable;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name="User")
public class User implements Serializable {
	@Id
	@Column(name="id")
	private String id;
	
	@Column(name="fKUserTypeId")
	private int fKUserTypeId;
	
	@Column(name="fKParentId")
	private String fKParentId;
	
	public String getId(){
		return id;
	}
	
	public int getUserTypeId(){
		return fKUserTypeId;
	}
	
	public String getParentId(){
		return fKParentId;
	}
	
	public void setId(String id){
		this.id = id;
	}
	
	public void setUserTypeId(int fKUserTypeId){
		this.fKUserTypeId = fKUserTypeId;
	}
	
	public void setParentId(String fKParentId){
		this.fKParentId = fKParentId;
	}
}
