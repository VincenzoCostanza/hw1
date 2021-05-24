CREATE TABLE utenti(
    Nome varchar(255) not null,
    Cognome varchar(255) not null,
    email varchar(255) not null,
    username varchar(20) primary key,
    password varchar(255) not null
)Engine=InnoDB;

CREATE TABLE Post(
    id integer primary key auto_increment,
    titolo varchar(255),
    descrizione varchar(255),
    immagine varchar(255),
    num_commenti integer default 0,
    num_like integer default 0
)Engine=InnoDB;

CREATE TABLE likes(
    user varchar(20),
    id integer,
    foreign key(user) references utenti(username),
    foreign key(id) references Post(id),
    primary key(user,id)
)Engine=InnoDB;


CREATE TABLE competizioni(
    titolo varchar(20),
    immagine varchar(255),
    descrizione varchar(255)
)Engine=InnoDB;


CREATE TABLE preferiti(
    user varchar(20),
    titolo varchar(20),
    immagine varchar(255),
    foreign key(user) references utenti(username),
    primary key(user,titolo,immagine)
)Engine=InnoDB;        


CREATE TABLE commenti(
    user varchar(20),
    id integer not null,
    commento varchar(254),
    foreign key(user) references utenti(username),
    foreign key(id) references Post(id)
)Engine=InnoDB;


DELIMITER //
CREATE TRIGGER likes_trigger
AFTER INSERT ON likes
FOR EACH ROW
BEGIN
UPDATE Post
SET num_like = num_like + 1
WHERE id = new.id;
END //
DELIMITER ;



DELIMITER //
CREATE TRIGGER unlikes_trigger
AFTER DELETE ON likes
FOR EACH ROW
BEGIN
UPDATE Post
SET num_like = num_like - 1
WHERE id = old.id;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER comments_trigger
AFTER INSERT ON commenti
FOR EACH ROW
BEGIN
UPDATE post 
SET num_commenti = num_commenti + 1
WHERE id = new.id;
END //
DELIMITER ;

CREATE DATABASE calcisticamente;
use database calcisticamente;

************************************************PER  GLI  ARTICOLI***************************************************************************************************************************************** 
INSERT into POST(titolo,descrizione,immagine) values('La fine di un ciclo','Messi e Ronaldo fuori dalla coppa dalle grandi orecchie agli ottavi, non succedeva da 16 anni!','articolo_1.png');

INSERT into POST(titolo,descrizione,immagine) values('Juve le cose si complicano','Che beffa! Il benevento aspetta e porta a casa un risultato inaspettato allo stadium! Addio scudetto?','articolo_2.jpg');

INSERT into POST(titolo,descrizione,immagine) values('Ultimissime di mercato','La Juventus spera nel ritorno di Kean. Locatelli alla juve a giugno?','articolo_3.jpg');

INSERT into POST(titolo,descrizione,immagine) values('Problemi di intesa','Il Milan oltre Donnarumma: offerti 8 milioni,Raiola tace. Ecco a chi si punta.','articolo_4.jpg');
*************************************************************************************************************************************************************************************************************

**************************************************PER   LE   COMPETIZIONI****************************************************************************************************************************************
INSERT into COMPETIZIONI values('Serie A','seriea.png','Campionato italiano');
INSERT into COMPETIZIONI values('Premier League','premierleague.png','Campionato inglese');
INSERT into COMPETIZIONI values('Champions League','champions.jpg','La coppa dalle grandi orecchie');
INSERT into COMPETIZIONI values('Europa League','europa.jpg','La coppa uefa per gli intenditori');
INSERT into COMPETIZIONI values('Liga','liga.jpg','Campionato spagnolo');
INSERT into COMPETIZIONI values('Bundesliga','bunde.png','Campionato tedesco');
*****************************************************************************************************************************************************************************************************