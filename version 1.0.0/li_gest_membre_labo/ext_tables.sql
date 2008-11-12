#
# Table structure for table 'tx_ligestmembrelabo_MembreDuLabo'
#
CREATE TABLE tx_ligestmembrelabo_MembreDuLabo (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	NomDUsage varchar(255) DEFAULT '' NOT NULL,
	NomPreMarital varchar(255) DEFAULT '' NOT NULL,
	NomMaritale varchar(255) DEFAULT '' NOT NULL,
	Prenom varchar(255) DEFAULT '' NOT NULL,
	Genre char(1) DEFAULT '' NOT NULL,
	DateNaissance date DEFAULT '0000-00-00' NOT NULL,
	Nationalite varchar(255) DEFAULT '' NOT NULL,
	DateArrivee date DEFAULT '0000-00-00' NOT NULL,
	DateSortie date DEFAULT '0000-00-00' NOT NULL,
	NumINE varchar(255) DEFAULT '' NOT NULL,
	SectionCNU varchar(255) DEFAULT '' NOT NULL,
	CoordonneesRecherche varchar(255) DEFAULT '' NOT NULL,
	CoordonneesEnseignement varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	CoordonneesPersonnelles varchar(255) DEFAULT '' NOT NULL,
	PageWeb varchar(255) DEFAULT '',
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_Exerce'
#
CREATE TABLE tx_ligestmembrelabo_Exerce (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	idMembreLabo int(11) DEFAULT '0' NOT NULL,
	idStructure int(11) DEFAULT '0' NOT NULL,
	idFonction int(11) DEFAULT '0' NOT NULL,
	DateDebut date DEFAULT '0000-00-00' NOT NULL,
	DateFin date DEFAULT '0000-00-00' NOT NULL,
	
	#PRIMARY KEY (idMembreLabo, idStructure, idFonction),
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_Structure'
#
CREATE TABLE tx_ligestmembrelabo_Structure (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	LibelleDesSaisies varchar(255) DEFAULT '' NOT NULL,
	Nom varchar(255) DEFAULT '' NOT NULL,
	Adresse varchar(255) DEFAULT '' NOT NULL,
	Type char(1) DEFAULT '' NOT NULL,
	idStructureParente int(11) DEFAULT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_Fonction'
#
CREATE TABLE tx_ligestmembrelabo_Fonction (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	Libelle varchar(255) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_TypePosteWeb'
#
CREATE TABLE tx_ligestmembrelabo_TypePosteWeb (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	idTypePosteWeb varchar(5) NOT NULL,
	LibelleWeb varchar(255) DEFAULT '',

	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_TypePoste'
#
CREATE TABLE tx_ligestmembrelabo_TypePoste (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	idTypePoste varchar(5) NOT NULL,
	Libelle varchar(255) DEFAULT '' NOT NULL,
	idTypePosteWeb varchar(5) DEFAULT '0' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_Possede'
#
CREATE TABLE tx_ligestmembrelabo_Possede (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	idTypePoste varchar(5) DEFAULT '0' NOT NULL,
	idMembreLabo int(11) DEFAULT '0' NOT NULL,
	DateDebut date DEFAULT '0000-00-00' NOT NULL,
	DateFin date DEFAULT '0000-00-00' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_Categorie'
#
CREATE TABLE tx_ligestmembrelabo_Categorie (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	idCategorie varchar(5) DEFAULT '' NOT NULL,
	Libelle varchar(255) DEFAULT '' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_Categorie_MembreDuLabo'
#
CREATE TABLE tx_ligestmembrelabo_Categorie_MembreDuLabo (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	idCategorie varchar(5) DEFAULT '' NOT NULL,
	idMembreLabo int(11) DEFAULT '0' NOT NULL,
	DateDebut date DEFAULT '0000-00-00' NOT NULL,
	DateFin date DEFAULT '0000-00-00' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_Equipe'
#
CREATE TABLE tx_ligestmembrelabo_Equipe (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	Nom varchar(255) DEFAULT '' NOT NULL,
	Abreviation varchar(255) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_EstMembreDe'
#
CREATE TABLE tx_ligestmembrelabo_EstMembreDe (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	idMembreLabo int(11) DEFAULT '0' NOT NULL,
	idEquipe int(11) DEFAULT '0' NOT NULL,
	Rang varchar(255) DEFAULT '' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_TypeDiplome'
#
CREATE TABLE tx_ligestmembrelabo_TypeDiplome (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	Code varchar(5) DEFAULT '' NOT NULL,
	Libelle varchar(255) DEFAULT '' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);



#
# Table structure for table 'tx_ligestmembrelabo_AObtenu'
#
CREATE TABLE tx_ligestmembrelabo_AObtenu (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	idMembreLabo int(11) DEFAULT '0' NOT NULL,
	CodeDiplome varchar(5) DEFAULT '' NOT NULL,
	DateObtention date DEFAULT '0000-00-00' NOT NULL,
	Intitule varchar(255) DEFAULT '' NOT NULL,
	LieuDObtention varchar(255) DEFAULT '' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);