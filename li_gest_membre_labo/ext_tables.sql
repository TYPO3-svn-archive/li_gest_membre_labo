#
# Table structure for table 'tx_ligestmembrelabo_MembreDuLabo'
#
CREATE TABLE tx_ligestmembrelabo_MembreDuLabo (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	nomdusage varchar(255) DEFAULT '' NOT NULL,
	nommaritale varchar(255) DEFAULT '' NOT NULL,
	nompremarital varchar(255) DEFAULT '' NOT NULL,
	prenom varchar(255) DEFAULT '' NOT NULL,
	genre char(1) DEFAULT '' NOT NULL,
	datenaissance int(11) DEFAULT '0' NOT NULL,
	nationalite varchar(255) DEFAULT '' NOT NULL,
	datearrivee int(11) DEFAULT '0' NOT NULL,
	datesortie int(11) DEFAULT '0' NOT NULL,
	numine varchar(255) DEFAULT '' NOT NULL,
	sectioncnu varchar(255) DEFAULT '' NOT NULL,
	coordonneesrecherche varchar(255) DEFAULT '' NOT NULL,
	coordonneesenseignement varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	coordonneespersonnelles varchar(255) DEFAULT '' NOT NULL,
	pageweb varchar(255) DEFAULT '' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);