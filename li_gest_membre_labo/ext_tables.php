<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
$TCA["tx_ligestmembrelabo_MembreDuLabo"] = array (
	"ctrl" => array (
		'title'     => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo',		
		'label'     => 'uid',	
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


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key';


t3lib_extMgm::addPlugin(array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');


t3lib_extMgm::addStaticFile($_EXTKEY,"pi1/static/","Managing Member");


if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_ligestmembrelabo_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_ligestmembrelabo_pi1_wizicon.php';
?>