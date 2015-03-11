<?php 
class StatsParser{
	public static $dates = array("2012-12-31","2011-12-31","2010-12-31","2009-12-31","2008-12-31","2007-12-31","2006-12-31","2005-12-31","2004-12-31","2003-12-31");
	public static $files = array(
		"net" => "ODA-RUS_GGXONLB.xlsx",
		"unemployment" => "WORLDBANK-RUS_SL_UEM_TOTL_ZS.xlsx",
		"cpi" => "RATEINF-CPI_RUS.xlsx", 
		"price" => "WORLDBANK-RUS_FP_WPI_TOTL.xlsx", 
		"gdp" => "WORLDBANK-RUS_NY_GDP_PCAP_KN.xlsx"
		);

	static function ParseData(){
		$data = array();
		$compiled = array();
		foreach (self::$files as $key => $file) {
			$data[$key] = self::ParseXLS("data/".$file);
		}
		foreach (self::$dates as $value) {
			$item = new DataModel();
			$item->date = $value;
			$item->date_raw = $data["net"][$value]["date"];
			$item->net = $data["net"][$value]["value"];
			$item->cpi = $data["cpi"][$value]["value"];
			$item->price = $data["price"][$value]["value"];
			$item->gdp = $data["gdp"][$value]["value"];
			$item->unemployment = $data["unemployment"][$value]["value"];
			$compiled[] = $item;
		}
		return $compiled;
	}

	static function ParseXLS($file){
		$PHPExcel = PHPExcel_IOFactory::load($file);
		$sheet = $PHPExcel->getActiveSheet();
		$rows = $sheet->getHighestRow();	

		$input = array();

		for ($row = 2; $row <= $rows; $row++) {
			$date_raw = $sheet->getCellByColumnAndRow(0, $row)->getValue();
			$date = (string)$sheet->getCellByColumnAndRow(0, $row)->getFormattedValue();
			$value = $sheet->getCellByColumnAndRow(1, $row)->getValue();
		  	$input[$date] = array("date"=> $date_raw, "value" => $value);
		}
		return $input;
	}

	/*static function ParseXLS($file){
		$PHPExcel = PHPExcel_IOFactory::load($file);
		$sheet = $PHPExcel->getActiveSheet();
		$rows = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		$columns = PHPExcel_Cell::columnIndexFromString($highestColumn);

		$input = array();

		for ($row = 2; $row <= $rows; $row++) {
			$item = new VideoData();
			$item->title = $sheet->getCellByColumnAndRow(0, $row)->getValue();	
			$item->day = $sheet->getCellByColumnAndRow(2, $row)->getValue();	
			$item->date = self::ParseDate($sheet->getCellByColumnAndRow(2, $row+1)->getCalculatedValue());	
			$item->length = self::ParseLength($sheet->getCellByColumnAndRow(3, $row)->getValue());	
			$item->lengthstr = $sheet->getCellByColumnAndRow(3, $row)->getValue();	
			$item->views = floatval($sheet->getCellByColumnAndRow(4, $row)->getCalculatedValue());	
			$item->rating = floatval($sheet->getCellByColumnAndRow(5, $row)->getCalculatedValue());	
			$item->comments = floatval($sheet->getCellByColumnAndRow(6, $row)->getCalculatedValue());	
			$item->subs = floatval($sheet->getCellByColumnAndRow(8, $row)->getCalculatedValue());
			$row++;	
		  	$input[] = $item;
		}
		return $input;
	}

	static function ParseDate($data){
		$str = trim($data);
		$arr = explode('/',$str);
		$month = filter_var($arr[0], FILTER_SANITIZE_NUMBER_INT);
		$day = filter_var($arr[1], FILTER_SANITIZE_NUMBER_INT);
		$date = date("Y-m-d", mktime(0, 0, 0, $month, $day, date('Y', time()) ) );
		return $date;
	}
	static function ParseLength($data){
		$str = trim($data);
		if($str[0] === ":") $str = "0".$str;
		$arr = explode(':',$str);
		$length = 0;

		for ($part = 1; $part <= count($arr); $part++) {
			$length += $arr[$part-1] * pow(60, count($arr)-$part);			
		}

		return $length;
	}*/

}
?>