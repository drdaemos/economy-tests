<?php
class Route{
	public $pattern;
	public $patternTokens;
	public $callable;
	public $methods;
	public $defaults;

	public $controller;
	public $action;
	public $requestVars;

	public $priority;

	public function __construct($pattern, $methods, $defaults, $callable) {
		$this->priority = 0;
		$this->pattern = $pattern;
		$this->callable = $callable;
		$this->defaults = $defaults;		
		$this->methods = explode(',', $methods);
		if(isset($defaults["controller"])){
			$this->controller = $defaults["controller"];			
		}
		if(isset($defaults["action"])){
			$this->action = $defaults["action"];
		}
		$this->patternTokens = array_values(array_filter(explode('/', $pattern), 'mb_strlen'));
	}

	public function match($request){
		if(!in_array($request->method, $this->methods)){
			return false;
		}
		$index = 0;
		if(!empty($this->patternTokens)){
			foreach ($this->patternTokens as $index => $token) {
				if(!isset($request->tokens[$index])){
					return false;
				}
				if($token === "{ctrl}"){
					$this->priority -= 3;					
					$this->controller = $request->tokens[$index];
				} else if($token === "{action}"){					
					$this->priority -= 2;			
					$this->action = $request->tokens[$index];					
				} else if(preg_match("/{\w+}/i", $token)){	
					$this->requestVars[trim($token, '{}')] = $request->tokens[$index];
				} else {
					$this->priority += 1;	
					if($token !== $request->tokens[$index]){
						return false;
					}					
				}
			}
		} else {
			if(!empty($request->tokens)){
				return false;
			} 
		}
		if($index < count($request->tokens)-1){
			$this->priority -= 3;
		}
		for($i = $index; $i < count($request->tokens)-1; $i++){
			$this->priority -= 1;	
		}


		return true;
	}
}
?>