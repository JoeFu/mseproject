package com.studentdata.common;

import javax.xml.xpath.XPath;
import javax.xml.xpath.XPathExpressionException;
import javax.xml.xpath.XPathFactory;

import org.xml.sax.InputSource;

/**
 * Load the configuration from config file.
 * @author TonyPhan
 *
 */
public class ConfigurationManager {
  public static String SAVE_DATA_URL;
  public static String ADD_COMPONENT_URL;
  public static String ADD_EVENTTYPE_URL;
  public static String ADD_USERTYPE_URL;
  public static String REMOVE_DATA_URL;
  public static String GET_EVENT_URL;
  
  /**
   * Load the configuration from config file.
   *
   */  
  public static void loadConfiguration() {
    try {
      XPath xpath = XPathFactory.newInstance().newXPath();
      InputSource inputSource = new InputSource("config.xml");
      SAVE_DATA_URL = xpath.evaluate("//savedataturl", inputSource);
      ADD_COMPONENT_URL = xpath.evaluate("//addcomponentturl", inputSource);
      ADD_EVENTTYPE_URL = xpath.evaluate("//addeventtypeturl", inputSource);
      ADD_USERTYPE_URL = xpath.evaluate("//addusertypeturl", inputSource);
      REMOVE_DATA_URL = xpath.evaluate("//removedataturl", inputSource);
      GET_EVENT_URL = xpath.evaluate("//geteventturl", inputSource);
    } catch (XPathExpressionException e) {
      e.printStackTrace();
    }
  }
}
