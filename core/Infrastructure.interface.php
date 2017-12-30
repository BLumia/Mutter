<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	/*
	Infra is a module which should be used to attach to a route strategy.
	Recommend to used as a TemplateEngine holder.
	*/
	interface Infra {
		public function routeArray($routeArray);
		public function renderPage();
	}
?>