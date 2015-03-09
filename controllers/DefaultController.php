<?php
class DefaultController extends Controller{
	public function Index(){

		echo $this->view->render(array("title" => "Why are you seeing this?"));		
	}

	public function Input(){
		$data = DataModel::GetUsedCountries();
		echo $this->view->render(array("title" => "Input data", "data" => $data));		
	}

	public function Regression(){		

		echo $this->view->render(array("title" => "Regression Tests"));		
	}

	public function Clusters(){
		echo $this->view->render(array("title" => "K-means clustering"));		
	}
	public function ParseData(){
		StatsParserWB::ParseData();
		echo "yay!";
	}

	public function Project(){

		echo $this->view->render(array("title" => "Project data and diagrams"));		
	}
	static function NotFound(){
		$app = Application::getInstance();
		$view = $app->twig->loadTemplate('notfound.twig');
		echo $view->render(array());
	}
	static function Error(){
		$app = Application::getInstance();
		$view = $app->twig->loadTemplate('error.twig');
		echo $view->render(array());
	}
}
?>