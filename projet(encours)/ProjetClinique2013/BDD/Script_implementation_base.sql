Drop database if exists Questionnaire;
create database Questionnaire;
use Questionnaire;

Create table Service(
idService varchar(10) primary key ,
libService varchar(40))engine=InnoDB;

Create table TypeQuestionnaire(
idType varchar(6) primary key, 
libType varchar(40))engine=InnoDB;

Create table Partie(
idPartie smallint,
libPartie varchar(100),
idType varchar(6),
CONSTRAINT pk_Partie primary key(idPartie,idType),
Foreign key (idType) References TypeQuestionnaire(idType))engine=InnoDb;

Create table Chambre(
idChambre varchar(5) primary key,
idService varchar(10),
Foreign key (idService) References Service(idService))engine=InnoDb;

Create table Lit(
idLit varchar(5) ,
idChambre varchar(5) ,
CONSTRAINT pk_Lit PRIMARY KEY (idLit,idChambre),
Foreign key (idChambre) References Chambre(idChambre))engine=InnoDb;

Create table ContenuPartie(
idPartie smallint,
idType varchar(6),
idLigneContenu smallint,
libContenu varchar(150),
CONSTRAINT pk_ContenuPartie Primary key (idPartie,idType,idLigneContenu),
Foreign key (idPartie,idType) References Partie(idPartie,idType))engine=InnoDb;

Create table Affichage(
noQuestionnaire int primary key auto_increment,
dateEntree date,
dateSaisie date,
idService varchar(10) ,
idChambre varchar(5),
idType varchar(6),
Foreign key (idService) References Service(idService),
Foreign key (idChambre) References Chambre(idChambre),
Foreign key (idType) References TypeQuestionnaire(idType))engine=InnoDb;

Create table Satisfaction(
noQuestionnaire int ,
idPartie smallint,
idType varchar(6),
idLigneContenu smallint,
libSatisfaction varchar(255),
CONSTRAINT pk_Satisfaction Primary key (noQuestionnaire,idPartie,idLigneContenu,idType),
Foreign key (idPartie,idType,idLigneContenu) References ContenuPartie(idPartie,idType,idLigneContenu),
Foreign key (noQuestionnaire) References Affichage(noQuestionnaire))engine=InnoDb;