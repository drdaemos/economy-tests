<?php
class Debug {
	/**
	 * Send debug code to the Javascript console
	 */ 
	static function ToJS($data) {
	    if(is_array($data) || is_object($data))
		{
			echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
		} else {
			echo("<script>console.log('PHP: ".$data."');</script>");
		}
	}
	/**
	 * Send debug trace to debug.log
	 */ 
	static function ToFile($data){
		$now = new DateTime();
		$msg = "[ ".$now->format('Y-m-d H:i:s')." ] Debug: ";
		$output = Debug::var_debug($data);
		$msg .= $output."\r\n";
		$log_name = "debug.log";
		file_put_contents($log_name, $msg, FILE_APPEND | LOCK_EX);
	}

	static function var_dump_str()
	{
	    $argc = func_num_args();
	    $argv = func_get_args();

	    if ($argc > 0) {
	        ob_start();
	        call_user_func_array('var_dump', $argv);
	        $result = ob_get_contents();
	        ob_end_clean();
	        return $result;
	    }
	    return '';
	}
	static function var_debug ($variable,$strlen=100,$width=25,$depth=10,$i=1,&$objects = array()){
		$search = array("\0", "\a", "\b", "\f", "\n", "\r", "\t", "\v");
		$replace = array('\0', '\a', '\b', '\f', '\n', '\r', '\t', '\v');

		$string = '';

		switch(gettype($variable)) {
		case 'boolean':      $string.= $variable?'true':'false'; break;
		case 'integer':      $string.= $variable;                break;
		case 'double':       $string.= $variable;                break;
		case 'resource':     $string.= '[resource]';             break;
		case 'NULL':         $string.= "null";                   break;
		case 'unknown type': $string.= '???';                    break;
		case 'string':
		  $len = strlen($variable);
		  $variable = str_replace($search,$replace,substr($variable,0,$strlen),$count);
		  $variable = substr($variable,0,$strlen);
		  if ($len<$strlen) $string.= '"'.$variable.'"';
		  else $string.= 'string('.$len.'): "'.$variable.'"...';
		  break;
		case 'array':
		  $len = count($variable);
		  if ($i==$depth) $string.= 'array('.$len.') {...}';
		  elseif(!$len) $string.= 'array(0) {}';
		  else {
		    $keys = array_keys($variable);
		    $spaces = str_repeat(' ',$i*2);
		    $string.= "array($len)\n".$spaces.'{';
		    $count=0;
		    foreach($keys as $key) {
		      if ($count==$width) {
		        $string.= "\n".$spaces."  ...";
		        break;
		      }
		      $string.= "\n".$spaces."  [$key] => ";
		      $string.= self::var_debug($variable[$key],$strlen,$width,$depth,$i+1,$objects);
		      $count++;
		    }
		    $string.="\n".$spaces.'}';
		  }
		  break;
		case 'object':
		  $id = array_search($variable,$objects,true);
		  if ($id!==false)
		    $string.=get_class($variable).'#'.($id+1).' {...}';
		  else if($i==$depth)
		    $string.=get_class($variable).' {...}';
		  else {
		    $id = array_push($objects,$variable);
		    $array = (array)$variable;
		    $spaces = str_repeat(' ',$i*2);
		    $string.= get_class($variable)."#$id\n".$spaces.'{';
		    $properties = array_keys($array);
		    foreach($properties as $property) {
		      $name = str_replace("\0",':',trim($property));
		      $string.= "\n".$spaces."  [$name] => ";
		      $string.= self::var_debug($array[$property],$strlen,$width,$depth,$i+1,$objects);
		    }
		    $string.= "\n".$spaces.'}';
		  }
		  break;
		}

		if ($i>0) return $string;

		$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		do $caller = array_shift($backtrace); while ($caller && !isset($caller['file']));
		if ($caller) $string = $caller['file'].':'.$caller['line']."\n".$string;

		echo $string;
	}
}
?>