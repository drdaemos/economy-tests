<?php 
class StatsParserWB{
	public static $dates = array("2003","2004","2005","2006","2007","2008","2009","2010","2011","2012");
	public static $indices = array(
		"net" => "GC.BAL.CASH.GD.ZS",
		"unemployment" => "SL.UEM.TOTL.NE.ZS",
		"cpi" => "FP.CPI.TOTL", 
		"wpi" => "FP.WPI.TOTL", 
		"gdp" => "NY.GDP.PCAP.PP.CD",
		"gni" => "NY.GNP.PCAP.PP.CD"
		);
	public static $files = array(
		"USA" => "usa_Country_en_excel_v2.xlsx", 
		"Russia" => "rus_Country_en_excel_v2.xlsx", 
		"Germany" => "deu_Country_en_excel_v2.xlsx",
		// "India" => "ind_Country_en_excel_v2.xlsx", 
		// "Brazil" => "bra_Country_en_excel_v2.xlsx",
		"Ukraine" => "ukr_Country_en_excel_v2.xlsx",
		"Greece" => "grc_Country_en_excel_v2.xlsx"
		);

	static function ParseData(){
		$db = ORM::get_db();
	    $db->beginTransaction();
	    $db->exec('TRUNCATE data');
	    $db->exec('TRUNCATE country');
	    $db->commit();
		echo "cleared<br>";
		$data = array();
		$compiled = array();
		foreach (self::$files as $country_name => $file) {
			set_time_limit(30);
			echo "parsing $country_name<br>";
			$country = ORM::for_table('country')->create();
			$country->name = $country_name;
			$country->save();
			try {
				$data_rows = self::ParseXLS("data/".$file);
			} catch (Exception $e){
				var_dump($e);
			}
			var_dump($data_rows);
			foreach ($data_rows as $index => $row) {
				$data_item = ORM::for_table('data')->create();
				$data_item->date = $row["date"];
				$data_item->wpi = $row["wpi"];
				$data_item->cpi = $row["cpi"];
				$data_item->net = $row["net"];
				$data_item->unemployment = $row["unemployment"];
				$data_item->gdp = $row["gdp"];
				$data_item->gni = $row["gni"];
				$data_item->country_id = $country->id();
				$data_item->save();
			}
			echo "done! $country_name<br>";
		}
	}

	static function ParseXLS($file){
		$PHPExcel = PHPExcel_IOFactory::load($file);
		//$PHPExcel->setReadDataOnly(true);
		$sheet = $PHPExcel->setActiveSheetIndex(0);
		$rows = $sheet->getHighestRow();
		$columns = PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());

		$date_columns = array();
		foreach (self::$dates as $date) {			
			$date_columns[$date] = self::SearchColumnByValue($date, 3, $sheet);
		}
		$data_rows = array();		
		foreach (self::$indices as $key => $name) {			
			$data_rows[$key] = self::SearchRowByValue($name, 3, $sheet);
		}

		$input = array();

		foreach ($date_columns as $date => $column) {
			$item = array("date" => $date);
			foreach ($data_rows as $index => $row) {
				$item[$index] = $sheet->getCellByColumnAndRow($column, $row)->getValue();
			}
			$input[] = $item;
		}
		$PHPExcel->disconnectWorksheets();
		unset($PHPExcel);

		return $input;
	}

	static function SearchColumnByValue($value, $row, $sheet){
		$columns = PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());
		for($column = 0; $column <= $columns; $column++){
			$cell = $sheet->getCellByColumnAndRow($column, $row);
			$input = $cell->getValue();
			if($value === $input){
				return $column;
			}
		}
		return false;
	}

	static function SearchRowByValue($value, $column, $sheet){
		$rows = $sheet->getHighestRow();
		for($row = 1; $row <= $rows; $row++){
			$cell = $sheet->getCellByColumnAndRow($column, $row);
			$input = $cell->getValue();
			if($value === $input){
				return $row;
			}
		}
		return false;
	}

}
?>