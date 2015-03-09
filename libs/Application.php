<?php
class Application{
	private static $instance;
	public $twig;
	public $config;
	public $router;

	public function __construct() {
		$this->loadAppConfig();
		$this->loadTwig();
		$this->initORM();
		$this->router = new Router($this);
	}	

	static function getInstance(){
 		if (null === self::$instance) {
            // создаем новый экземпляр
            self::$instance = new self();
        }
        // возвращаем созданный или существующий экземпляр
        return self::$instance;
	}

	public function run(){		
		$this->router->handleRequest();
	}

	public function notFound( $callable = null ) {
        if ( !is_null($callable) ) {
            $this->router->notFound($callable);
        } else {
            ob_start();
            $customNotFoundHandler = $this->router->notFound();
            if ( is_callable($customNotFoundHandler) ) {
                call_user_func($customNotFoundHandler);
            }
            $this->halt(404, ob_get_clean());
        }
    }

    public function error( $callable = null ) {
        if ( !is_null($callable) && $callable instanceof Exception === false ) {
            $this->router->error($callable);
        } else {
            ob_start();
            $customErrorHandler = $this->router->error();
            if ( is_callable($customErrorHandler) ) {
                call_user_func_array($customErrorHandler, array($callable));
            }
            $this->halt(500, ob_get_clean());
        }
    }

    public function halt( $code, $message = '') {
        if ( ob_get_level() !== 0 ) {
            ob_clean();
        }
        $this->status($code);
        echo $message;
        die();
    }

    public function status($code){
		if ( !is_null($code) ) {
            if ( !in_array(intval($code), array_keys(self::$messages)) ) {
                throw new InvalidArgumentException('Cannot set Response status. Provided status code "' . $code . '" is not a valid HTTP response code.');
            }
            $this->status = intval($code);
        }
        header($_SERVER["SERVER_PROTOCOL"]." ".$this->status);
    }

	//routes
	public function get($pattern, $callable, $defaults = null){
		$this->router->addRoute($pattern, "GET", $defaults, $callable);
	}
	public function post($pattern, $callable, $defaults = null){
		$this->router->addRoute($pattern, "POST", $defaults, $callable);
	}
	public function put($pattern, $callable, $defaults = null){
		$this->router->addRoute($pattern, "PUT", $defaults, $callable);
	}
	public function delete($pattern, $callable, $defaults = null){
		$this->router->addRoute($pattern, "DELETE", $defaults, $callable);
	}
    public function respond($pattern, $methods, $callable, $defaults = null){
        $this->router->addRoute($pattern, $methods, $defaults, $callable);
    }

	private function loadAppConfig(){
		require_once 'AppConfig.php';
		$this->config = $config;
	}

	private function loadTwig(){
		$loader = new Twig_Loader_Filesystem($this->config["twig"]["templates"]); //TODO: introduce config var

		$twig = new Twig_Environment($loader, array(  //TODO: introduce config var
		  'cache' => $this->config["twig"]["cache"],'debug' => $this->config["debug"]));
		
		$invFilter = new Twig_SimpleFilter('colorinverse', array('Utils', 'color_inverse'));
		$conFilter = new Twig_SimpleFilter('colorcontrast', array('Utils', 'color_contrast'));
		$twig->addFilter($invFilter);
		$twig->addFilter($conFilter);
		$this->twig = $twig;
	}

	private function getDbConnection($db = null){
		if(empty($db)){
			return $this->config["dbConnections"][$this->config["db"]];
		} else {			
			return $this->config["dbConnections"][$db];
		}
	}

	private function initORM(){
		$connection = $this->getDbConnection();

		ORM::configure(array(
		    'connection_string' => "mysql:host=$connection[host];dbname=$connection[db]",
		    'username' => $connection["username"],
		    'password' => $connection["password"]
		));
		ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $connection[charset]"));
		ORM::configure('return_result_sets', true);
	}

	/**
     * @var array HTTP response codes and messages
     */
    protected static $messages = array(
        //Informational 1xx
        100 => '100 Continue',
        101 => '101 Switching Protocols',
        //Successful 2xx
        200 => '200 OK',
        201 => '201 Created',
        202 => '202 Accepted',
        203 => '203 Non-Authoritative Information',
        204 => '204 No Content',
        205 => '205 Reset Content',
        206 => '206 Partial Content',
        //Redirection 3xx
        300 => '300 Multiple Choices',
        301 => '301 Moved Permanently',
        302 => '302 Found',
        303 => '303 See Other',
        304 => '304 Not Modified',
        305 => '305 Use Proxy',
        306 => '306 (Unused)',
        307 => '307 Temporary Redirect',
        //Client Error 4xx
        400 => '400 Bad Request',
        401 => '401 Unauthorized',
        402 => '402 Payment Required',
        403 => '403 Forbidden',
        404 => '404 Not Found',
        405 => '405 Method Not Allowed',
        406 => '406 Not Acceptable',
        407 => '407 Proxy Authentication Required',
        408 => '408 Request Timeout',
        409 => '409 Conflict',
        410 => '410 Gone',
        411 => '411 Length Required',
        412 => '412 Precondition Failed',
        413 => '413 Request Entity Too Large',
        414 => '414 Request-URI Too Long',
        415 => '415 Unsupported Media Type',
        416 => '416 Requested Range Not Satisfiable',
        417 => '417 Expectation Failed',
        //Server Error 5xx
        500 => '500 Internal Server Error',
        501 => '501 Not Implemented',
        502 => '502 Bad Gateway',
        503 => '503 Service Unavailable',
        504 => '504 Gateway Timeout',
        505 => '505 HTTP Version Not Supported'
    );

}
?>