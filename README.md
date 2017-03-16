## Työaihetietokanta

[Linkki projektin dokumentaatioon](https://github.com/MJL7068/Tsoha-Bootstrap/blob/master/doc/dokumentaatio.pdf)

[Linkki projektiin users-palvelimella](http://matleino.users.cs.helsinki.fi/projekti/)


Työn tarkoituksena on ohjelmoida yksinkertainen tietokantasovellus harjoitustyöaiheiden ja niihin liittyvien suoritusten ylläpitoon.

Järjestelmän avulla käyttäjät voivat katsella eri kursseihin liittyviä harjoitustyöaiheita. Opettajat ja ylläpitäjä näkevät yksityiskohtaisia tietoja liittyen siihen, miten usein jokin tietty aihe on valittu, miten kauan sen suoritukseen on mennyt, mitä arvosanoja siitä on saatu jne.

Jokainen aihe liittyy johonkin kurssiin. Sillä on kuvaus, maksimiarvosana ja vaikeustaso.

Opiskelijalla voi olla yksi tai useampia harjoitustöitä (maksimissaan yksi jokaiselle kurssille). Yhteen aiheeseen voi liittyä useampia harjoitustyösuoritus.

Opettajat voivat lisätä uusia harjoitustyöaiheita ja muokata niihin liittyviä tietoja.

Projektissa on ainakin kolme muokattavaa tietokohdetta johon toteutetaan CRUD-nelikko (opiskelija, harjoitustyön aihe ja opiskelijan harjoitustyön toteutus). Koska opiskelijalla voi olla useampia harjoitustöitä ja tietyn harjoitustyöaiheen voi toteuttaa useampi opiskelija, on harjoitustyöaihe- ja opiskelija-tietokantataulujen välillä monesta-moneen suhde. Projektiin toteutetaan sisäänkirjautumistoiminto.

Projekti toteutetaan laitoksen users-palvelimella käyttäen php-ohjelmointikieltä sekä PostgreSQL-tietokantapalvelinta.
