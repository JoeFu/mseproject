package com.studentdata.common;

import javax.xml.xpath.XPath;
import javax.xml.xpath.XPathExpressionException;
import javax.xml.xpath.XPathFactory;

import org.xml.sax.InputSource;

public class ConfigurationManager {
	  public static String SAVE_DATA_URL;

	  public static void loadConfiguration(){
		  try {
			  XPath xpath = XPathFactory.newInstance().newXPath();
			  InputSource inputSource = new InputSource("config.xml");			  
			  SAVE_DATA_URL = xpath.evaluate("//savedataturl", inputSource);
		} catch (XPathExpressionException e) { 
			e.printStackTrace();
		}
	  }	  
}
