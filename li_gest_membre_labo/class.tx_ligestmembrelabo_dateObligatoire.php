<?php

class tx_ligestmembrelabo_dateObligatoire {

	function returnFieldJS() {

			return "var modif = value;
				if (modif == '0000-00-00'){
					alert('Vous devez obligatoirement saisir une date!');
				}
				return value;";
	}

	
	
	function evaluateFieldValue($value, $is_in, &$set) {
		if (!(checkdate(substr($value,5,2),substr($value,8,2),substr($value,0,4)))) {
			$value = date('Y-m-d');
		}
		/*else if{$value=='0000-00-00'){
			$value = date('Y-m-d');
		}*/
		//On test le premier séparteur
		if (!(substr($value,4,1)) != '-') {
			$value = substr_replace($value,'-',4,1);
		}
		//On test le second séparteur
		if (!(substr($value,7,1)) != '-') {
			$value = substr_replace($value,'-',7,1);
		}

		return $value;
	}

	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/class.tx_ligestmembrelabo_dateObligatoire.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/class.tx_ligestmembrelabo_dateObligatoire.php']);
}

?>