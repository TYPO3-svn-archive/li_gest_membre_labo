<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
$TCA["tx_ligestmembrelabo_MembreDuLabo"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo',		
		'label'     => 'idMembreLabo',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_MembreDuLabo.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, nomdusage, nommaritale, nompremarital, prenom, genre, datenaissance, nationalite, datearrivee, datesortie, numine, sectioncnu, coordonneesrecherche, coordonneesenseignement, email, coordonneespersonnelles, pageweb",
	)
);

$TCA["tx_ligestmembrelabo_Exerce"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce',		
		'label'     => 'idMembreLabo',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Exerce.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idmembrelabo, idstructure, idfonction, datedebut, datefin",
	)
);

$TCA["tx_ligestmembrelabo_Structure"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure',		
		'label'     => 'idStructure',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Structure.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, libelledessaisies, nom, adresse, type, idstructureparente",
	)
);

$TCA["tx_ligestmembrelabo_Fonction"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Fonction',		
		'label'     => 'idFonction',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Fonction.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, libelle",
	)
);

$TCA["tx_ligestmembrelabo_TypePosteWeb"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePosteWeb',		
		'label'     => 'idTypePosteWeb',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_TypePosteWeb.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idtypeposteweb, libelleweb",
	)
);

$TCA["tx_ligestmembrelabo_TypePoste"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste',		
		'label'     => 'idTypePoste',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_TypePoste.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idtypeposte, libelle, idtypeposteweb",
	)
);

$TCA["tx_ligestmembrelabo_Possede"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede',		
		'label'     => 'idMembreLabo',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Possede.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idtypeposte, idmembrelabo, datedebut, datefin",
	)
);

$TCA["tx_ligestmembrelabo_Categorie"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie',		
		'label'     => 'idCategorie',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Categorie.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idcategorie, libelle",
	)
);

$TCA["tx_ligestmembrelabo_Categorie_MembreDuLabo"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo',		
		'label'     => 'idCategorie',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Categorie_MembreDuLabo.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idcategorie, idmembrelabo, datedebut, datefin",
	)
);

$TCA["tx_ligestmembrelabo_Equipe"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Equipe',		
		'label'     => 'idEquipe',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_Equipe.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, nom, abreviation",
	)
);

$TCA["tx_ligestmembrelabo_EstMembreDe"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe',		
		'label'     => 'idMembreLabo',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_EstMembreDe.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idmembrelabo, idequipe, rang",
	)
);

$TCA["tx_ligestmembrelabo_TypeDiplome"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypeDiplome',		
		'label'     => 'Code',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_TypeDiplome.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, libelle",
	)
);

$TCA["tx_ligestmembrelabo_AObtenu"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu',		
		'label'     => 'idMembreLabo',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => "ORDER BY crdate",	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_ligestmembrelabo_AObtenu.gif',
	),
	"feInterface" => array (
		"fe_admin_fieldList" => "hidden, idmembrelabo, codediplome, dateobtention, intitule, lieudobtention",
	)
);


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform'; //Ajouté


t3lib_extMgm::addPlugin(array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');


t3lib_extMgm::addStaticFile($_EXTKEY,"pi1/static/","Managing Member");

t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:li_gest_membre_labo/flexform_ds_pi1.xml'); //Ajouté


if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_ligestmembrelabo_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_ligestmembrelabo_pi1_wizicon.php';
?>