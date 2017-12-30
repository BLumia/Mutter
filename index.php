<?php
	define("MUTTER", "Mutter is a simple and stupid blogging system.");
	define("MUTTER_PATH", dirname(__FILE__));
	
	require_once('./core/TemplateEngine.class.php');
	require_once('./core/RouteStrategy.class.php');
	require_once('./core/Config.class.php');
	require_once('./core/SubFolderFriendly.class.php');
	require_once('./core/Infrastructure.interface.php');
	
	require_once('./infra/PostList.class.php');
	require_once('./infra/PageGenerator.class.php');
	require_once('./infra/StaticFiles.class.php');
	
	function GIVEMETHEFUCKINGUTF8($text) {
		return iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
	}
	
	function getFileExtension($fileName) {
		$explodeArr = explode('.',$fileName);
		$explodeArr = array_reverse($explodeArr);  
		return strtolower($explodeArr[0]);
	}
	
	$config = new Config();
	
	$router = new Routing();
	$router->add("blog", new PostList());
	$router->add("about", new PageGenerator($config));
	$router->add("static", new StaticFiles($config));
	$router->setDefault("blog");
	$router->doWork();