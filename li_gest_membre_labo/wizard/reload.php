<?php


unset($MCONF);
define('TYPO3_MOD_PATH', '../typo3conf/ext/li_gest_membre_labo/wizard/');
$BACK_PATH='../../../../typo3/';
//$MCONF['name']='xMOD_tx_testtypo3_tx_testtypo3_testwiz';
require_once($BACK_PATH.'init.php');
require_once($BACK_PATH.'template.php');
//$LANG->includeLLFile('EXT:li_gest_membre_labo/wizard/locallang.xml');
require_once(PATH_t3lib.'class.t3lib_scbase.php');

/**
 * La classe tx_ligestmembrelabo_reload permet de recharcher la page appelante
 *
 * @return	[type]		...
 */
class tx_ligestmembrelabo_reload extends t3lib_SCbase {

	// Internal, dynamic:
	var $include_once=array();	// List of files to include.

	// Internal, static:
	
		// Internal, static: GPvars
	var $P;						// Wizard parameters, coming from TCEforms linking to the wizard.

	/**
	 * fonction Main permettant de supprimer un enregistrement dans un menu déroulant
	 *
	 * @return	[type]		...
	 */
	function main()	{

		// On réactualise la page d'où on a appelé la suppression et on ferme notre popup
		echo '<script>
			window.opener.location.reload();
			window.close();
			</script>';
	}



}




if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/wizard/reload.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/wizard/reload.php']);
}


// Make instance:
$SOBE = t3lib_div::makeInstance('tx_ligestmembrelabo_reload');
$SOBE->main();





?>
