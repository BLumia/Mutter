<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	/*
	Util functions
	*/
	function GIVEMETHEFUCKINGUTF8($text) {
		return iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
	}
	
	function getFileExtension($fileName) {
		$explodeArr = explode('.',$fileName);
		$explodeArr = array_reverse($explodeArr);  
		return strtolower($explodeArr[0]);
	}
	
	function tryYAMLFrontMatter(&$content, $removeFrontMatter = false) {
	/*
		Try parse YAML Front-Matter from content
		More about front-matter, please refer to: https://hexo.io/docs/front-matter.html
		@param $content Content which may include YAML front matter
		@param $removeFrontMatter If there is YAML front matter, remove it from $content ?
	*/
		$_content = substr($content, 0, 300);
		$canFound = strpos($_content, '---');
		if ($canFound === false) return false;
		
		$resultArr = array();
		
		$_content = substr($_content, 0, $canFound);
		$rawFrontMatter = explode("\n", $_content);
		foreach($rawFrontMatter as $aLine) {
			$aLine = trim($aLine);
			if (empty($aLine)) continue;
			$findColon = strpos($aLine, ':');
			if ($findColon === false) return false;
			$key = trim(substr($aLine, 0, $findColon)); 
			$value = trim(substr($aLine, $findColon + 1)); 
			if (empty($key)) return false;
			$resultArr[$key] = $value;
		}
		
		if ($removeFrontMatter) $content = substr($content, $canFound + 4);
		return $resultArr;
	}
	
	function fire($status, $message, $result = null) {
	/*
		Return json payload or HTTP status code other than 200
		@param $status HTTP Status Code
		@param $message Message for reason of that HTTP status.
		@param $result payload, as an array, will be converted to json.
	*/
		if ($result == null) unset($result);
		$httpStatusCode = array( 
			200 => "HTTP/1.1 200 OK",
			400 => "HTTP/1.1 400 Bad Request",
			401 => "HTTP/1.1 401 Unauthorized",
			403 => "HTTP/1.1 403 Forbidden",
			404 => "HTTP/1.1 404 Not Found",
			500 => "HTTP/1.1 500 Internal Server Error",
			501 => "HTTP/1.1 501 Not Implemented",
			503 => "HTTP/1.1 503 Service Unavailable",
			504 => "HTTP/1.1 504 Gateway Time-out"
		);
		if (function_exists('http_response_code')) {
			http_response_code(intval($status));
		} else {
			@header($httpStatusCode[$status]);
		}
		@header('Content-Type: application/json');
		exit(json_encode(compact("status", "message", "result")));
	}
?>