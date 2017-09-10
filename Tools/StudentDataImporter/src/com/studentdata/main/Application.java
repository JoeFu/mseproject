package com.studentdata.main;

import com.studentdata.common.ConfigurationManager;
import java.awt.EventQueue;

/**
 * @author TonyPhan.
 *
 */
public class Application {
  
  /**
  * The main method of the application.
  *
  */
  public static void main(String[] args) {
    ConfigurationManager.loadConfiguration();
    EventQueue.invokeLater(new Runnable() {
      @Override
      public void run() {
        MessageDialogsEx md = new MessageDialogsEx();
        md.setVisible(true);
        }
      });
  }
}
