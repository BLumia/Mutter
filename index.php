<?php
	define("MUTTER", "Mutter is a simple and stupid blogging system.");
	define("MUTTER_PATH", dirname(__FILE__));
	
	require_once('./core/TemplateEngine.class.php');
	require_once('./core/RouteStrategy.class.php');
	require_once('./core/Config.class.php');
	require_once('./core/SubFolderFriendly.class.php');
	require_once('./core/Infrastructure.interface.php');
	require_once('./core/Utils.Function.php');
	
	require_once('./vendor/Parsedown.php');
	require_once('./vendor/ParsedownExtra.php');
	
	//require_once('./infra/HelloWorld.class.php');
	require_once('./infra/PostList.class.php');
	require_once('./infra/PageGenerator.class.php');
	require_once('./infra/StaticPageGenerator.class.php');
	require_once('./infra/StaticFiles.class.php');
	
	$config = new Config();
	
	$router = new Routing();
	//$router->add("hello", new HelloWorld($config));
	$router->add("posts", new PostList($config));
	$router->add("post", new PageGenerator($config));
	$router->add("about", new StaticPageGenerator($config));
	$router->add("Mutter", new StaticPageGenerator($config));
	$router->add("static", new StaticFiles($config));
	$router->setDefault("posts");
	$router->doWork();