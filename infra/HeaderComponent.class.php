<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class HeaderComponent extends SubFolderFriendly implements Infra {
		
		protected $pageTemplate;
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->subFolderName = "static";
			
			$this->pageTemplate = new Template($this->getDataFilePath("static")."template-header.html");
			$this->pageTemplate->set("title", $config->siteHeaderText);
			$this->pageTemplate->set("subtitle", $config->siteSubHeaderText);
		}
		
		public function routeArray($routeArray) {}
		
		public function renderPage() {
			return $this->pageTemplate->render();
		}
	}
?>