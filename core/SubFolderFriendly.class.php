<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	/*
	Extend this class if one Infra (Module) use a sub folder.
	We recommend you leave a default value for $this->subFolderName in __construct function, 
	so it can also works well as a sub infra.
	*/
	class SubFolderFriendly {
		
		protected $dataFilePath;
		protected $subFolderName;
		
		protected function getDataFilePath() {
			return "{$this->dataFilePath}/{$this->subFolderName}/";
		}
		
		public function setSubFolderName($newSubFolderName) {
			if (is_string($newSubFolderName)) $subFolderName = $newSubFolderName;
			else exit("(*.*)");
		}
	}
?>