<?php
class ApiController extends Controller{
	public function GetUsedCountries(){
		$data = DataModel::GetUsedCountries();
		echo json_encode($data);
	}
	public function GetData(){
		$data = DataModel::GetData();
		echo json_encode($data);
	}
	public function GetKmeansTest(){
		$data = DataModel::GetDataAsObject();
		$analysis = DataAnalysis::KMeansTest($data);
		echo json_encode($analysis);
	}
	public function GetRegressionTest(){
		$countries = DataModel::GetUsedCountriesAsObject();
		foreach ($countries as &$country) {
			$regression = DataAnalysis::MultiRegression($country["data"]);
			$regression1d = DataAnalysis::Regression1D($country["data"], "gni");
			$country["regression"] = $regression->GetData();
			$country["regression1d"] = $regression1d->GetData();
			$country["data"] = DataModel::GetDataByCountry($country["id"]);
		}

		echo json_encode($countries);
	}
}
?>