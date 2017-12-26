<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class PageGenerator implements Infra, SubFolderFriendly {
		
		protected $dataFilePath;
		protected $subFolderName = "post";
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
		}
		
		protected function getDataFilePath() {
			return "{$this->dataFilePath}/{$this->subFolderName}/";
		}
		
		public function setSubFolderName($newSubFolderName) {
			if (is_string($newSubFolderName)) $subFolderName = $newSubFolderName;
			else exit("(*.*)");
		}
		
		public function routeArray($routeArray) {}
		
		public function renderPage() {
			echo "whoa dude";
		}
	}
?>