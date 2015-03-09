<?php
class Utils{
	static function mb_ucfirst($str) {
		$fc = mb_strtoupper(mb_substr($str, 0, 1));
		return $fc.mb_substr($str, 1);
	}

	static function sortByColumn(&$array, $column, $direction = SORT_ASC){
		$sortby = array();
		foreach ($array as $key => $row)
		{
			$sortby[$key] = $row[$column];
		}
		array_multisort($sortby, $direction, $array);
	}
	static function color_contrast($color){		
		$r = hexdec(substr($color,1,2));
		$g = hexdec(substr($color,3,2));
		$b = hexdec(substr($color,5,2));
		$yiq = (($r*299)+($g*587)+($b*114))/1000;
		return ($yiq >= 128) ? '#000000' : '#ffffff';
	}

	static function color_inverse($color){
		$color = str_replace('#', '', $color);
		if (strlen($color) != 6){ return '000000'; }
		$rgb = '';
		for ($x=0;$x<3;$x++){
			$c = 255 - hexdec(substr($color,(2*$x),2));
			$c = ($c < 0) ? 0 : dechex($c);
			$rgb .= (strlen($c) < 2) ? '0'.$c : $c;
		}
		return '#'.$rgb;
	}
	
	static function splitPrice($input){		
		$min_rate = 0;
		$max_rate = 0;
		if(is_numeric($input)){
			$min_rate += $input;
			$max_rate += $input;
		} else {
			$split = explode("-", $input);
			if(!empty($split)){
				$min_rate += trim($split[0]);
				$max_rate += trim($split[1]);
			}
		}
		return array("min" => $min_rate, "max" => $max_rate);
	}

	static function getColumn($array, $column_name = 'id'){
		return $array[$column_name];
	}

	static function maybePost($var_name){
		return isset($_POST[$var_name]) ? $_POST[$var_name] : null;
	}

	static function maybeGet($var_name){		
		return isset($_GET[$var_name]) ? $_GET[$var_name] : null;
	}

	static function requirePost($var_name){
		$var = isset($_POST[$var_name]) ? $_POST[$var_name] : null;
		if(empty($var)){
			header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
			echo "$var_name is empty"; 
			die();
		} else {
			return $var;
		}
	}

	static function createPath($path) {
		if (is_dir($path)) return true;
		$prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
		$return = self::CreatePath($prev_path);
		return ($return && is_writable($prev_path)) ? mkdir($path) : false;
	}

	static function sanitizeName($string){
		$str = self::Translit($string);
		$str = mb_strtolower($str);
		$str = preg_replace("/[\W]/", "_", $str);
		return $str;
	}
	
	static function translit($text) {
	$text = preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml|caron);~i', '$1', htmlentities($text, ENT_QUOTES, 'UTF-8'));
	$trans = array(
							"а" => "a",
							"б" => "b",
							"в" => "v",
							"г" => "g",
							"д" => "d",
							"е" => "e",
							"ё" => "e",
							"ж" => "zh",
							"з" => "z",
							"и" => "i",
							"й" => "y",
							"к" => "k",
							"л" => "l",
							"м" => "m",
							"н" => "n",
							"о" => "o",
							"п" => "p",
							"р" => "r",
							"с" => "s",
							"т" => "t",
							"у" => "u",
							"ф" => "f",
							"х" => "kh",
							"ц" => "ts",
							"ч" => "ch",
							"ш" => "sh",
							"щ" => "shch",
							"ы" => "y",
							"э" => "e",
							"ю" => "yu",
							"я" => "ya",
							"А" => "A",
							"Б" => "B",
							"В" => "V",
							"Г" => "G",
							"Д" => "D",
							"Е" => "E",
							"Ё" => "E",
							"Ж" => "Zh",
							"З" => "Z",
							"И" => "I",
							"Й" => "Y",
							"К" => "K",
							"Л" => "L",
							"М" => "M",
							"Н" => "N",
							"О" => "O",
							"П" => "P",
							"Р" => "R",
							"С" => "S",
							"Т" => "T",
							"У" => "U",
							"Ф" => "F",
							"Х" => "Kh",
							"Ц" => "Ts",
							"Ч" => "Ch",
							"Ш" => "Sh",
							"Щ" => "Shch",
							"Ы" => "Y",
							"Э" => "E",
							"Ю" => "Yu",
							"Я" => "Ya",
							"ь" => "",
							"Ь" => "",
							"ъ" => "",
							"Ъ" => "",
					);
	if(preg_match("/[а-яА-Яa-zA-Z\.]/", $text)) {
			return strtr($text, $trans);  
	}
	else {
			return $text;
	}                               
}
}
?>