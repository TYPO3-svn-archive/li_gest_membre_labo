<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

// Insertion des classes suplémentaires

// Classe pour la gestion des  dates valides dans les formulaires
$TYPO3_CONF_VARS['SC_OPTIONS']['tce']['formevals']['tx_ligestmembrelabo_dateValide'] = 'EXT:li_gest_membre_labo/class.tx_ligestmembrelabo_dateValide.php';

// Classe pour la gestion des dates obligatoires dans les formulaires
$TYPO3_CONF_VARS['SC_OPTIONS']['tce']['formevals']['tx_ligestmembrelabo_dateObligatoire'] = 'EXT:li_gest_membre_labo/class.tx_ligestmembrelabo_dateObligatoire.php';



// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_MembreDuLabo dans le backend.

// allow MembreDuLabo records on normal pages
t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_MembreDuLabo');
// add the MembreDuLabo record to the insert records content element
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_MembreDuLabo');

$TCA["tx_ligestmembrelabo_MembreDuLabo"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo',		
		'label'     => 'NomDUsage, Prenom',
		'label_alt' => 'NomDUsage, Prenom',	
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY NomDUsage, Prenom",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_MembreDuLabo.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, NomDUsage, NomMarital, NomPreMarital, Prenom, Genre, DateNaissance, Nationalite, DateArrivee, DateSortie, NumINE, SectionCNU, CoordonneesRecherche, CoordonneesEnseignement, email, CoordonneesPersonnelles, PageWeb, Afficher_Equipe, Afficher_Possede, Afficher_Exerce, Afficher_CategorieMembre, Afficher_AObtenu, Afficher_PEDR, Informations",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_Fonction dans le backend.

// allow Fonction records on normal pages
t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Fonction');
// add the Fonction record to the insert records content element
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Fonction');

$TCA["tx_ligestmembrelabo_Fonction"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Fonction',		
		'label'     => 'Libelle',
		'label_alt' => '',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY Libelle",	
		
		'copyAfterDuplFields' => 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'shadowColumnsForNewPlaceholders' => 'sys_language_uid,l18n_parent',
		
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Fonction.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, Libelle",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_Structure dans le backend.

// allow Structure records on normal pages
t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Structure');
// add the Structure record to the insert records content element
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Structure');

$TCA["tx_ligestmembrelabo_Structure"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure',		
		'label'     => 'LibelleDesSaisies',
		'label_alt' => '',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY LibelleDesSaisies",
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Structure.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, LibelleDesSaisies, Nom, Adresse, Type, idStructureParente",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_Exerce dans le backend.

// allow Exerce records on normal pages
//t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Exerce');
// add the Exerce record to the insert records content element
//t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Exerce');

$TCA["tx_ligestmembrelabo_Exerce"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce',		
		'label'     => 'idStructure, idFonction, DateDebut, DateFin',
		'label_alt' => 'idStructure, idFonction, DateDebut, DateFin',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY uid",	
		'delete' => 'deleted',
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Exerce.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idMembreLabo, idStructure, idFonction, DateDebut, DateFin",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_TypePosteWeb dans le backend.

// allow TypePosteWeb records on normal pages
t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_TypePosteWeb');
// add the TypePosteWeb record to the insert records content element
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_TypePosteWeb');

$TCA["tx_ligestmembrelabo_TypePosteWeb"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePosteWeb',		
		'label'     => 'LibelleWeb',
		'label_alt' => '',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',

		'default_sortby' => "ORDER BY sys_language_uid, LibelleWeb",	

		'copyAfterDuplFields' => 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'shadowColumnsForNewPlaceholders' => 'sys_language_uid,l18n_parent',

		
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_TypePosteWeb.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "sys_language_uid, l18n_parent, l18n_diffsource, hidden, idTypePosteWeb, LibelleWeb",
	)
);


// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_TypePoste dans le backend.

// allow TypePoste records on normal pages
t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_TypePoste');
// add the TypePoste record to the insert records content element
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_TypePoste');

$TCA["tx_ligestmembrelabo_TypePoste"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste',		
		'label'     => 'Libelle',
		'label_alt' => '',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		
		'copyAfterDuplFields' => 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'shadowColumnsForNewPlaceholders' => 'sys_language_uid,l18n_parent',
		
		'default_sortby' => "ORDER BY Libelle",	
		'delete' => 'deleted',
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_TypePoste.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idTypePoste, Libelle, idTypePosteWeb",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_Possede dans le backend.

// allow Possede records on normal pages
//t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Possede');
// add the Possede record to the insert records content element
//t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Possede');

$TCA["tx_ligestmembrelabo_Possede"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede',		
		'label'     => 'idTypePoste, DateDebut, DateFin',
		'label_alt' => 'idTypePoste, DateDebut, DateFin',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY idMembreLabo",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Possede.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idMembreLabo, idTypePoste, DateDebut, DateFin",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_Categorie dans le backend.

// allow Categorie records on normal pages
t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Categorie');
// add the Categorie record to the insert records content element
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Categorie');

$TCA["tx_ligestmembrelabo_Categorie"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie',		
		'label'     => 'Libelle',
		'label_alt' => '',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY sys_language_uid, idCategorie, Libelle",	
		
				
		'copyAfterDuplFields' => 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'shadowColumnsForNewPlaceholders' => 'sys_language_uid,l18n_parent',
		
		
		'delete' => 'deleted',
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Categorie.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "sys_language_uid, l18n_parent, l18n_diffsource, hidden, idCategorie, Libelle",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_CategorieMembre dans le backend.

// allow CategorieMembre records on normal pages
//t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_CategorieMembre');
// add the CategorieMembre record to the insert records content element
//t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_CategorieMembre');

$TCA["tx_ligestmembrelabo_CategorieMembre"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_CategorieMembre',		
		'label'     => 'idCategorie, DateDebut, DateFin',
		'label_alt' => 'idCategorie, DateDebut, DateFin',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY uid",
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_CategorieMembre.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idMembreLabo, idCategorie, DateDebut, DateFin",
	)
);


// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_Equipe dans le backend.

// allow Equipe records on normal pages
t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Equipe');
// add the Equipe record to the insert records content element
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Equipe');

$TCA["tx_ligestmembrelabo_Equipe"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Equipe',		
		'label'     => 'Abreviation',
		'label_alt' => '',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		
		'copyAfterDuplFields' => 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'shadowColumnsForNewPlaceholders' => 'sys_language_uid,l18n_parent',
		
		'default_sortby' => "ORDER BY Abreviation, Nom",	
		'delete' => 'deleted',	
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Equipe.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, Nom, Abreviation",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_EstMembreDe dans le backend.

// allow EstMembreDe records on normal pages
//t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_EstMembreDe');
// add the EstMembreDe record to the insert records content element
//t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_EstMembreDe');

$TCA["tx_ligestmembrelabo_EstMembreDe"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe',		
		'label'     => 'idEquipe, DateDebut, DateFin',
		'label_alt' => 'idEquipe, DateDebut, DateFin',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY uid",
		'delete' => 'deleted',
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_EstMembreDe.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idMembreLabo, idEquipe, Rang, DateDebut, DateFin",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_TypeDiplome dans le backend.

// allow TypeDiplome records on normal pages
t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_TypeDiplome');
// add the TypeDiplome record to the insert records content element
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_TypeDiplome');

$TCA["tx_ligestmembrelabo_TypeDiplome"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypeDiplome',		
		'label'     => 'Libelle',
		'label_alt' => '',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		
		'copyAfterDuplFields' => 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'languageField' => 'sys_language_uid',
		'shadowColumnsForNewPlaceholders' => 'sys_language_uid,l18n_parent',
		
		'default_sortby' => "ORDER BY Code, Libelle",	
		'delete' => 'deleted',
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_TypeDiplome.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "sys_language_uid, l18n_parent, l18n_diffsource, hidden, Code, Libelle",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_AObtenu dans le backend.

// allow AObtenu records on normal pages
//t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_AObtenu');
// add the AObtenu record to the insert records content element
//t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_AObtenu');

$TCA["tx_ligestmembrelabo_AObtenu"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu',
		'label'     => 'Intitule, CodeDiplome',
		'label_alt' => 'Intitule, CodeDiplome',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY Intitule",
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_AObtenu.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idMembreLabo, CodeDiplome, DateObtention, Intitule, LieuDObtention",
	)
);

// Paramétrage de l'affichage de listes d'enregistrement de la table tx_ligestmembrelabo_PEDR dans le backend.

// allow PEDR records on normal pages
//t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_PEDR');
// add the PEDR record to the insert records content element
//t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_PEDR');

$TCA["tx_ligestmembrelabo_PEDR"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_PEDR',
		'label'     => 'DateDebut, DateFin',
		'label_alt' => 'DateDebut, DateFin',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY DateDebut",
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_PEDR.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idMembreLabo, DateDebut, DateFin",
	)
);


// load tt_content to $TCA array
t3lib_div::loadTCA('tt_content');

// remove some fields from the tt_content content element
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';

// add FlexForm field to tt_content
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform';

// add li_gest_membre_labo to the "insert plugin" content element
t3lib_extMgm::addPlugin(array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');

// initialize static extension templates
t3lib_extMgm::addStaticFile($_EXTKEY,"pi1/static/","Managing Member");

// initalize "context sensitive help" (csh)
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_MembreDuLabo','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_MembreDuLabo.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_Fonction','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Fonction.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_Structure','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Structure.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_Exerce','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Exerce.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_TypePosteWeb','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_TypePosteWeb.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_TypePoste','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_TypePoste.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_Possede','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Possede.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_Categorie','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Categorie.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_CategorieMembre','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_CategorieMembre.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_Equipe','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Equipe.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_EstMembreDe','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_EstMembreDe.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_TypeDiplome','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_TypeDiplome.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_AObtenu','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_AObtenu.xml');
t3lib_extMgm::addLLrefForTCAdescr('tx_ligestmembrelabo_PEDR','EXT:li_gest_membre_labo/csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_PEDR.xml');


// switch the XML files for the FlexForm
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:li_gest_membre_labo/flexform_ds_pi1.xml');


if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_ligestmembrelabo_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_ligestmembrelabo_pi1_wizicon.php';
?>