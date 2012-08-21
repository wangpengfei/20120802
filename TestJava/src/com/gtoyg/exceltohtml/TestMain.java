package com.gtoyg.exceltohtml;

import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;

import org.apache.poi.hssf.converter.ExcelToHtmlConverter;
import org.apache.poi.hssf.usermodel.HSSFWorkbook;
import org.w3c.dom.Document;

public class TestMain {

	/**
	 * @param args
	 */
	public static void main(String[] args) {

		try {
			//
			FileInputStream fin = new FileInputStream("D:\\2011.xls");
			
			ToHtml toHtml = ToHtml.create(fin, System.out);
			toHtml.setCompleteHTML(true);
			toHtml.printPage();

			// HSSFWorkbook book = new HSSFWorkbook(fin);
			//
			// Document doc = null;
			// ExcelToHtmlConverter etohtml = new ExcelToHtmlConverter(doc);
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

}
