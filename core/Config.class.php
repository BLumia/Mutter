<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	/*
	Config for Infra (Module), the Mutter core doesn't need a config.
	*/
	class Config {
		public $dataFolderPath;
		public $markdownExts = array("md", "markdown", "bmd");
		
		public function __construct() {
			if (defined("MUTTER_PATH")) $this->dataFolderPath = MUTTER_PATH;
		}
	}
?>