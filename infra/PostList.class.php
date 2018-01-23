<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class PostList extends SubFolderFriendly implements Infra {
		
		protected $pageTemplate;
		protected $allowedExts;
		
		private function postLinkGenerator($title, $postTime, $url) {
			return "<h3><a href='{$url}'>{$title}</a><small>{$postTime}</small></h3>";
		}
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->setSubFolderName("posts");
			$this->allowedExts = $config->markdownExts;
			
			$this->pageTemplate = new Template($this->getDataFilePath("static")."template-artical-list.html");
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
				if (is_dir($curFilePath)) continue;
				if (in_array($fileExt,$this->allowedExts)) {
					array_push($postList, 
						array(
							"title"=>$utf8FileName,
							"url"=>"?/post/".rawurlencode(basename($utf8FileName, ".{$fileExt}")),
							"modifiedTime"=>filemtime($curFilePath)
						)
					);
				}
			}
			
			foreach ($postList as $aPost) {
				$postsDOM .= $this->postLinkGenerator($aPost['title'], date("Y/m/d H:i:s", $aPost['modifiedTime']), $aPost['url']);
			}
			
			$this->pageTemplate->set("posts", $postsDOM);
		}
		
		public function renderPage() {
			echo $this->pageTemplate->render();
		}
	}
?>