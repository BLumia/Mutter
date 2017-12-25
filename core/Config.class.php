<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class Config {
		public $dataFolderPath;
		public $markdownExts = array("md", "markdown", "bmd");
		
		public function __construct() {
			if (defined("MUTTER_PATH")) $this->dataFolderPath = MUTTER_PATH;
		}
	}
?>