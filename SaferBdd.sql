CREATE DATABASE safer_project;
use safer_project;

CREATE TABLE bien (
	id INT AUTO_INCREMENT NOT NULL,
	categorie_id INT DEFAULT NULL,
	 titre VARCHAR(200) NOT NULL,
	 description VARCHAR(200) NOT NULL,
	 prix INT DEFAULT NULL,
	 cp INT NOT NULL,
	 est_vente TINYINT(1) DEFAULT NULL,
	 surface VARCHAR(10) NOT NULL,
	 ville VARCHAR(100) DEFAULT NULL,
	 INDEX IDX_45EDC386BCF5E72D (categorie_id),
	 PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

CREATE TABLE categorie (
	id INT AUTO_INCREMENT NOT NULL,
	 type VARCHAR(100) NOT NULL,
	 PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

CREATE TABLE messenger_messages (
	id BIGINT AUTO_INCREMENT NOT NULL,
	 body LONGTEXT NOT NULL,
	 headers LONGTEXT NOT NULL,
	 queue_name VARCHAR(190) NOT NULL,
	 created_at DATETIME NOT NULL, available_at DATETIME NOT NULL,
	 delivered_at DATETIME DEFAULT NULL,
	 INDEX IDX_75EA56E0FB7336F0 (queue_name),
	 INDEX IDX_75EA56E0E3BD61CE (available_at),
	 INDEX IDX_75EA56E016BA31DB (delivered_at),
	 PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

ALTER TABLE bien 
	ADD CONSTRAINT FK_45EDC386BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id);

CREATE TABLE `admin` (
	id INT AUTO_INCREMENT NOT NULL,
	 email VARCHAR(180) NOT NULL, 
	roles JSON NOT NULL, 
	password VARCHAR(255) NOT NULL, 
	UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), 
	PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

ALTER TABLE `admin`
	 ADD nom VARCHAR(100) DEFAULT NULL,
	 ADD prenom VARCHAR(100) DEFAULT NULL,
	 ADD login VARCHAR(100) NOT NULL;

ALTER TABLE bien 
	ADD image VARCHAR(100) NOT NULL;

CREATE TABLE contact (
id INT AUTO_INCREMENT NOT NULL,
 mail VARCHAR(255) NOT NULL,
 description VARCHAR(255) NOT NULL,
 date DATETIME NOT NULL,
 PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

INSERT INTO `categorie` (`id`, `type`) VALUES
(1, 'Terrain agricole'),
(2, 'Prairie'),
(3, 'Bois'),
(4, 'Bâtiments'),
(5, 'Exploitations');

INSERT INTO `bien` (`categorie_id`, `titre`, `description`, `prix`, `cp`, `est_vente`, `surface`, `ville`, `image`) VALUES
(5 , 'Activités Equestres, Apiculture, Chasse,', 'Propriété Charente-Maritime', 330000, 17200, true,'17Ha' , 'Royan', '17.03.017.jpg'),
(5, 'FERME 100% HERBAGERE/ ELEVAGE LAITIER', 'Situ?e ? l\'or?e d\'un bourg, ? 10 minutes des services et commerces', 950, 35200, false,'34Ha' , 'Ville', '19.07.118.jpg'),
(4, 'Propriété Creuse', 'Dans un hameau à moins de 10 minutes d\'un bourg avec services et commerces, et d\'un village ayant un intérêt touristique sur les routes de St-Jacques-de-Compostelle.', 860, 23320, false,'1Ha55' , 'Bussière-Dunoise', '23.16.104.jpg'),
(5, 'Propri?t? Gard', 'Ensemble immobilier proche d\'un plan d\'eau am?nag?', 2000, 34290, false, '29Ha', 'ville', '30VI9700.jpg'),
(3, 'Id?al soci?t? de chasse', 'Terrain bois? class? ONF', 120000 , 22700, true, '35Ha', 'ville', '313453DR.jpg'),
(3, 'Sapini?re', 'Sapini?re en cours de bail, cherche reprise', 800, 35200, false, '1,8Ha', 'ville', '344334UJ.jpg'),
(3, 'Bois sur pied', 'Diverses essences sur place', 30000, 29510, true, '6Ha', 'Ville', '345E7EG.jpg'),
(4, 'Tourisme rural-h?bergement', 'Au nord de l\'H?rault, proche des axes routiers et ? 45 minutes de Montpellier', 1490000, 34070, true, '1Ha90', 'Ville', '34AG10897.jpg'),
(4, 'Propri?t? viticole et sa cave', 'Au c?ur de l\'appellation Saint-Chinian', 1500000, 34280, true, '30Ha', 'Ville', '34VI6979.jpg'),
(1, 'Vallons du Voironnais', '13 Ha de terrain', 2000, 38500, false, '13Ha', 'ville', '38TB22187.jpg'),
(2, 'Prairies en pays glazik', 'Usage petits animaux type caprins', 15000, 29510, true, '1ha22', 'Ville', '43LM220118.jpg'),
(4, 'B?timents avicoles ? transmettre', 'Site avicole ? transmettre sur la commune de Nort-sur-Erdre, au nord de Nantes.', 200000, 44220, true, '2Ha', 'Ville', '44 22 AN 08.jpg'),
(1, 'PRET A USAGE sur 95 ha - PLAINE DES VOSGES ', ' A 5 min de Villeneuve-sur-Lot', 11000, 47300, false, '14Ha', 'ville', '47.06.098.jpg'),
(4, 'Propri?t? Loz?re', 'Ensemble b?ti avec environ 1ha55', 700, 48370, false, '1Ha55', 'ville', '48EL11345.jpg'),
(1, 'Situ? ? 15 minutes de Mende', 'id?al pour polyculture sur 14 ha', 1300, 30430, false, '10Ha', 'ville', '48RE11201.jpg'),
(5, 'Propri?t? Meuse', 'FERME DE COURUPT : Secteur Sainte-Menehould / Clermont-en-Argonne / Revigny', null , 88340, false, '59Ha', 'ville', '55VS.jpg'),
(1, 'Ancienne ferme ?questre en ruine', 'Terrains actuellement lou?s', 156000, 29510, true, '12Ha', 'Ville', '5667DB.jpg'),
(2, 'Productions v?g?tales', 'La parcelle se situe dans le B?arn sur la commune de LAGOR.', 7700, 64150, true, '2Ha', 'Ville', '64.02.59.jpg'),
(4, 'Propri?t? situ?e dans un secteur vallonn?', 'Propri?t? Pyr?n?es-Atlantiques', 650, 23500, false, '6Ha', 'ville', '64.03.60.jpg'),
('3', 'Terrain class? T4', 'clotur? et partiellement bois?', 500, 56500, false, '1,2Ha', 'ville', '65.23.876.jpg'),
(2, 'Prairies sur les plateaux', 'Parcelle de terre labourable d\'environ 2 ha', 400000, 81090, true, '76Ha', 'Ville', '7629CA.jpg'),
(2, 'Prairies orient?es nord ouest', 'Lot d\'un seul tenant', 113000, 56500, true, '11Ha', 'Ville', '765DN.jpg'),
(2, 'Terrain proche cours d\'eau', 'Non accessible par la route, uniquement chemin d\'exploitation', 3000, 35200, false, '5,5Ha', 'ville', '76RZDC.jpg'),
(3, 'Secteur du S?gala-Viaur', 'les secteurs les plus en pente sont empi?r?s', 400000, 12200, true, '54Ha', 'Ville', '81EL11100.jpg'),
(1, 'Vittel Dombrot : Ouest vosgien, secteur de VITTEL', 'Terrains d\'environ 6,5 ha', null, 88170, true, '6,5Ha', 'Ville', '88 FB .jpg'),
(2, 'Terrain avec abri', 'Pour propri?taire ?quin', 1200, 44110, false, '1,2Ha', 'ville', '9875RDC.jpg'),
(5, 'Exploitation Agricole sp?cialis?e en polyculture ?levage', 'Exploitation situ?e dans le Sud Est de La Sarthe, entre la commune d\'Ecommoy (72220) et Sarc? (72327)', null, 72220, true, '87Ha', 'Ville', 'AA 72 22 0088 RB.jpg'),
(5, 'Propri?t? Calvados', 'JFD : Noue de Sienne (14)', 173440, 14380, true, '17Ha', 'Ville', 'MQ14170356 .jpg'),
(3, 'Bois domainial', 'Bois accessible avec sentiers', 12000, 44110, false, '32Ha', 'ville', 'QDSGF56.jpg'),
(2, 'L?g?rement en Pente', 'Id?al paturage moutons', '2400', 22700, false, '3,4Ha', 'ville', 'Z34.345.45.jpg');
