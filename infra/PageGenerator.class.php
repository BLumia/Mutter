<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class PageGenerator extends SubFolderFriendly implements Infra {
		
		protected $pageTemplate;
		protected $frontMatter;
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->setSubFolderName("posts");
			
			$this->pageTemplate = new Template($this->getDataFilePath("static")."template-artical.html");
			$this->pageTemplate->setInfra("HeaderComponent", new HeaderComponent($config), null);
		}
		
		public function routeArray($routeArray) {
			$content = "";
			if (count($routeArray) <= 1) $content = "<h1>Oops.</h1><p>Post not found.</p>";
			else {
				$fileName = urldecode($routeArray[1]).".md";
				$filePath = $this->getDataFilePath().$fileName;
				if (file_exists($filePath)) {
					$content = file_get_contents($filePath, null, null, 0, 20000);
					$this->frontMatter = tryYAMLFrontMatter($content, true);
					$ParsedownExtra = new ParsedownExtra();
					$content = $ParsedownExtra->text($content);
				} else {
					$content = "<h1>Oops.</h1><p>Post not found.</p>";
				}
			}
			
			//var_dump($this->frontMatter);
			$this->pageTemplate->set("title", isset($this->frontMatter["title"]) ? $this->frontMatter["title"] : "Post");
			$this->pageTemplate->set("content", $content);
		}
		
		public function renderPage() {
			return $this->pageTemplate->render();
		}
	}
?>