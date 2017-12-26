<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
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