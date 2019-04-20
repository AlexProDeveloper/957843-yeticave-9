CREATE DATABASE YetiCave
DEFAULT  CHARACTER SET utf8
DEFAULT COLLATE utf8_generical_si;
USE YetiCave;

CREATE TABLE usersBase(
    ig INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(30) UNIQUE,
    email char(50) NOT NULL,
    password CHAR(30)
);

CREATE TABLE lots(
    imgUrl CHAR,
    category CHAR(30),
    name CHAR(100),
    prise INT,
    time INT
);
