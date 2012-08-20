package com.gtoyg.exceltohtml;

import org.apache.poi.hssf.converter.ExcelToHtmlConverter;
import org.w3c.dom.Document;

public class TestMain {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		Document doc = null;
		ExcelToHtmlConverter etohtml = new ExcelToHtmlConverter(doc);
	}

}
