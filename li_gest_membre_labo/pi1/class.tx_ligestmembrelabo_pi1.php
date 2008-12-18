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
	
	//Choix du type de poste
	//Cette fonction permet de créer une clause concernant le type de poste
	private function typeDePoste($typeDePoste,$typeDate)
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

			//Gestion des dates...
			if($typeDate=='Actuels')
			{
				$postes = $postes.' AND tx_ligestmembrelabo_Possede.DateDebut<"'.date('Y-m-d').'" AND (tx_ligestmembrelabo_Possede.DateFin>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_Possede.DateFin="0000-00-00")';
			}
			else if($typeDate=='Anciens')
			{
				$postes = $postes.' AND tx_ligestmembrelabo_Possede.DateFin<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_Possede.DateFin<>"0000-00-00"';
			}
				
			return $postes;
	}
	
	
	
	
	//Choix des categories
	//Cette fonction permet de créer une clause concernant les categories
	//id_categories contient une chaîne de caractères des uid des catégories à afficher (séparés par des virgules)
	//typeDate contient le type de date à afficher (Actuels, Tous ou Anciens)
	private function categorie($uid_categories,$typeDate)
	{
			//Création de la clause permettant l'affichage que de certains types de poste...
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
				$categories = $categories.' AND tx_ligestmembrelabo_CategorieMembre.DateDebut<"'.date('Y-m-d').'" AND (tx_ligestmembrelabo_CategorieMembre.DateFin>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_CategorieMembre.DateFin="0000-00-00")';
			}
			else if($typeDate=='Anciens')
			{
				$categories = $categories.' AND tx_ligestmembrelabo_CategorieMembre.DateFin<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_CategorieMembre.DateFin<>"0000-00-00"';
			}
				
			return $categories;
	}
	
	
	
	
	//Choix des structures
	//Cette fonction permet de créer une clause concernant les structures
	//uid_structures contient une chaîne de caractères des uid des catégories à afficher (séparés par des virgules)
	//typeDate contient le type de date à afficher (Actuels, Tous ou Anciens)
	private function structure($uid_structures,$typeDate)
	{
			//Création de la clause permettant l'affichage que de certains types de poste...
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
				$structures = $structures.' AND tx_ligestmembrelabo_Exerce.DateDebut<"'.date('Y-m-d').'" AND (tx_ligestmembrelabo_Exerce.DateFin>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_Exerce.DateFin="0000-00-00")';
			}
			else if($typeDate=='Anciens')
			{
				$structures = $structures.' AND tx_ligestmembrelabo_Exerce.DateFin<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_Exerce.DateFin<>"0000-00-00"';
			}
				
			return $structures;
	}
	
	
	//Recherche des structures filles
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
	

	
	//Choix des fonctions
	//Cette fonction permet de créer une clause concernant les fonctions
	//uid_fonctions contient une chaîne de caractères des uid des fonctions à afficher (séparés par des virgules)
	//typeDate contient le type de date à afficher (Actuels, Tous ou Anciens)
	private function fonction($uid_fonctions,$typeDate)
	{
			//Création de la clause permettant l'affichage que de certains types de poste...
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
				$fonctions = $fonctions.' AND tx_ligestmembrelabo_Exerce.DateDebut<"'.date('Y-m-d').'" AND (tx_ligestmembrelabo_Exerce.DateFin>="'.date('Y-m-d').'" OR tx_ligestmembrelabo_Exerce.DateFin="0000-00-00")';
			}
			else if($typeDate=='Anciens')
			{
				$fonctions = $fonctions.' AND tx_ligestmembrelabo_Exerce.DateFin<"'.date('Y-m-d').'" AND tx_ligestmembrelabo_Exerce.DateFin<>"0000-00-00"';
			}
				
			return $fonctions;
	}



	//Choix des diplomes
	//Cette fonction permet de créer une clause concernant les diplomes
	//uid_diplomes contient une chaîne de caractères des uid des diplomes à afficher (séparés par des virgules)
	private function diplome($uid_diplomes)
	{
			//Création de la clause permettant l'affichage que de certains types de poste...
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
					$diplomes=$diplomes.'tx_ligestmembrelabo_Fonction.uid='.$diplome_courant;
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


		//Gestion de gabarits (Template)

		$this->templateCode = $this->cObj->fileResource($this->lConf["template_file"]);

		$template = array();

		$template['total'] = $this->cObj->getSubpart($this->templateCode, '###TEMPLATE###');

		$template['item'] = $this->cObj->getSubpart($template['total'], '###ITEM###');

		$template['categories'] = $this->cObj->getSubpart($template['item'], '###CATEGORIES###');
		$template['categories_dernier'] = $this->cObj->getSubpart($template['item'], '###CATEGORIES_DERNIER###');

		$template['equipe'] = $this->cObj->getSubpart($template['item'], '###EQUIPE###');

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

			

			//$select = $select.', tx_ligestmembrelabo_EstMembreDe.*, tx_ligestmembrelabo_Equipe.*';
			$table = $table.', tx_ligestmembrelabo_EstMembreDe, tx_ligestmembrelabo_Equipe';
			$where = $where.' AND tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_EstMembreDe.idMembreLabo AND tx_ligestmembrelabo_EstMembreDe.idEquipe = tx_ligestmembrelabo_Equipe.uid';
			if (($this->lConf['labo'])<>''){
				$where = $where.' AND tx_ligestmembrelabo_EstMembreDe.deleted<>1 AND tx_ligestmembrelabo_Equipe.deleted<>1 AND (tx_ligestmembrelabo_Equipe.Nom = "'.$this->lConf['labo'].'" OR tx_ligestmembrelabo_Equipe.Abreviation = "'.$this->lConf['labo'].'")';
			}



			/********************FILTRES********************/
			//Ces filtres rajoute des contraintes sur la requête à afficher


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
			
			
			//Gestion des structures
			$structure = $this->structure($this->lConf['structure'],$this->lConf['datetypestructure']);
			if($structure<>""){
				//$select = $select.', tx_ligestmembrelabo_Structure.*';
				$table = $table.', tx_ligestmembrelabo_Structure';
				$where = $where.' AND tx_ligestmembrelabo_Structure.deleted<>1 AND tx_ligestmembrelabo_Exerce.idStructure = tx_ligestmembrelabo_Structure.uid';
				$where = $where.$structure;
			}
			
			
			
			//Gestion des fonctions
			$fonction = $this->fonction($this->lConf['fonction'],$this->lConf['datetypefonction']);
			if($fonction<>""){
				//$select = $select.', tx_ligestmembrelabo_Fonction.*';
				$table = $table.', tx_ligestmembrelabo_Fonction';
				$where = $where.' AND tx_ligestmembrelabo_Fonction.deleted<>1 AND tx_ligestmembrelabo_Exerce.idFonction = tx_ligestmembrelabo_Fonction.uid';
				$where = $where.$fonction;
			}
			
			
						
			if($structure<>"" || $fonction<>"")
			{
				//$select = $select.', tx_ligestmembrelabo_Exerce.*';
				$table = $table.', tx_ligestmembrelabo_Exerce';
				$where = $where.' AND tx_ligestmembrelabo_Exerce.deleted<>1 AND tx_ligestmembrelabo_Exerce.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.uid';
			}
			
			
			
			//Gestion des diplomes
			$diplome = $this->diplome($this->lConf['diplome']);
			if($diplome<>""){
				//$select = $select.', tx_ligestmembrelabo_TypeDiplome.*, tx_ligestmembrelabo_AObtenu.*';
				$table = $table.', tx_ligestmembrelabo_TypeDiplome, tx_ligestmembrelabo_AObtenu';
				$where = $where.' AND tx_ligestmembrelabo_TypeDiplome.deleted<>1 AND tx_ligestmembrelabo_AObtenu.deleted<>1 AND tx_ligestmembrelabo_AObtenu.idMembreLabo = tx_ligestmembrelabo_MembreDuLabo.uid AND tx_ligestmembrelabo_AObtenu.CodeDiplome = tx_ligestmembrelabo_TypeDiplome.uid';
				$where = $where.$diplome;
			}


			// Création de la clause permettant de ne choisir que certains membres selon les dossiers sélectionnés
			//On récupère tous les sous-dossiers...
			$dossiers = '';	
			
			$pid = array(); //dossiers sélectionnés
			$pages = array(); //dossiers et sous dossiers...
			
			$chaine = $this->lConf['pid'];
			
			if ($chaine!=''){
				$dossiers = $dossiers.' AND (';
				$pid = Explode(",",$chaine);
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
		$markerArray_Categories = array();
		$contentItem='';

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields, $from_table, $where_clause, $groupBy, $orderBy, $tryMemcached);

		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))       {

			//**************************************
			$uid=$row['uidmembre'];
			// Table MembreDuLabo

			//$markerArray['###uid###'] = $row['uidmembre'];
			$markerArray['###NomDUsage###'] = $row['NomDUsage'];
			$markerArray['###NOMDUSAGE###'] = mb_strtoupper($row['NomDUsage'],"UTF-8");

			$markerArray['###NomMaritale###'] = $row['NomMaritale'];
			$markerArray['###NOMMARITALE###'] = mb_strtoupper($row['NomMaritale'],"UTF-8");

			$markerArray['###NomPreMarital###'] = $row['NomPreMarital'];
			$markerArray['###NOMPREMARITAL###'] = mb_strtoupper($row['NomPreMarital'],"UTF-8");

			$markerArray['###Prenom###'] = $row['Prenom'];
			$markerArray['###PRENOM###'] = mb_strtoupper($row['Prenom'],"UTF-8");

			// Afficher les initailes d'un membre
			$markerArray['###InitialesPN###'] = substr($row['Prenom'],0,1).'.'.substr($row['NomDUsage'],0,1).'.';
			$markerArray['###InitialesNP###'] = substr($row['NomDUsage'],0,1).'.'.substr($row['Prenom'],0,1).'.';


			$markerArray['###Genre###'] = $row['Genre'];
			if($row['DateNaissance']=='0000-00-00'){
				$markerArray['###DateNaissance###'] = $this->lConf['datenaissance'];
			}
			else{
				$markerArray['###DateNaissance###'] = $row['DateNaissance'];
			}

			$markerArray['###Nationalite###'] = $row['Nationalite'];
			$markerArray['###NATIONALITE###'] = mb_strtoupper($row['Nationalite'],"UTF-8");

			if($row['DateArrivee']=='0000-00-00'){
				$markerArray['###DateArrivee###'] = $this->lConf['datearrivee'];
			}
			else{
				$markerArray['###DateArrivee###'] = $row['DateArrivee'];
			}
			if($row['DateSortie']=='0000-00-00'){
				$markerArray['###DateSortie###'] = $this->lConf['datesortie'];
			}
			else{
				$markerArray['###DateSortie###'] = $row['DateSortie'];
			}
			$markerArray['###NumINE###'] = $row['NumINE'];
			$markerArray['###SectionCNU###'] = $row['SectionCNU'];
			$markerArray['###CoordonneesRecherche###'] = $row['CoordonneesRecherche'];
			$markerArray['###CoordonneesEnseignement###'] = $row['CoordonneesEnseignement'];
			$markerArray['###email###'] = $row['email'];
			$markerArray['###CoordonneesPersonnelles###'] = $row['CoordonneesPersonnelles'];
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


			//**************************************
			// Tables Equipe et EstMembreDe
			//**************************************
				$contentEquipe = '';
				$equipe_select_fields = "tx_ligestmembrelabo_Equipe.uid AS uidequipe, tx_ligestmembrelabo_Equipe.*, tx_ligestmembrelabo_EstMembreDe.*";
				$equipe_from_table = "tx_ligestmembrelabo_MembreDuLabo, tx_ligestmembrelabo_Equipe, tx_ligestmembrelabo_EstMembreDe";
				$equipe_where_clause = "tx_ligestmembrelabo_MembreDuLabo.uid = ".$uid." AND tx_ligestmembrelabo_MembreDuLabo.uid = tx_ligestmembrelabo_EstMembreDe.idMembreLabo AND tx_ligestmembrelabo_EstMembreDe.deleted<>1 AND tx_ligestmembrelabo_EstMembreDe.idEquipe = tx_ligestmembrelabo_Equipe.uid AND tx_ligestmembrelabo_Equipe.deleted<>1";
				$equipe_groupBy = "";
				$equipe_orderBy = "";
				$equipe_limit = "";
				$equipe_tryMemcached = "";

				$equipe_res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($equipe_select_fields, $equipe_from_table, $equipe_where_clause, $equipe_groupBy, $equipe_orderBy, $equipe_tryMemcached);
				
				while($equipe_row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($equipe_res)){
					//Champ Libelle (multilingue)
						$champNom='';
						$champNom=$equipe_row['Nom'];
							//On recherche le libellé traduit de Libelle
						$champNom=$this->rechercherUidLangue($equipe_row['uidequipe'],$equipe_row['sys_language_uid'],$equipe_row['l18n_parent'],$equipe_row['Nom'],'tx_ligestmembrelabo_Equipe','Nom');
					$markerArray_Equipe['###Equipe_Nom###'] = $champNom;

					$markerArray_Equipe['###Equipe_Abreviation###'] = $equipe_row['Abreviation'];

					/*$rang='';
					if ($equipe_row['Rang']=='1')
					{
						$rang="Responsable d'équipe";
					}
					else if ($equipe_row['Rang']=='2')
					{
						$rang="Responsable adjoint";
					}
					$markerArray_Equipe['###EstMembreDe_Rang###'] = $rang;
					*/
					$markerArray_Equipe['###EstMembreDe_Rang###'] = $equipe_row['Rang'];

					$contentEquipe .= $this->cObj->substituteMarkerArrayCached($template['equipe'],$markerArray_Equipe,array(),array());
				}

				$subpartArray_Item['###EQUIPE###'] = $contentEquipe;





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
					if($premier_enregistrement==true){
						$markerArray_Categories_dernier['###Categorie_Libelle_Dernier###'] = $champLibelle;
					}
					
					if($categorie_row['DateDebut']=='0000-00-00'){
						$markerArray_Categories['###CategorieMembre_DateDebut###'] = $this->lConf['categoriedatedebut'];
						if($premier_enregistrement==true){
							$markerArray_Categories_dernier['###CategorieMembre_DateDebut_Dernier###'] = $this->lConf['categoriedatedebut'];
						}
					}
					else{
						$markerArray_Categories['###CategorieMembre_DateDebut###'] = $categorie_row['DateDebut'];
						if($premier_enregistrement==true){
							$markerArray_Categories_dernier['###CategorieMembre_DateDebut_Dernier###'] = $categorie_row['DateDebut'];
						}
					}
					
					if($categorie_row['DateFin']=='0000-00-00'){
						$markerArray_Categories['###CategorieMembre_DateFin###'] = $this->lConf['categoriedatefin'];
						if($premier_enregistrement==true){
							$markerArray_Categories_dernier['###CategorieMembre_DateFin_Dernier###'] = $this->lConf['categoriedatefin'];
						}
					}
					else{
						$markerArray_Categories['###CategorieMembre_DateFin###'] = $categorie_row['DateFin'];
						if($premier_enregistrement==true){
							$markerArray_Categories_dernier['###CategorieMembre_DateFin_Dernier###'] = $categorie_row['DateFin'];
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
					if($premier_enregistrement==true){
						$markerArray_Diplomes_dernier['###Diplomes_Libelle_Dernier###'] = $champLibelle;
					}

					$markerArray_Diplomes['###Diplomes_Code###'] = $diplomes_row['Code'];
					if($premier_enregistrement==true){
						$markerArray_Diplomes_dernier['###Diplomes_Code_Dernier###'] = $diplomes_row['Code'];
					}

					if($diplomes_row['DateObtention']=='0000-00-00'){
						$markerArray_Diplomes['###Diplomes_DateObtention###'] = $this->lConf['diplomedateobtention'];
						if($premier_enregistrement==true){
							$markerArray_Diplomes_dernier['###Diplomes_DateObtention_Dernier###'] = $this->lConf['diplomedateobtention'];
						}
					}
					else{
						$markerArray_Diplomes['###Diplomes_DateObtention###'] = $diplomes_row['DateObtention'];
						if($premier_enregistrement==true){
							$markerArray_Diplomes_dernier['###Diplomes_DateObtention_Dernier###'] = $diplomes_row['DateObtention'];
						}
					}

					$markerArray_Diplomes['###Diplomes_Intitule###'] = $diplomes_row['Intitule'];
					if($premier_enregistrement==true){
						$markerArray_Diplomes_dernier['###Diplomes_Intitule_Dernier###'] = $diplomes_row['Intitule'];
					}

					$markerArray_Diplomes['###Diplomes_LieuDObtention###'] = $diplomes_row['LieuDObtention'];
					if($premier_enregistrement==true){
						$markerArray_Diplomes_dernier['###Diplomes_LieuDObtention_Dernier###'] = $diplomes_row['LieuDObtention'];
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
					if($premier_enregistrement==true){
						$markerArray_Postes_dernier['###Postes_LibelleWeb_Dernier###'] = $champLibelleWeb;
					}

					//Champ Libelle (multilingue)
						$champLibelle='';
						$champLibelle=$postes_row['Libelle'];
							//On recherche le libellé traduit de Libelle
						$champLibelle=$this->rechercherUidLangue($postes_row['uidposte'],$postes_row['sys_language_uidposte'],$postes_row['l18n_parentposte'],$postes_row['Libelle'],'tx_ligestmembrelabo_TypePoste','Libelle');
					$markerArray_Postes['###Postes_Libelle###'] = $champLibelle;
					if($premier_enregistrement==true){
						$markerArray_Postes_dernier['###Postes_Libelle_Dernier###'] = $champLibelle;
					}

					if($postes_row['DateDebut']=='0000-00-00'){
						$markerArray_Postes['###Postes_DateDebut###'] = $this->lConf['typepostedatedebut'];
						if($premier_enregistrement==true){
							$markerArray_Postes_dernier['###Postes_DateDebut_Dernier###'] = $this->lConf['typepostedatedebut'];
						}
					}
					else{
						$markerArray_Postes['###Postes_DateDebut###'] = $postes_row['DateDebut'];
						if($premier_enregistrement==true){
							$markerArray_Postes_dernier['###Postes_DateDebut_Dernier###'] = $postes_row['DateDebut'];
						}
					}

					if($postes_row['DateFin']=='0000-00-00'){
						$markerArray_Postes['###Postes_DateFin###'] = $this->lConf['typepostedatefin'];
						if($premier_enregistrement==true){
							$markerArray_Postes_dernier['###Postes_DateFin_Dernier###'] = $this->lConf['typepostedatefin'];
						}
					}
					else{
						$markerArray_Postes['###Postes_DateFin###'] = $postes_row['DateFin'];
						if($premier_enregistrement==true){
							$markerArray_Postes_dernier['###Postes_DateFin_Dernier###'] = $postes_row['DateFin'];
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
					if($premier_enregistrement==true){
						$markerArray_FonctionsStructures_dernier['###Fonctions_Libelle_Dernier###'] = $champLibelle;
					}

					$markerArray_FonctionsStructures['###Structures_LibelleDesSaisies###'] = $fonctionsstructures_row['LibelleDesSaisies'];
					if($premier_enregistrement==true){
						$markerArray_FonctionsStructures_dernier['###Structures_LibelleDesSaisies_Dernier###'] = $fonctionsstructures_row['LibelleDesSaisies'];
					}

					$markerArray_FonctionsStructures['###Structures_Nom###'] = $fonctionsstructures_row['Nom'];
					if($premier_enregistrement==true){
						$markerArray_FonctionsStructures_dernier['###Structures_Nom_Dernier###'] = $fonctionsstructures_row['Nom'];
					}

					$markerArray_FonctionsStructures['###Structures_Adresse###'] = $fonctionsstructures_row['Adresse'];
					if($premier_enregistrement==true){
						$markerArray_FonctionsStructures_dernier['###Structures_Adresse_Dernier###'] = $fonctionsstructures_row['Adresse'];
					}

					$markerArray_FonctionsStructures['###Structures_Type###'] = $fonctionsstructures_row['Type'];
					if($premier_enregistrement==true){
						$markerArray_FonctionsStructures_dernier['###Structures_Type_Dernier###'] = $fonctionsstructures_row['Type'];
					}

					if($fonctionsstructures_row['DateDebut']=='0000-00-00'){
						$markerArray_FonctionsStructures['###FonctionsStructures_DateDebut###'] = $this->lConf['fonctionstructuredatedebut'];
						if($premier_enregistrement==true){
							$markerArray_FonctionsStructures_dernier['###FonctionsStructures_DateDebut_Dernier###'] = $this->lConf['fonctionstructuredatedebut'];
						}
					}
					else{
						$markerArray_FonctionsStructures['###FonctionsStructures_DateDebut###'] = $fonctionsstructures_row['DateDebut'];
						if($premier_enregistrement==true){
							$markerArray_FonctionsStructures_dernier['###FonctionsStructures_DateDebut_Dernier###'] = $fonctionsstructures_row['DateDebut'];
						}
					}
					
					if($fonctionsstructures_row['DateFin']=='0000-00-00'){
						$markerArray_FonctionsStructures['###FonctionsStructures_DateFin###'] = $this->lConf['fonctionstructuredatefin'];
						if($premier_enregistrement==true){
							$markerArray_FonctionsStructures_dernier['###FonctionsStructures_DateFin_Dernier###'] = $this->lConf['fonctionstructuredatefin'];
						}
					}
					else{
						$markerArray_FonctionsStructures['###FonctionsStructures_DateFin###'] = $fonctionsstructures_row['DateFin'];
						if($premier_enregistrement==true){
							$markerArray_FonctionsStructures_dernier['###FonctionsStructures_DateFin_Dernier###'] = $fonctionsstructures_row['DateFin'];
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