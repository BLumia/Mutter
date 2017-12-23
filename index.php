<?php
	$curPath = dirname(__FILE__);
	$markdownFolderPath = $curPath; // Change this if you'd like to put your song folders into a sub folder or somewhere else.
	$allowedExts = array("md", "markdown", "bmd");
	
	function GIVEMETHEFUCKINGUTF8($text) {
		return iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
	}
	
	function getUrlRouteArray() {
		return array_values(array_filter(explode("/", $_SERVER['QUERY_STRING']))); 
	}
	
	function getFileExtension($fileName) {
		$explodeArr = explode('.',$fileName);
		$explodeArr = array_reverse($explodeArr);  
		return strtolower($explodeArr[0]);
	}
	
	print_r(getUrlRouteArray());