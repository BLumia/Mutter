<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class StaticFiles implements Infra {
		
		protected $shiftedArray;
		protected $dataFilePath;
		protected $subFolderName = "static";
		
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
		
		public function routeArray($routeArray) {
			if (count($routeArray) <= 1) $this->shiftedArray = array();
			else { // for safe.
				if (in_array("..", $routeArray)) $routeArray = array();
				else array_shift($routeArray);
				$this->shiftedArray = $routeArray;
			}
		}
		
		public function renderPage() {
			$fileLocation = $this->getDataFilePath().implode("/", $this->shiftedArray);
			if (is_file($fileLocation)) exit(file_get_contents($fileLocation));
			else exit("(qwq)");
		}
	}
?>