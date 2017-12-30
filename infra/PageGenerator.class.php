<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class PageGenerator extends SubFolderFriendly implements Infra {
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->subFolderName = "post";
		}
		
		public function routeArray($routeArray) {}
		
		public function renderPage() {
			echo "whoa dude";
		}
	}
?>