<?php
class Request{
	public $method;
	public $uri;
	public $tokens;

	public function __construct($uri, $method, $tokens) {
		$this->method = $method;
		$this->uri = $uri;
		$this->tokens = $tokens;
	}
}