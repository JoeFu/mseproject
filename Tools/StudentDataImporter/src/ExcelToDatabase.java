import java.awt.EventQueue;
import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.net.MalformedURLException;
import java.net.URL;
import java.rmi.RemoteException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.sql.Timestamp;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.time.Year;
import java.time.ZonedDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Date;
import java.util.Iterator;
import java.util.List;
import java.util.Scanner;
import java.util.Vector;

import javax.swing.text.DateFormatter;
import javax.transaction.HeuristicMixedException;
import javax.transaction.HeuristicRollbackException;
import javax.transaction.RollbackException;
import javax.transaction.SystemException;

import org.apache.poi.hssf.usermodel.HSSFCell;
import org.apache.poi.hssf.usermodel.HSSFRow;
import org.apache.poi.hssf.usermodel.HSSFSheet;
import org.apache.poi.hssf.usermodel.HSSFWorkbook;
import org.apache.poi.xssf.usermodel.XSSFCell;
import org.apache.poi.xssf.usermodel.XSSFRow;
import org.apache.poi.xssf.usermodel.XSSFSheet;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import org.hibernate.Session;

import javax.xml.namespace.QName;
import javax.xml.ws.Service;

//import au.edu.students.dataaccesslayer.Entities.Event;
public class ExcelToDatabase {

	public static void main(String[] args) throws SecurityException, RollbackException, HeuristicMixedException, HeuristicRollbackException, SystemException, IOException{
		//String fileName = "F:\\Adelaide\\University\\Semester1_2017\\MSE\\Project\\Data\\From Teacher\\ForumsData404.xls";
		String fileName = "F:\\Adelaide\\University\\Semester1_2017\\MSE\\Project\\Data\\From Teacher\\History";
		//List<List<String>> dataHolder = readFile(fileName);
		List<List<String>> dataHolder = readDataFromFile(fileName);
		//List<List<String>> dataHolder;
		//dataHolder = readFile(fileName);
		//saveToUser(dataHolder);
		DatabaseHelper.saveToDatabase(dataHolder, 2);
		//DatabaseHelper.saveToUser(dataHolder, 2);
		//List<Event> events = DatabaseHelper.getEventsByUserId("USER0039");
		
	}			
	
//	public static void main(String[] args) {
//
//        EventQueue.invokeLater(new Runnable() {
//
//            @Override
//            public void run() {
//                MessageDialogsEx md = new MessageDialogsEx();
//                md.setVisible(true);
//            }
//        });
//    }	
	public static List<List<String>> readFile(String fileName){
		List<List<String>> cellVectorHolder = new ArrayList<List<String>>(); 
		try{
			FileInputStream input = new FileInputStream(fileName);			
			HSSFWorkbook  workbook = new HSSFWorkbook (input);
			HSSFSheet sheet = workbook.getSheetAt(0);
			Iterator rowIter = sheet.rowIterator();
			while(rowIter.hasNext()){
				HSSFRow row = (HSSFRow) rowIter.next();
				Iterator cellIter = row.cellIterator();
				List list = new ArrayList();
				while(cellIter.hasNext()){
                    HSSFCell cell = (HSSFCell) cellIter.next();
                    list.add(cell);
                }
				cellVectorHolder.add(list);
			}
		}catch(Exception e){
			e.printStackTrace();
		}
		return cellVectorHolder;
	}

	public static List<List<String>> readDataFromFile(String fileName) throws IOException{
		List<List<String>> dataLines = new ArrayList<List<String>>();
//		BufferedReader br = null;
//		try {
//			br = new BufferedReader(new FileReader(fileName));
//			String line = br.readLine();			
//			while (line != null) {
//				String[] data = line.split(";");
//				List<String> myList = new ArrayList<String>(Arrays.asList(data));
//				dataLines.add(myList);
//			}
//		} catch (FileNotFoundException e) {
//			// TODO Auto-generated catch block
//			e.printStackTrace();
//		} finally{
//			br.close();
//		}
		
		Scanner in = new Scanner(new FileReader(fileName));
		while(in.hasNext()) {			 
			String[] data = in.next().toString().split(";");
			List<String> myList = new ArrayList<String>(Arrays.asList(data));
			dataLines.add(myList);
		}
		in.close();
		return dataLines;
	}
}
