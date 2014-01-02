<?php
/*
 * Declension of words
 * This algorithm taken from https://github.com/livestreet/livestreet/blob/eca10c0186c8174b774a2125d8af3760e1c34825/engine/modules/viewer/plugs/modifier.declension.php
 *
 * @param int $count
 * @param string $forms
 * @param string $lang
 *
 * @return string
 * */
function declension($count, $forms, $lang = null) {
	global $modx;
	if (empty($lang)) {
		$lang = $modx->getOption('cultureKey',null,'en');
	}
	$forms = $modx->fromJSON($forms);

	if ($lang == 'ru') {
		$mod100 = $count % 100;
		switch ($count % 10) {
			case 1:
				if ($mod100 == 11) {$text = $forms[2];}
				else {$text = $forms[0];}
				break;
			case 2:
			case 3:
			case 4:
				if (($mod100 > 10) && ($mod100 < 20)) {$text = $forms[2];}
				else {$text = $forms[1];}
				break;
			case 5:
			case 6:
			case 7:
			case 8:
			case 9:
			case 0:
			default: $text = $forms[2];
		}
	}
	else {
		if ($count == 1) {
			$text = $forms[0];
		}
		else {
			$text = $forms[1];
		}
	}
	return $text;
}