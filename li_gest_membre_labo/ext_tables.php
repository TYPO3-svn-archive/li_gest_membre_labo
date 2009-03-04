<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


$TYPO3_CONF_VARS['SC_OPTIONS']['tce']['formevals']['tx_ligestmembrelabo_dateValide'] = 'EXT:li_gest_membre_labo/class.tx_ligestmembrelabo_dateValide.php';
$TYPO3_CONF_VARS['SC_OPTIONS']['tce']['formevals']['tx_ligestmembrelabo_dateObligatoire'] = 'EXT:li_gest_membre_labo/class.tx_ligestmembrelabo_dateObligatoire.php';

t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_MembreDuLabo');
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

t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Fonction');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Fonction');

$TCA["tx_ligestmembrelabo_Fonction"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Fonction',		
		'label'     => 'Libelle',
		'label_alt' => 'Libelle',
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

t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Structure');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Structure');

$TCA["tx_ligestmembrelabo_Structure"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure',		
		'label'     => 'LibelleDesSaisies',
		'label_alt' => 'LibelleDesSaisies',
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


t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Exerce');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Exerce');

$TCA["tx_ligestmembrelabo_Exerce"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce',		
		'label'     => 'idMembreLabo, idStructure, idFonction, DateDebut, DateFin',
		'label_alt' => 'idMembreLabo, idStructure, idFonction, DateDebut, DateFin',
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

t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_TypePosteWeb');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_TypePosteWeb');

$TCA["tx_ligestmembrelabo_TypePosteWeb"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePosteWeb',		
		'label'     => 'LibelleWeb',
		'label_alt' => 'LibelleWeb',
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




t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_TypePoste');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_TypePoste');

$TCA["tx_ligestmembrelabo_TypePoste"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste',		
		'label'     => 'Libelle',
		'label_alt' => 'Libelle',
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

t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Possede');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Possede');

$TCA["tx_ligestmembrelabo_Possede"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede',		
		'label'     => 'idMembreLabo, idTypePoste, DateDebut, DateFin',
		'label_alt' => 'idMembreLabo, idTypePoste, DateDebut, DateFin',
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

t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Categorie');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Categorie');

$TCA["tx_ligestmembrelabo_Categorie"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie',		
		'label'     => 'Libelle',
		'label_alt' => 'Libelle',
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

t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_CategorieMembre');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_CategorieMembre');

$TCA["tx_ligestmembrelabo_CategorieMembre"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_CategorieMembre',		
		'label'     => 'idMembreLabo, idCategorie, DateDebut, DateFin',
		'label_alt' => 'idMembreLabo, idCategorie, DateDebut, DateFin',
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



t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_Equipe');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_Equipe');

$TCA["tx_ligestmembrelabo_Equipe"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Equipe',		
		'label'     => 'Abreviation',
		'label_alt' => 'Abreviation',
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

t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_EstMembreDe');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_EstMembreDe');

$TCA["tx_ligestmembrelabo_EstMembreDe"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe',		
		'label'     => 'idMembreLabo, idEquipe, DateDebut, DateFin',
		'label_alt' => 'idMembreLabo, idEquipe, DateDebut, DateFin',
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

t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_TypeDiplome');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_TypeDiplome');

$TCA["tx_ligestmembrelabo_TypeDiplome"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypeDiplome',		
		'label'     => 'Libelle',
		'label_alt' => 'Libelle',
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

t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_AObtenu');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_AObtenu');

$TCA["tx_ligestmembrelabo_AObtenu"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu',
		'label'     => 'idMembreLabo, Intitule, CodeDiplome',
		'label_alt' => 'idMembreLabo, Intitule, CodeDiplome',
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


t3lib_extMgm::allowTableOnStandardPages('tx_ligestmembrelabo_PEDR');
t3lib_extMgm::addToInsertRecords('tx_ligestmembrelabo_PEDR');

$TCA["tx_ligestmembrelabo_PEDR"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_PEDR',
		'label'     => 'idMembreLabo, DateDebut, DateFin',
		'label_alt' => 'idMembreLabo, DateDebut, DateFin',
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



t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform'; //Ajouté


t3lib_extMgm::addPlugin(array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');


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







t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:li_gest_membre_labo/flexform_ds_pi1.xml'); //Ajouté


if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_ligestmembrelabo_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_ligestmembrelabo_pi1_wizicon.php';
?>