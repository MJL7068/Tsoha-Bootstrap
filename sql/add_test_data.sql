INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Matti Meikäläinen', 014413456);
INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES ('Sanna Savolainen', 014410908);
INSERT INTO Opettaja (nimi) VALUES ('Ossi Opettaja');
INSERT INTO Opettaja (nimi) VALUES ('Marjaana Metsänen');
INSERT INTO Kurssi (nimi) VALUES ('Tietokantasovellus');
INSERT INTO Kurssi (nimi) VALUES ('Ohjelmoinnin harjoitustyö');
INSERT INTO Kurssi (nimi) VALUES ('Tietoliikenne');
INSERT INTO Kurssi (nimi) VALUES ('Tietorakenteet');
INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES ('Drinkkikirjasto', 'keskitasoa', 5, 1, ' Tehtävänä on laatia www-sivulla toimiva drinkinhakulomake.');
INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES ('Laivanupotus', 'helppo', 4, 2, 'Tämän harjoitustyön aiheena on ohjelmoida laivanupotus');
INSERT INTO Suoritus (aihe, tekija, ohjaaja, kuvaus, tyomaara, arvosana) VALUES (1, 1, 1, 'Tämän harjoitustyön aiheena on drinkkikirjasto.', 25, 5);
