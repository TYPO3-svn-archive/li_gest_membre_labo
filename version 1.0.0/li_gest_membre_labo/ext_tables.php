<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');


$TYPO3_CONF_VARS['SC_OPTIONS']['tce']['formevals']['tx_ligestmembrelabo_dateValide'] = 'EXT:li_gest_membre_labo/class.tx_ligestmembrelabo_dateValide.php';
$TYPO3_CONF_VARS['SC_OPTIONS']['tce']['formevals']['tx_ligestmembrelabo_dateObligatoire'] = 'EXT:li_gest_membre_labo/class.tx_ligestmembrelabo_dateObligatoire.php';



$TCA["tx_ligestmembrelabo_MembreDuLabo"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo',		
		'label'     => 'uid',
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
		"fe_admin_fieldList" => "hidden, NomDUsage, NomMaritale, NomPreMarital, Prenom, Genre, DateNaissance, Nationalite, DateArrivee, DateSortie, NumINE, SectionCNU, CoordonneesRecherche, CoordonneesEnseignement, email, CoordonneesPersonnelles, PageWeb",
	)
);

$TCA["tx_ligestmembrelabo_Fonction"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Fonction',		
		'label'     => 'uid',
		'label_alt' => 'Libelle',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY Libelle",	
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

$TCA["tx_ligestmembrelabo_Structure"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure',		
		'label'     => 'uid',
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




$TCA["tx_ligestmembrelabo_Exerce"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce',		
		'label'     => 'uid',
		'label_alt' => 'idMembreLabo, idStructure, idFonction',
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


$TCA["tx_ligestmembrelabo_TypePosteWeb"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePosteWeb',		
		'label'     => 'uid',
		'label_alt' => 'LibelleWeb',
		'label_alt_force' => '1',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'default_sortby' => "ORDER BY sys_language_uid, LibelleWeb",	
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

$TCA["tx_ligestmembrelabo_TypePoste"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste',		
		'label'     => 'uid',
		'label_alt' => 'Libelle',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
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

$TCA["tx_ligestmembrelabo_Possede"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede',		
		'label'     => 'uid',
		'label_alt' => 'idMembreLabo, idTypePoste',
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

$TCA["tx_ligestmembrelabo_Categorie"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie',		
		'label'     => 'uid',
		'label_alt' => 'idCategorie, Libelle',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY sys_language_uid, idCategorie, Libelle",	
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



$TCA["tx_ligestmembrelabo_CategorieMembre"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_CategorieMembre',		
		'label'     => 'uid',
		'label_alt' => 'idMembreLabo, idCategorie',
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





















$TCA["tx_ligestmembrelabo_Equipe"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Equipe',		
		'label'     => 'uid',
		'label_alt' => 'Abreviation, Nom',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
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

$TCA["tx_ligestmembrelabo_EstMembreDe"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe',		
		'label'     => 'uid',
		'label_alt' => 'idMembreLabo, idEquipe',
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
		"fe_admin_fieldList" => "hidden, idMembreLabo, idEquipe, Rang",
	)
);

$TCA["tx_ligestmembrelabo_TypeDiplome"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypeDiplome',		
		'label'     => 'uid',
		'label_alt' => 'Code, Libelle',
		'label_alt_force' => '1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY Code, Libelle",	
		'delete' => 'deleted',
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_TypeDiplome.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, Code, Libelle",
	)
);

$TCA["tx_ligestmembrelabo_AObtenu"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu',
		'label'     => 'uid',
		'label_alt' => 'idMembreLabo, CodeDiplome, Intitule',
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
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_AObtenu.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idMembreLabo, CodeDiplome, DateObtention, Intitule, LieuDObtention",
	)
);


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform'; //Ajouté


t3lib_extMgm::addPlugin(array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');


t3lib_extMgm::addStaticFile($_EXTKEY,"pi1/static/","Managing Member");

t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:li_gest_membre_labo/flexform_ds_pi1.xml'); //Ajouté


if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_ligestmembrelabo_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_ligestmembrelabo_pi1_wizicon.php';
?>