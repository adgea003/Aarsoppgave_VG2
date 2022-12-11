--Den lager bruker tabellen. ID er integer og kan ikke være ingenting. Den alltid øker med 1. Navn er varchar, altså string og har en grense på 60 tegn. Epost er også varchar, men grensen er 90 tegn. Begge kan ikke være ingenting. Saldo er også integer og kan ikke være ingenting
CREATE TABLE bruker (
    id INT not null PRIMARY KEY AUTO_INCREMENT,
    navn VARCHAR(60) not null,
    epost VARCHAR(90) not null,
    saldo INT not null
    ) 