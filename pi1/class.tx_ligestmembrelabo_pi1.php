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
	 * Recherche des sous-dossiers contenant les membres du laboratoire...
	 * @param $pid_parent identifiant du dossier à explorer
	 * @return Un tableau contenant tous les sous-dossiers trouvés...
	 */
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
	

	/**
	 * Gestion du multilangue
	 * Cette fonction recherche le texte le plus approprié par rapport à la page chargée
	 * Cette fonction est utilisée à la suite d'une requête permettant de connaître les paramètres $uid, $sys_language_uid, $uid_parent et $texte_champ.
	 * @param $uid L'identifiant de l'enregistrement pour lequel on recherche la meilleur traduction.
	 * @param $sys_language_uid L'identifiant de la langue de l'enregistrement pour lequel on recherche la meilleur traduction.
	 * @param $uid_parent L'identifiant du parent  de l'enregistrement pour lequel on recherche la meilleur traduction.
	 * @param $texte_champ La traduction de l'enregistrement pour lequel on recherche la meilleur traduction.
	 * @param $table Le nom de la table dans laquel se trouve le champ à traduire
	 * @param $nom_champ Le nom du champ à traduire
	 * @return Une chaîne de caratères contenant la traduction a afficher
	 */
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
				$where_clause_uid = $table.'.uid='.$pid_parent.' AND '.$table.'.deleted<>1';
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
				$where_clause_uid = $table.'.l18n_parent='.$uid_recherche.' AND '.$table.'.deleted<>1';
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
	

	/**
	 * Choix de l'équipe
	 * Cette fonction permet de créer une contrainte concernant le type de poste
	 * @param $equipe Chaîne de caractères contenant les identifiants des équipes(uid) séparés par des virgules
	 * @return Une chaîne de caratères contenant une contrainte à rajouter à une requête
	 */
	private function equipe($uid_equipes,$typeDate)
	{
			//Création de la contrainte permettant l'affichage que de certains types de postes...
			$equipes='';
	

			if($uid_equipes<>'')
			{
				$equipes=' AND ( ';
				$premier=true;

				$tableau_equipes = Explode(",",$uid_equipes);

				foreach ($tableau_equipes as $equipe_courante) {
					if ($premier <> true)
					{
						$equipes = $equipes.' OR ';
					}
					else
					{
						$premier=false;
					}
					$equipes=$equipes.'tx_ligestmembrelabo_Equipe.uid='.$equipe_courante;
				}

				$equipes = $equipes.' )';

			}
			
			
			//Gestion des dates...
			if($typeDate=='Actuels')
			{
				$postes = $postes.' AND tx_ligestmembrelabo_EstMembreDe.DateDebut<="'.date('Y-m-d').'" AND (tx_ligestmembrelabo_EstMembreDe.DateFin>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_EstMembreDe.DateFin="0000-00-00")';
			}
			else if($typeDate=='Anciens')
			{
				$postes = $postes.' AND tx_ligestmembrelabo_EstMembreDe.DateFin<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_EstMembreDe.DateFin<>"0000-00-00"';
			}
			


			return $equipes;
	}
	
	
	
	/**
	 * Choix du type de poste
	 * Cette fonction permet de créer une contrainte concernant le type de poste
	 * @param $typeDePoste Chaîne de caractères contenant les identifiants des types de poste (uid) séparés par des virgules
	 * @param $typeDate Chaîne de caractère contenant le type de date: Actuels, Anciens ou Tous
	 * @return Une chaîne de caratères contenant une contrainte à rajouter à une requête
	 */
	private function typeDePoste($typeDePoste,$typeDate)
	{
			//Création de la contrainte permettant l'affichage que de certains types de postes...
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

			//Gestion des dates...
			if($typeDate=='Actuels')
			{
				$postes = $postes.' AND tx_ligestmembrelabo_Possede.DateDebut<="'.date('Y-m-d').'" AND (tx_ligestmembrelabo_Possede.DateFin>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_Possede.DateFin="0000-00-00")';
			}
			else if($typeDate=='Anciens')
			{
				$postes = $postes.' AND tx_ligestmembrelabo_Possede.DateFin<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_Possede.DateFin<>"0000-00-00"';
			}
				
			return $postes;
	}
	
	

	/**
	 * Choix des categories
	 * Cette fonction permet de créer une contrainte concernant les categories
	 * @param $uid_categories Chaîne de caractères contenant les identifiants des catégories (uid) séparés par une virgule
	 * @param $typeDate Chaîne de caractère contenant le type de date: Actuels, Anciens ou Tous
	 * @return Une chaîne de caratères contenant une contrainte à rajouter à une requête
	 */
	private function categorie($uid_categories,$typeDate)
	{
			//Création de la contrainte permettant l'affichage que de certains types de catégories...
			$categories='';

			if($uid_categories<>'')
			{
				$categories=' AND ( ';
				$premier=true;

				$tableau_categories = Explode(",",$uid_categories);

				foreach ($tableau_categories as $categorie_courante) {
					if ($premier <> true)
					{
						$categories = $categories.' OR ';
					}
					else
					{
						$premier=false;
					}
					$categories=$categories.'tx_ligestmembrelabo_Categorie.uid='.$categorie_courante;
				}
	
				$categories = $categories.' )';

			}

			//Gestion des dates...
			if($typeDate=='Actuels')
			{
				$categories = $categories.' AND tx_ligestmembrelabo_CategorieMembre.DateDebut<="'.date('Y-m-d').'" AND (tx_ligestmembrelabo_CategorieMembre.DateFin>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_CategorieMembre.DateFin="0000-00-00")';
			}
			else if($typeDate=='Anciens')
			{
				$categories = $categories.' AND tx_ligestmembrelabo_CategorieMembre.DateFin<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_CategorieMembre.DateFin<>"0000-00-00"';
			}
				
			return $categories;
	}
	
	
	
	
	/**
	 * Choix des structures
	 * Cette fonction permet de créer une contrainte concernant les structures
	 * @param $uid_categories Chaîne de caractères contenant les identifiants des structures (uid) séparés par une virgule
	 * @param $typeDate Chaîne de caractère contenant le type de date: Actuels, Anciens ou Tous
	 * @return Une chaîne de caratères contenant une contrainte à rajouter à une requête
	 */
	private function structure($uid_structures,$typeDate)
	{
			//Création de la contrainte permettant l'affichage que de certains types de structures...
			$structures='';

			if($uid_structures<>'')
			{
				$structures=' AND ( ';
				$premier=true;

				//Recherche des structures filles
				$tableau_temporaire = Explode(",",$uid_structures);
				$tableau_structures = array(); //structures et sous-structures...
				
				foreach ($tableau_temporaire as $structure_courante) {
					$tableau_structures = array_merge($tableau_structures,$this->rechercheStructuresFille($structure_courante));
				}
				
				//On ajoute les structures de départs
				foreach ($tableau_temporaire as $value) {
					$taille_tableau = count($tableau_structures);

					$tableau_structures[$taille_tableau] = $value;
				}


				foreach ($tableau_structures as $structure_courante) {
					if ($premier <> true)
					{
						$structures = $structures.' OR ';
					}
					else
					{
						$premier=false;
					}
					$structures=$structures.'tx_ligestmembrelabo_Structure.uid='.$structure_courante;
				}
	
				$structures = $structures.' )';

			}

			//Gestion des dates...
			if($typeDate=='Actuels')
			{
				$structures = $structures.' AND tx_ligestmembrelabo_Exerce.DateDebut<="'.date('Y-m-d').'" AND (tx_ligestmembrelabo_Exerce.DateFin>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_Exerce.DateFin="0000-00-00")';
			}
			else if($typeDate=='Anciens')
			{
				$structures = $structures.' AND tx_ligestmembrelabo_Exerce.DateFin<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_Exerce.DateFin<>"0000-00-00"';
			}
				
			return $structures;
	}
	
	
	//Recherche des structures filles
	/**
	 * Recherche de structures filles
	 * @param $id_parent identifiant de la structure principale
	 * @return Un tableau contenant toutes les sous-structures trouvées...
	 */
	private function rechercheStructuresFille($id_parent)
	{
		$tableau = array(); //tableau contenant toutes les sous-structures trouvées...
		
		$tableau_temp = array(); //tableau intermédiaire contenant les sous-structures à stocker
		
		//Requête pour trouver toutes les sous-structures à partir de la structure courante
		$select_fields_pid = 'tx_ligestmembrelabo_Structure.uid';
		$from_table_pid = 'tx_ligestmembrelabo_Structure';
		$where_clause_pid = 'tx_ligestmembrelabo_Structure.idStructureParente='.$id_parent;
		$groupBy_pid = '';
		$orderBy_pid = '';
		$limit_pid = '';
		$tryMemcached_pid = '';


		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields_pid, $from_table_pid, $where_clause_pid, $groupBy_pid, $orderBy_pid, $tryMemcached_pid);

		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))
		{
			$structure_courante = $row['uid'];


			//On stocke l'uid courant dans le tableau
			$taille_tableau = count($tableau);
						
			$tableau[$taille_tableau] = $structure_courante;

			$tableau_temp = $this->rechercheStructuresFille($structure_courante);

			foreach ($tableau_temp as $value) {
				$taille_tableau = count($tableau);
					
				$tableau[$taille_tableau] = $value;
			}
		}
		return $tableau;
	}
	

	

	/**
	 * Choix des fonctions
	 * Cette fonction permet de créer une contrainte concernant les fonctions
	 * @param $uid_fonctions Chaîne de caractères contenant les identifiants des fonctions (uid) séparés par une virgule
	 * @param $typeDate Chaîne de caractère contenant le type de date: Actuels, Anciens ou Tous
	 * @return Une chaîne de caratères contenant une contrainte à rajouter à une requête
	 */
	private function fonction($uid_fonctions,$typeDate)
	{
			//Création de la contrainte permettant l'affichage que de certains types de fonctions...
			$fonctions='';

			if($uid_fonctions<>'')
			{
				$fonctions=' AND ( ';
				$premier=true;

				$tableau_fonctions = Explode(",",$uid_fonctions);

				foreach ($tableau_fonctions as $fonction_courante) {
					if ($premier <> true)
					{
						$fonctions = $fonctions.' OR ';
					}
					else
					{
						$premier=false;
					}
					$fonctions=$fonctions.'tx_ligestmembrelabo_Fonction.uid='.$fonction_courante;
				}
	
				$fonctions = $fonctions.' )';

			}

			//Gestion des dates...
			if($typeDate=='Actuels')
			{
				$fonctions = $fonctions.' AND tx_ligestmembrelabo_Exerce.DateDebut<="'.date('Y-m-d').'" AND (tx_ligestmembrelabo_Exerce.DateFin>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_Exerce.DateFin="0000-00-00")';
			}
			else if($typeDate=='Anciens')
			{
				$fonctions = $fonctions.' AND tx_ligestmembrelabo_Exerce.DateFin<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_Exerce.DateFin<>"0000-00-00"';
			}
				
			return $fonctions;
	}



	/**
	 * Choix des diplomes
	 * Cette fonction permet de créer une contrainte concernant les diplomes
	 * @param $uid_diplomes Chaîne de caractères contenant les identifiants des diplômes (uid) séparés par une virgule
	 * @return Une chaîne de caratères contenant une contrainte à rajouter à une requête
	 */
	private function diplome($uid_diplomes)
	{
			//Création de la contrainte permettant l'affichage que de certains diplomes...
			$diplomes='';

			if($uid_diplomes<>'')
			{
				$diplomes=' AND ( ';
				$premier=true;

				$tableau_diplomes = Explode(",",$uid_diplomes);

				foreach ($tableau_diplomes as $diplome_courant) {
					if ($premier <> true)
					{
						$diplomes = $diplomes.' OR ';
					}
					else
					{
						$premier=false;
					}
					$diplomes=$diplomes.'tx_ligestmembrelabo_TypeDiplome.uid='.$diplome_courant;
				}
	
				$diplomes = $diplomes.' )';

			}
				
			return $diplomes;
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
		$this->lConf2 = array();
		$this->lConftotal = array();
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


					if(ereg('groupe',$key)){
						$temp = $key;
						foreach ($val as $key2 => $val2 )
						{
							$temp = $temp.'/'.$key2;
							foreach ($val2 as $key3 => $val3 )
							{
								$this->lConf[$key3] = $this->pi_getFFvalue($piFlexForm, $key.'/'.$key2.'/'.$key3, $sheet);
							}
						}
		
					
					}
				}

			}

		}
		//$this->lConftotal = array_merge($this->lConf,$this->lConf2);

		$this->pi_loadLL();

		//Gestion de gabarits (Template)

		$this->templateCode = $this->cObj->fileResource($this->lConf["template_file"]);

		$template = array();

		$template['total'] = $this->cObj->getSubpart($this->templateCode, '###TEMPLATE###');

		$template['item'] = $this->cObj->getSubpart($template['total'], '###ITEM###');

		$template['categories'] = $this->cObj->getSubpart($template['item'], '###CATEGORIES###');
		$template['categories_dernier'] = $this->cObj->getSubpart($template['item'], '###CATEGORIES_DERNIER###');

		$template['equipe'] = $this->cObj->getSubpart($template['item'], '###EQUIPE###');
		$template['equipe_dernier'] = $this->cObj->getSubpart($template['item'], '###EQUIPE_DERNIER###');

		$template['diplomes'] = $this->cObj->getSubpart($template['item'], '###DIPLOMES###');
		$template['diplomes_dernier'] = $this->cObj->getSubpart($template['item'], '###DIPLOMES_DERNIER###');

		$template['postes'] = $this->cObj->getSubpart($template['item'], '###POSTES###');
		$template['postes_dernier'] = $this->cObj->getSubpart($template['item'], '###POSTES_DERNIER###');

		$template['fonctions_structures'] = $this->cObj->getSubpart($template['item'], '###FONCTIONS_STRUCTURES###');
		$template['fonctions_structures_dernier'] = $this->cObj->getSubpart($template['item'], '###FONCTIONS_STRUCTURES_DERNIER###');


		//Exemple de création de requêtes
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


		if(($this->lConf['requete'])<>true){


			//Récupération de toutes les membres de l'équipe demandée ayant les postes sélectionnés
			$code = ''; //Variable contenant le code à afficher

			//Construction de la requête
			$select = 'DISTINCT tx_ligestmembrelabo_MembreDuLabo.uid AS uidmembre, tx_ligestmembrelabo_MembreDuLabo.*';
			$table = 'tx_ligestmembrelabo_MembreDuLabo';
			$where = 'tx_ligestmembrelabo_MembreDuLabo.deleted<>1';
			

			//Gestion du nom de l'Equipe
			/*$table = $table.', tx_ligestmembrelabo_EstMembreDe, tx_ligestmembrelabo_Equipe';
			$where = $where.' AND tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_EstMembreDe.idMembreLabo AND tx_ligestmembrelabo_EstMembreDe.idEquipe = tx_ligestmembrelabo_Equipe.uid';
			if (($this->lConf['labo'])<>''){
				$where = $where.' AND tx_ligestmembrelabo_EstMembreDe.deleted<>1 AND tx_ligestmembrelabo_Equipe.deleted<>1 AND (tx_ligestmembrelabo_Equipe.Nom = "'.$this->lConf['labo'].'" OR tx_ligestmembrelabo_Equipe.Abreviation = "'.$this->lConf['labo'].'")';
			}*/
			$equipes = $this->equipe($this->lConf['equipe'],$this->lConf['dateequipe']);
			$table = $table.', tx_ligestmembrelabo_EstMembreDe, tx_ligestmembrelabo_Equipe';
			$where = $where.' AND tx_ligestmembrelabo_EstMembreDe.deleted<>1 AND tx_ligestmembrelabo_Equipe.deleted<>1 AND tx_ligestmembrelabo_EstMembreDe.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.uid AND tx_ligestmembrelabo_EstMembreDe.idEquipe = tx_ligestmembrelabo_Equipe.uid';
			if($equipes<>""){
				$where = $where.$equipes;
			}
			


			/********************FILTRES********************/
			//Ces filtres rajoutent des contraintes sur la requête à afficher


			//Gestion de la date d'arrivée et de départ du labo
			if($this->lConf['datelabo']=='Actuels')
			{
				$where = $where.' AND tx_ligestmembrelabo_MembreDuLabo.DateArrivee<="'.date('Y-m-d').'" AND (tx_ligestmembrelabo_MembreDuLabo.DateSortie>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_MembreDuLabo.DateSortie="0000-00-00")';
			}
			else if($this->lConf['datelabo']=='Anciens')
			{
				$where = $where.' AND tx_ligestmembrelabo_MembreDuLabo.DateSortie<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_MembreDuLabo.DateSortie<>"0000-00-00"';
			}


			//Gestion des types de postes
			$postes = $this->typeDePoste($this->lConf['typeposte'],$this->lConf['datetypeposte']);
			//$select = $select.', tx_ligestmembrelabo_Possede.*, tx_ligestmembrelabo_TypePoste.*, tx_ligestmembrelabo_TypePosteWeb.*';
			$table = $table.', tx_ligestmembrelabo_Possede, tx_ligestmembrelabo_TypePoste, tx_ligestmembrelabo_TypePosteWeb';
			$where = $where.' AND tx_ligestmembrelabo_Possede.deleted<>1 AND tx_ligestmembrelabo_TypePoste.deleted<>1 AND tx_ligestmembrelabo_TypePosteWeb.deleted<>1 AND tx_ligestmembrelabo_Possede.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.uid AND tx_ligestmembrelabo_Possede.idTypePoste = tx_ligestmembrelabo_TypePoste.uid AND tx_ligestmembrelabo_TypePoste.idTypePosteWeb = tx_ligestmembrelabo_TypePosteWeb.uid';
			if($postes<>""){
				$where = $where.$postes;
			}

			//Gestion des categories
			$categorie = $this->categorie($this->lConf['categorie'],$this->lConf['datetypecategorie']);
			if($categorie<>""){
				//$select = $select.', tx_ligestmembrelabo_Categorie.*, tx_ligestmembrelabo_CategorieMembre.*';
				$table = $table.', tx_ligestmembrelabo_CategorieMembre, tx_ligestmembrelabo_Categorie';
				$where = $where.' AND tx_ligestmembrelabo_CategorieMembre.deleted<>1 AND tx_ligestmembrelabo_Categorie.deleted<>1 AND tx_ligestmembrelabo_CategorieMembre.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.uid AND tx_ligestmembrelabo_CategorieMembre.idCategorie = tx_ligestmembrelabo_Categorie.uid';
				$where = $where.$categorie;
			}
			

			//Gestion des structures et des fonctions
			
			$structure = $this->structure($this->lConf['structure'],$this->lConf['datetypestructure']);
			if($structure<>""){
				$where = $where.' AND EXISTS (SELECT * FROM tx_ligestmembrelabo_Exerce, tx_ligestmembrelabo_Structure WHERE tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_Exerce.idMembreLabo AND tx_ligestmembrelabo_Exerce.idStructure = tx_ligestmembrelabo_Structure.uid'.$structure.')';
			}			
			
			$fonction = $this->fonction($this->lConf['fonction'],$this->lConf['datetypefonction']);
			if($fonction<>""){
				$where = $where.' AND EXISTS (SELECT * FROM tx_ligestmembrelabo_Exerce, tx_ligestmembrelabo_Fonction WHERE tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_Exerce.idMembreLabo AND tx_ligestmembrelabo_Exerce.idFonction = tx_ligestmembrelabo_Fonction.uid'.$fonction.')';
			}
			
			
			
			
			//Gestion des diplomes
			$diplome = $this->diplome($this->lConf['diplome']);
			if($diplome<>""){
				//$select = $select.', tx_ligestmembrelabo_TypeDiplome.*, tx_ligestmembrelabo_AObtenu.*';
				$table = $table.', tx_ligestmembrelabo_TypeDiplome, tx_ligestmembrelabo_AObtenu';
				$where = $where.' AND tx_ligestmembrelabo_TypeDiplome.deleted<>1 AND tx_ligestmembrelabo_AObtenu.deleted<>1 AND tx_ligestmembrelabo_AObtenu.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.uid AND tx_ligestmembrelabo_AObtenu.CodeDiplome = tx_ligestmembrelabo_TypeDiplome.uid';
				$where = $where.$diplome;
			}
			
			//Gestion des PEDR
			$datepedr = $this->lConf['datepedr'];
			if($datepedr<>"")
			{
				if($datepedr=='Actuels')
				{
					$table = $table.', tx_ligestmembrelabo_PEDR';
					$where = $where.' AND tx_ligestmembrelabo_PEDR.deleted<>1 AND tx_ligestmembrelabo_PEDR.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.uid AND tx_ligestmembrelabo_PEDR.DateDebut<="'.date('Y-m-d').'" AND (tx_ligestmembrelabo_PEDR.DateFin>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_PEDR.DateFin="0000-00-00")';
				}
				else if($datepedr=='Anciens')
				{
					$table = $table.', tx_ligestmembrelabo_PEDR';
					$where = $where.' AND tx_ligestmembrelabo_PEDR.deleted<>1 AND tx_ligestmembrelabo_PEDR.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.uid AND tx_ligestmembrelabo_PEDR.DateFin<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_PEDR.DateFin<>"0000-00-00"';
				}
				else if($datepedr=='ActuelsEtAnciens')
				{
					$table = $table.', tx_ligestmembrelabo_PEDR';
					$where = $where.' AND tx_ligestmembrelabo_PEDR.deleted<>1 AND tx_ligestmembrelabo_PEDR.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.uid';
				}
			}
			
			
			
			

			// Création de la clause permettant de ne choisir que certains membres selon les dossiers sélectionnés
			//On récupère tous les sous-dossiers...
			$dossiers = '';	
			
			$pid = array(); //dossiers sélectionnés
			$pages = array(); //dossiers et sous dossiers...
			
			$chaine = $this->lConf['pid'];
			
			if ($chaine!=''){
				$dossiers = $dossiers.' AND (';
				$pid = explode(",",$chaine);
				//$pages = $pid;
				
				$premier = true;
				
				foreach ($pid as $pid_courant) {
					$pages = array_merge($pages,$this->rechercheFils($pid_courant));
				}
				
				foreach ($pid as $value) {
					$taille_tableau = count($pages);

					$pages[$taille_tableau] = $value;
				}
				
				
				foreach ($pages as $value) {
					if ($premier == true){
						$dossiers = $dossiers.'tx_ligestmembrelabo_MembreDuLabo.pid='.$value;
						$premier = false;
					}
					else{
						$dossiers = $dossiers.' OR tx_ligestmembrelabo_MembreDuLabo.pid='.$value;
					}
				}

				$dossiers = $dossiers.')';
			}

			$where = $where.$dossiers;




			//$select_fields = 'tx_ligestmembrelabo_MembreDuLabo.uid, tx_ligestmembrelabo_MembreDuLabo.NomDUsage, tx_ligestmembrelabo_MembreDuLabo.Prenom, tx_ligestmembrelabo_MembreDuLabo.PageWeb, tx_ligestmembrelabo_TypePosteWeb.uid, tx_ligestmembrelabo_TypePosteWeb.sys_language_uid, tx_ligestmembrelabo_TypePosteWeb.l18n_parent, tx_ligestmembrelabo_TypePosteWeb.LibelleWeb';
			$select_fields = $select;
			$from_table = $table;
			$where_clause = $where;
			$groupBy = '';
			$orderBy = 'tx_ligestmembrelabo_MembreDuLabo.NomDUsage, tx_ligestmembrelabo_MembreDuLabo.Prenom';
			$limit = '';
			$tryMemcached = '';



		}
		else{
			$select_fields = $this->lConf['select'];
			$from_table = $this->lConf['from_table'];
			$where_clause = $this->lConf['where_clause'];
			$groupBy = $this->lConf['groupBy'];
			$orderBy = $this->lConf['orderBy'];
			$limit = $this->lConf['limit'];
			$tryMemcached = $this->lConf['tryMemcached'];
		}


		$markerArray = array();
		$markerArray_Equipe = array();
		$markerArray_Categories = array();
		$markerArray_Categories_dernier = array();
		$markerArray_Diplomes = array();
		$markerArray_Diplomes_dernier = array();
		$markerArray_Postes = array();
		$markerArray_Postes_dernier = array();
		$markerArray_FonctionsStructures = array();
		$markerArray_FonctionsStructures_dernier = array();
		
		$contentItem='';

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields, $from_table, $where_clause, $groupBy, $orderBy, $tryMemcached);

		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))       {

			//**************************************
			$uid=$row['uidmembre'];
			// Table MembreDuLabo

			//$markerArray['###uid###'] = $row['uidmembre'];
			$markerArray['###NomDUsage###'] = $row['NomDUsage'];
			if($row['NomDUsage']<>''){
				$markerArray['###NomDUsage_Separateur###'] = $this->lConf['separateurNomDUsage'];
			}
			else{
				$markerArray['###NomDUsage_Separateur###'] = '';
			}
			
			$markerArray['###NOMDUSAGE###'] = mb_strtoupper($row['NomDUsage'],"UTF-8");
			if($row['NomDUsage']<>''){
				$markerArray['###NOMDUSAGE_Separateur###'] = $this->lConf['separateurNomDUsage'];
			}
			else{
				$markerArray['###NOMDUSAGE_Separateur###'] = '';
			}


			$markerArray['###NomMarital###'] = $row['NomMarital'];
			if($row['NomMarital']<>''){
				$markerArray['###NomMarital_Separateur###'] = $this->lConf['separateurNomMarital'];
			}
			else{
				$markerArray['###NomMarital_Separateur###'] = '';
			}
			
			$markerArray['###NOMMARITAL###'] = mb_strtoupper($row['NomMarital'],"UTF-8");
			if($row['NomMarital']<>''){
				$markerArray['###NOMMARITAL_Separateur###'] = $this->lConf['separateurNomMarital'];
			}
			else{
				$markerArray['###NOMMARITAL_Separateur###'] = '';
			}


			$markerArray['###NomPreMarital###'] = $row['NomPreMarital'];
			if($row['NomPreMarital']<>''){
				$markerArray['###NomPreMarital_Separateur###'] = $this->lConf['separateurNomPreMarital'];
			}
			else{
				$markerArray['###NomPreMarital_Separateur###'] = '';
			}
			
			$markerArray['###NOMPREMARITAL###'] = mb_strtoupper($row['NomPreMarital'],"UTF-8");
			if($row['NomPreMarital']<>''){
				$markerArray['###NOMPREMARITAL_Separateur###'] = $this->lConf['separateurNomPreMarital'];
			}
			else{
				$markerArray['###NOMPREMARITAL_Separateur###'] = '';
			}



			$markerArray['###Prenom###'] = $row['Prenom'];
			if($row['Prenom']<>''){
				$markerArray['###Prenom_Separateur###'] = $this->lConf['separateurPrenom'];
			}
			else{
				$markerArray['###Prenom_Separateur###'] = '';
			}
			
			$markerArray['###PRENOM###'] = mb_strtoupper($row['Prenom'],"UTF-8");
			if($row['Prenom']<>''){
				$markerArray['###PRENOM_Separateur###'] = $this->lConf['separateurPrenom'];
			}
			else{
				$markerArray['###PRENOM_Separateur###'] = '';
			}

			// Afficher les initiales d'un membre
			//$markerArray['###InitialePrenom###'] = substr($row['Prenom'],0,1);

			$prenoms = explode("-",$row['Prenom']);
			$initiales_prenom = "";
			$premier_prenom = true;
			foreach ($prenoms as $prenom_courant) {
				if($premier_prenom != true)
				{
					$initiales_prenom = $initiales_prenom."-";
				}
				$initiales_prenom = $initiales_prenom.substr($prenom_courant,0,1);
				$premier_prenom = false;
			}
			if($initiales_prenom != '')
			{
				$markerArray['###InitialePrenom###'] = $initiales_prenom.".";
			}	
			
			
			
			if($row['Prenom']<>''){
				$markerArray['###InitialePrenom_Separateur###'] = $this->lConf['separateurInitialePrenom'];
			}
			else{
				$markerArray['###InitialePrenom_Separateur###'] = '';
			}


			$markerArray['###InitialeNom###'] = substr($row['NomDUsage'],0,1).".";
			if($row['NomDUsage']<>''){
				$markerArray['###InitialeNom_Separateur###'] = $this->lConf['separateurInitialeNom'];
			}
			else{
				$markerArray['###InitialeNom_Separateur###'] = '';
			}



			if($row['Genre']=='H'){
				$markerArray['###Genre###'] = $this->lConf['genrehomme'];
				
				if($this->lConf['genrehomme']<>''){
					$markerArray['###Genre_Separateur###'] = $this->lConf['separateurGenre'];
				}
				else{
					$markerArray['###Genre_Separateur###'] = '';
				}
			}
			else if($row['Genre']=='F'){
				$markerArray['###Genre###'] = $this->lConf['genrefemme'];
				
				if($this->lConf['genrefemme']<>''){
					$markerArray['###Genre_Separateur###'] = $this->lConf['separateurGenre'];
				}
				else{
					$markerArray['###Genre_Separateur###'] = '';
				}
			}
			else{
				$markerArray['###Genre###'] = $this->lConf['genreinconnu'];
				
				if($this->lConf['genreinconnu']<>''){
					$markerArray['###Genre_Separateur###'] = $this->lConf['separateurGenre'];
				}
				else{
					$markerArray['###Genre_Separateur###'] = '';
				}
			}



			if($row['DateNaissance']=='0000-00-00'){
				//$markerArray['###DateNaissance###'] = $this->lConf['datenaissance'];			
				$markerArray['###DateNaissance###'] = $this->lConf['datenaissance'];
				if($this->lConf['datenaissance']<>''){
					$markerArray['###DateNaissance_Separateur###'] = $this->lConf['separateurDateNaissance'];
				}
				else{
					$markerArray['###DateNaissance_Separateur###'] = '';
				}
			}
			else{
				//$markerArray['###DateNaissance###'] = $row['DateNaissance'];

				$date_explosee = explode("-", $row['DateNaissance']);

				$annee = (int)$date_explosee[0];
				$mois = (int)$date_explosee[1];
				$jour = (int)$date_explosee[2];

				$markerArray['###DateNaissance###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));

				if($row['DateNaissance']<>''){
					$markerArray['###DateNaissance_Separateur###'] = $this->lConf['separateurDateNaissance'];
				}
				else{
					$markerArray['###DateNaissance_Separateur###'] = '';
				}
			}

			$markerArray['###Nationalite###'] = $row['Nationalite'];
			if($row['Nationalite']<>''){
				$markerArray['###Nationalite_Separateur###'] = $this->lConf['separateurNationalite'];
			}
			else{
				$markerArray['###Nationalite_Separateur###'] = '';
			}
			
			$markerArray['###NATIONALITE###'] = mb_strtoupper($row['Nationalite'],"UTF-8");

			if($row['Nationalite']<>''){
				$markerArray['###NATIONALITE_Separateur###'] = $this->lConf['separateurNationalite'];
			}
			else{
				$markerArray['###NATIONALITE_Separateur###'] = '';
			}
			
			
			if($row['DateArrivee']=='0000-00-00'){
				$markerArray['###DateArrivee###'] = $this->lConf['datearrivee'];
				
				if($this->lConf['datearrivee']<>''){
					$markerArray['###DateArrivee_Separateur###'] = $this->lConf['separateurDateArrivee'];
				}
				else{
					$markerArray['###DateArrivee_Separateur###'] = '';
				}
			}
			else{
				//$markerArray['###DateArrivee###'] = $row['DateArrivee'];
				
				$date_explosee = explode("-", $row['DateArrivee']);

				$annee = (int)$date_explosee[0];
				$mois = (int)$date_explosee[1];
				$jour = (int)$date_explosee[2];

				$markerArray['###DateArrivee###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
				
				
				
				if($row['DateArrivee']<>''){
					$markerArray['###DateArrivee_Separateur###'] = $this->lConf['separateurDateArrivee'];
				}
				else{
					$markerArray['###DateArrivee_Separateur###'] = '';
				}
			}
			
			
			if($row['DateSortie']=='0000-00-00'){
				$markerArray['###DateSortie###'] = $this->lConf['datesortie'];
				
				if($this->lConf['datesortie']<>''){
					$markerArray['###DateSortie_Separateur###'] = $this->lConf['separateurDateSortie'];
				}
				else{
					$markerArray['###DateSortie_Separateur###'] = '';
				}
			}
			else{
				//$markerArray['###DateSortie###'] = $row['DateSortie'];
				
				$date_explosee = explode("-", $row['DateSortie']);

				$annee = (int)$date_explosee[0];
				$mois = (int)$date_explosee[1];
				$jour = (int)$date_explosee[2];

				$markerArray['###DateSortie###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
				
				if($row['DateSortie']<>''){
					$markerArray['###DateSortie_Separateur###'] = $this->lConf['separateurDateSortie'];
				}
				else{
					$markerArray['###DateSortie_Separateur###'] = '';
				}
			}
			
			$markerArray['###NumINE###'] = $row['NumINE'];

			if($row['NumINE']<>''){
				$markerArray['###NumINE_Separateur###'] = $this->lConf['separateurNumINE'];
			}
			else{
				$markerArray['###NumINE_Separateur###'] = '';
			}


			$markerArray['###SectionCNU###'] = $row['SectionCNU'];

			if($row['SectionCNU']<>''){
				$markerArray['###SectionCNU_Separateur###'] = $this->lConf['separateurSectionCNU'];
			}
			else{
				$markerArray['###SectionCNU_Separateur###'] = '';
			}


			$markerArray['###CoordonneesRecherche###'] = nl2br($row['CoordonneesRecherche']);
			if($row['CoordonneesRecherche']<>''){
				$markerArray['###CoordonneesRecherche_Separateur###'] = $this->lConf['separateurCoordonneesRecherche'];
			}
			else{
				$markerArray['###CoordonneesRecherche_Separateur###'] = '';
			}

			$markerArray['###CoordonneesRecherche_Ligne###'] = $row['CoordonneesRecherche'];
			
			if($row['CoordonneesRecherche']<>''){
				$markerArray['###CoordonneesRecherche_Ligne_Separateur###'] = $this->lConf['separateurCoordonneesRecherche'];
			}
			else{
				$markerArray['###CoordonneesRecherche_Ligne_Separateur###'] = '';
			}


			$markerArray['###CoordonneesEnseignement###'] = nl2br($row['CoordonneesEnseignement']);
			if($row['CoordonneesEnseignement']<>''){
				$markerArray['###CoordonneesEnseignement_Separateur###'] = $this->lConf['separateurCoordonneesEnseignement'];
			}
			else{
				$markerArray['###CoordonneesEnseignement_Separateur###'] = '';
			}
			
			$markerArray['###CoordonneesEnseignement_Ligne###'] = $row['CoordonneesEnseignement'];
			if($row['CoordonneesEnseignement']<>''){
				$markerArray['###CoordonneesEnseignement_Ligne_Separateur###'] = $this->lConf['separateurCoordonneesEnseignement'];
			}
			else{
				$markerArray['###CoordonneesEnseignement_Ligne_Separateur###'] = '';
			}



			$markerArray['###CoordonneesPersonnelles###'] = nl2br($row['CoordonneesPersonnelles']);
			if($row['CoordonneesPersonnelles']<>''){
				$markerArray['###CoordonneesPersonnelles_Separateur###'] = $this->lConf['separateurCoordonneesPersonnelles'];
			}
			else{
				$markerArray['###CoordonneesPersonnelles_Separateur###'] = '';
			}
			
			$markerArray['###CoordonneesPersonnelles_Ligne###'] = $row['CoordonneesPersonnelles'];
			if($row['CoordonneesPersonnelles']<>''){
				$markerArray['###CoordonneesPersonnelles_Ligne_Separateur###'] = $this->lConf['separateurCoordonneesPersonnelles'];
			}
			else{
				$markerArray['###CoordonneesPersonnelles_Ligne_Separateur###'] = '';
			}


			$markerArray['###email###'] = $row['email'];

			if($row['email']<>''){
				$markerArray['###email_Separateur###'] = $this->lConf['separateuremail'];
			}
			else{
				$markerArray['###email_Separateur###'] = '';
			}


			//Configuration du lien PageWeb
				// configure the typolink
				$this->local_cObj = t3lib_div::makeInstance('tslib_cObj');
				$this->local_cObj->setCurrentVal($GLOBALS['TSFE']->id);
				$this->typolink_conf = $this->conf['typolink.'];
				// configure typolink
				$temp_conf = $this->typolink_conf;
				$temp_conf['parameter'] = $row['PageWeb'];
				$temp_conf['extTarget'] = '';				
				$temp_conf['parameter.']['wrap'] = "|";
				// Fill wrapped subpart marker
			$wrappedSubpartContentArray['###PageWebLien###'] = $this->local_cObj->typolinkWrap($temp_conf);
			
			$markerArray['###PageWeb###'] = $row['PageWeb'];

			if($row['PageWeb']<>''){
				$markerArray['###PageWeb_Separateur###'] = $this->lConf['separateurPageWeb'];
			}
			else{
				$markerArray['###PageWeb_Separateur###'] = '';
			}
			
			//Le contenu de cette balise est modifié, ci besoin dans la partie conernant l'équipe du membre.
			$wrappedSubpartContentArray['###MembresSurlignes###'] = array('','');


			//**************************************
			// Tables Equipe et EstMembreDe
			//**************************************
				$contentEquipe = '';
				$contentEquipe_dernier = '';

				$equipe_select_fields = "tx_ligestmembrelabo_Equipe.uid AS uidequipe, tx_ligestmembrelabo_Equipe.*, tx_ligestmembrelabo_EstMembreDe.*";
				$equipe_from_table = "tx_ligestmembrelabo_MembreDuLabo, tx_ligestmembrelabo_Equipe, tx_ligestmembrelabo_EstMembreDe";
				$equipe_where_clause = "tx_ligestmembrelabo_MembreDuLabo.uid = ".$uid." AND tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_EstMembreDe.idMembreLabo AND tx_ligestmembrelabo_EstMembreDe.deleted<>1 AND tx_ligestmembrelabo_EstMembreDe.idEquipe = tx_ligestmembrelabo_Equipe.uid AND tx_ligestmembrelabo_Equipe.deleted<>1";
				$equipe_groupBy = "";
				$equipe_orderBy = "tx_ligestmembrelabo_EstMembreDe.DateDebut DESC";
				$equipe_limit = "";
				$equipe_tryMemcached = "";

				$equipe_res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($equipe_select_fields, $equipe_from_table, $equipe_where_clause, $equipe_groupBy, $equipe_orderBy, $equipe_tryMemcached);

				$premier_enregistrement = true; //On recupère l'enregistrement ayant la date de début la plus recente

				while($equipe_row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($equipe_res)){
					$idEquipe = $equipe_row['uidequipe'];
					
					//Champ Libelle (multilingue)
						$champNom='';
						$champNom=$equipe_row['Nom'];
							//On recherche le libellé traduit de Libelle
						$champNom=$this->rechercherUidLangue($equipe_row['uidequipe'],$equipe_row['sys_language_uid'],$equipe_row['l18n_parent'],$equipe_row['Nom'],'tx_ligestmembrelabo_Equipe','Nom');
					$markerArray_Equipe['###Equipe_Nom###'] = $champNom;

					if($champNom<>''){
						$markerArray_Equipe['###Equipe_Nom_Separateur###'] = $this->lConf['separateurEquipeNom'];
					}
					else{
						$markerArray_Equipe['###Equipe_Nom_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						$markerArray_Equipe_dernier['###Equipe_Nom_Dernier###'] = $champNom;
						
						
						
	
					//On ajoute ou non les balises pour surligner le membre si sa dernière équipe a été sélectionnée

					$tableau_equipes = explode(",",$this->lConf['baliseequipe']);
					
					foreach ($tableau_equipes as $equipe_courante) {
						if($idEquipe==$equipe_courante)
						{
							$wrappedSubpartContentArray['###MembresSurlignes###'] = array($this->lConf['balisedebut'],$this->lConf['balisefin']);
						}					
					}
						
						
						
						
						
						
						if($champNom<>''){
							$markerArray_Equipe_dernier['###Equipe_Nom_Dernier_Separateur###'] = $this->lConf['separateurEquipeNomdernier'];
						}
						else{
							$markerArray_Equipe_dernier['###Equipe_Nom_Dernier_Separateur###'] = '';
						}
					}

					$markerArray_Equipe['###Equipe_Abreviation###'] = $equipe_row['Abreviation'];

					if($equipe_row['Abreviation']<>''){
						$markerArray_Equipe['###Equipe_Abreviation_Separateur###'] = $this->lConf['separateurEquipeAbreviation'];
					}
					else{
						$markerArray_Equipe['###Equipe_Abreviation_Separateur###'] = '';
					}
					
					if($premier_enregistrement==true){
						$markerArray_Equipe_dernier['###Equipe_Abreviation_Dernier###'] = $equipe_row['Abreviation'];
						
						if($equipe_row['Abreviation']<>''){
							$markerArray_Equipe_dernier['###Equipe_Abreviation_Dernier_Separateur###'] = $this->lConf['separateurEquipeAbreviationdernier'];
						}
						else{
							$markerArray_Equipe_dernier['###Equipe_Abreviation_Dernier_Separateur###'] = '';
						}
					}

					//$markerArray_Equipe['###EstMembreDe_Rang###'] = $equipe_row['Rang'];
					
					if($equipe_row['Rang']=='1'){
						$markerArray_Equipe['###EstMembreDe_Rang###']= $this->lConf['rang1'];

						if($this->lConf['rang1']<>''){
							$markerArray_Equipe['###EstMembreDe_Rang_Separateur###'] = $this->lConf['separateurEstMembreDeRang'];
						}
						else{
							$markerArray_Equipe['###EstMembreDe_Rang_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_Equipe_dernier['###EstMembreDe_Rang_Dernier###'] = $this->lConf['rang1'];

							if($this->lConf['rang1']<>''){
								$markerArray_Equipe_dernier['###EstMembreDe_Rang_Dernier_Separateur###'] = $this->lConf['separateurEstMembreDeRangdernier'];
							}
							else{
								$markerArray_Equipe_dernier['###EstMembreDe_Rang_Dernier_Separateur###'] = '';
							}
						}
					}
					else if($equipe_row['Rang']=='2'){
						$markerArray_Equipe['###EstMembreDe_Rang###']= $this->lConf['rang2'];

						if($this->lConf['rang2']<>''){
							$markerArray_Equipe['###EstMembreDe_Rang_Separateur###'] = $this->lConf['separateurEstMembreDeRang'];
						}
						else{
							$markerArray_Equipe['###EstMembreDe_Rang_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_Equipe_dernier['###EstMembreDe_Rang_Dernier###'] = $this->lConf['rang2'];

							if($this->lConf['rang2']<>''){
								$markerArray_Equipe_dernier['###EstMembreDe_Rang_Dernier_Separateur###'] = $this->lConf['separateurEstMembreDeRangdernier'];
							}
							else{
								$markerArray_Equipe_dernier['###EstMembreDe_Rang_Dernier_Separateur###'] = '';
							}
						}
					}
					else
					{
						$markerArray_Equipe['###EstMembreDe_Rang###']= $this->lConf['rang0'];
						
						if($this->lConf['rang2']<>''){
							$markerArray_Equipe['###EstMembreDe_Rang_Separateur###'] = $this->lConf['separateurEstMembreDeRang'];
						}
						else{
							$markerArray_Equipe['###EstMembreDe_Rang_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_Equipe_dernier['###EstMembreDe_Rang_Dernier###'] = $this->lConf['rang0'];
							
							if($this->lConf['rang0']<>''){
								$markerArray_Equipe_dernier['###EstMembreDe_Rang_Dernier_Separateur###'] = $this->lConf['separateurEstMembreDeRangdernier'];
							}
							else{
								$markerArray_Equipe_dernier['###EstMembreDe_Rang_Dernier_Separateur###'] = '';
							}
						}
					}
					
					if($equipe_row['DateDebut']=='0000-00-00'){
						$markerArray_Equipe['###EstMembreDe_DateDebut###'] = $this->lConf['equipedatedebut'];
						
						if($this->lConf['equipedatedebut']<>''){
							$markerArray_Equipe['###EstMembreDe_DateDebut_Separateur###'] = $this->lConf['separateurEstMembreDateDebut'];
						}
						else{
							$markerArray_Equipe['###EstMembreDe_DateDebut_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_Equipe_dernier['###EstMembreDe_DateDebut_Dernier###'] = $this->lConf['equipedatedebut'];

							if($this->lConf['equipedatedebut']<>''){
								$markerArray_Equipe_dernier['###EstMembreDe_DateDebut_Dernier_Separateur###'] = $this->lConf['separateurEstMembreDateDebutdernier'];
							}
							else{
								$markerArray_Equipe_dernier['###EstMembreDe_DateDebut_Dernier_Separateur###'] = '';
							}
						}
					}
					else{
						//$markerArray_Equipe['###EstMembreDe_DateDebut###'] = $equipe_row['DateDebut'];

						$date_explosee = explode("-", $equipe_row['DateDebut']);

						$annee = (int)$date_explosee[0];
						$mois = (int)$date_explosee[1];
						$jour = (int)$date_explosee[2];

						$markerArray_Equipe['###EstMembreDe_DateDebut###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
						
						
						if($equipe_row['DateDebut']<>''){
							$markerArray_Equipe['###EstMembreDe_DateDebut_Separateur###'] = $this->lConf['separateurEstMembreDateDebut'];
						}
						else{
							$markerArray_Equipe['###EstMembreDe_DateDebut_Separateur###'] = '';
						}
	
						if($premier_enregistrement==true){
							//$markerArray_Equipe_dernier['###EstMembreDe_DateDebut_Dernier###'] = $equipe_row['DateDebut'];
							
							$date_explosee = explode("-", $equipe_row['DateDebut']);

							$annee = (int)$date_explosee[0];
							$mois = (int)$date_explosee[1];
							$jour = (int)$date_explosee[2];

							$markerArray_Equipe_dernier['###EstMembreDe_DateDebut_Dernier###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
							

							if($equipe_row['DateDebut']<>''){
								$markerArray_Equipe_dernier['###EstMembreDe_DateDebut_Dernier_Separateur###'] = $this->lConf['separateurEstMembreDateDebutdernier'];
							}
							else{
								$markerArray_Equipe_dernier['###EstMembreDe_DateDebut_Dernier_Separateur###'] = '';
							}
						}
					}

					if($equipe_row['DateFin']=='0000-00-00'){
						$markerArray_Equipe['###EstMembreDe_DateFin###'] = $this->lConf['equipedatefin'];

						if($this->lConf['equipedatefin']<>''){
							$markerArray_Equipe['###EstMembreDe_DateFin_Separateur###'] = $this->lConf['separateurEstMembreDateFin'];
						}
						else{
							$markerArray_Equipe['###EstMembreDe_DateFin_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_Equipe_dernier['###EstMembreDe_DateFin_Dernier###'] = $this->lConf['equipedatefin'];

							if($this->lConf['equipedatefin']<>''){
								$markerArray_Equipe_dernier['###EstMembreDe_DateFin_Dernier_Separateur###'] = $this->lConf['separateurEstMembreDateFindernier'];
							}
							else{
								$markerArray_Equipe_dernier['###EstMembreDe_DateFin_Dernier_Separateur###'] = '';
							}
						}
					}
					else{
						//$markerArray_Equipe['###EstMembreDe_DateFin###'] = $equipe_row['DateFin'];

						$date_explosee = explode("-", $equipe_row['DateFin']);

						$annee = (int)$date_explosee[0];
						$mois = (int)$date_explosee[1];
						$jour = (int)$date_explosee[2];

						$markerArray_Equipe['###EstMembreDe_DateFin###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
						
						
						if($equipe_row['DateFin']<>''){
							$markerArray_Equipe['###EstMembreDe_DateFin_Separateur###'] = $this->lConf['separateurEstMembreDateFin'];
						}
						else{
							$markerArray_Equipe['###EstMembreDe_DateFin_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							//$markerArray_Equipe_dernier['###EstMembreDe_DateFin_Dernier###'] = $equipe_row['DateFin'];
							
							$date_explosee = explode("-", $equipe_row['DateFin']);

							$annee = (int)$date_explosee[0];
							$mois = (int)$date_explosee[1];
							$jour = (int)$date_explosee[2];

							$markerArray_Equipe_dernier['###EstMembreDe_DateFin_Dernier###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
							

							if($equipe_row['DateFin']<>''){
								$markerArray_Equipe_dernier['###EstMembreDe_DateFin_Dernier_Separateur###'] = $this->lConf['separateurEstMembreDateFindernier'];
							}
							else{
								$markerArray_Equipe_dernier['###EstMembreDe_DateFin_Dernier_Separateur###'] = '';
							}
						}
					}


					$contentEquipe .= $this->cObj->substituteMarkerArrayCached($template['equipe'],$markerArray_Equipe,array(),array());
					if($premier_enregistrement==true){
						$contentEquipe_dernier .= $this->cObj->substituteMarkerArrayCached($template['equipe_dernier'],$markerArray_Equipe_dernier,array(),array());
					}

					$premier_enregistrement = false;
				}

				$subpartArray_Item['###EQUIPE###'] = $contentEquipe;
				$subpartArray_Item['###EQUIPE_DERNIER###'] = $contentEquipe_dernier;




			//**************************************
			// Tables Categorie et  CategorieMembre
			//**************************************
				$contentCategorie = '';
				$contentCategorie_dernier = '';

				$categorie_select_fields = "tx_ligestmembrelabo_Categorie.uid AS uidcategorie, tx_ligestmembrelabo_Categorie.*, tx_ligestmembrelabo_CategorieMembre.*";
				$categorie_from_table = "tx_ligestmembrelabo_MembreDuLabo, tx_ligestmembrelabo_Categorie, tx_ligestmembrelabo_CategorieMembre";
				$categorie_where_clause = "tx_ligestmembrelabo_MembreDuLabo.uid = ".$uid." AND tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_CategorieMembre.idMembreLabo AND tx_ligestmembrelabo_CategorieMembre.deleted<>1 AND tx_ligestmembrelabo_CategorieMembre.idCategorie = tx_ligestmembrelabo_Categorie.uid AND tx_ligestmembrelabo_Categorie.deleted<>1";
				$categorie_groupBy = "";
				$categorie_orderBy = "tx_ligestmembrelabo_CategorieMembre.DateDebut DESC";
				$categorie_limit = "";
				$categorie_tryMemcached = "";

				$categorie_res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($categorie_select_fields, $categorie_from_table, $categorie_where_clause, $categorie_groupBy, $categorie_orderBy, $categorie_tryMemcached);

				$premier_enregistrement = true; //On recupère l'enregistrement ayant la date de début la plus recente

				while($categorie_row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($categorie_res))       {

					//Champ Libelle (multilingue)
						$champLibelle='';
						$champLibelle=$categorie_row['Libelle'];
							//On recherche le libellé traduit de Libelle
						$champLibelle=$this->rechercherUidLangue($categorie_row['uidcategorie'],$categorie_row['sys_language_uid'],$categorie_row['l18n_parent'],$categorie_row['Libelle'],'tx_ligestmembrelabo_Categorie','Libelle');
					$markerArray_Categories['###Categorie_Libelle###'] = $champLibelle;

					if($champLibelle<>''){
						$markerArray_Categories['###Categorie_Libelle_Separateur###'] = $this->lConf['separateurCategorieLibelle'];
					}
					else{
						$markerArray_Categories['###Categorie_Libelle_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						$markerArray_Categories_dernier['###Categorie_Libelle_Dernier###'] = $champLibelle;
						
						if($champLibelle<>''){
							$markerArray_Categories_dernier['###Categorie_Libelle_Dernier_Separateur###'] = $this->lConf['separateurCategorieLibelledernier'];
						}
						else{
							$markerArray_Categories_dernier['###Categorie_Libelle_Dernier_Separateur###'] = '';
						}
					}

					if($categorie_row['DateDebut']=='0000-00-00'){
						$markerArray_Categories['###CategorieMembre_DateDebut###'] = $this->lConf['categoriedatedebut'];
						
						if($this->lConf['categoriedatedebut']<>''){
							$markerArray_Categories['###CategorieMembre_DateDebut_Separateur###'] = $this->lConf['separateurCategorieMembreDateDebut'];
						}
						else{
							$markerArray_Categories['###CategorieMembre_DateDebut_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_Categories_dernier['###CategorieMembre_DateDebut_Dernier###'] = $this->lConf['categoriedatedebut'];

							if($this->lConf['categoriedatedebut']<>''){
								$markerArray_Categories_dernier['###CategorieMembre_DateDebut_Dernier_Separateur###'] = $this->lConf['separateurCategorieMembreDateDebutdernier'];
							}
							else{
								$markerArray_Categories_dernier['###CategorieMembre_DateDebut_Dernier_Separateur###'] = '';
							}
						}
					}
					else{
						//$markerArray_Categories['###CategorieMembre_DateDebut###'] = $categorie_row['DateDebut'];

						$date_explosee = explode("-", $categorie_row['DateDebut']);

						$annee = (int)$date_explosee[0];
						$mois = (int)$date_explosee[1];
						$jour = (int)$date_explosee[2];

						$markerArray_Categories['###CategorieMembre_DateDebut###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
						
						
						
						if($categorie_row['DateDebut']<>''){
							$markerArray_Categories['###CategorieMembre_DateDebut_Separateur###'] = $this->lConf['separateurCategorieMembreDateDebut'];
						}
						else{
							$markerArray_Categories['###CategorieMembre_DateDebut_Separateur###'] = '';
						}
	
						if($premier_enregistrement==true){
							//$markerArray_Categories_dernier['###CategorieMembre_DateDebut_Dernier###'] = $categorie_row['DateDebut'];
							
							$date_explosee = explode("-", $categorie_row['DateDebut']);

							$annee = (int)$date_explosee[0];
							$mois = (int)$date_explosee[1];
							$jour = (int)$date_explosee[2];

							$markerArray_Categories_dernier['###CategorieMembre_DateDebut_Dernier###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
							

							if($categorie_row['DateDebut']<>''){
								$markerArray_Categories_dernier['###CategorieMembre_DateDebut_Dernier_Separateur###'] = $this->lConf['separateurCategorieMembreDateDebutdernier'];
							}
							else{
								$markerArray_Categories_dernier['###CategorieMembre_DateDebut_Dernier_Separateur###'] = '';
							}
						}
					}

					if($categorie_row['DateFin']=='0000-00-00'){
						$markerArray_Categories['###CategorieMembre_DateFin###'] = $this->lConf['categoriedatefin'];

						if($this->lConf['categoriedatefin']<>''){
							$markerArray_Categories['###CategorieMembre_DateFin_Separateur###'] = $this->lConf['separateurCategorieMembreDateFin'];
						}
						else{
							$markerArray_Categories['###CategorieMembre_DateFin_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_Categories_dernier['###CategorieMembre_DateFin_Dernier###'] = $this->lConf['categoriedatefin'];

							if($this->lConf['categoriedatefin']<>''){
								$markerArray_Categories_dernier['###CategorieMembre_DateFin_Dernier_Separateur###'] = $this->lConf['separateurCategorieMembreDateFindernier'];
							}
							else{
								$markerArray_Categories_dernier['###CategorieMembre_DateFin_Dernier_Separateur###'] = '';
							}
						}
					}
					else{
						//$markerArray_Categories['###CategorieMembre_DateFin###'] = $categorie_row['DateFin'];

						$date_explosee = explode("-", $categorie_row['DateFin']);

						$annee = (int)$date_explosee[0];
						$mois = (int)$date_explosee[1];
						$jour = (int)$date_explosee[2];

						$markerArray_Categories['###CategorieMembre_DateFin###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
						
						
						if($categorie_row['DateFin']<>''){
							$markerArray_Categories['###CategorieMembre_DateFin_Separateur###'] = $this->lConf['separateurCategorieMembreDateFin'];
						}
						else{
							$markerArray_Categories['###CategorieMembre_DateFin_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							//$markerArray_Categories_dernier['###CategorieMembre_DateFin_Dernier###'] = $categorie_row['DateFin'];
							
							$date_explosee = explode("-", $categorie_row['DateFin']);

							$annee = (int)$date_explosee[0];
							$mois = (int)$date_explosee[1];
							$jour = (int)$date_explosee[2];

							$markerArray_Categories_dernier['###CategorieMembre_DateFin_Dernier###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));

							if($categorie_row['DateFin']<>''){
								$markerArray_Categories_dernier['###CategorieMembre_DateFin_Dernier_Separateur###'] = $this->lConf['separateurCategorieMembreDateFindernier'];
							}
							else{
								$markerArray_Categories_dernier['###CategorieMembre_DateFin_Dernier_Separateur###'] = '';
							}
						}
					}

					$contentCategorie .= $this->cObj->substituteMarkerArrayCached($template['categories'],$markerArray_Categories,array(),array());
					if($premier_enregistrement==true){
							$contentCategorie_dernier .= $this->cObj->substituteMarkerArrayCached($template['categories_dernier'],$markerArray_Categories_dernier,array(),array());
					}

					$premier_enregistrement = false;
				}

				$subpartArray_Item['###CATEGORIES###'] = $contentCategorie;
				$subpartArray_Item['###CATEGORIES_DERNIER###'] = $contentCategorie_dernier;


			//**************************************
			// Tables TypeDiplome et AObtenu
			//**************************************
			
				$contentDiplomes = '';
				$contentDiplomes_dernier = '';

				$diplomes_select_fields = "tx_ligestmembrelabo_TypeDiplome.uid AS uiddiplome, tx_ligestmembrelabo_TypeDiplome.*, tx_ligestmembrelabo_AObtenu.*";
				$diplomes_from_table = "tx_ligestmembrelabo_MembreDuLabo, tx_ligestmembrelabo_TypeDiplome, tx_ligestmembrelabo_AObtenu";
				$diplomes_where_clause = "tx_ligestmembrelabo_MembreDuLabo.uid = ".$uid." AND tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_AObtenu.idMembreLabo AND tx_ligestmembrelabo_AObtenu.deleted<>1 AND tx_ligestmembrelabo_AObtenu.CodeDiplome = tx_ligestmembrelabo_TypeDiplome.uid AND tx_ligestmembrelabo_TypeDiplome.deleted<>1";
				$diplomes_groupBy = "";
				$diplomes_orderBy = "tx_ligestmembrelabo_AObtenu.DateObtention DESC";
				$diplomes_limit = "";
				$diplomes_tryMemcached = "";

				$diplomes_res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($diplomes_select_fields, $diplomes_from_table, $diplomes_where_clause, $diplomes_groupBy, $diplomes_orderBy, $diplomes_tryMemcached);

				$premier_enregistrement = true; //On recupère l'enregistrement ayant la date de début la plus recente

				while($diplomes_row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($diplomes_res)){
					//Champ Libelle (multilingue)
						$champLibelle='';
						$champLibelle=$diplomes_row['Libelle'];
							//On recherche le libellé traduit de Libelle
						$champLibelle=$this->rechercherUidLangue($diplomes_row['uiddiplome'],$diplomes_row['sys_language_uid'],$diplomes_row['l18n_parent'],$diplomes_row['Libelle'],'tx_ligestmembrelabo_TypeDiplome','Libelle');
					$markerArray_Diplomes['###Diplomes_Libelle###'] = $champLibelle;
					
					if($champLibelle<>''){
						$markerArray_Diplomes['###Diplomes_Libelle_Separateur###'] = $this->lConf['separateurDiplomesLibelle'];
					}
					else{
						$markerArray_Diplomes['###Diplomes_Libelle_Separateur###'] = '';
					}
					
					if($premier_enregistrement==true){
						$markerArray_Diplomes_dernier['###Diplomes_Libelle_Dernier###'] = $champLibelle;
						
						if($champLibelle<>''){
							$markerArray_Diplomes_dernier['###Diplomes_Libelle_Dernier_Separateur###'] = $this->lConf['separateurDiplomesLibelledernier'];
						}
						else{
							$markerArray_Diplomes_dernier['###Diplomes_Libelle_Dernier_Separateur###'] = '';
						}
					}


					$markerArray_Diplomes['###Diplomes_Code###'] = $diplomes_row['Code'];

					if($diplomes_row['Code']<>''){
						$markerArray_Diplomes['###Diplomes_Code_Separateur###'] = $this->lConf['separateurDiplomesCode'];
					}
					else{
						$markerArray_Diplomes['###Diplomes_Code_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						$markerArray_Diplomes_dernier['###Diplomes_Code_Dernier###'] = $diplomes_row['Code'];

						if($diplomes_row['Code']<>''){
							$markerArray_Diplomes_dernier['###Diplomes_Code_Dernier_Separateur###'] = $this->lConf['separateurDiplomesCodedernier'];
						}
						else{
							$markerArray_Diplomes_dernier['###Diplomes_Code_Dernier_Separateur###'] = '';
						}
					}

					if($diplomes_row['DateObtention']=='0000-00-00'){
						$markerArray_Diplomes['###Diplomes_DateObtention###'] = $this->lConf['diplomedateobtention'];
						
						if($premier_enregistrement==true){
							$markerArray_Diplomes_dernier['###Diplomes_DateObtention_Dernier###'] = $this->lConf['diplomedateobtention'];
						}
					}
					else{
						//$markerArray_Diplomes['###Diplomes_DateObtention###'] = $diplomes_row['DateObtention'];

						$date_explosee = explode("-", $diplomes_row['DateObtention']);

						$annee = (int)$date_explosee[0];
						$mois = (int)$date_explosee[1];
						$jour = (int)$date_explosee[2];

						$markerArray_Diplomes['###Diplomes_DateObtention###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
						

						if($diplomes_row['DateObtention']<>''){
							$markerArray_Diplomes['###Diplomes_DateObtention_Separateur###'] = $this->lConf['separateurDiplomesDateObtention'];
						}
						else{
							$markerArray_Diplomes['###Diplomes_DateObtention_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							//$markerArray_Diplomes_dernier['###Diplomes_DateObtention_Dernier###'] = $diplomes_row['DateObtention'];
							
							$date_explosee = explode("-", $diplomes_row['DateObtention']);

							$annee = (int)$date_explosee[0];
							$mois = (int)$date_explosee[1];
							$jour = (int)$date_explosee[2];

							$markerArray_Diplomes_dernier['###Diplomes_DateObtention_Dernier###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
							
							
							if($diplomes_row['DateObtention']<>''){
								$markerArray_Diplomes_dernier['###Diplomes_DateObtention_Dernier_Separateur###'] = $this->lConf['separateurDiplomesDateObtentiondernier'];
							}
							else{
								$markerArray_Diplomes_dernier['###Diplomes_DateObtention_Dernier_Separateur###'] = '';
							}
						}
					}

					$markerArray_Diplomes['###Diplomes_Intitule###'] = $diplomes_row['Intitule'];

					if($diplomes_row['Intitule']<>''){
						$markerArray_Diplomes['###Diplomes_Intitule_Separateur###'] = $this->lConf['separateurDiplomesIntitule'];
					}
					else{
						$markerArray_Diplomes['###Diplomes_Intitule_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						$markerArray_Diplomes_dernier['###Diplomes_Intitule_Dernier###'] = $diplomes_row['Intitule'];

						if($diplomes_row['Intitule']<>''){
							$markerArray_Diplomes_dernier['###Diplomes_Intitule_Dernier_Separateur###'] = $this->lConf['separateurDiplomesIntituledernier'];
						}
						else{
							$markerArray_Diplomes_dernier['###Diplomes_Intitule_Dernier_Separateur###'] = '';
						}
					}

					$markerArray_Diplomes['###Diplomes_LieuDObtention###'] = $diplomes_row['LieuDObtention'];

					if($diplomes_row['LieuDObtention']<>''){
						$markerArray_Diplomes['###Diplomes_LieuDObtention_Separateur###'] = $this->lConf['separateurDiplomesLieuDObtention'];
					}
					else{
						$markerArray_Diplomes['###Diplomes_LieuDObtention_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						$markerArray_Diplomes_dernier['###Diplomes_LieuDObtention_Dernier###'] = $diplomes_row['LieuDObtention'];

						if($diplomes_row['LieuDObtention']<>''){
							$markerArray_Diplomes_dernier['###Diplomes_LieuDObtention_Dernier_Separateur###'] = $this->lConf['separateurDiplomesLieuDObtentiondernier'];
						}
						else{
							$markerArray_Diplomes_dernier['###Diplomes_LieuDObtention_Dernier_Separateur###'] = '';
						}
					}

					$contentDiplomes .= $this->cObj->substituteMarkerArrayCached($template['diplomes'],$markerArray_Diplomes,array(),array());
					if($premier_enregistrement==true){
						$contentDiplomes_dernier .= $this->cObj->substituteMarkerArrayCached($template['diplomes_dernier'],$markerArray_Diplomes_dernier,array(),array());
					}
					$premier_enregistrement=false;
				}

				$subpartArray_Item['###DIPLOMES###'] = $contentDiplomes;
				$subpartArray_Item['###DIPLOMES_DERNIER###'] = $contentDiplomes_dernier;





			//**************************************
			// Tables TypePosteWeb, TypePoste et Possede
			//**************************************

				$contentPostes = '';
				$contentPostes_dernier = '';

				$postes_select_fields = "tx_ligestmembrelabo_TypePosteWeb.uid AS uidposteweb, tx_ligestmembrelabo_TypePosteWeb.sys_language_uid AS sys_language_uidposteweb, tx_ligestmembrelabo_TypePosteWeb.l18n_parent AS l18n_parentposteweb, tx_ligestmembrelabo_TypePosteWeb.*, tx_ligestmembrelabo_TypePoste.uid AS uidposte, tx_ligestmembrelabo_TypePoste.sys_language_uid AS sys_language_uidposte, tx_ligestmembrelabo_TypePoste.l18n_parent AS l18n_parentposte, tx_ligestmembrelabo_TypePoste.*, tx_ligestmembrelabo_Possede.*";
				$postes_from_table = "tx_ligestmembrelabo_MembreDuLabo, tx_ligestmembrelabo_TypePosteWeb, tx_ligestmembrelabo_TypePoste, tx_ligestmembrelabo_Possede";
				$postes_where_clause = "tx_ligestmembrelabo_MembreDuLabo.uid = ".$uid." AND tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_Possede.idMembreLabo AND tx_ligestmembrelabo_Possede.deleted<>1 AND tx_ligestmembrelabo_Possede.idTypePoste = tx_ligestmembrelabo_TypePoste.uid AND tx_ligestmembrelabo_TypePoste.deleted<>1 AND tx_ligestmembrelabo_TypePoste.idTypePosteWeb = tx_ligestmembrelabo_TypePosteWeb.uid AND tx_ligestmembrelabo_TypePosteWeb.deleted<>1";
				$postes_groupBy = "";
				$postes_orderBy = "tx_ligestmembrelabo_Possede.DateDebut DESC";
				$postes_limit = "";
				$postes_tryMemcached = "";

				$postes_res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($postes_select_fields, $postes_from_table, $postes_where_clause, $postes_groupBy, $postes_orderBy, $postes_tryMemcached);

				$premier_enregistrement=true;
				while($postes_row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($postes_res)){
					//Champ Libelle (multilingue)
						$champLibelleWeb='';
						$champLibelleWeb=$postes_row['LibelleWeb'];
							//On recherche le libellé traduit de LibelleWeb
						$champLibelleWeb=$this->rechercherUidLangue($postes_row['uidposteweb'],$postes_row['sys_language_uidposteweb'],$postes_row['l18n_parentposteweb'],$postes_row['LibelleWeb'],'tx_ligestmembrelabo_TypePosteWeb','LibelleWeb');
					$markerArray_Postes['###Postes_LibelleWeb###'] = $champLibelleWeb;

					if($champLibelleWeb<>''){
						$markerArray_Postes['###Postes_LibelleWeb_Separateur###'] = $this->lConf['separateurPostesLibelleWeb'];
					}
					else{
						$markerArray_Postes['###Postes_LibelleWeb_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						$markerArray_Postes_dernier['###Postes_LibelleWeb_Dernier###'] = $champLibelleWeb;
						
						if($champLibelleWeb<>''){
							$markerArray_Postes_dernier['###Postes_LibelleWeb_Dernier_Separateur###'] = $this->lConf['separateurPostesLibelleWebdernier'];
						}
						else{
							$markerArray_Postes_dernier['###Postes_LibelleWeb_Dernier_Separateur###'] = '';
						}
					}

					//Champ Libelle (multilingue)
						$champLibelle='';
						$champLibelle=$postes_row['Libelle'];
							//On recherche le libellé traduit de Libelle
						$champLibelle=$this->rechercherUidLangue($postes_row['uidposte'],$postes_row['sys_language_uidposte'],$postes_row['l18n_parentposte'],$postes_row['Libelle'],'tx_ligestmembrelabo_TypePoste','Libelle');
					$markerArray_Postes['###Postes_Libelle###'] = $champLibelle;

					if($champLibelle<>''){
						$markerArray_Postes['###Postes_Libelle_Separateur###'] = $this->lConf['separateurPostesLibelle'];
					}
					else{
						$markerArray_Postes['###Postes_Libelle_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						$markerArray_Postes_dernier['###Postes_Libelle_Dernier###'] = $champLibelle;

						if($champLibelle<>''){
							$markerArray_Postes_dernier['###Postes_Libelle_Dernier_Separateur###'] = $this->lConf['separateurPostesLibelledernier'];
						}
						else{
							$markerArray_Postes_dernier['###Postes_Libelle_Dernier_Separateur###'] = '';
						}
					}

					if($postes_row['DateDebut']=='0000-00-00'){
						$markerArray_Postes['###Postes_DateDebut###'] = $this->lConf['typepostedatedebut'];

						if($this->lConf['typepostedatedebut']<>''){
							$markerArray_Postes['###Postes_DateDebut_Separateur###'] = $this->lConf['separateurPostesDateDebut'];
						}
						else{
							$markerArray_Postes['###Postes_DateDebut_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_Postes_dernier['###Postes_DateDebut_Dernier###'] = $this->lConf['typepostedatedebut'];

							if($this->lConf['typepostedatedebut']<>''){
								$markerArray_Postes_dernier['###Postes_DateDebut_Dernier_Separateur###'] = $this->lConf['separateurPostesDateDebutdernier'];
							}
							else{
								$markerArray_Postes_dernier['###Postes_DateDebut_Dernier_Separateur###'] = '';
							}
						}
					}
					else{
						//$markerArray_Postes['###Postes_DateDebut###'] = $postes_row['DateDebut'];
						
						$date_explosee = explode("-", $postes_row['DateDebut']);

						$annee = (int)$date_explosee[0];
						$mois = (int)$date_explosee[1];
						$jour = (int)$date_explosee[2];

						$markerArray_Postes['###Postes_DateDebut###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
							
						
						if($postes_row['DateDebut']<>''){
							$markerArray_Postes['###Postes_DateDebut_Separateur###'] = $this->lConf['separateurPostesDateDebut'];
						}
						else{
							$markerArray_Postes['###Postes_DateDebut_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							//$markerArray_Postes_dernier['###Postes_DateDebut_Dernier###'] = $postes_row['DateDebut'];
							$date_explosee = explode("-", $postes_row['DateDebut']);

							$annee = (int)$date_explosee[0];
							$mois = (int)$date_explosee[1];
							$jour = (int)$date_explosee[2];

							$markerArray_Postes_dernier['###Postes_DateDebut_Dernier###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));

							if($postes_row['DateDebut']<>''){
								$markerArray_Postes_dernier['###Postes_DateDebut_Dernier_Separateur###'] = $this->lConf['separateurPostesDateDebutdernier'];
							}
							else{
								$markerArray_Postes_dernier['###Postes_DateDebut_Dernier_Separateur###'] = '';
							}
						}
					}

					if($postes_row['DateFin']=='0000-00-00'){
						$markerArray_Postes['###Postes_DateFin###'] = $this->lConf['typepostedatefin'];
						
						if($this->lConf['typepostedatefin']<>''){
							$markerArray_Postes['###Postes_DateFin_Separateur###'] = $this->lConf['separateurPostesDateFin'];
						}
						else{
							$markerArray_Postes['###Postes_DateFin_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_Postes_dernier['###Postes_DateFin_Dernier###'] = $this->lConf['typepostedatefin'];

							if($this->lConf['typepostedatefin']<>''){
								$markerArray_Postes_dernier['###Postes_DateFin_Dernier_Separateur###'] = $this->lConf['separateurPostesDateFindernier'];
							}
							else{
								$markerArray_Postes_dernier['###Postes_DateFin_Dernier_Separateur###'] = '';
							}
						}
					}
					else{
						//$markerArray_Postes['###Postes_DateFin###'] = $postes_row['DateFin'];

						$date_explosee = explode("-", $postes_row['DateFin']);

						$annee = (int)$date_explosee[0];
						$mois = (int)$date_explosee[1];
						$jour = (int)$date_explosee[2];

						$markerArray_Postes['###Postes_DateFin###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));

						if($postes_row['DateFin']<>''){
							$markerArray_Postes['###Postes_DateFin_Separateur###'] = $this->lConf['separateurPostesDateFin'];
						}
						else{
							$markerArray_Postes['###Postes_DateFin_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							//$markerArray_Postes_dernier['###Postes_DateFin_Dernier###'] = $postes_row['DateFin'];
							
							$date_explosee = explode("-", $postes_row['DateFin']);

							$annee = (int)$date_explosee[0];
							$mois = (int)$date_explosee[1];
							$jour = (int)$date_explosee[2];

							$markerArray_Postes_dernier['###Postes_DateFin_Dernier###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
							
							if($postes_row['DateFin']<>''){
								$markerArray_Postes_dernier['###Postes_DateFin_Dernier_Separateur###'] = $this->lConf['separateurPostesDateFindernier'];
							}
							else{
								$markerArray_Postes_dernier['###Postes_DateFin_Dernier_Separateur###'] = '';
							}
						}
					}

					$contentPostes .= $this->cObj->substituteMarkerArrayCached($template['postes'],$markerArray_Postes,array(),array());
					if($premier_enregistrement==true){
						$contentPostes_dernier .= $this->cObj->substituteMarkerArrayCached($template['postes_dernier'],$markerArray_Postes_dernier,array(),array());
					}

					$premier_enregistrement=false;
				}

				$subpartArray_Item['###POSTES###'] = $contentPostes;
				$subpartArray_Item['###POSTES_DERNIER###'] = $contentPostes_dernier;





		//$template['fonctions_structures'] = $this->cObj->getSubpart($template['item'], '###FONCTIONS_STRUCTURES###');

			//**************************************
			// Tables Fonction, Structure et Exerce
			//**************************************

				$contentFonctionsStructures = '';
				$contentFonctionsStructures_dernier = '';
				
				$fonctionsstructures_select_fields = "tx_ligestmembrelabo_Fonction.uid AS uidfonction, tx_ligestmembrelabo_Fonction.*, tx_ligestmembrelabo_Structure.*, tx_ligestmembrelabo_Exerce.*";
				$fonctionsstructures_from_table = "tx_ligestmembrelabo_MembreDuLabo, tx_ligestmembrelabo_Fonction, tx_ligestmembrelabo_Structure, tx_ligestmembrelabo_Exerce";
				$fonctionsstructures_where_clause = "tx_ligestmembrelabo_MembreDuLabo.uid = ".$uid." AND tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_Exerce.idMembreLabo AND tx_ligestmembrelabo_Exerce.deleted<>1 AND tx_ligestmembrelabo_Exerce.idFonction = tx_ligestmembrelabo_Fonction.uid AND tx_ligestmembrelabo_Fonction.deleted<>1 AND tx_ligestmembrelabo_Exerce.idStructure = tx_ligestmembrelabo_Structure.uid AND tx_ligestmembrelabo_Structure.deleted<>1 ";
				$fonctionsstructures_groupBy = "";
				$fonctionsstructures_orderBy = "tx_ligestmembrelabo_Exerce.DateDebut DESC";
				$fonctionsstructures_limit = "";
				$fonctionsstructures_tryMemcached = "";

				$fonctionsstructures_res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($fonctionsstructures_select_fields, $fonctionsstructures_from_table, $fonctionsstructures_where_clause, $fonctionsstructures_groupBy, $fonctionsstructures_orderBy, $fonctionsstructures_tryMemcached);

				$premier_enregistrement=true;
				while($fonctionsstructures_row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($fonctionsstructures_res)){
					//Champ Libelle (multilingue)
						$champLibelle='';
						$champLibelle=$fonctionsstructures_row['Libelle'];
							//On recherche le libellé traduit de LibelleWeb
						$champLibelle=$this->rechercherUidLangue($fonctionsstructures_row['uidfonction'],$fonctionsstructures_row['sys_language_uid'],$fonctionsstructures_row['l18n_parent'],$fonctionsstructures_row['Libelle'],'tx_ligestmembrelabo_Fonction','Libelle');
					$markerArray_FonctionsStructures['###Fonctions_Libelle###'] = $champLibelle;

					if($champLibelle<>''){
						$markerArray_FonctionsStructures['###Fonctions_Libelle_Separateur###'] = $this->lConf['separateurFonctionsLibelle'];
					}
					else{
						$markerArray_FonctionsStructures['###Fonctions_Libelle_Separateur###'] = '';
					}


					if($premier_enregistrement==true){
						$markerArray_FonctionsStructures_dernier['###Fonctions_Libelle_Dernier###'] = $champLibelle;

						if($champLibelle<>''){
							$markerArray_FonctionsStructures_dernier['###Fonctions_Libelle_Dernier_Separateur###'] = $this->lConf['separateurFonctionsLibelledernier'];
						}
						else{
							$markerArray_FonctionsStructures_dernier['###Fonctions_Libelle_Dernier_Separateur###'] = '';
						}
					}

					$markerArray_FonctionsStructures['###Structures_LibelleDesSaisies###'] = $fonctionsstructures_row['LibelleDesSaisies'];
					if($fonctionsstructures_row['LibelleDesSaisies']<>''){
						$markerArray_FonctionsStructures['###Structures_LibelleDesSaisies_Separateur###'] = $this->lConf['separateurStructuresLibelleDesSaisies'];
					}
					else{
						$markerArray_FonctionsStructures['###Structures_LibelleDesSaisies_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						$markerArray_FonctionsStructures_dernier['###Structures_LibelleDesSaisies_Dernier###'] = $fonctionsstructures_row['LibelleDesSaisies'];

						if($fonctionsstructures_row['LibelleDesSaisies']<>''){
							$markerArray_FonctionsStructures_dernier['###Structures_LibelleDesSaisies_Dernier_Separateur###'] = $this->lConf['separateurStructuresLibelleDesSaisiesdernier'];
						}
						else{
							$markerArray_FonctionsStructures_dernier['###Structures_LibelleDesSaisies_Dernier_Separateur###'] = '';
						}
					}

					$markerArray_FonctionsStructures['###Structures_Nom###'] = $fonctionsstructures_row['Nom'];
					if($fonctionsstructures_row['Nom']<>''){
						$markerArray_FonctionsStructures['###Structures_Nom_Separateur###'] = $this->lConf['separateurStructuresNom'];
					}
					else{
						$markerArray_FonctionsStructures['###Structures_Nom_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						$markerArray_FonctionsStructures_dernier['###Structures_Nom_Dernier###'] = $fonctionsstructures_row['Nom'];

						if($fonctionsstructures_row['Nom']<>''){
							$markerArray_FonctionsStructures_dernier['###Structures_Nom_Dernier_Separateur###'] = $this->lConf['separateurStructuresNomdernier'];
						}
						else{
							$markerArray_FonctionsStructures_dernier['###Structures_Nom_Dernier_Separateur###'] = '';
						}
					}

					//$markerArray_FonctionsStructures['###Structures_Adresse###'] = $fonctionsstructures_row['Adresse'];
					$markerArray_FonctionsStructures['###Structures_Adresse###'] = nl2br($fonctionsstructures_row['Adresse']);
					
					if($fonctionsstructures_row['Adresse']<>''){
						$markerArray_FonctionsStructures['###Structures_Adresse_Separateur###'] = $this->lConf['separateurStructuresAdresse'];
					}
					else{
						$markerArray_FonctionsStructures['###Structures_Adresse_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						//['###Structures_Adresse_Dernier###'] = $fonctionsstructures_row['Adresse'];
						$markerArray_FonctionsStructures_dernier['###Structures_Adresse_Dernier###'] = nl2br($fonctionsstructures_row['Adresse']);

						if($fonctionsstructures_row['Adresse']<>''){
							$markerArray_FonctionsStructures_dernier['###Structures_Adresse_Dernier_Separateur###'] = $this->lConf['separateurStructuresAdressedernier'];
						}
						else{
							$markerArray_FonctionsStructures_dernier['###Structures_Adresse_Dernier_Separateur###'] = '';
						}
					}

					$markerArray_FonctionsStructures['###Structures_Type###'] = $fonctionsstructures_row['Type'];
					if($fonctionsstructures_row['Type']<>''){
						$markerArray_FonctionsStructures['###Structures_Type_Separateur###'] = $this->lConf['separateurStructuresType'];
					}
					else{
						$markerArray_FonctionsStructures['###Structures_Type_Separateur###'] = '';
					}

					if($premier_enregistrement==true){
						$markerArray_FonctionsStructures_dernier['###Structures_Type_Dernier###'] = $fonctionsstructures_row['Type'];
						if($fonctionsstructures_row['Type']<>''){
							$markerArray_FonctionsStructures_dernier['###Structures_Type_Dernier_Separateur###'] = $this->lConf['separateurStructuresTypedernier'];
						}
						else{
							$markerArray_FonctionsStructures_dernier['###Structures_Type_Dernier_Separateur###'] = '';
						}
					}

					if($fonctionsstructures_row['DateDebut']=='0000-00-00'){
						$markerArray_FonctionsStructures['###FonctionsStructures_DateDebut###'] = $this->lConf['fonctionstructuredatedebut'];
						
						
						if($this->lConf['fonctionstructuredatedebut']<>''){
							$markerArray_FonctionsStructures['###Structures_DateDebut_Separateur###'] = $this->lConf['separateurStructuresDateDebut'];
						}
						else{
							$markerArray_FonctionsStructures['###Structures_DateDebut_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_FonctionsStructures_dernier['###FonctionsStructures_DateDebut_Dernier###'] = $this->lConf['fonctionstructuredatedebut'];

							if($this->lConf['fonctionstructuredatedebut']<>''){
								$markerArray_FonctionsStructures_dernier['###Structures_DateDebut_Dernier_Separateur###'] = $this->lConf['separateurStructuresDateDebutdernier'];
							}
							else{
								$markerArray_FonctionsStructures_dernier['###Structures_DateDebut_Dernier_Separateur###'] = '';
							}

						}
					}
					else{
						//$markerArray_FonctionsStructures['###FonctionsStructures_DateDebut###'] = $fonctionsstructures_row['DateDebut'];

						$date_explosee = explode("-", $fonctionsstructures_row['DateDebut']);

						$annee = (int)$date_explosee[0];
						$mois = (int)$date_explosee[1];
						$jour = (int)$date_explosee[2];

						$markerArray_FonctionsStructures['###FonctionsStructures_DateDebut###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
						
						if($fonctionsstructures_row['DateDebut']<>''){
							$markerArray_FonctionsStructures['###Structures_DateDebut_Separateur###'] = $this->lConf['separateurStructuresDateDebut'];
						}
						else{
							$markerArray_FonctionsStructures['###Structures_DateDebut_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							//$markerArray_FonctionsStructures_dernier['###FonctionsStructures_DateDebut_Dernier###'] = $fonctionsstructures_row['DateDebut'];

							$date_explosee = explode("-", $fonctionsstructures_row['DateDebut']);

							$annee = (int)$date_explosee[0];
							$mois = (int)$date_explosee[1];
							$jour = (int)$date_explosee[2];

							$markerArray_FonctionsStructures_dernier['###FonctionsStructures_DateDebut_Dernier###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));

							if($fonctionsstructures_row['DateDebut']<>''){
								$markerArray_FonctionsStructures_dernier['###Structures_DateDebut_Dernier_Separateur###'] = $this->lConf['separateurStructuresDateDebutdernier'];
							}
							else{
								$markerArray_FonctionsStructures_dernier['###Structures_DateDebut_Dernier_Separateur###'] = '';
							}
						}
					}

					if($fonctionsstructures_row['DateFin']=='0000-00-00'){
						$markerArray_FonctionsStructures['###FonctionsStructures_DateFin###'] = $this->lConf['fonctionstructuredatefin'];

						if($this->lConf['fonctionstructuredatefin']<>''){
							$markerArray_FonctionsStructures['###Structures_DateFin_Separateur###'] = $this->lConf['separateurStructuresDateFin'];
						}
						else{
							$markerArray_FonctionsStructures['###Structures_DateFin_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							$markerArray_FonctionsStructures_dernier['###FonctionsStructures_DateFin_Dernier###'] = $this->lConf['fonctionstructuredatefin'];

							if($this->lConf['fonctionstructuredatefin']<>''){
								$markerArray_FonctionsStructures_dernier['###Structures_DateFin_Dernier_Separateur###'] = $this->lConf['separateurStructuresDateFindernier'];
							}
							else{
								$markerArray_FonctionsStructures_dernier['###Structures_DateFin_Dernier_Separateur###'] = '';
							}
						}
					}
					else{
						//$markerArray_FonctionsStructures['###FonctionsStructures_DateFin###'] = $fonctionsstructures_row['DateFin'];
						
						$date_explosee = explode("-", $fonctionsstructures_row['DateFin']);

						$annee = (int)$date_explosee[0];
						$mois = (int)$date_explosee[1];
						$jour = (int)$date_explosee[2];

						$markerArray_FonctionsStructures['###FonctionsStructures_DateFin###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));
						
						if($fonctionsstructures_row['DateFin']<>''){
							$markerArray_FonctionsStructures['###Structures_DateFin_Separateur###'] = $this->lConf['separateurStructuresDateFin'];
						}
						else{
							$markerArray_FonctionsStructures['###Structures_DateFin_Separateur###'] = '';
						}

						if($premier_enregistrement==true){
							//$markerArray_FonctionsStructures_dernier['###FonctionsStructures_DateFin_Dernier###'] = $fonctionsstructures_row['DateFin'];
							
							$date_explosee = explode("-", $fonctionsstructures_row['DateFin']);

							$annee = (int)$date_explosee[0];
							$mois = (int)$date_explosee[1];
							$jour = (int)$date_explosee[2];

							$markerArray_FonctionsStructures_dernier['###FonctionsStructures_DateFin_Dernier###'] = date($this->lConf['formatdate'],mktime(0, 0, 0, $mois, $jour, $annee));

							if($fonctionsstructures_row['DateFin']<>''){
								$markerArray_FonctionsStructures_dernier['###Structures_DateFin_Dernier_Separateur###'] = $this->lConf['separateurStructuresDateFindernier'];
							}
							else{
								$markerArray_FonctionsStructures_dernier['###Structures_DateFin_Dernier_Separateur###'] = '';
							}
						}
					}
					
					$contentFonctionsStructures .= $this->cObj->substituteMarkerArrayCached($template['fonctions_structures'],$markerArray_FonctionsStructures,array(),array());
					if($premier_enregistrement==true){
						$contentFonctionsStructures_dernier .= $this->cObj->substituteMarkerArrayCached($template['fonctions_structures_dernier'],$markerArray_FonctionsStructures_dernier,array(),array());
					}

					$premier_enregistrement=false;
				}

				$subpartArray_Item['###FONCTIONS_STRUCTURES###'] = $contentFonctionsStructures;
				$subpartArray_Item['###FONCTIONS_STRUCTURES_DERNIER###'] = $contentFonctionsStructures_dernier;





			// Fill the temporary item
			$contentItem .= $this->cObj->substituteMarkerArrayCached($template['item'],$markerArray, $subpartArray_Item, $wrappedSubpartContentArray);		
		}
		


		// Fill the content with items in $contentItem
		$subpartArray['###CONTENT###'] = $contentItem;

		// Fill the TEMPLATE subpart
		$content = $this->cObj->substituteMarkerArrayCached($template['total'], array(), $subpartArray);
		
		//$content=$code;
	
		return $this->pi_wrapInBaseClass($content);
	}



}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/pi1/class.tx_ligestmembrelabo_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/li_gest_membre_labo/pi1/class.tx_ligestmembrelabo_pi1.php']);
}

?>