<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class StaticPageGenerator extends SubFolderFriendly implements Infra {
		
		protected $pageTemplate;
		protected $frontMatter;
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->setSubFolderName("singlepage");
			
			$this->pageTemplate = new Template($this->getDataFilePath("static")."template-artical.html");
			$this->pageTemplate->setInfra("HeaderComponent", new HeaderComponent($config), null);
			$this->pageTemplate->setInfra("FooterComponent", new FooterComponent($config), null);
		}
		
		public function routeArray($routeArray) {
			$content = "";
			if (count($routeArray) < 1) $content = "<h1>Oops.</h1><p>Post not found.</p>";
			else {
				$fileName = urldecode($routeArray[0]).".md";
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
			
			$pageTitle = isset($this->frontMatter["title"]) ? $this->frontMatter["title"] : "Page";
			if ($pageTitle != "Page") $this->pageTemplate->getInfra("HeaderComponent")->pageTemplate->set("title", $pageTitle);
			$this->pageTemplate->set("content", $content);
			$this->pageTemplate->set("title", $pageTitle);
		}
		
		public function renderPage() {
			return $this->pageTemplate->render();
		}
	}
?>