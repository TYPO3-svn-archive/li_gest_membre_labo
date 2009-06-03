<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$admin = '0';

$GLOBALS['BE_USER'] = t3lib_div::makeInstance('t3lib_beUserAuth');
$GLOBALS['BE_USER']->start();
$GLOBALS['BE_USER']->backendCheckLogin();

if (isset($GLOBALS['BE_USER']) && !empty($GLOBALS['BE_USER']))
{
	$admin = $GLOBALS['BE_USER']->isAdmin();
}

$MembreDuLabo = '';
$Fonction = '';
$Structure = '';
$Exerce = '';
$TypePosteWeb = '';
$TypePoste = '';
$Possede = '';
$Categorie = '';
$CategorieMembre = '';
$Equipe = '';
$EstMembreDe = '';
$TypeDiplome = '';
$AObtenu = '';
$PEDR = '';

if($admin == "1")
{
	$MembreDuLabo = 'hidden;;1;;1-1-1,';
	$Fonction = 'hidden,';
	$Structure = 'hidden;;1;;1-1-1,';
	$Exerce = 'hidden;;1;;1-1-1, idMembreLabo,';
	$TypePosteWeb = 'hidden,';
	$TypePoste = 'hidden,';
	$Possede = 'hidden;;1;;1-1-1, idMembreLabo,';
	$Categorie = 'hidden,';
	$CategorieMembre = 'hidden;;1;;1-1-1, idMembreLabo,';
	$Equipe = 'hidden,';
	$EstMembreDe = 'hidden;;1;;1-1-1, idMembreLabo,';
	$TypeDiplome = 'hidden,';
	$AObtenu = 'hidden;;1;;1-1-1, idMembreLabo,';
	$PEDR = 'hidden;;1;;1-1-1, idMembreLabo,';
}

// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_MembreDuLabo
// ******************************************************************
$TCA["tx_ligestmembrelabo_MembreDuLabo"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_MembreDuLabo"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, NomDUsage, NomMarital, NomPreMarital, Prenom, Genre, DateNaissance, Nationalite, DateArrivee, DateSortie, NumINE, SectionCNU, CoordonneesRecherche, CoordonneesEnseignement, CoordonneesPersonnelles, email, PageWeb, Afficher_Equipe, Afficher_Possede, Afficher_Exerce, Afficher_CategorieMembre, Afficher_AObtenu, Afficher_PEDR, Informations"
	),
	//"feInterface" => $TCA["tx_ligestmembrelabo_MembreDuLabo"]["feInterface"],
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
		"NomMarital" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.nommarital",		
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
				"eval" => "trim,tx_ligestmembrelabo_dateValide",
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
				'default' => ""
			)
		),
		"DateArrivee" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.datearrivee",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "required,trim,tx_ligestmembrelabo_dateValide,tx_ligestmembrelabo_dateObligatoire",
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
				"eval" => "trim,tx_ligestmembrelabo_dateValide",
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
				"type" => "text",	
				"cols" => "48",	
				"rows" => "10",
			)
		),
		"CoordonneesEnseignement" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.coordonneesenseignement",		
			"config" => Array (
				"type" => "text",	
				"cols" => "48",	
				"rows" => "10",	
			)
		),
		"CoordonneesPersonnelles" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.coordonneespersonnelles",		
			"config" => Array (
				"type" => "text",	
				"cols" => "48",	
				"rows" => "10",
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
		"Afficher_Equipe" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.afficherequipe",		
			"config" => Array (
				"type" => "select",
				"foreign_table" => "tx_ligestmembrelabo_EstMembreDe",	
				"foreign_table_where" => "AND tx_ligestmembrelabo_EstMembreDe.IdMembreLabo=###THIS_UID### ORDER BY tx_ligestmembrelabo_EstMembreDe.uid",
				"size" => 6,
				"minitems" => 0,
				"maxitems" => 1,
				"wizards" => Array(
					"_PADDING" => 2,
					"_VERTICAL" => 1,
					"add" => Array(
						"type" => "popup",
						"title" => "Create new record",
						"notNewRecords" => 1,
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/add.php",
						"icon" => "add.gif",
						"params" => Array(
							"table"			=> "tx_ligestmembrelabo_EstMembreDe",
							"champ"			=> "idMembreLabo",
							"lien"			=> Array('tx_ligestmembrelabo_Equipe')
						),
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					
					"edit" => Array(
						"type" => "popup",
						"title" => "Edit",
						"script" => "wizard_edit.php",
						"popup_onlyOpenIfSelected" => 1,
						"notNewRecords" => 1,
						"icon" => "edit2.gif",
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"del" => Array(
						"title" => "Delete record",
						"type" => "popup",
						"notNewRecords" => 1,
						"icon" => "clearout.gif",
						"popup_onlyOpenIfSelected" => 1,
						'params' => Array(
							'table'=>'tx_ligestmembrelabo_EstMembreDe'
						),
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/delete.php",
						"JSopenParams" => "height=1,width=1,status=0,menubar=0,scrollbars=1",
					),
					/*
					"reload" => Array(
						"title" => "Refresh",
						"type" => "popup",
						"icon" => "refresh_n.gif",
						"notNewRecords" => 1,
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/reload.php",
						"JSopenParams" => "height=1,width=1,status=0,menubar=0,scrollbars=1",
					),*/
					
				),
			),
		),
		"Afficher_Possede" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.afficherpossede",		
			"config" => Array (
				"type" => "select",
				"foreign_table" => "tx_ligestmembrelabo_Possede",	
				"foreign_table_where" => "AND tx_ligestmembrelabo_Possede.idMembreLabo=###THIS_UID### ORDER BY tx_ligestmembrelabo_Possede.DateDebut DESC",
				"size" => 6,
				"minitems" => 0,
				"maxitems" => 1,
				"wizards" => Array(
					"_PADDING" => 2,
					"_VERTICAL" => 1,
					"add" => Array(
						"type" => "popup",
						"title" => "Create new record",
						"notNewRecords" => 1,
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/add.php",
						"icon" => "add.gif",
						"params" => Array(
							"table"			=> "tx_ligestmembrelabo_Possede",
							"champ"			=> "idMembreLabo",
							"lien"			=> Array('tx_ligestmembrelabo_TypePoste')
						),
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"edit" => Array(
						"type" => "popup",
						"title" => "Edit",
						"script" => "wizard_edit.php",
						"popup_onlyOpenIfSelected" => 1,
						"notNewRecords" => 1,
						"icon" => "edit2.gif",
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"del" => Array(
						"title" => "Delete record",
						"type" => "popup",
						"notNewRecords" => 1,
						"icon" => "clearout.gif",
						"popup_onlyOpenIfSelected" => 1,
						'params' => Array(
							'table'=>'tx_ligestmembrelabo_Possede'
						),
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/delete.php",
						"JSopenParams" => "height=1,width=1,status=0,menubar=0,scrollbars=1",
					),
				),
			),
		),
		
		"Afficher_Exerce" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.afficherexerce",		
			"config" => Array (
				"type" => "select",
				"foreign_table" => "tx_ligestmembrelabo_Exerce",	
				"foreign_table_where" => "AND tx_ligestmembrelabo_Exerce.IdMembreLabo=###THIS_UID### ORDER BY tx_ligestmembrelabo_Exerce.DateDebut DESC",
				"size" => 6,
				"minitems" => 0,
				"maxitems" => 1,
				"wizards" => Array(
					"_PADDING" => 2,
					"_VERTICAL" => 1,
					"add" => Array(
						"type" => "popup",
						"title" => "Create new record",
						"notNewRecords" => 1,
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/add.php",
						"icon" => "add.gif",
						"params" => Array(
							"table"			=> "tx_ligestmembrelabo_Exerce",
							"champ"			=> "idMembreLabo",
							"lien"			=> Array('tx_ligestmembrelabo_Fonction','tx_ligestmembrelabo_Structure')
						),
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"edit" => Array(
						"type" => "popup",
						"title" => "Edit",
						"script" => "wizard_edit.php",
						"popup_onlyOpenIfSelected" => 1,
						"notNewRecords" => 1,
						"icon" => "edit2.gif",
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"del" => Array(
						"title" => "Delete record",
						"type" => "popup",
						"notNewRecords" => 1,
						"icon" => "clearout.gif",
						"popup_onlyOpenIfSelected" => 1,
						'params' => Array(
							'table'=>'tx_ligestmembrelabo_Exerce'
						),
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/delete.php",
						"JSopenParams" => "height=1,width=1,status=0,menubar=0,scrollbars=1",
					),
				),
			),
		),
		"Afficher_CategorieMembre" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.affichercategoriemembre",		
			"config" => Array (
				"type" => "select",
				"foreign_table" => "tx_ligestmembrelabo_CategorieMembre",	
				"foreign_table_where" => "AND tx_ligestmembrelabo_CategorieMembre.IdMembreLabo=###THIS_UID### ORDER BY tx_ligestmembrelabo_CategorieMembre.DateDebut DESC",
				"size" => 6,
				"minitems" => 0,
				"maxitems" => 1,
				"wizards" => Array(
					"_PADDING" => 2,
					"_VERTICAL" => 1,
					"add" => Array(
						"type" => "popup",
						"title" => "Create new record",
						"notNewRecords" => 1,
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/add.php",
						"icon" => "add.gif",
						"params" => Array(
							"table"			=> "tx_ligestmembrelabo_CategorieMembre",
							"champ"			=> "idMembreLabo",
							"lien"			=> Array('tx_ligestmembrelabo_Categorie')
						),
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"edit" => Array(
						"type" => "popup",
						"title" => "Edit",
						"script" => "wizard_edit.php",
						"popup_onlyOpenIfSelected" => 1,
						"notNewRecords" => 1,
						"icon" => "edit2.gif",
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"del" => Array(
						"title" => "Delete record",
						"type" => "popup",
						"notNewRecords" => 1,
						"icon" => "clearout.gif",
						"popup_onlyOpenIfSelected" => 1,
						'params' => Array(
							'table'=>'tx_ligestmembrelabo_CategorieMembre'
						),
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/delete.php",
						"JSopenParams" => "height=1,width=1,status=0,menubar=0,scrollbars=1",
					),
				),
			),
		),	
		"Afficher_AObtenu" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.afficheraobtenu",		
			"config" => Array (
				"type" => "select",
				"foreign_table" => "tx_ligestmembrelabo_AObtenu",	
				"foreign_table_where" => "AND tx_ligestmembrelabo_AObtenu.IdMembreLabo=###THIS_UID### ORDER BY tx_ligestmembrelabo_AObtenu.DateObtention DESC",
				"size" => 6,
				"minitems" => 0,
				"maxitems" => 1,
				"wizards" => Array(
					"_PADDING" => 2,
					"_VERTICAL" => 1,
					"add" => Array(
						"type" => "popup",
						"title" => "Create new record",
						"notNewRecords" => 1,
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/add.php",
						"icon" => "add.gif",
						"params" => Array(
							"table"			=> "tx_ligestmembrelabo_AObtenu",
							"champ"			=> "idMembreLabo",
							"lien"			=> Array('tx_ligestmembrelabo_TypeDiplome')
						),
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"edit" => Array(
						"type" => "popup",
						"title" => "Edit",
						"script" => "wizard_edit.php",
						"popup_onlyOpenIfSelected" => 1,
						"notNewRecords" => 1,
						"icon" => "edit2.gif",
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"del" => Array(
						"title" => "Delete record",
						"type" => "popup",
						"notNewRecords" => 1,
						"icon" => "clearout.gif",
						"popup_onlyOpenIfSelected" => 1,
						'params' => Array(
							'table'=>'tx_ligestmembrelabo_AObtenu'
						),
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/delete.php",
						"JSopenParams" => "height=1,width=1,status=0,menubar=0,scrollbars=1",
					),
				),
			),
		),
		"Afficher_PEDR" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.afficherpedr",
			"config" => Array (
				"type" => "select",
				"foreign_table" => "tx_ligestmembrelabo_PEDR",	
				"foreign_table_where" => "AND tx_ligestmembrelabo_PEDR.IdMembreLabo=###THIS_UID### ORDER BY tx_ligestmembrelabo_PEDR.DateDebut DESC",
				"size" => 6,
				"minitems" => 0,
				"maxitems" => 1,
				"wizards" => Array(
					"_PADDING" => 2,
					"_VERTICAL" => 1,
					"add" => Array(
						"type" => "popup",
						"title" => "Create new record",
						"notNewRecords" => 1,
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/add.php",
						"icon" => "add.gif",
						"params" => Array(
							"table"			=> "tx_ligestmembrelabo_PEDR",
							"champ"			=> "idMembreLabo"
						),
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"edit" => Array(
						"type" => "popup",
						"title" => "Edit",
						"script" => "wizard_edit.php",
						"popup_onlyOpenIfSelected" => 1,
						"notNewRecords" => 1,
						"icon" => "edit2.gif",
						"JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
					),
					"del" => Array(
						"title" => "Delete record",
						"type" => "popup",
						"notNewRecords" => 1,
						"icon" => "clearout.gif",
						"popup_onlyOpenIfSelected" => 1,
						'params' => Array(
							'table'=>'tx_ligestmembrelabo_PEDR'
						),
						"script" => t3lib_extMgm::extRelPath("li_gest_membre_labo")."wizard/delete.php",
						"JSopenParams" => "height=1,width=1,status=0,menubar=0,scrollbars=1",
					),
				),
			),
		),
		"Informations" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_MembreDuLabo.informations",		
			"config" => Array (
				"type" => "text",	
				"cols" => "48",	
				"rows" => "10",
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => $MembreDuLabo."NomDUsage, NomMarital, NomPreMarital, Prenom, Genre, DateNaissance, Nationalite, DateArrivee, DateSortie, NumINE, SectionCNU, CoordonneesRecherche, CoordonneesEnseignement, CoordonneesPersonnelles, email, PageWeb, Informations, Afficher_Equipe, Afficher_Possede, Afficher_Exerce, Afficher_CategorieMembre, Afficher_AObtenu, Afficher_PEDR")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);







// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_Fonction
// ******************************************************************
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
			'l10n_mode' => 'mergeIfNotBlank',
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Fonction.libelle",
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_ligestmembrelabo_Fonction',
				//'foreign_table_where' => 'AND tx_ligestmembrelabo_Fonction.pid=###CURRENT_PID### AND tx_ligestmembrelabo_Fonction.sys_language_uid IN (-1,0)',
				'foreign_table_where' => 'AND tx_ligestmembrelabo_Fonction.sys_language_uid IN (-1,0)',
			
			)
		),
		'l18n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),	
	),
	"types" => array (
		"0" => array("showitem" => $Fonction."sys_language_uid, l18n_parent, l18n_diffsource, Libelle")
	),
);

// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_Structure
// ******************************************************************
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
				"type" => "text",	
				"cols" => "48",	
				"rows" => "10",
			)
		),
		"Type" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.type",		
			'config' => Array (
				'type' => 'select',
				'size' => 1,
				'maxitems' => 1,
				'items' => Array (
					Array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.type.Composante', 'C'),
					Array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.type.Entreprise', 'N'),
					Array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.type.Etablissement', 'T'),
					Array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.type.Institution', 'I'),
					Array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.type.LaboratoirePrive', 'R'),
					Array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.type.LaboratoirePublic', 'U'),
					Array('LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Structure.type.Site', 'S')
				),
				 'default' => 'C',
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
				"foreign_table_where" => "AND tx_ligestmembrelabo_Structure.uid<>###THIS_UID### ORDER BY tx_ligestmembrelabo_Structure.LibelleDesSaisies",	
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => $Structure."LibelleDesSaisies, Nom, Adresse, Type, idStructureParente")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);





// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_Exerce
// ******************************************************************
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
				"foreign_table_where" => "AND tx_ligestmembrelabo_Fonction.sys_language_uid<=0 ORDER BY tx_ligestmembrelabo_Fonction.Libelle",	
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
				"eval" => "required,trim,tx_ligestmembrelabo_dateValide,tx_ligestmembrelabo_dateObligatoire",
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
				"eval" => "trim,tx_ligestmembrelabo_dateValide",
				'default' => '0000-00-00'
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => $Exerce."idStructure, idFonction, DateDebut, DateFin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_TypePosteWeb
// ******************************************************************
$TCA["tx_ligestmembrelabo_TypePosteWeb"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_TypePosteWeb"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, idTypePosteWeb, LibelleWeb"
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
			'l10n_mode' => 'mergeIfNotBlank',
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePosteWeb.idtypeposteweb",		
			"config" => Array (
				"type" => "input",	
				"size" => "5",	
				"max" => "5",	
				"eval" => "trim",
			)
		),
		"LibelleWeb" => Array (
			"exclude" => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePosteWeb.libelleweb",		
			"config" => Array (
				"type" => "input",
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_ligestmembrelabo_TypePosteWeb',
				//'foreign_table_where' => 'AND tx_ligestmembrelabo_TypePosteWeb.pid=###CURRENT_PID### AND tx_ligestmembrelabo_TypePosteWeb.sys_language_uid IN (-1,0)',
				'foreign_table_where' => 'AND tx_ligestmembrelabo_TypePosteWeb.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),	
	),
	'types' => Array (
		'0' => Array('showitem' =>	$TypePosteWeb.'l18n_parent,sys_language_uid,idTypePosteWeb,LibelleWeb'),
	),
);









// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_TypePoste
// ******************************************************************
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
			'l10n_mode' => 'mergeIfNotBlank',
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
			'l10n_mode' => 'mergeIfNotBlank',
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
			'l10n_mode' => 'mergeIfNotBlank',	
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypePoste.idtypeposteweb",		
			"config" => Array (
				"type" => "select",
				"foreign_table" => "tx_ligestmembrelabo_TypePosteWeb",
				"foreign_table_where" => "AND tx_ligestmembrelabo_TypePosteWeb.sys_language_uid<=0 ORDER BY tx_ligestmembrelabo_TypePosteWeb.LibelleWeb",	
				"size" => 1,
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_ligestmembrelabo_TypePoste',
				//'foreign_table_where' => 'AND tx_ligestmembrelabo_TypePoste.pid=###CURRENT_PID### AND tx_ligestmembrelabo_TypePoste.sys_language_uid IN (-1,0)',
				'foreign_table_where' => 'AND tx_ligestmembrelabo_TypePoste.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => $TypePoste."sys_language_uid, l18n_parent, l18n_diffsource, idTypePoste, Libelle, idTypePosteWeb")
	),
);


// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_Possede
// ******************************************************************
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
				"foreign_table_where" => "AND tx_ligestmembrelabo_TypePoste.sys_language_uid<=0 ORDER BY tx_ligestmembrelabo_TypePoste.Libelle",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"idMembreLabo" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Possede.idmembrelabo",		
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
				"eval" => "required,trim,tx_ligestmembrelabo_dateValide,tx_ligestmembrelabo_dateObligatoire",
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
				"eval" => "trim,tx_ligestmembrelabo_dateValide",
				'default' => '0000-00-00'
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => $Possede."idTypePoste, DateDebut, DateFin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);


// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_Categorie
// ******************************************************************
$TCA["tx_ligestmembrelabo_Categorie"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_Categorie"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "sys_language_uid, l18n_parent, l18n_diffsource, hidden, idCategorie, Libelle"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_Categorie"]["feInterface"],
	"columns" => array (
		'sys_language_uid' => array (
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_ligestmembrelabo_Categorie',
				//'foreign_table_where' => 'AND tx_ligestmembrelabo_Categorie.pid=###CURRENT_PID### AND tx_ligestmembrelabo_Categorie.sys_language_uid IN (-1,0)',
				'foreign_table_where' => 'AND tx_ligestmembrelabo_Categorie.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (
			'config' => array (
				'type' => 'passthrough'
			)
		),	
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
			'l10n_mode' => 'mergeIfNotBlank',
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
			'l10n_mode' => 'mergeIfNotBlank',
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
		"0" => array("showitem" => $Categorie."sys_language_uid, l18n_parent, l18n_diffsource, idCategorie, Libelle")
	),
);







// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_CategorieMembre
// ******************************************************************
$TCA["tx_ligestmembrelabo_CategorieMembre"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_CategorieMembre"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, idMembreLabo, idCategorie, DateDebut, DateFin"
	),
	"feInterface" => $TCA["tx_ligestmembrelabo_CategorieMembre"]["feInterface"],
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_CategorieMembre.idmembrelabo",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_CategorieMembre.idcategorie",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_ligestmembrelabo_Categorie",	
				"foreign_table_where" => "AND tx_ligestmembrelabo_Categorie.sys_language_uid<=0 ORDER BY tx_ligestmembrelabo_Categorie.Libelle",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"DateDebut" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_CategorieMembre.datedebut",
			"config" => Array (
				"type" => "input",
				"size" => "10",
				"max" => "10",
				"eval" => "required,trim,tx_ligestmembrelabo_dateValide,tx_ligestmembrelabo_dateObligatoire",
				'default' => '0000-00-00'
			)
		),
		"DateFin" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_CategorieMembre.datefin",
			"config" => Array (
				"type" => "input",
				"size" => "10",
				"max" => "10",
				"eval" => "trim,tx_ligestmembrelabo_dateValide",
				'default' => '0000-00-00'
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => $CategorieMembre."idCategorie, DateDebut, DateFin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);



// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_Equipe
// ******************************************************************
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
			'l10n_mode' => 'mergeIfNotBlank',
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
			'l10n_mode' => 'mergeIfNotBlank',
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_Equipe.abreviation",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_ligestmembrelabo_Equipe',
				//'foreign_table_where' => 'AND tx_ligestmembrelabo_Equipe.pid=###CURRENT_PID### AND tx_ligestmembrelabo_Equipe.sys_language_uid IN (-1,0)',
				'foreign_table_where' => 'AND tx_ligestmembrelabo_Equipe.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => $Equipe."sys_language_uid, l18n_parent, l18n_diffsource, Nom, Abreviation")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);


// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_EstMembreDe
// ******************************************************************
$TCA["tx_ligestmembrelabo_EstMembreDe"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_EstMembreDe"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, idMembreLabo, idEquipe, Rang, DateDebut, DateFin"
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
				"foreign_table_where" => "AND tx_ligestmembrelabo_Equipe.sys_language_uid<=0 ORDER BY tx_ligestmembrelabo_Equipe.Abreviation, tx_ligestmembrelabo_Equipe.Nom",	
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
		"DateDebut" => Array (
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.datedebut",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "required,trim,tx_ligestmembrelabo_dateValide,tx_ligestmembrelabo_dateObligatoire",
				'default' => '0000-00-00'
			)
		),
		"DateFin" => Array (
			"exclude" => 1,		
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_EstMembreDe.datefin",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"max" => "10",	
				"eval" => "trim,tx_ligestmembrelabo_dateValide",
				'default' => '0000-00-00'
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => $EstMembreDe."idEquipe, Rang, DateDebut, DateFin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);


// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_TypeDiplome
// ******************************************************************
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
			'l10n_mode' => 'mergeIfNotBlank',
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
			'l10n_mode' => 'mergeIfNotBlank',	
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_TypeDiplome.libelle",		
			"config" => Array (
				"type" => "input",	
				"size" => "48",	
				"max" => "255",	
				"eval" => "trim",
			)
		),
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_ligestmembrelabo_TypeDiplome',
				//'foreign_table_where' => 'AND tx_ligestmembrelabo_TypeDiplome.pid=###CURRENT_PID### AND tx_ligestmembrelabo_TypeDiplome.sys_language_uid IN (-1,0)',
				'foreign_table_where' => 'AND tx_ligestmembrelabo_TypeDiplome.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' =>	$TypeDiplome.'l18n_parent,sys_language_uid, Code, Libelle'),
	),
);


// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_AObtenu
// ******************************************************************
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
				"foreign_table_where" => "AND tx_ligestmembrelabo_TypeDiplome.sys_language_uid<=0 ORDER BY tx_ligestmembrelabo_TypeDiplome.Libelle, tx_ligestmembrelabo_TypeDiplome.Code",	
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
				"eval" => "trim,tx_ligestmembrelabo_dateValide",
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
		"0" => array("showitem" => $AObtenu."CodeDiplome, DateObtention, Intitule, LieuDObtention")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);

// ******************************************************************
// Création du formulaire pour la table tx_ligestmembrelabo_PEDR
// ******************************************************************
$TCA["tx_ligestmembrelabo_PEDR"] = array (
	"ctrl" => $TCA["tx_ligestmembrelabo_PEDR"]["ctrl"],
	"interface" => array (
		"showRecordFieldList" => "hidden, idMembreLabo, DateDebut, DateFin"
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_PEDR.idmembrelabo",		
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
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_PEDR.datedebut",		
			"config" => Array (
				"type" => "input",
				"size" => "10",
				"max" => "10",
				"eval" => "required,trim,tx_ligestmembrelabo_dateValide,tx_ligestmembrelabo_dateObligatoire",
				'default' => '0000-00-00'
			)
		),
		"DateFin" => Array (
			"exclude" => 1,
			"label" => "LLL:EXT:li_gest_membre_labo/locallang_db.xml:tx_ligestmembrelabo_PEDR.datefin",		
			"config" => Array (
				"type" => "input",
				"size" => "10",
				"max" => "10",
				"eval" => "trim,tx_ligestmembrelabo_dateValide",
				'default' => '0000-00-00'
			)
		),
	),
	"types" => array (
		"0" => array("showitem" => $PEDR."DateDebut, DateFin")
	),
	"palettes" => array (
		"1" => array("showitem" => "")
	)
);

?>