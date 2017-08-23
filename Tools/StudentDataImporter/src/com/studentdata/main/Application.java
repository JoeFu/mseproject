package com.studentdata.main;
import java.awt.EventQueue;

import com.studentdata.common.ConfigurationManager;

public class Application {

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
