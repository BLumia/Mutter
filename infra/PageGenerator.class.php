<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class PageGenerator extends SubFolderFriendly implements Infra {
		
		protected $pageTemplate;
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->setSubFolderName("posts");
			
			$this->pageTemplate = new Template($this->getDataFilePath("static")."template-artical.html");
		}
		
		public function routeArray($routeArray) {
			$content = "";
			if (count($routeArray) <= 1) $content = "<h1>Oops.</h1><p>Post not found.</p>";
			else {
				$fileName = urldecode($routeArray[1]).".md";
				$filePath = $this->getDataFilePath().$fileName;
				if (file_exists($filePath)) {
					$Parsedown = new Parsedown();
					$content = $Parsedown->text(file_get_contents($filePath, null, null, 0, 20000));//$routeArray[1];
				} else {
					$content = "<h1>Oops.</h1><p>Post not found.</p>";
				}
			}
			$this->pageTemplate->set("content", $content);
		}
		
		public function renderPage() {
			echo $this->pageTemplate->render();
		}
	}
?>