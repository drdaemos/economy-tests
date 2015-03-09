<?php 
class DataModel{
	static function GetUsedCountries(){
		$countries = ORM::for_table('country')->where("used", 1)->find_array();
		foreach ($countries as &$country) {
			$country["data"] = self::GetDataByCountry($country["id"]);						
		}
		return $countries;
	}
	static function GetUsedCountriesAsObject(){
		$countries = ORM::for_table('country')->where("used", 1)->find_array();
		foreach ($countries as &$country) {
			$country["data"] = self::GetDataByCountryAsObject($country["id"]);						
		}
		return $countries;
	}
	static function GetDataByCountry($country_id){
		return ORM::for_table('data')->where('country_id', $country_id)->find_array();
	}
	static function GetDataByCountryAsObject($country_id){
		return ORM::for_table('data')->where('country_id', $country_id)->find_many();
	}
	static function GetData(){
		return ORM::for_table('data')->find_array();
	}
	static function GetDataAsObject(){
		return ORM::for_table('data')->find_many();
	}
}
?>