<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA["tx_ligestmembrelabo_MembreDuLabo"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_MembreDuLabo"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,NomDUsage,NomMaritale,NomPreMarital,Prenom,Genre,DateNaissance,Nationalite,DateArrivee,DateSortie,NumINE,SectionCNU,CoordonneesRecherche,CoordonneesEnseignement,email,CoordonneesPersonnelles,PageWeb"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_MembreDuLabo"]["feInterface"],
	"columns" => array (
		"hidden" => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		"NomDUsage" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.nomdusage",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",
				"eval" => "required,trim",
			)
		),
		"NomMaritale" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.nommaritale",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"NomPreMarital" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.nompremarital",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"Prenom" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.prenom",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "required,trim",
			)
		),
		'Genre' => Array (
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.genre',
			'config' => Array (
				'type' => 'select',
				'size' => 1,
				'maxitems' => 1,
				'items' => Array (
					Array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.genre.h', 'H'),
					Array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.genre.f', 'F'),
					Array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.genre.i', NULL)
				),
				 'default' => 'H',
			)
		),
		"DateNaissance" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.datenaissance",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim",
				'default' => '0000-00-00'
			)
		),
		"Nationalite" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.nationalite",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
				'default' => 'Français'
			)
		),
		"DateArrivee" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.datearrivee",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim",
				'default' => '0000-00-00'
			)
		),
		"DateSortie" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.datesortie",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim",
				'default' => '0000-00-00'
			)
		),
		"NumINE" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.numine",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"SectionCNU" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.sectioncnu",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"CoordonneesRecherche" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.coordonneesrecherche",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"CoordonneesEnseignement" => Array (		
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
		"CoordonneesPersonnelles" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.coordonneespersonnelles",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"PageWeb" => Array (		
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
		"0" => array("showitem" => "hidden;;1;;1-1-1, NomDUsage, NomMaritale, NomPreMarital, Prenom, Genre, DateNaissance, Nationalite, DateArrivee, DateSortie, NumINE, SectionCNU, CoordonneesRecherche, CoordonneesEnseignement, email, CoordonneesPersonnelles, PageWeb")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);


$TCA["tx_ligestmembrelabo_Fonction"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Fonction"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,Libelle"
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
		"Libelle" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Fonction.libelle",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, Libelle")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);


$TCA["tx_ligestmembrelabo_Structure"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Structure"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,LibelleDesSaisies,Nom,Adresse,Type,IdStructureParente"
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
		"LibelleDesSaisies" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.libelledessaisies",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"Nom" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.nom",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"Adresse" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.adresse",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"Type" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.type",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "1",	
				"eval" => "trim",
			)
		),
		"IdStructureParente" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.idstructureparente",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_Structure",
				//"foreign_table_where" => "tx_ligestmembrelabo_Structure.uid <> ###THIS_UID### ORDER BY tx_ligestmembrelabo_Structure.uid",
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Structure.uid",				
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
				'default' => '',
			),
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, LibelleDesSaisies, Nom, Adresse, Type, IdStructureParente")
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.idmembrelabo",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_MembreDuLabo",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_MembreDuLabo.idMembreLabo",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idstructure" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.idstructure",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_Structure",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Structure.idStructure",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idfonction" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.idfonction",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_Fonction",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Fonction.idFonction",	
				"size" => 30,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"datedebut" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.datedebut",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.datefin",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.idtypeposteweb",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"libelleweb" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePosteWeb.libelleweb",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.idtypeposte",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"libelle" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.libelle",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"idtypeposteweb" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.idtypeposteweb",		
			"config" => Array (
				"type" => "select",	
				"items" => Array (
					Array("",0),
				),
				"foreign_table" => "tx_ligestmembrelabo_TypePosteWeb",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_TypePosteWeb.idtypeposteweb",	
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.idtypeposte",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.idmembremabo",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.datedebut",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.datefin",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie.idcategorie",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"libelle" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie.libelle",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo.idcategorie",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"idmembrelabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo.idmembrelabo",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo.datedebut",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo.datefin",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Equipe.nom",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"abreviation" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Equipe.abreviation",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.idmembrelabo",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.idequipe",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.rang",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypeDiplome.code",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"libelle" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypeDiplome.libelle",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.idmembrelabo",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.codediplome",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.dateobtention",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.intitule",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"lieudobtention" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.lieudobtention",		
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