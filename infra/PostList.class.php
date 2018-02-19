<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	/*
	This is the Infra module we are using to generate post list.
	We use file timestamp and front-matter (if exist) to sort posts.
	
	Currently we parse these variables from front-matter:
	 - `title` for post title, will use the file name if no front-matter provided.
	 - `date` for post created date, will use `filectime` if no front-matter provided.
	 - `updated` for last updated time, will use `filemtime` if no front-matter prpvided.
	tryYAMLFrontMatter will parse the YAML format front-matter if exist. Checkout `Utils.Function.php` for more details.
	*/
	class PostList extends SubFolderFriendly implements Infra {
		
		protected $pageTemplate;
		protected $allowedExts;
		protected $postInfraName; // For subfolder name, and also for generating links.
		
		private function postLinkGenerator($title, $postTime, $url) {
			return "<h3><a href='{$url}'>{$title}</a><small>{$postTime}</small></h3>";
		}
		
		private static function postdataCompare($a, $b) {
			return $b["__postTimestamp"] - $a["__postTimestamp"];
		}
		
		public function __construct($config, $postInfraName) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			if ($postInfraName == null || !is_string($postInfraName)) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->setSubFolderName($postInfraName); // Subfolder name and link string is the same.
			$this->allowedExts = $config->markdownExts;
			$this->postInfraName = $postInfraName; // Yeah same `$postInfraName`, it sucks? try hack this part, it's simple.
			
			$this->pageTemplate = new Template($this->getDataFilePath("static")."template-artical-list.html");
			$this->pageTemplate->setInfra("HeaderComponent", new HeaderComponent($config), null);
			$this->pageTemplate->setInfra("FooterComponent", new FooterComponent($config), null);
		}
		
		public function routeArray($routeArray) {
			// When we need a pager, we need access page number from url, or says, from $routeArray.
			// But we didn't need one, for now.
			
			// Get post list and generate DOM here.
			$postsDOM = "";
			$dataFileDir = $this->getDataFilePath();
			$postList = array();
			date_default_timezone_set("Etc/GMT-8");
			
			$fileList = scandir($dataFileDir);
			foreach($fileList as $oneFileName) {
				if($oneFileName == "." || $oneFileName == "..") continue;
				$utf8FileName = GIVEMETHEFUCKINGUTF8($oneFileName);
				$fileExt = getFileExtension($utf8FileName);
				$curFilePath = "{$dataFileDir}/{$oneFileName}";
				$tmpContent = file_get_contents($curFilePath, null, null, 0, 300);
				$tryFrontMatter = tryYAMLFrontMatter($tmpContent);
				if (is_dir($curFilePath)) continue;
				if (in_array($fileExt,$this->allowedExts)) {
					$postTimestamp = isset($tryFrontMatter["date"]) ? strtotime($tryFrontMatter["date"]) : filectime($curFilePath);
					array_push($postList, array(
						"title"=>isset($tryFrontMatter["title"]) ? $tryFrontMatter["title"] : $utf8FileName,
						"url"=>"?/{$this->postInfraName}/".rawurlencode(basename($utf8FileName, ".{$fileExt}")),
						"modifiedTime"=>isset($tryFrontMatter["updated"]) ? $tryFrontMatter["updated"] : date("Y/m/d H:i:s", filemtime($curFilePath)),
						"createdTime"=>date("Y/m/d H:i:s", $postTimestamp),
						"__postTimestamp"=>$postTimestamp // used by compare function
					));
				}
			}
			
			usort($postList, array('PostList','postdataCompare'));
			foreach ($postList as $idx => $aPost) {
				$postsDOM .= $this->postLinkGenerator($aPost['title'], $aPost['createdTime'], $aPost['url']);
			}
			
			$this->pageTemplate->set("posts", $postsDOM);
		}
		
		public function renderPage() {
			return $this->pageTemplate->render();
		}
	}
?>