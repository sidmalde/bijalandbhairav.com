<?php
App::uses('AppHelper', 'View/Helper');

class TextHelper extends AppHelper {
	
	function sth($text){
		$text = htmlentities($text);
		$text = nl2br(str_replace("support@stopthehacker.com", Configure::read('Config.support_email'),$text));
		$text = nl2br(str_replace("StopTheHacker", "HackAvert",$text));
		$text = nl2br(str_replace("STH", "HackAvert",$text));
		return $text;
	}
	
	function removeAccents($text = '', $sanitise = false){
		$match = array('À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ý','ß','à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ');
		$replace = array('A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','Y','S','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y');
		if($sanitise) {
			$match[] = ' ';
			$replace[] = '';
			
			$match[] = ',';
			$replace[] = '';
			
			$match[] = '\'';
			$replace[] = '';
			
			$match[] = '"';
			$replace[] = '';
		}
		return str_replace($match, $replace, $text);
	}
	
	function returnInitials($userData) {
		return strtoupper(substr($this->removeAccents($userData['firstname']), 0, 1)).strtoupper(substr($this->removeAccents($userData['lastname']), 0, 3));
	}
}
