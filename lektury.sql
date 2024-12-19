-- Tworzenie bazy danych LEKTURY
CREATE DATABASE LEKTURY;

-- Użycie bazy danych LEKTURY
USE LEKTURY;

-- Tworzenie tabel
CREATE TABLE klasa1 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasa2 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasa3 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasa4 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasa5 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasa6 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasa7 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasa8 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasaS1 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasaS2 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasaS3 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasaS4 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE klasaS5 (
    ID INT NOT NULL AUTO_INCREMENT,
    author_name CHAR(50) NOT NULL,
    author_lastname CHAR(50) NOT NULL,
    tittle CHAR(250) NOT NULL,
    PRIMARY KEY (ID)
);




INSERT INTO klasa1 (author_name, author_lastname, tittle) VALUES
    ('Jan', 'Brzechwa', 'Akademia Pana Kleksa'),
    ('Astrid', 'Lindgren', 'Dzieci z Bullerbyn');

INSERT INTO klasa2 (author_name, author_lastname, tittle) VALUES
    ('Aleksander', 'Fredro', 'Zemsta'),
    ('Kornel', 'Makuszyński', 'Przygody Pana Kleksa');

INSERT INTO klasa3 (author_name, author_lastname, tittle) VALUES
    ('Henryk', 'Sienkiewicz', 'Quo Vadis'),
    ('Juliusz', 'Słowacki', 'Anhelli');

INSERT INTO klasa4 (author_name, author_lastname, tittle) VALUES
    ('Adam', 'Mickiewicz', 'Pan Tadeusz'),
    ('Juliusz', 'Verne', 'Podróż do wnętrza Ziemi');

INSERT INTO klasa5 (author_name, author_lastname, tittle) VALUES
    ('Stefan', 'Żeromski', 'Syzyfowe Prace'),
    ('Maria', 'Konopnicka', 'O dwóch panach');

INSERT INTO klasa6 (author_name, author_lastname, tittle) VALUES
    ('Jan', 'Kochanowski', 'Pieśni i Treny'),
    ('William', 'Shakespeare', 'Romeo i Julia');

INSERT INTO klasa7 (author_name, author_lastname, tittle) VALUES
    ('Adam', 'Mickiewicz', 'Dziady i Konrad Wallenrod'),
    ('Aleksander', 'Pushkin', 'Eugeniusz Oniegin');

INSERT INTO klasa8 (author_name, author_lastname, tittle) VALUES
    ('Ignacy Jan', 'Paderewski', 'Polonia'),
    ('Henryk', 'Sienkiewicz', 'Potop');


INSERT INTO klasaS1 (author_name, author_lastname, tittle) VALUES
    ('Ernest', 'Hemingway', 'Stary człowiek i morze'),
    ('Franz', 'Kafka', 'Proces');

INSERT INTO klasaS2 (author_name, author_lastname, tittle) VALUES
    ('William', 'Faulkner', 'Hałas i wściekłość'),
    ('William', 'Faulkner', 'Pożegnanie z bronią');

INSERT INTO klasaS3 (author_name, author_lastname, tittle) VALUES
    ('George', 'Orwell', 'Rok 1984'),
    ('George', 'Orwell', 'Folwark Zwierzęcy');

INSERT INTO klasaS4 (author_name, author_lastname, tittle) VALUES
    ('Gabriel', 'Garcia Marquez', 'Sto lat samotności'),
    ('Albert', 'Camus', 'Dżuma');

INSERT INTO klasaS5 (author_name, author_lastname, tittle) VALUES
    ('J.R.R.', 'Tolkien', 'Władca Pierścieni'),
    ('Stephen', 'King', 'Lśnienie');