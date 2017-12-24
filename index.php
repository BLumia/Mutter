<?php
	$curPath = dirname(__FILE__);
	$markdownFolderPath = $curPath; // Change this if you'd like to put your song folders into a sub folder or somewhere else.
	$allowedExts = array("md", "markdown", "bmd");
	define("MUTTER", "Mutter is a simple and stupid blogging system.");
	
	require_once('./core/TemplateEngine.class.php');
	require_once('./core/RouteStrategy.class.php');
	require_once('./core/Infrastructure.interface.php');
	
	require_once('./core/PostList.class.php');
	
	function GIVEMETHEFUCKINGUTF8($text) {
		return iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
	}
	
	function getFileExtension($fileName) {
		$explodeArr = explode('.',$fileName);
		$explodeArr = array_reverse($explodeArr);  
		return strtolower($explodeArr[0]);
	}
	
	$router = new Routing();
	$router->add("blog", new PostList());
	$router->setDefault("blog");
	$router->doWork();