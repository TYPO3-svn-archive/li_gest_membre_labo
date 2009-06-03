<?php

########################################################################
# Extension Manager/Repository config file for ext: "li_gest_membre_labo"
#
# Auto generated 03-06-2009 14:32
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Managing Members',
	'description' => 'Insert a list of members of a laboratory',
	'category' => 'plugin',
	'author' => 'Bruno Gallet',
	'author_email' => 'gallet.bruno@gmail.com',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '1.1.0',
	'constraints' => array(
		'depends' => array(
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:115:{s:9:"ChangeLog";s:4:"f462";s:45:"class.tx_ligestmembrelabo_dateObligatoire.php";s:4:"5c25";s:40:"class.tx_ligestmembrelabo_dateValide.php";s:4:"4282";s:12:"ext_icon.gif";s:4:"3df4";s:17:"ext_localconf.php";s:4:"961c";s:14:"ext_tables.php";s:4:"d7d9";s:14:"ext_tables.sql";s:4:"43eb";s:19:"flexform_ds_pi1.xml";s:4:"40a3";s:36:"icon_tx_ligestmembrelabo_AObtenu.gif";s:4:"3df4";s:38:"icon_tx_ligestmembrelabo_Categorie.gif";s:4:"3df4";s:44:"icon_tx_ligestmembrelabo_CategorieMembre.gif";s:4:"3df4";s:35:"icon_tx_ligestmembrelabo_Equipe.gif";s:4:"3df4";s:40:"icon_tx_ligestmembrelabo_EstMembreDe.gif";s:4:"3df4";s:35:"icon_tx_ligestmembrelabo_Exerce.gif";s:4:"3df4";s:37:"icon_tx_ligestmembrelabo_Fonction.gif";s:4:"3df4";s:41:"icon_tx_ligestmembrelabo_MembreDuLabo.gif";s:4:"3df4";s:33:"icon_tx_ligestmembrelabo_PEDR.gif";s:4:"3df4";s:36:"icon_tx_ligestmembrelabo_Possede.gif";s:4:"3df4";s:38:"icon_tx_ligestmembrelabo_Structure.gif";s:4:"3df4";s:40:"icon_tx_ligestmembrelabo_TypeDiplome.gif";s:4:"3df4";s:38:"icon_tx_ligestmembrelabo_TypePoste.gif";s:4:"3df4";s:41:"icon_tx_ligestmembrelabo_TypePosteWeb.gif";s:4:"3df4";s:13:"locallang.xml";s:4:"aa21";s:16:"locallang_db.xml";s:4:"b9de";s:7:"tca.php";s:4:"cf38";s:14:"pi1/ce_wiz.gif";s:4:"24df";s:37:"pi1/class.tx_ligestmembrelabo_pi1.php";s:4:"392f";s:45:"pi1/class.tx_ligestmembrelabo_pi1_wizicon.php";s:4:"8aa6";s:13:"pi1/clear.gif";s:4:"cc11";s:38:"pi1/li_gest_membre_labo_stylesheet.css";s:4:"d41d";s:37:"pi1/li_gest_membre_labo_template.html";s:4:"8b43";s:48:"pi1/li_gest_membre_labo_template_libelleweb.html";s:4:"bb1c";s:42:"pi1/li_gest_membre_labo_template_test.html";s:4:"02ca";s:17:"pi1/locallang.xml";s:4:"aff7";s:24:"pi1/static/editorcfg.txt";s:4:"538a";s:66:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_AObtenu.xml";s:4:"7551";s:68:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Categorie.xml";s:4:"fb65";s:74:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_CategorieMembre.xml";s:4:"b5c3";s:65:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Equipe.xml";s:4:"9f6b";s:70:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_EstMembreDe.xml";s:4:"dc68";s:65:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Exerce.xml";s:4:"fe37";s:67:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Fonction.xml";s:4:"044e";s:71:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_MembreDuLabo.xml";s:4:"1201";s:72:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_MembreDuLabo2.xml";s:4:"214a";s:63:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_PEDR.xml";s:4:"1548";s:66:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Possede.xml";s:4:"208e";s:68:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_Structure.xml";s:4:"8505";s:70:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_TypeDiplome.xml";s:4:"74f0";s:68:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_TypePoste.xml";s:4:"8067";s:71:"csh/ligestmembrelabo_locallang_csh_tx_ligestmembrelabo_TypePosteWeb.xml";s:4:"712c";s:14:"wizard/add.php";s:4:"8ebf";s:17:"wizard/delete.php";s:4:"0f60";s:17:"wizard/reload.php";s:4:"8ec7";s:12:"doc/Doxyfile";s:4:"6a5c";s:31:"doc/Typo3_Gallet_RapportPFE.pdf";s:4:"c864";s:38:"doc/bd_membres_theses_publications.pdf";s:4:"6110";s:25:"doc/doxygen_main_page.dox";s:4:"0358";s:27:"doc/li_gest_membre_labo.pdf";s:4:"4092";s:29:"doc/html/add_8php-source.html";s:4:"6ea6";s:22:"doc/html/add_8php.html";s:4:"beda";s:23:"doc/html/annotated.html";s:4:"3e42";s:71:"doc/html/class_8tx__ligestmembrelabo__date_obligatoire_8php-source.html";s:4:"9830";s:64:"doc/html/class_8tx__ligestmembrelabo__date_obligatoire_8php.html";s:4:"fb7b";s:66:"doc/html/class_8tx__ligestmembrelabo__date_valide_8php-source.html";s:4:"3a6d";s:59:"doc/html/class_8tx__ligestmembrelabo__date_valide_8php.html";s:4:"d14e";s:58:"doc/html/class_8tx__ligestmembrelabo__pi1_8php-source.html";s:4:"6d9f";s:51:"doc/html/class_8tx__ligestmembrelabo__pi1_8php.html";s:4:"1a54";s:67:"doc/html/class_8tx__ligestmembrelabo__pi1__wizicon_8php-source.html";s:4:"cf98";s:60:"doc/html/class_8tx__ligestmembrelabo__pi1__wizicon_8php.html";s:4:"d44b";s:52:"doc/html/classtx__ligestmembrelabo__add-members.html";s:4:"4056";s:44:"doc/html/classtx__ligestmembrelabo__add.html";s:4:"706e";s:65:"doc/html/classtx__ligestmembrelabo__date_obligatoire-members.html";s:4:"f9d9";s:57:"doc/html/classtx__ligestmembrelabo__date_obligatoire.html";s:4:"6028";s:60:"doc/html/classtx__ligestmembrelabo__date_valide-members.html";s:4:"e239";s:52:"doc/html/classtx__ligestmembrelabo__date_valide.html";s:4:"3044";s:55:"doc/html/classtx__ligestmembrelabo__delete-members.html";s:4:"1713";s:47:"doc/html/classtx__ligestmembrelabo__delete.html";s:4:"2143";s:52:"doc/html/classtx__ligestmembrelabo__pi1-members.html";s:4:"1b96";s:44:"doc/html/classtx__ligestmembrelabo__pi1.html";s:4:"0e2a";s:61:"doc/html/classtx__ligestmembrelabo__pi1__wizicon-members.html";s:4:"db2c";s:53:"doc/html/classtx__ligestmembrelabo__pi1__wizicon.html";s:4:"f976";s:55:"doc/html/classtx__ligestmembrelabo__reload-members.html";s:4:"ca12";s:47:"doc/html/classtx__ligestmembrelabo__reload.html";s:4:"33c4";s:32:"doc/html/delete_8php-source.html";s:4:"43b6";s:25:"doc/html/delete_8php.html";s:4:"a5c6";s:20:"doc/html/doxygen.css";s:4:"2b5b";s:20:"doc/html/doxygen.png";s:4:"33f8";s:38:"doc/html/doxygen__main__page_8dox.html";s:4:"3933";s:37:"doc/html/ext__emconf_8php-source.html";s:4:"abff";s:30:"doc/html/ext__emconf_8php.html";s:4:"5d62";s:40:"doc/html/ext__localconf_8php-source.html";s:4:"6528";s:33:"doc/html/ext__localconf_8php.html";s:4:"f9bb";s:37:"doc/html/ext__tables_8php-source.html";s:4:"2d04";s:30:"doc/html/ext__tables_8php.html";s:4:"ffc8";s:19:"doc/html/files.html";s:4:"3164";s:23:"doc/html/functions.html";s:4:"d8e5";s:28:"doc/html/functions_func.html";s:4:"2606";s:28:"doc/html/functions_vars.html";s:4:"fa2c";s:21:"doc/html/globals.html";s:4:"5062";s:26:"doc/html/globals_enum.html";s:4:"3bf4";s:26:"doc/html/globals_vars.html";s:4:"8634";s:25:"doc/html/graph_legend.dot";s:4:"2555";s:26:"doc/html/graph_legend.html";s:4:"4619";s:25:"doc/html/graph_legend.png";s:4:"5700";s:19:"doc/html/index.html";s:4:"5e2f";s:32:"doc/html/namespace_t_y_p_o3.html";s:4:"3ee7";s:24:"doc/html/namespaces.html";s:4:"66f9";s:32:"doc/html/reload_8php-source.html";s:4:"d34f";s:25:"doc/html/reload_8php.html";s:4:"b01a";s:18:"doc/html/tab_b.gif";s:4:"a22e";s:18:"doc/html/tab_l.gif";s:4:"749f";s:18:"doc/html/tab_r.gif";s:4:"9802";s:17:"doc/html/tabs.css";s:4:"9656";s:29:"doc/html/tca_8php-source.html";s:4:"c9b3";s:22:"doc/html/tca_8php.html";s:4:"1974";}',
	'suggests' => array(
	),
);

?>