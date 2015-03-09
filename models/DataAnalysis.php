<?php
class DataAnalysis{
	static function Regression1D($data, $value){
		$predictors = array();
		$criterion = array();
		foreach ($data as $item) {
			$predictors[] = array(1, $item->date);
			$criterion[] = array($item->$value);
		}
		$test = new Lib_Regression();
		$test->setX($predictors);
		$test->setY($criterion);
		$test->Compute();

		return $test;
	}
	static function PolyRegression1D($data, $value){
		$test = new PolynomialRegression(2); 
		foreach ($data as $item) {
   			$test->addData($item->date_raw, $item->$value); 
		}

 		$coefficients = $test->getCoefficients(); 
 		return $coefficients;
	}

	static function MultiRegression($data){
		$predictors = array();
		$criterion = array();
		foreach ($data as $item) {
			$predictors[] = array(1, $item->wpi, $item->cpi, $item->unemployment, $item->net);
			$criterion[] = array($item->gni);
		}
		$test = new Lib_Regression();
		$test->setX($predictors);
		$test->setY($criterion);
		$test->Compute();

		return $test;
	}

	static function KMeansTest($data){
		$dataset = array();
		foreach ($data as $item) {
			$dataset[] = array($item->wpi, $item->cpi, $item->unemployment, $item->net, $item->gdp, $item->gni);
		}
		$result = ll_kmeans($dataset, 3);
		return $result;
	}
}

?>