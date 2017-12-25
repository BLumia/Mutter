<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class StaticFiles implements Infra {
		
		protected $shiftedArray;
		protected $dataFilePath;
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath."/static/";
		}
		
		public function routeArray($routeArray) {
			if (count($routeArray) <= 1) $this->shiftedArray = array();
			else {
				// for safe.
				if (in_array("..", $routeArray)) $routeArray = array();
				else array_shift($routeArray);
				$this->shiftedArray = $routeArray;
			}
		}
		
		public function renderPage() {
			$fileLocation = $this->dataFilePath.implode("/", $this->shiftedArray);
			var_dump(is_file($fileLocation));
		}
	}
?>