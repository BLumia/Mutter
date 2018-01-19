<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class PageGenerator extends SubFolderFriendly implements Infra {
		
		protected $pageTemplate;
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->setSubFolderName("page");
			
			$this->pageTemplate = new Template($this->getDataFilePath("static")."template-artical.html");
		}
		
		public function routeArray($routeArray) {
			$content = "";
			if (count($routeArray) <= 1) $content = "<h1>Oops.</h1><p>Post not found.</p>";
			else {
				$Parsedown = new Parsedown();
				$content = $Parsedown->text('# Title!');//$routeArray[1];
			}
			$this->pageTemplate->set("content", $content);
		}
		
		public function renderPage() {
			echo $this->pageTemplate->render();
		}
	}
?>