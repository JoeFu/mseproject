package com.studentdata.main;

import java.io.File;
import java.util.List;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFileChooser;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.border.TitledBorder;
import javax.swing.filechooser.FileNameExtensionFilter;

import com.studentdata.common.ConfigurationManager;
import com.studentdata.common.DataMessage;
import com.studentdata.common.JsonHelper;
import com.sun.jersey.api.client.Client;
import com.sun.jersey.api.client.ClientResponse;
import com.sun.jersey.api.client.WebResource;

/**
 * Created by TonyPhan
 */
public class MessageDialogsEx extends JFrame {
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private JPanel panel;
	private String selectedDataSource;
	private String selectedFilePath = "";
	
	public MessageDialogsEx(){
		initUI();
	}
	
	// Initialize the interface
	private void initUI(){
		this.setResizable(false);
		
		// Make and set the content panel
		panel = (JPanel)getContentPane();
		panel.setBorder(new TitledBorder(null, "Import data", TitledBorder.LEADING, TitledBorder.TOP, null, null));
		panel.setBounds(6, 6, 356, 96);
		panel.setLayout(null);	
		
		// Add Browse button
		JButton btnBrowse = new JButton("Browse");
		btnBrowse.addActionListener(new ActionListener() {
			public void actionPerformed(java.awt.event.ActionEvent e) {
				JFileChooser jfc=new JFileChooser();  
				FileNameExtensionFilter filter = new FileNameExtensionFilter("Excel file", "xls", "xlsx");
				jfc.addChoosableFileFilter(filter);
		        jfc.setFileSelectionMode(JFileChooser.FILES_AND_DIRECTORIES );
		        jfc.setCurrentDirectory(new File("./"));
		        jfc.showOpenDialog(null);  
		        File file=jfc.getSelectedFile();
		        if (file == null){
		        	selectedFilePath = "";
		        	return;
		        }		        			       
		        selectedFilePath = file.getPath();	
			}
		});
		
		// Add combobox to select data sources
		JComboBox<String> comboDatasources = new JComboBox<String>();
		comboDatasources.addItem("Moodle Forum");
		comboDatasources.addItem("Web Submission");
		comboDatasources.addActionListener(new ActionListener() {			
			@Override
			public void actionPerformed(ActionEvent e) {
				JComboBox<String> combo = (JComboBox<String>)e.getSource();
				selectedDataSource = (String)combo.getSelectedItem();					
			}
		});

		comboDatasources.setBounds(34, 34, 156, 29);
		panel.add(comboDatasources);
		
		btnBrowse.setBounds(200, 34, 86, 29);
		panel.add(btnBrowse);
		
		// Add the message label
        JLabel lblMessage = new JLabel("Inserted successfully!");
        lblMessage.setBounds(34, 150, 230, 29);
        lblMessage.setVisible(false);
        panel.add(lblMessage);
        
        // Set title of the tool
        setTitle("Data Importer tool");
        setSize(350, 250);
        setLocationRelativeTo(null);
        setDefaultCloseOperation(EXIT_ON_CLOSE);
		
        // Add Import button
		JButton importButton = new JButton("Import");
		importButton.addActionListener(new ActionListener() {					  
		  @Override
		  public void actionPerformed(ActionEvent e) {
			try {
			  selectedDataSource = (String)comboDatasources.getSelectedItem();
			  int dataSourceType = 1; // by default
			  switch(selectedDataSource){
				case "Moodle Forum":
				  dataSourceType = 1;
				break;
				case "Web Submission":
				  dataSourceType = 2;
				  break;
			  }										
			  // Build Json message
			  DataMessage dataMessage = new DataMessage();
			  dataMessage.setFilePath(selectedFilePath);
			  dataMessage.setDataSourceType(dataSourceType);
			  String dataMessageJson = JsonHelper.parseDataMessageToJson(dataMessage);
			  
			  // Invoke Restful API to save data
		      Client client = Client.create();
		      WebResource webResource = client.resource(ConfigurationManager.SAVE_DATA_URL);
		      ClientResponse response = webResource.accept("application/json").type("application/json").post(ClientResponse.class, dataMessageJson);
		      
		      // If error occurs, throw the message
		      if (response.getStatus() != 201) {
		        throw new RuntimeException("Failed : HTTP error code : " + response.getStatus());
		      }	        	
		      System.out.println("Output from Server .... \n");
		      String output = response.getEntity(String.class);
		      System.out.println(output);	        
		      lblMessage.setVisible(true);					
			} catch (SecurityException e1) {				  
			  e1.printStackTrace();
			}							
		  }
		});
		importButton.setBounds(34, 100, 86, 29);
		panel.add(importButton);		
    }	
}
