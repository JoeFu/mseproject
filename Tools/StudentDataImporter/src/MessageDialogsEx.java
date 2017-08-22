import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
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
import javax.transaction.HeuristicMixedException;
import javax.transaction.HeuristicRollbackException;
import javax.transaction.RollbackException;
import javax.transaction.SystemException;

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
	
	private void initUI(){
		this.setResizable(false);
		panel = (JPanel)getContentPane();
		panel.setBorder(new TitledBorder(null, "Import data", TitledBorder.LEADING, TitledBorder.TOP, null, null));
		panel.setBounds(6, 6, 356, 96);
		panel.setLayout(null);	
		
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
		
		JButton importButton = new JButton("Import");
		importButton.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				List<List<String>> dataHolder = new ArrayList<List<String>>();
				try {
					selectedDataSource = (String)comboDatasources.getSelectedItem();
					int dataSourceType = 1; // by default
					switch(selectedDataSource){
					case "Moodle Forum":
						dataSourceType = 1;
						dataHolder = DataReaderHelper.readDataFromExcelFile(selectedFilePath);
						break;
					case "Web Submission":
						dataSourceType = 2;
						dataHolder = DataReaderHelper.readDataFromTextFile(selectedFilePath);
						break;
					}					
					DatabaseHelper.saveToDatabase(dataHolder, dataSourceType);
				} catch (SecurityException e1) {
					e1.printStackTrace();
				} catch (RollbackException e1) {
					e1.printStackTrace();
				} catch (HeuristicMixedException e1) {
					e1.printStackTrace();
				} catch (HeuristicRollbackException e1) {
					e1.printStackTrace();
				} catch (SystemException e1) {
					e1.printStackTrace();
				} catch (IOException e1) {
					e1.printStackTrace();
				}							
			}
		});
		
		importButton.setBounds(34, 100, 86, 29);
		panel.add(importButton);
		
		JLabel lblMessage = new JLabel("Inserted successfully!");
		lblMessage.setBounds(34, 150, 230, 29);
		lblMessage.setVisible(false);
		panel.add(lblMessage);
		
        setTitle("Data Importer tool");
        setSize(350, 250);
        setLocationRelativeTo(null);
        setDefaultCloseOperation(EXIT_ON_CLOSE);
    }
	
	
}
