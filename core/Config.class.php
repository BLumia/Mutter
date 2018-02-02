<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	/*
	Config for Infra (Module), although an Infra doesn't always need a config.
	*/
	class Config {
		public $dataFolderPath;
		public $markdownExts = array("md", "markdown", "bmd");
		public $siteHeaderText = "The Big Site Title";
		public $siteSubHeaderText = "Sub title should be long.";
		
		public function __construct() {
			if (defined("MUTTER_PATH")) $this->dataFolderPath = MUTTER_PATH."/data/";
		}
	}
?>