<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class StaticFiles extends SubFolderFriendly implements Infra {
		
		protected $shiftedArray;
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->subFolderName = "static";
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
			if (is_file($fileLocation)) {
				$ext = getFileExtension($fileLocation);
				switch ($ext) {
					case "css": @header('Content-Type: text/css'); break;
				}
				return file_get_contents($fileLocation);
			}
			else exit("(qwq)");
		}
	}
?>