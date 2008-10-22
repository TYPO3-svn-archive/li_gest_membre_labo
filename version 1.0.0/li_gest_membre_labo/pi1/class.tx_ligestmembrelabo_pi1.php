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
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
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
		
		
		$code = '';
		//Récupération de toutes les membres de l'équipe demandée ayant les postes sélectionnés
		$nom = '';
		
		$premier = true;
		
		$postes = '';
		if(($this->lConf['professeur'])==true)
		{
			if ($premier == true)
			{
				$postes = 'AND ( ';
				$premier = false;
			}
			else
			{
				$postes = $postes.' OR ';
			}
			$postes=$postes.'tx_ligestmembrelabo_TypePosteWeb.LibelleWeb LIKE "%Professeur%"';
		}
		if(($this->lConf['maitre'])==true)
		{
			if ($premier == true)
			{
				$postes = 'AND ( ';
				$premier = false;
			}
			else
			{
				$postes = $postes.' OR ';
			}
			$postes=$postes.'tx_ligestmembrelabo_TypePosteWeb.LibelleWeb LIKE "%Maitre de Conferences%"';
		}
		if(($this->lConf['docteur'])==true)
		{
			if ($premier == true)
			{
				$postes = 'AND ( ';
				$premier = false;
			}
			else
			{
				$postes = $postes.' OR ';
			}
			$postes=$postes.'tx_ligestmembrelabo_TypePosteWeb.LibelleWeb LIKE "%Docteur%"';
		}
		if(($this->lConf['doctorant'])==true)
		{
			if ($premier == true)
			{
				$postes = 'AND ( ';
				$premier = false;
			}
			else
			{
				$postes = $postes.' OR ';
			}
			$postes=$postes.'tx_ligestmembrelabo_TypePosteWeb.LibelleWeb LIKE "%Doctorant%"';
		}
		if(($this->lConf['autre'])==true)
		{
			if ($premier == true)
			{
				$postes = 'AND ( ';
				$premier = false;
			}
			else
			{
				$postes = $postes.' OR ';
			}
			$postes=$postes.'tx_ligestmembrelabo_TypePosteWeb.LibelleWeb LIKE "%Autre Chercheur%"';
		}
		if ($postes <> '')
		{
			$postes = $postes.' )';
		}
		
		
		$select_fields = 'tx_ligestmembrelabo_MembreDuLabo.idMembreLabo, tx_ligestmembrelabo_MembreDuLabo.NomDUsage, tx_ligestmembrelabo_MembreDuLabo.Prenom, tx_ligestmembrelabo_MembreDuLabo.PageWeb, tx_ligestmembrelabo_TypePosteWeb.LibelleWeb';
		$from_table = 'tx_ligestmembrelabo_MembreDuLabo, tx_ligestmembrelabo_EstMembreDe, tx_ligestmembrelabo_Equipe, tx_ligestmembrelabo_Possede, tx_ligestmembrelabo_TypePoste, tx_ligestmembrelabo_TypePosteWeb';
		$where_clause = 'tx_ligestmembrelabo_MembreDuLabo.idMembreLabo = tx_ligestmembrelabo_EstMembreDe.idMembreLabo AND tx_ligestmembrelabo_EstMembreDe.idEquipe = tx_ligestmembrelabo_Equipe.idEquipe AND (tx_ligestmembrelabo_Equipe.Nom = "'.$this->lConf['labo'].'" OR tx_ligestmembrelabo_Equipe.Abreviation = "'.$this->lConf['labo'].'") AND tx_ligestmembrelabo_Possede.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.idMembreLabo AND tx_ligestmembrelabo_Possede.idTypePoste = tx_ligestmembrelabo_TypePoste.idTypePoste AND tx_ligestmembrelabo_TypePoste.idTypePosteWeb = tx_ligestmembrelabo_TypePosteWeb.idTypePosteWeb '.$postes;
		$groupBy = '';
		$orderBy = 'tx_ligestmembrelabo_MembreDuLabo.NomDUsage, tx_ligestmembrelabo_MembreDuLabo.Prenom';
		$limit = '';
		$tryMemcached = '';
		
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields, $from_table, $where_clause, $groupBy, $orderBy, $tryMemcached);
		
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))
		{
			//if ($row['PageWeb']=='' || is_null($row['PageWeb']))
			//{
			//	$nom = $nom.'<p>'.$row['NomDUsage'].' '.$row['Prenom'].'</p>
			//	';
			//}
			//else
			//{
			//	$nom = $nom.'<p><a href="'.$row['PageWeb'].'">'.$row['NomDUsage'].' '.$row['Prenom'].'</a></p>
			//	';
			//}
			
			$pageWeb = false;
			$nom = $nom.'<p>';
			
			if ($row['PageWeb']<>'' && !(is_null($row['PageWeb'])))
			{
				$nom = $nom.'<a href="'.$row['PageWeb'].'">';
				$pageWeb=true;
			}
			$nom = $nom.$row['NomDUsage'].' '.$row['Prenom'];
			if ($pageWeb=true)
			{
				$nom = $nom.'</a>';			
			}

			if ($this->lConf['poste']==true)
			{
				$nom = $nom.', '.$row['LibelleWeb'];
			}
			
			
			$nom = $nom.'</p>
			';
			
		}
		
		
		
		
		
		
		
		
		
		
		
	
		$content=$nom;
	
		return $this->pi_wrapInBaseClass($content);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/pi1/class.tx_ligestmembrelabo_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/pi1/class.tx_ligestmembrelabo_pi1.php']);
}

?>