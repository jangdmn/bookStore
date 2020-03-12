﻿DROP DATABASE IF EXISTS GroGoGroup;
CREATE DATABASE GroGoGroup;
USE GroGoGroup;

-- Tabelle Kunde
DROP TABLE IF EXISTS kunde;
CREATE TABLE Kunde 
(
benutzerID INT PRIMARY KEY AUTO_INCREMENT,
passwort VARCHAR(255) NOT NULL,
vorname VARCHAR(50) NOT NULL,
nachname VARCHAR(50),
strasse VARCHAR(50),
hausNr INT,
PLZ CHAR(5),
email VARCHAR(50) UNIQUE
);

-- Tabelle Administrator

CREATE TABLE Administrator
(
adminID INT PRIMARY KEY AUTO_INCREMENT,
passwort VARCHAR(255) NOT NULL
);

-- Tabelle Buch

CREATE TABLE Buch
(
buchID INT PRIMARY KEY AUTO_INCREMENT,
ISBN10 VARCHAR(25) UNIQUE,
ISBN13 VARCHAR(25) UNIQUE,
titel VARCHAR(100) NOT NULL,
autor VARCHAR(100),
verzeichnisPfad VARCHAR(255) UNIQUE,
bearbeitungsID INT DEFAULT 1,
FOREIGN KEY (bearbeitungsID) REFERENCES Administrator (adminID)
);

-- Tabelle Buecherregal

CREATE TABLE Buecherregal
(
regalID INT PRIMARY KEY AUTO_INCREMENT,
benutzerID INT,
buchID INT,
FOREIGN KEY (benutzerID) REFERENCES Kunde (benutzerID),
FOREIGN KEY (buchID)  REFERENCES Buch (buchID)
);

-- Tabelle Leseliste

CREATE TABLE Leseliste
(
leselisteID INT PRIMARY KEY AUTO_INCREMENT,
lesezeichen INT,
regalID INT,
FOREIGN KEY (regalID) REFERENCES Buecherregal (regalID)
); 

-- Beispiel Kunde, Passwort: test
INSERT INTO `kunde`(`BenutzerID`, `Passwort`, `Vorname`, `Nachname`, `Strasse`, `HausNr`, `PLZ`, `email`) 
VALUES (1, '$2y$10$qCgb4MKzbMKAqUU2LOFBQ.wGoAD6yBElFA7V7EPwK.QGCViJjx4mu', 'Max', 'Mustermann',
'Musterstr.', 1,'12345', 'mm@muster.de');

-- Beispiel Admin, Passwort: test
INSERT INTO Administrator(passwort)
VALUES ('$2y$10$qCgb4MKzbMKAqUU2LOFBQ.wGoAD6yBElFA7V7EPwK.QGCViJjx4mu');

-- Beispiel Bücher
INSERT INTO Buch (isbn10, isbn13, titel, autor, verzeichnisPfad, bearbeitungsID)
VALUES ('1111111111', '1111111111111', 'firstTestTitel', 'firstAutorName', 'upload/firstTestTitel', 1);

INSERT INTO Buch (isbn10, isbn13, titel, autor, verzeichnisPfad, bearbeitungsID)
VALUES ('2222222222', '2222222222222', 'secondTestTitel', 'secondAutorName', 'upload/secondTestTitel', 1);