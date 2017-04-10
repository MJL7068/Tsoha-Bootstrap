INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Matti Meikäläinen', 014413456);
INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Sanna Savolainen', 014410908);
INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Outi Opiskelija', 014419999);
INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Mikko Metsänen', 014412323);
INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Ville Veikkonen', 014419876);

INSERT INTO Opettaja (nimi) VALUES ('Ossi Opettaja');
INSERT INTO Opettaja (nimi) VALUES ('Marjaana Metsänen');
INSERT INTO Opettaja (nimi) VALUES ('Rolf Bergström');

INSERT INTO Kurssi (nimi) VALUES ('Tietokantasovellus');
INSERT INTO Kurssi (nimi) VALUES ('Ohjelmoinnin harjoitustyö');
INSERT INTO Kurssi (nimi) VALUES ('Tietoliikenne');
INSERT INTO Kurssi (nimi) VALUES ('Tietorakenteet');

INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES ('Drinkkikirjasto', 'keskitasoa', 5, 1, ' Tehtävänä on laatia www-sivulla toimiva drinkinhakulomake.');
INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES ('Laivanupotus', 'helppo', 4, 2, 'Tämän harjoitustyön aiheena on ohjelmoida laivanupotus');
INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES ('Huutokauppa', 'vaikea', 5, 1, 'Huutokauppakamari Verkkodiili haluaa rakentaa huutokauppajärjestelmän, jonka avulla se voi kaupata tuotteita verkossa.');

INSERT INTO Suoritus (aihe, nimi, ohjaaja, kuvaus, tyomaara, arvosana) VALUES (1, 'Drinkittäjä', 1, 'Tämän harjoitustyön aiheena on drinkkikirjasto.', 25, 5);
INSERT INTO Suoritus (aihe, nimi, ohjaaja, kuvaus, tyomaara, arvosana) VALUES (2, 'Upotus', 2, 'Ohjelmoin laivanupotuspelin.', 15, 4);
INSERT INTO Suoritus (aihe, nimi, ohjaaja, kuvaus, tyomaara, arvosana) VALUES (3, 'Huutokamari', 2, 'Ohjelmoin huutokauppasovelluksen.', 32, 5);

INSERT INTO Yllapitaja (nimi, salasana) VALUES ('Yllapitaja', 'salasana123');

INSERT INTO Suorittaja (opiskelija, suoritus) VALUES (1, 1);
INSERT INTO Suorittaja (opiskelija, suoritus) VALUES (1, 2);
INSERT INTO Suorittaja (opiskelija, suoritus) VALUES (2, 3);