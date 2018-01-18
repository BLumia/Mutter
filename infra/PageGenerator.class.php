<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class PageGenerator extends SubFolderFriendly implements Infra {
		
		protected $pageTemplate;
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->setSubFolderName("post");
			
			$this->pageTemplate = new Template($this->getDataFilePath("static")."template-artical.html");
			$this->pageTemplate->set("test", "<h1>Test Header</h1><p>Test Paragraph.</p>");
		}
		
		public function routeArray($routeArray) {}
		
		public function renderPage() {
			echo $this->pageTemplate->render();
		}
	}
?>