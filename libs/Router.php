<?php
class Router {
	public $request;
	public $routes = array();
	public $route;
	public $app;
	public $notFound;
	public $error;

	public function __construct($app) {
		$this->app = $app;
		$this->notFound = $this->app->config["notFound"];
		$this->error = $this->app->config["error"];
	}
	public function handleRequest(){		
		$uri = $_SERVER["REQUEST_URI"]; //TODO: maybe $_SERVER["REDIRECT_URL"] ???
		$method = $_SERVER["REQUEST_METHOD"];

		//clean from GET vars 
		if(mb_stristr($uri, '?', true)){
	   		$uri = mb_stristr($uri, '?', true);
	    }

	    //TODO: clean hash?
	    
	    //TODO: maybe urldecode for russian chars?
	    $tokens = array_values(array_filter(explode('/', $uri), 'mb_strlen')); //split
	    $tokens = array_map('strtolower', $tokens);

	    $this->request = new Request($uri, $method, $tokens);
	    $this->match($this->request);	    
	}	

	public function match($request){
		$matches = array();
		$route = null;
		if(empty($this->routes)){
			$this->app->error();
		} 
		if(empty($request)){		
			$this->app->error();
		}
		foreach ($this->routes as $route) {
			if($route->match($request)){
				$matches[] = $route;
			}
		}
		if(empty($matches)){
			$this->app->notFound();
		}
		$this->route = array_reduce($matches, 'Router::topPriorityRoute');

		$this->execute($this->route);
	}

	public function execute($route){
		//TODO: refactor

		if(!empty($route->callable)){
			$call = $route->callable;
			return call_user_func($call);
		}
		$ctrlClass = Utils::mb_ucfirst($route->controller)."Controller";
		$action = $route->action;

		$pathToView = mb_strtolower($route->controller)."/".mb_strtolower($action).$this->app->config["twig"]["extension"];
		try{			
			if(class_exists($ctrlClass)){
				$controller = new $ctrlClass();
			} else throw new Exception('No controller found by name '.$route->controller);
			if(method_exists($controller,$action)){	
				Debug::ToFile("||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||");
				Debug::ToFile("------------- NEW REQUEST --------------------------------------------------------");
				Debug::ToFile("Searching $pathToView");
				try{
					$view = $this->app->twig->loadTemplate($pathToView);
					$controller->view = $view;			
				} catch (Exception $e) {
					Debug::ToFile("No view loaded for ".$route->controller."-> $action. Exception: ".$e->getMessage());
				}				
				Debug::ToFile("Calling ".$route->controller."->$action");	
				try{
					return $controller->$action($route->requestVars);
				} catch (Exception $e) {		
					Debug::ToFile($e);
				}	
			} else throw new Exception('No action found for '.$route->controller.'->'.$route->action);
		} catch (Exception $e) {			
			Debug::ToFile($e);
			$this->app->notFound();
		}
	}

	public function addRoute($pattern, $methods, $defaults, $callable){
		$this->routes[] = new Route($pattern, $methods, $defaults, $callable);		
	}

	/**
     * Register a 404 Not Found callback
     * @param   mixed $callable Anything that returns TRUE for is_callable()
     * @return  mixed
     */
    public function notFound( $callable = null ) {
        if ( is_callable($callable) ) {
            $this->notFound = $callable;
        }
        return $this->notFound;
    }

    /**
     * Register a 500 Error callback
     * @param   mixed $callable Anything that returns TRUE for is_callable()
     * @return  mixed
     */
    public function error( $callable = null ) {
        if ( is_callable($callable) ) {
            $this->error = $callable;
        }
        return $this->error;
    }

	static function topPriorityRoute($res, $route){
		if(empty($res)){
			return $route;
		} else if($route->priority > $res->priority){
			return $route;
		} else {
			return $res;
		}
	}
}
?>