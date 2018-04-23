<?php
	if (!defined("MUTTER")) exit("(OoO)");
	
	require_once("./vendor/Parsedown.php");
	require_once("./vendor/ParsedownExtra.php");
	
	/*
	A parsedown-extra wrapper class for some feature extends.
	*/
	class MutterParsedown extends ParsedownExtra {
		
		protected $allowedTagElements = array(
			'div', 'span',
			'details', 'summary'
		);
		
		protected function blockMarkup($Line) {
			if (preg_match('/^<(\w[\w-]*)(?:[ ]*'.$this->regexHtmlAttribute.')*[ ]*(\/)?>/', $Line['text'], $matches)) {
				$element = strtolower($matches[1]);

				if (in_array($element, $this->allowedTagElements)) {
					return;
				}
			}
			
			parent::blockMarkup($Line);
		}
	}
?>