<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	interface Infra {
		public function routeArray($routeArray);
		public function renderPage();
	}
?>