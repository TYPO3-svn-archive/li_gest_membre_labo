<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA["tx_ligestmembrelabo_MembreDuLabo"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_MembreDuLabo"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,nomdusage,nommaritale,nompremarital,prenom,genre,datenaissance,nationalite,datearrivee,datesortie,numine,sectioncnu,coordonneesrecherche,coordonneesenseignement,email,coordonneespersonnelles,pageweb"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_MembreDuLabo"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"nomdusage" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.nomdusage",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"nommaritale" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.nommaritale",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"nompremarital" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.nompremarital",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"prenom" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.prenom",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"genre" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.genre",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "1",	
				"eval" => "required,trim",
			)
		),
		"datenaissance" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.datenaissance",		
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
		"nationalite" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.nationalite",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"datearrivee" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.datearrivee",		
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
		"datesortie" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.datesortie",		
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
		"numine" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.numine",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"sectioncnu" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.sectioncnu",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"coordonneesrecherche" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.coordonneesrecherche",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"coordonneesenseignement" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.coordonneesenseignement",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"email" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.email",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"coordonneespersonnelles" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.coordonneespersonnelles",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"pageweb" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.pageweb",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, nomdusage, nommaritale, nompremarital, prenom, genre, datenaissance, nationalite, datearrivee, datesortie, numine, sectioncnu, coordonneesrecherche, coordonneesenseignement, email, coordonneespersonnelles, pageweb")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);
?>