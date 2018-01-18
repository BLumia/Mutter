<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	class Template {
		protected $file;
		protected $map = array();
		protected $subInfra = array();
		protected $subInfraRouteArray = array();
		
		public function __construct($file) {
			$this->file = $file;
		}
		
		public function set($key, $value) {
			$this->map[$key] = $value;
		}
		
		public function setArray($arr) {
			$this->map = array_merge($arr, $this->map);
		}
		
		public function setInfra($key, $value, $arg) {
			if (!is_a($module, "Infra")) exit("(OwO)");
			$this->subInfra[$key] = $value;
			$this->subInfraRouteArray[$key] = $arg;
		}
		
		public function render() {
			if (!file_exists($this->file)) exit("(ToT)");
			$output = file_get_contents($this->file);
			foreach ($this->map as $key => $value) {
				$valueTagFormat = '{{$'.$key.'}}';
				$output = str_replace($valueTagFormat, $value, $output);
			}
			foreach ($this->subInfra as $key => $subInfra) {
				$valueTagFormat = '{{@'.$key.'}}';
				$subInfra->routeArray($this->subInfraRouteArray[$key]);
				$output = str_replace($valueTagFormat, $subInfra->render(), $output);
			}
			return $output;
		}
	}
?>