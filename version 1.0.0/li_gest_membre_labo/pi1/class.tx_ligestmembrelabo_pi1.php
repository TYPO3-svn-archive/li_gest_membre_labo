<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Bruno Gallet <gallet.bruno@gmail.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'Managing Member' for the 'li_gest_membre_labo' extension.
 *
 * @author	Bruno Gallet <gallet.bruno@gmail.com>
 * @package	TYPO3
 * @subpackage	tx_ligestmembrelabo
 */
class tx_ligestmembrelabo_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_ligestmembrelabo_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_ligestmembrelabo_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'li_gest_membre_labo';	// The extension key.
	var $pi_checkCHash = true;

	//Recherche des sous-dossiers contenant les membres du laboratoire...
	private function rechercheFils($pid_parent)
	{
		$tableau = array(); //tableau contenant tous les sous-dossiers trouvés...
		
		$tableau_temp = array(); //tableau intermédiaire contenant les sous-dossiers à stocker
		
		//Requête pour trouver tous les sous-dossiers du dossier courant
		$select_fields_pid = 'pages.uid';
		$from_table_pid = 'pages';
		$where_clause_pid = 'pages.pid='.$pid_parent;
		$groupBy_pid = '';
		$orderBy_pid = '';
		$limit_pid = '';
		$tryMemcached_pid = '';

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields_pid, $from_table_pid, $where_clause_pid, $groupBy_pid, $orderBy_pid, $tryMemcached_pid);

		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))
		{
			$pid_courant = $row['uid'];

			
			//On stocke l'uid courant dans le tableau
			$taille_tableau = count($tableau);
						
			$tableau[$taille_tableau] = $pid_courant;

			$tableau_temp = $this->rechercheFils($pid_courant);
				
			foreach ($tableau_temp as $value) {
				$taille_tableau = count($tableau);
					
				$tableau[$taille_tableau] = $value;
			}
		}
		return $tableau;
	}
	
	//Gestion du multilangue
	private function rechercherUidLangue($uid,$sys_language_uid,$uid_parent,$texte_champ,$table,$nom_champ)
	{
		$texte=$texte_champ;
		//On teste si le libellé est déjà dans la bonne langue...
		if ($sys_language_uid<>$GLOBALS['TSFE']->sys_language_content)
		{
			$uid_recherche=$uid;
			$trouve=false;
			// Si on a l'id du parent
			if($uid_parent<>'0')
			{

				//Requête pour trouver les infos du parent
				$select_fields_uid = $table.'.uid, '.$table.'.sys_language_uid, '.$table.'.'.$nom_champ;
				$from_table_uid = $table;
				$where_clause_uid = $table.'uid='.$pid_parent;
				$groupBy_uid = '';
				$orderBy_uid = '';
				$limit_uid = '';
				$tryMemcached_uid = '';

				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields_uid, $from_table_uid, $where_clause_uid, $groupBy_uid, $orderBy_uid, $tryMemcached_uid);

				while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))
				{
					if($row['sys_language_uid']==$GLOBALS['TSFE']->sys_language_content)
					{
						$texte=$row[$nom_champ];
						$trouve=true;
					}
					else
					{
						$uid_recherche=$row['uid'];
					}
				}
			}
			
			if($trouve==false)
			{
				//Requête pour trouver les infos du parent
				$select_fields_uid = $table.'.uid, '.$table.'.sys_language_uid, '.$table.'.'.$nom_champ;
				$from_table_uid = $table;
				$where_clause_uid = $table.'.l18n_parent='.$uid_recherche;
				$groupBy_uid = '';
				$orderBy_uid = '';
				$limit_uid = '';
				$tryMemcached_uid = '';

				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields_uid, $from_table_uid, $where_clause_uid, $groupBy_uid, $orderBy_uid, $tryMemcached_uid);

				while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))
				{
					if($row['sys_language_uid']==$GLOBALS['TSFE']->sys_language_content)
					{
						$texte=$row[$nom_champ];
					}
				}
			}
		}
		
		return $texte;
	}
	
	//Choix du type de poste
	private function typeDePoste($typeDePoste)
	{
			//Création de la clause permettant l'affichage que de certains types de poste...
			$postes='';
	
	
			if($typeDePoste<>'')
			{
				$postes=' AND ( ';
				$premier=true;

				$tableau_postes = Explode(",",$typeDePoste);

				foreach ($tableau_postes as $poste_courant) {
					if ($premier <> true)
					{
						$postes = $postes.' OR ';
					}
					else
					{
						$premier=false;
					}
					$postes=$postes.'tx_ligestmembrelabo_TypePosteWeb.uid='.$poste_courant;
				}
	
				$postes = $postes.' )';
			}

			return $postes;
	}
	
	
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string	$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content,$conf)	{
		//Initialisation
		$this->conf=$conf;
		$this->pi_initPIflexForm(); // Init and get the flexform data of the plugin
		$this->lConf = array(); // Setup our storage array...
		// Assign the flexform data to a local variable for easier access
		$this->pi_setPiVarDefaults();
		$piFlexForm = $this->cObj->data['pi_flexform'];
		 // Traverse the entire array based on the language...
		 // and assign each configuration option to $this->lConf array...

		foreach ( $piFlexForm['data'] as $sheet => $data )
		{
			foreach ( $data as $lang => $value )
			{
				foreach ( $value as $key => $val )
				{
					$this->lConf[$key] = $this->pi_getFFvalue($piFlexForm, $key, $sheet);
				}
			}
		}
		$this->pi_loadLL();

		
		/*----------------------------------------------------------------------------------------
		//Création de requête
		$select_fields = '*';
		$from_table = 'test';
		$where_clause = '';
		$groupBy = '';
		$orderBy = 'champ1';
		$limit = '';
		$tryMemcached = '';
		
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields, $from_table, $where_clause, $groupBy, $orderBy, $tryMemcached);
		
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))
		{
			$test = $test.$row['champ1'].' ';
		}
		----------------------------------------------------------------------------------------*/
		$select_fields = '';
		$from_table = '';
		$where_clause = '';
		$groupBy = '';
		$orderBy = '';
		$limit = '';
		$tryMemcached = '';
		
		
		if(($this->lConf['requete'])<>true)
		{
		
		
			//Récupération de toutes les membres de l'équipe demandée ayant les postes sélectionnés
			$code = ''; //Variable contenant le code à afficher
			
			//Gestion des types de postes
			$postes=$this->typeDePoste($this->lConf['typePoste']);

			
			//Gestion du nom de l'Equipe
			$from_table = '';
			$equipe_where_clause = '';
			if (($this->lConf['labo'])<>'')
			{
				$from_table = ', tx_ligestmembrelabo_EstMembreDe, tx_ligestmembrelabo_Equipe';
				$equipe_where_clause = ' AND tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_EstMembreDe.idMembreLabo AND tx_ligestmembrelabo_EstMembreDe.idEquipe = tx_ligestmembrelabo_Equipe.uid AND (tx_ligestmembrelabo_Equipe.Nom = "'.$this->lConf['labo'].'" OR tx_ligestmembrelabo_Equipe.Abreviation = "'.$this->lConf['labo'].'")';
			}
			
			

			
			// Création de la clause permettant de ne choisir que certains membres selon les dossiers sélectionnés
			//On récupère tous les sous-dossiers...
			$dossiers = '';	
			
			$pid = array(); //dossiers sélectionnés
			$pages = array(); //dossiers et sous dossiers...
			
			$chaine = $this->lConf['pid'];
			
			if ($chaine!='')
			{
				$dossiers = $dossiers.' AND (';
				$pid = Explode(",",$chaine);
				//$pages = $pid;
				
				$premier = true;
				
				foreach ($pid as $pid_courant) {
					$pages = $pages+$this->rechercheFils($pid_courant);
				}
				
				foreach ($pid as $value) {
					$taille_tableau = count($pages);

					$pages[$taille_tableau] = $value;
				}
				
				
				foreach ($pages as $value) {
					if ($premier == true)
					{
						$dossiers = $dossiers.'tx_ligestmembrelabo_MembreDuLabo.pid='.$value;
						$premier = false;
					}
					else
					{
						$dossiers = $dossiers.' OR tx_ligestmembrelabo_MembreDuLabo.pid='.$value;
					}
				}

				$dossiers = $dossiers.')';
			}
			

			
			
			
			
			$select_fields = 'tx_ligestmembrelabo_MembreDuLabo.uid, tx_ligestmembrelabo_MembreDuLabo.NomDUsage, tx_ligestmembrelabo_MembreDuLabo.Prenom, tx_ligestmembrelabo_MembreDuLabo.PageWeb, tx_ligestmembrelabo_TypePosteWeb.uid, tx_ligestmembrelabo_TypePosteWeb.sys_language_uid, tx_ligestmembrelabo_TypePosteWeb.l18n_parent, tx_ligestmembrelabo_TypePosteWeb.LibelleWeb';
			$from_table = 'tx_ligestmembrelabo_MembreDuLabo, tx_ligestmembrelabo_Possede, tx_ligestmembrelabo_TypePoste, tx_ligestmembrelabo_TypePosteWeb'.$from_table;
			$where_clause = 'tx_ligestmembrelabo_Possede.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.uid AND tx_ligestmembrelabo_Possede.idTypePoste = tx_ligestmembrelabo_TypePoste.idTypePoste AND tx_ligestmembrelabo_TypePoste.idTypePosteWeb = tx_ligestmembrelabo_TypePosteWeb.idTypePosteWeb '.$equipe_where_clause.$postes.$dossiers;
			$groupBy = '';
			$orderBy = 'tx_ligestmembrelabo_MembreDuLabo.NomDUsage, tx_ligestmembrelabo_MembreDuLabo.Prenom';
			$limit = '';
			$tryMemcached = '';
				

			
			
		}
		else
		{
			$select_fields = $this->lConf['select'];
			$from_table = $this->lConf['from_table'];
			$where_clause = $this->lConf['where_clause'];
			$groupBy = $this->lConf['groupBy'];
			$orderBy = $this->lConf['orderBy'];
			$limit = $this->lConf['limit'];
			$tryMemcached = $this->lConf['tryMemcached'];
			
		}
		


			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields, $from_table, $where_clause, $groupBy, $orderBy, $tryMemcached);

			while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))
			{

				$pageWeb = false;
				$code = $code.'<p>';
				
				if ($row['PageWeb']<>'' && !(is_null($row['PageWeb'])))
				{
					$code = $code.'<a href="'.$row['PageWeb'].'">';
					$pageWeb=true;
				}
				$code = $code.$row['NomDUsage'].' '.$row['Prenom'];
				if ($pageWeb=true)
				{
					$code = $code.'</a>';			
				}


				//Gestion multilangue
				
				//Si le type de poste est affiché
				if ($this->lConf['poste']==true)
				{
					$champ='';
					$champ=$row['LibelleWeb'];
					//On recherche le libellé traduit de LibelleWeb
					$champ=$this->rechercherUidLangue($row['uid'],$row['sys_language_uid'],$row['l18n_parent'],$row['LibelleWeb'],'tx_ligestmembrelabo_TypePosteWeb','LibelleWeb');
					
					if(!(is_null($row['LibelleWeb'])) && $row['LibelleWeb']<>'')
					{
						$code= $code.', '.$champ;
					}
				}
				
				
				
				
				
				
				
				//Ancien sans multi langue
				//if ($this->lConf['poste']==true && !(is_null($row['LibelleWeb'])) && $row['LibelleWeb']<>'')
				//{
				//	$code= $code.', '.$row['LibelleWeb'];
				//}
				
				
				$code = $code.'</p>
				';
				
			}
		
		$content=$code;
	
		return $this->pi_wrapInBaseClass($content);
	}

	
	
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/pi1/class.tx_ligestmembrelabo_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/pi1/class.tx_ligestmembrelabo_pi1.php']);
}

?>