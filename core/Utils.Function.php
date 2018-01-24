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