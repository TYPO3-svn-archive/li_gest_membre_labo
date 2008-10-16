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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.Nomdusage",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"nommaritale" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.NomMaritale",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"nompremarital" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.NomPreMarital",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"prenom" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.Prenom",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"genre" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.Genre",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "1",	
				"eval" => "required,trim",
			)
		),
		"datenaissance" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.DateNaissance",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.Nationalite",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		"datearrivee" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.DateArrivee",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.DateSortie",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.NumINE",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"sectioncnu" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.SectionCNU",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"coordonneesrecherche" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.CoordonneesRecherche",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"coordonneesenseignement" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.CoordonneesEnseignement",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.CoordonneesPersonnelles",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"pageweb" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.PageWeb",		
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



$TCA["tx_ligestmembrelabo_Exerce"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Exerce"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idmembrelabo,idstructure,idfonction,datedebut,datefin"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_Exerce"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"idmembrelabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.idMembreLabo",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_MembreDuLabo",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_MembreDuLabo.uid",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idstructure" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.idStructure",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_Structure",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Structure.uid",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idfonction" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.idFonction",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_Fonction",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Fonction.uid",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"datedebut" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.DateDebut",		
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
		"datefin" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.DateFin",		
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idmembrelabo, idstructure, idfonction, datedebut, datefin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_Structure"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Structure"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,libelledessaisies,nom,adresse,type,idstructureparente"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_Structure"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"libelledessaisies" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.LibelleDesSaisies",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"nom" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.Nom",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"adresse" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.Adresse",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"type" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.Type",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "1",	
				"eval" => "trim",
			)
		),
		"idstructureparente" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.idDtructureParente",		
			"config" => Array (
				"type"     => "input",
				"size"     => "4",
				"max"      => "4",
				"eval"     => "int",
				"checkbox" => "0",
				"range"    => Array (
					"upper" => "1000",
					"lower" => "10"
				),
				"default" => 0
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, libelledessaisies, nom, adresse, type, idstructureparente")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_Fonction"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Fonction"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,libelle"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_Fonction"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"libelle" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Fonction.Libelle",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, libelle")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_TypePosteWeb"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_TypePosteWeb"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idtypeposteweb,libelleweb"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_TypePosteWeb"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"idtypeposteweb" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.idTypePosteWeb",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"libelleweb" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePosteWeb.LibelleWeb",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1,idtypeposteweb,libelleweb")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_TypePoste"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_TypePoste"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idtypeposte,libelle,idtypeposteweb"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_TypePoste"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"idtypeposte" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.idTypePoste",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"libelle" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.Libelle",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"idtypeposteweb" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.idTypePosteWeb",		
			"config" => Array (
				"type" => "select",	
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_ligestmembrelabo_TypePosteWeb",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_TypePosteWeb.idTypePosteWeb",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idtypeposte, libelle, idtypeposteweb")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_Possede"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Possede"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idtypeposte,idmembrelabo,datedebut,datefin"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_Possede"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"idtypeposte" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.idTypePoste",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_TypePoste",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_TypePoste.idTypePoste",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idmembrelabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.idMembreMabo",		
			"config" => Array (
				"type" => "group",	
				"internal_type" => "db",	
				"allowed" => "tx_ligestmembrelabo_MembreDuLabo",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"datedebut" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.DateDebut",		
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
		"datefin" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.DateFin",		
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idtypeposte, idmembrelabo, datedebut, datefin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_Categorie"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Categorie"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idcategorie,libelle"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_Categorie"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"idcategorie" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie.idCategorie",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"libelle" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie.Libelle",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idcategorie, libelle")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_Categorie_MembreDuLabo"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Categorie_MembreDuLabo"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idcategorie,idmembrelabo,datedebut,datefin"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_Categorie_MembreDuLabo"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"idcategorie" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo.idCategorie",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"idmembrelabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo.idMembreLabo",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_MembreDuLabo",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_MembreDuLabo.idMembreLabo",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"datedebut" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo.DateDebut",		
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
		"datefin" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo.DateFin",		
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idcategorie, idmembrelabo, datedebut, datefin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_Equipe"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Equipe"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,nom,abreviation"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_Equipe"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"nom" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Equipe.Nom",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"abreviation" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Equipe.Abreviation",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, nom, abreviation")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_EstMembreDe"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_EstMembreDe"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idmembrelabo,idequipe,rang"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_EstMembreDe"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"idmembrelabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.idMembreLabo",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_MembreDuLabo",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_MembreDuLabo.idMembreLabo",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idequipe" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.idEquipe",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_Equipe",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Equipe.idEquipe",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"rang" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.Rang",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idmembrelabo, idequipe, rang")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_TypeDiplome"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_TypeDiplome"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,code,libelle"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_TypeDiplome"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"code" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypeDiplome.Code",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"libelle" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypeDiplome.Libelle",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, code, libelle")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_AObtenu"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_AObtenu"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idmembrelabo,codediplome,dateobtention,intitule,lieudobtention"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_AObtenu"]["feInterface"],
	"columns" => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"idmembrelabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.idMembreLabo",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_MembreDuLabo",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_MembreDuLabo.idMembreLabo",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"codediplome" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.CodeDiplome",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_TypeDiplome",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_TypeDiplome.Code",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"dateobtention" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.DateObtention",		
			"config" => Array (
				"type"     => "input",
				"size"     => "8",
				"max"      => "20",
				"eval"     => "date",
				"checkbox" => "0",
				"default"  => "0"
			)
		),
		"intitule" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.Intitule",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"lieudobtention" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.LieuDObtention",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idmembrelabo, codediplome, dateobtention, intitule, lieudobtention")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);
?>