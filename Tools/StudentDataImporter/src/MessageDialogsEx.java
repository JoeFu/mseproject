import java.io.File;
import java.util.List;

import javax.swing.JButton;
import javax.swing.JFileChooser;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.border.TitledBorder;
import javax.transaction.HeuristicMixedException;
import javax.transaction.HeuristicRollbackException;
import javax.transaction.RollbackException;
import javax.transaction.SystemException;

public class MessageDialogsEx extends JFrame {
	private JPanel panel;
	
	public MessageDialogsEx(){
		initUI();
	}
	
	private void initUI(){
		panel = (JPanel)getContentPane();
		panel.setBorder(new TitledBorder(null, "Import data", TitledBorder.LEADING, TitledBorder.TOP, null, null));
		panel.setBounds(6, 6, 356, 96);
		panel.setLayout(null);	
		
		JButton btnLoad = new JButton("Load");
		btnLoad.addActionListener(new ActionListener() {
			public void actionPerformed(java.awt.event.ActionEvent e) {
				JFileChooser jfc=new JFileChooser();  
		        jfc.setFileSelectionMode(JFileChooser.FILES_AND_DIRECTORIES );
		        jfc.setCurrentDirectory(new File("./"));
		        jfc.showOpenDialog(null);  
		        File file=jfc.getSelectedFile();		        
				String filePath = file.getPath();	
				List<List<String>> dataHolder = ExcelToDatabase.readFile(filePath);
				try {
					DatabaseHelper.saveToDatabase(dataHolder);
				} catch (SecurityException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				} catch (RollbackException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				} catch (HeuristicMixedException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				} catch (HeuristicRollbackException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				} catch (SystemException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				}
			}
		});
		//createLayout(btnLoad);
		btnLoad.setBounds(34, 34, 96, 29);
		panel.add(btnLoad);
		
		JLabel lblMap = new JLabel("Inserted successfully!");
		lblMap.setBounds(34, 100, 230, 29);
		panel.add(lblMap);
		
        setTitle("Data Importer tool");
        setSize(300, 200);
        setLocationRelativeTo(null);
        setDefaultCloseOperation(EXIT_ON_CLOSE);
    }
	
	
}
