/**
 * 
 */
package com.studentdata.common;

import java.io.FileInputStream;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Iterator;
import java.util.List;
import java.util.Scanner;

import org.apache.poi.hssf.usermodel.HSSFCell;
import org.apache.poi.hssf.usermodel.HSSFRow;
import org.apache.poi.hssf.usermodel.HSSFSheet;
import org.apache.poi.hssf.usermodel.HSSFWorkbook;

/**
 * @author TonyPhan
 *
 */
public class DataReader {
	
	/**
	 * Read data from the excel file
	 * fileName: the path of the excel file
	 */	
	public static List<List<String>> readDataFromExcel(String fileName){
		// Check whether the file is of excel format
		String[] parts = fileName.split(".");
		if (parts.length == 2){
			if (!"xls".equals(parts[1]) && "xlsx".equals(parts[1]))
				return null;
		}
		
		// Read data from excel file
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
