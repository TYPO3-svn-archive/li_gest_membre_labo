<?php

class tx_ligestmembrelabo_dateValide {

	function returnFieldJS() {

			return "var modif = value;
				if (modif!='0000-00-00')
				{
					var verif = /^[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}$/;
					var verifMois = modif.substr(5,2);
					var verifJour = modif.substr(8,2);
					if (verif.exec(modif) == null){
						alert('La date saisie est incorrrect!');
					}
					else if (parseInt(verifMois,10) > 12){
						alert('La date saisie est incorrrect!');
					}
					else if (parseInt(verifMois,10) == 1 || parseInt(verifMois,10) == 3 || parseInt(verifMois,10) == 5 || parseInt(verifMois,10) == 7 || parseInt(verifMois,10) == 8 || parseInt(verifMois,10) == 10 || parseInt(verifMois,10) == 12){
						if (parseInt(verifJour,10) > 31){
							alert('La date saisie est incorrrect!');
						}
					}
					else
					{
						if (parseInt(verifJour,10) > 30){
							alert('La date saisie est incorrrect!');
						}
					}
				}				
				return value;";
	}


	function evaluateFieldValue($value, $is_in, &$set) {
		if (!(checkdate(substr($value,5,2),substr($value,8,2),substr($value,0,4)))) {
			$value = '0000-00-00';
		}
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

	function deevaluateFieldValue($params) {
		$dateTest = $params['value'];
		if (!(checkdate(substr($dateTest,5,2),substr($dateTest,8,2),substr($dateTest,0,4)))) {
			$dateTest='';
		}
		/*else if($dateTest=='0000-00-00')
		{
			$dateTest='';
		}*/
		return $dateTest;
	}
	
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/class.tx_ligestmembrelabo_dateValide.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/class.tx_ligestmembrelabo_dateValide.php']);
}

?>