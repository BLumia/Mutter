<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class Routing {
		protected $regList = array();
		protected $modules = array();
		protected $defaultKey = null;
		protected $notfoundKey = null;
		
		protected function getUrlRouteArray() {
			return array_values(array_filter(explode("/", $_SERVER['QUERY_STRING']))); 
		}
		
		public function setDefault($key) {
			if (isset($this->regList[$key])) $this->defaultKey = $key;
			else exit("(XoX)");
		}
		
		public function setNotFound($key) {
			if (isset($this->regList[$key])) $this->notfoundKey = $key;
			else exit("(XoX)");
		}
		
		public function add($key, $module) {
			if ($module == null || !is_a($module, "Infra")) exit("(OwO)");
			$this->regList[$key] = true;
			$this->modules[$key] = $module;
		}
		
		public function doWork() {
			$route = $this->getUrlRouteArray();
			$theKey = null;
			if (count($route) == 0 && $this->defaultKey != null) $theKey = $this->defaultKey;
			else {
				if (isset($this->regList[$route[0]])) $theKey = $route[0];
				else if ($this->notfoundKey != null) $theKey = $this->notfoundKey;
				else exit("(qaq)");
			}
			$this->modules[$theKey]->routeArray($route);
			$this->modules[$theKey]->renderPage();
		}
	}
?>