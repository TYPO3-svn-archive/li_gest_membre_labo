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
 * La classe tx_ligestmembrelabo_delete permet de supprimer un enregistrement dans un menu déroulant
 *
 * @return	[type]		...
 */
class tx_ligestmembrelabo_delete extends t3lib_SCbase {

	// Internal, dynamic:
	var $include_once=array();	// List of files to include.

	// Internal, static:
	var $table;						// Contient le nom de la table de l'enregistrement que l'on doit supprimer
	var $uid;						// Contient l'identifiant de l'enregistrement à supprimer
	var $table_principale;			// Contient le nom de la table d'où provient la suppession
	var $uid_table_principale;		// Contient l'identifiant de l'enregistrement de la table d'où provient la suppression
	var $field_table_principale; 	// Contient le champ de la table d'où provient la suppression
	
	
		// Internal, static: GPvars
	var $P;						// Wizard parameters, coming from TCEforms linking to the wizard.

	/**
	 * fonction Main permettant de supprimer un enregistrement dans un menu déroulant
	 *
	 * @return	[type]		...
	 */
	function main()	{

		$this->P = t3lib_div::_GP('P');

		// Set table:
		$this->table = $this->P['params']['table'];
		$this->uid = $this->P['currentValue'];
		$this->table_principale = $this->P['table'];
		$this->field_table_principale = $this->P['field'];
		$this->uid_table_principale = $this->P['uid'];

		if($this->table <> '' && $this->uid <> '')
		{
			// On supprime l'enregistrement (on passe l'attribut deleted à 1)
			$updateArray = array(
				'deleted' => 1
			);

			$query = $GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->table, 'uid='.$this->uid, $updateArray);
			
			echo "L'enregistrement ".$this->uid." de la table ".$this->table." a ete supprime";
		}
		
		
		if($this->table_principale <> '' && $this->field_table_principale <> '' && $this->uid_table_principale<>'')
		{
			//On réinitialise à 0, le numéro de l'enregistrement sélectionné pour l'affichage du formulaire de provenance
			$updateArray = array(
				$this->field_table_principale => 0
			);
			
			$query = $GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->table_principale, 'uid='.$this->uid_table_principale, $updateArray);
		}
		
		

		// On réactualise la page d'où on a appelé la suppression et on ferme notre popup
		echo '<script>
			window.opener.location.reload();
			window.close();
			</script>';
	}



}




if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/wizard/delete.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/wizard/delete.php']);
}


// Make instance:
$SOBE = t3lib_div::makeInstance('tx_ligestmembrelabo_delete');
$SOBE->main();





?>
