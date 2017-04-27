INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Matti Meikäläinen', '014413456');
INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Sanna Savolainen', '014410908');
INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Outi Opiskelija', '014419999');
INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Mikko Metsänen', '014412323');
INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Ville Veikkonen', '014419876');
INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Maija Maatila', '014448812');

INSERT INTO Opettaja (nimi) VALUES ('Ossi Opettaja');
INSERT INTO Opettaja (nimi) VALUES ('Marjaana Metsänen');
INSERT INTO Opettaja (nimi) VALUES ('Rolf Bergström');
INSERT INTO Opettaja (nimi) VALUES ('Heikki Niemelä');

INSERT INTO Kurssi (nimi) VALUES ('Tietokantasovellus');
INSERT INTO Kurssi (nimi) VALUES ('Ohjelmoinnin harjoitustyö');
INSERT INTO Kurssi (nimi) VALUES ('Tietoliikenne');
INSERT INTO Kurssi (nimi) VALUES ('Tietorakenteet');

INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES ('Drinkkikirjasto', 'Keskitasoa', 5, 1, ' Tehtävänä on laatia www-sivulla toimiva drinkinhakulomake.');
INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES ('Laivanupotus', 'Helppo', 4, 2, 'Tämän harjoitustyön aiheena on ohjelmoida laivanupotus');
INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES ('Huutokauppa', 'Vaikea', 5, 1, 'Huutokauppakamari Verkkodiili haluaa rakentaa huutokauppajärjestelmän, jonka avulla se voi kaupata tuotteita verkossa.');
INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES ('Äänestys', 'Helppo', 3, 1, 'Tehtävänäsi on laatia järjestelmä, jolla voi hoitaa erilaisia äänestyksiä, kuten ‘vuoden opettaja’, ‘vähiten huono euroviisuedustaja’, ‘miss/mister intranet’, jne.');
INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES ('Pizzapalvelu', 'Vaikea', 5, 1, 'Pirkon Pizza Palvelu (PPP) on suunnittelemassa toimintaansa varten tietojärjestelmää. Asiakas tekee tilauksensa internetin välityksellä. Tilaus voi käsittää useita tuotteita. Pizzoja on muutamaa perustyyppiä, joita voi täydentää erilaisilla lisukkeilla.');

INSERT INTO Suoritus (aihe, nimi, ohjaaja, kuvaus, tyomaara, arvosana) VALUES (1, 'Drinkittäjä', 1, 'Tämän harjoitustyön aiheena on drinkkikirjasto.', 25, 5);
INSERT INTO Suoritus (aihe, nimi, ohjaaja, kuvaus, tyomaara, arvosana) VALUES (2, 'Upotus', 2, 'Ohjelmoin laivanupotuspelin.', 15, 4);
INSERT INTO Suoritus (aihe, nimi, ohjaaja, kuvaus, tyomaara, arvosana) VALUES (3, 'Huutokamari', 2, 'Ohjelmoin huutokauppasovelluksen.', 32, 5);
INSERT INTO Suoritus (aihe, nimi, ohjaaja, kuvaus, tyomaara, arvosana) VALUES (4, 'Tapahtumaäänestäjä', 4, 'Tein ohjelman, jolla voi suorittaa tapahtumiin liittyviä äänestyksiä.', 22, 3);

INSERT INTO Yllapitaja (nimi, salasana) VALUES ('Yllapitaja', 'salasana123');

INSERT INTO Suorittaja (opiskelija, suoritus) VALUES (1, 1);
INSERT INTO Suorittaja (opiskelija, suoritus) VALUES (1, 2);
INSERT INTO Suorittaja (opiskelija, suoritus) VALUES (2, 3);
INSERT INTO Suorittaja (opiskelija, suoritus) VALUES (6, 4);