<?php
class Utils {

	/*
		Raccourcis vers la méthode debug seulement pour la pile d'appel
	*/
	public static function debug_backtrace($echo = true) {
		return self::debug(null, true, $echo);
	}

	/*
		Affiche les informations et le contenu d'une variable
	*/
	public static function debug($var, $backtrace = false, $echo = true, $pre = true) {

		$result = 'DEBUG >> '.self::debug_var($var);

		if ($backtrace === true) {
			$result .= '<br>BACKTRACE >> '.Utils::debug_var(debug_backtrace());
		}
		if ($pre === true) {
			$result = '<pre>'.$result.'</pre>';
		}
		if ($echo === true) {
			echo $result;
			return true;
		}

		return $result;
	}

	public static function debug_var($mixed = null) {
		ob_start();
		var_dump($mixed);
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	/*
		Transforme une chaîne du type "setCreation_date" en "setCreationDate"
	*/
	public static function getCamelCase($str) {
		return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
	}

	/*
		Coupe une chaine à la longueur $max_length en préservant les mots
	*/
	public static function cutString($text, $max_length, $end = '...') {
		// On défini une chaine qu'on va intercaller tous les X caractères en préservant les mots
		$sep = '[@]';

		// Si $max_length est positif et que la chaine $text est plus longue que $max_length
		if ($max_length > 0 && strlen($text) > $max_length) {
			// On intercalle la chaine $sep tous les X caractères
			$text = wordwrap($text, $max_length, $sep, true);
			// On découpe la chaine en plusieurs bouts dans un tableau
			$text = explode($sep, $text);
			// On retourne la première valeur du tableau et on concatène avec la chaine $end
			return $text[0].$end;
		}
		// On retourne la chaine telle qu'on l'a reçu
		return $text;
	}

	/*
		Coupe une chaine à la longueur $max_length en préservant les mots
	*/
	public static function slugify($str) {
		return self::cleanString($str, '-');
	}

	/*
		Nettoie une chaîne
	*/
	public static function cleanString($str, $delimiter = ' ') {
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
		return $clean;
	}

	public static function getBackLink($back_link = 'index.php') {
		if (!empty($_SERVER['HTTP_REFERER'])) {
			$back_link = $_SERVER['HTTP_REFERER'];
		}
		return $back_link;
	}

	public static function formatAmount($amount, $currency = '&euro;') {
		return number_format($amount, 2, ',', ' ').$currency;
	}

}