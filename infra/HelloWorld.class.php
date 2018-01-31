<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	/*
	This is a sample HelloWorld infra(Model).
	This infrastructure simply print a "Hello World!" out.
	
	As a scaffold model, just duplicate this file, rename the class name and file name,
	and add the stuff you needed like TemplateEngine into this infra, it's done!
	
	Don't forget go to index.php and add route rule to this infra so router will know what to do!
	*/
	class HelloWorld extends SubFolderFriendly implements Infra {
		
		public function __construct($config) { // Argument(s) are optional, but pass a Config class is useful.
			if ($config == null || !is_a($config, "Config")) exit("(O_O)"); // check the value is a Config class.
			$this->dataFilePath = $config->dataFolderPath; // this line is neccessary if this infra is `SubFolderFriendly`
			$this->setSubFolderName("hello"); // dig into `SubFolderFriendly` class and check out when we need this.
		}
		
		public function routeArray($routeArray) {}
		
		public function renderPage() {
			/*
			if you don't use any Infra as a subInfra, you can just use `echo` in `renderPage()`
			But if you do use any subInfra, use return to return the content you've constructed.
			Check out the TemplateEngine source code to see why.
			*/ 
			//echo $this->getDataFilePath(); // Uncomment this and play with it!
			return "Hello World!<br/>";
		}
	}
?>