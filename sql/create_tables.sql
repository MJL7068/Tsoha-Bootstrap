CREATE TABLE Opiskelija(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    opiskelijanumero varchar(50) NOT NULL
);

CREATE TABLE Opettaja(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL
);

CREATE TABLE Yllapitaja(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    salasana varchar(20) NOT NULL
);

CREATE TABLE Kurssi(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL
);

CREATE TABLE Aihe(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    vaikeustaso varchar(20) NOT NULL,
    maksimiarvosana INTEGER NOT NULL,
    kurssi INTEGER REFERENCES Kurssi(id),
    kuvaus varchar(400)
);

CREATE TABLE Suoritus(
    id SERIAL PRIMARY KEY,
    aihe INTEGER REFERENCES Aihe(id),
    tekija INTEGER REFERENCES Opiskelija(id),
    ohjaaja INTEGER REFERENCES Opettaja(id),
    kuvaus varchar(400),
    tyomaara INTEGER,
    arvosana INTEGER
);