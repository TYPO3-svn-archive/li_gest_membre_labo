<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA["tx_ligestmembrelabo_MembreDuLabo"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_MembreDuLabo"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, NomDUsage, NomMaritale, NomPreMarital, Prenom, Genre, DateNaissance, Nationalite, DateArrivee, DateSortie, NumINE, SectionCNU, CoordonneesRecherche, CoordonneesEnseignement, email, CoordonneesPersonnelles, PageWeb"
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
		"showRecordFieldList" => "hidden,LibelleDesSaisies,Nom,Adresse,Type,idStructureParente"
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
		"idStructureParente" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.idstructureparente",		
			"config" => Array (
				"type" => "select",
				'items' => Array (
					Array('',NULL),
				),
				"foreign_table" => "tx_ligestmembrelabo_Structure",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Structure.LibelleDesSaisies",	
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, LibelleDesSaisies, Nom, Adresse, Type, idStructureParente")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);






$TCA["tx_ligestmembrelabo_Exerce"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Exerce"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idMembreLabo,idStructure,idFonction,DateDebut,DateFin"
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
		"idMembreLabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.idmembrelabo",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_MembreDuLabo",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_MembreDuLabo.NomDUsage",	
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idStructure" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.idstructure",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_Structure",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Structure.LibelleDesSaisies",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idFonction" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.idfonction",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_Fonction",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Fonction.Libelle",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"DateDebut" => Array (
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.datedebut",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim",
				'default' => '0000-00-00'
			)
		),
		"DateFin" => Array (
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Exerce.datefin",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim",
				'default' => '0000-00-00'
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idMembreLabo, idStructure, idFonction, DateDebut, DateFin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);




$TCA["tx_ligestmembrelabo_TypePosteWeb"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_TypePosteWeb"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idTypePosteWeb,LibelleWeb"
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
		"idTypePosteWeb" => Array (
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.idtypeposteweb",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"LibelleWeb" => Array (
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
		"0" => array("showitem" => "hidden;;1;;1-1-1,idTypePosteWeb,LibelleWeb")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_TypePoste"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_TypePoste"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden,idTypePoste,Libelle,idTypePosteWeb"
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
		"idTypePoste" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.idtypeposte",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"Libelle" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.libelle",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"idTypePosteWeb" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.idtypeposteweb",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_TypePosteWeb",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_TypePosteWeb.LibelleWeb",	
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idTypePoste, Libelle, idTypePosteWeb")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_Possede"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Possede"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, idMembreLabo, idTypePoste, DateDebut, DateFin"
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
		"idTypePoste" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.idtypeposte",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_TypePoste",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_TypePoste.idTypePoste",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idMembreLabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.idmembremabo",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_MembreDuLabo",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_MembreDuLabo.NomDUsage, tx_ligestmembrelabo_MembreDuLabo.Prenom",		
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"DateDebut" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.datedebut",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim",
				'default' => '0000-00-00'
			)
		),
		"DateFin" => Array (
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.datefin",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim",
				'default' => '0000-00-00'
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idMembreLabo, idTypePoste, DateDebut, DateFin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_Categorie"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Categorie"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, idCategorie, Libelle"
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
		"idCategorie" => Array (
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie.idcategorie",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"Libelle" => Array (		
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
		"0" => array("showitem" => "hidden;;1;;1-1-1, idCategorie, Libelle")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_Categorie_MembreDuLabo"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Categorie_MembreDuLabo"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, idMembreLabo, idCategorie, DateDebut, DateFin"
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
		"idMembreLabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.idmembremabo",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_MembreDuLabo",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_MembreDuLabo.NomDUsage, tx_ligestmembrelabo_MembreDuLabo.Prenom",		
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idCategorie" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie.idcategorie",
			"config" => Array (
				"type" => "select",
				"foreign_table" => "tx_ligestmembrelabo_Categorie",
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Categorie.idCategorie",
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"DateDebut" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo.datedebut",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim",
				'default' => '0000-00-00'
			)
		),
		"DateFin" => Array (
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Categorie_MembreDuLabo.datefin",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim",
				'default' => '0000-00-00'
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idMembreLabo, idCategorie, DateDebut, DateFin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_Equipe"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Equipe"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, Nom, Abreviation"
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
		"Nom" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Equipe.nom",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"Abreviation" => Array (		
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
		"0" => array("showitem" => "hidden;;1;;1-1-1, Nom, Abreviation")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_EstMembreDe"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_EstMembreDe"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, idMembreLabo, idEquipe, Rang"
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
		"idMembreLabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.idmembrelabo",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_MembreDuLabo",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_MembreDuLabo.NomDUsage, tx_ligestmembrelabo_MembreDuLabo.Prenom",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idEquipe" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.idequipe",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_Equipe",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_Equipe.Abreviation, tx_ligestmembrelabo_Equipe.Nom",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"Rang" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.rang",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => "hidden;;1;;1-1-1, idMembreLabo, idEquipe, Rang")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_TypeDiplome"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_TypeDiplome"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, Code, Libelle"
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
		"Code" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypeDiplome.code",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		"Libelle" => Array (		
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
		"0" => array("showitem" => "hidden;;1;;1-1-1, Code, Libelle")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



$TCA["tx_ligestmembrelabo_AObtenu"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_AObtenu"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, idMembreLabo, CodeDiplome, DateObtention, Intitule, LieuDObtention"
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
		"idMembreLabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.idmembrelabo",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_MembreDuLabo",	
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_MembreDuLabo.NomDUsage, tx_ligestmembrelabo_MembreDuLabo.Prenom",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"CodeDiplome" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.codediplome",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_TypeDiplome",
				"foreign_table_where" => "ORDER BY tx_ligestmembrelabo_TypeDiplome.Code, tx_ligestmembrelabo_TypeDiplome.Libelle",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"DateObtention" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.dateobtention",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim",
				'default' => '0000-00-00'
			)
		),
		"Intitule" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_AObtenu.intitule",
			"config" => Array (
				"type" => "input",
				"size" => "48",
				"max" => "255",
				"eval" => "trim",
			)
		),
		"LieuDObtention" => Array (
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
		"0" => array("showitem" => "hidden;;1;;1-1-1, idMembreLabo, CodeDiplome, DateObtention, Intitule, LieuDObtention")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);
?>