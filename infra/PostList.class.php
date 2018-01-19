<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class PostList extends SubFolderFriendly implements Infra {
		
		protected $pageTemplate;
		
		private function postLinkGenerator($title, $postTime, $url) {
			return "<h3><a href='{$url}'>{$title}</a><small>{$postTime}</small></h3>";
		}
		
		public function __construct($config) {
			if ($config == null || !is_a($config, "Config")) exit("(O_O)");
			$this->dataFilePath = $config->dataFolderPath;
			$this->setSubFolderName("posts");
			
			$this->pageTemplate = new Template($this->getDataFilePath("static")."template-artical-list.html");
		}
		
		public function routeArray($routeArray) {
			// When we need a pager, we need access page number from url, or says, from $routeArray.
			// But we didn't need one, for now.
			
			// Get post list and generate DOM here.
			$postsDOM = "";
			date_default_timezone_set("Etc/GMT-8");
			
			for ($i = 1; $i <= 10; $i++) {
				$postsDOM .= $this->postLinkGenerator("Test Post ".$i, date("Y/m/d H:i:s"), "?/post/aaaaa");
			}
			
			$this->pageTemplate->set("posts", $postsDOM);
		}
		
		public function renderPage() {
			echo $this->pageTemplate->render();
		}
	}
?>