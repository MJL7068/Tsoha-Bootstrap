-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Opiskelija(
    id SERIAL PRIMARY KEY,
    opiskelijanumero varchar(50) NOT NULL,
    nimi varchar(50) NOT NULL,
    salasana varchar(50), NOT NULL
);

CREATE TABLE Aihe(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    kuvaus varchar(400),
    vaikeustaso varchar(50) NOT NULL,
    maksimiarvosana INTEGER NOT NULL
);