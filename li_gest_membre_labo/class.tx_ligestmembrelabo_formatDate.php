<?php


class tx_ligestmembrelabo_formatDate {
		
	/*function deevaluateFieldValue($params) {
		if (!(checkdate(substr(trim($params['value']),8,2),substr(trim($params['value']),5,2),substr(trim($params['value']),0,4)))) {
			$params['value'] = date('Y-m-d');

		}
		//On test le premier séparteur
		if (!(substr(trim($params['value']),4,1)) != '-') {
			$params['value'] = substr_replace($params['value'],'-',4,1);
		}
		//On test le second séparteur
		if (!(substr(trim($params['value']),7,1)) != '-') {
			$params['value'] = substr_replace($params['value'],'-',7,1);
		}
		$params['value']='toto2';
		return $params['value'];
	}*/
	
		function deevaluateFieldValue($params) {
		if (trim($params['value']) != '' && false === strpos($params['value'], '/')) {
			$params['value'] = 'toto';
		}
		
		return $params['value'];
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/class.tx_ligestmembrelabo_formatDate.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/class.tx_ligestmembrelabo_formatDate.php']);
}

?>