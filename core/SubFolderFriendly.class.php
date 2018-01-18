<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	/*
	Extend this class if one Infra (Module) use a sub folder.
	We recommend you leave a default value for $this->subFolderName in Infra class' `__construct` function, 
	so it can also works well as a sub infra.
	
	We don't need subclass this class if one infra doesn't need to work with file system access
	or you wanna deal with it by yourself.
	*/
	class SubFolderFriendly {
		
		protected $dataFilePath;
		protected $subFolderName;
		
		protected function getDataFilePath($folderName = null) {
			if ($folderName == null) return "{$this->dataFilePath}/{$this->subFolderName}/";
			return "{$this->dataFilePath}/{$folderName}/";
		}
		
		public function setSubFolderName($newSubFolderName) {
			if (is_string($newSubFolderName)) $this->subFolderName = $newSubFolderName;
			else exit("(*.*)");
		}
	}
?>