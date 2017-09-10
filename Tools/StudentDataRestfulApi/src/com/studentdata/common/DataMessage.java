package com.studentdata.common;

/**
 * This class is the message of data.
 * @author TonyPhan
 *
 */
public class DataMessage {
  private String filePath;
  private Integer dataSourceType;
  
  public String getFilePath() {
    return this.filePath;
  }
  
  public Integer getDataSourceType() {
    return this.dataSourceType;
  }
  
  public void setFilePath(String filePath) {
    this.filePath = filePath;
  }
  
  public void setDataSourceType(Integer dataSourceType) {
    this.dataSourceType = dataSourceType;
  }
}