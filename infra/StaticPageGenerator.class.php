<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class StaticPageGenerator extends SubFolderFriendly implements Infra {
		
		protected $pageTemplate;
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->setSubFolderName("singlepage");
			
			$this->pageTemplate = new Template($this->getDataFilePath("static")."template-artical.html");
		}
		
		public function routeArray($routeArray) {
			$markdownFilePath = $this->getDataFilePath().$routeArray[0].".md";
			$this->pageTemplate->set("content", "<h1>Test Header</h1><p>Test Paragraph.</p>");
		}
		
		public function renderPage() {
			echo $this->pageTemplate->render();
		}
	}
?>