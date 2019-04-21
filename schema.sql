CREATE DATABASE YetiCave
DEFAULT  CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE YetiCave;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(30) UNIQUE,
    email char(50) NOT NULL,
    password CHAR(30)
);

CREATE TABLE lots(
    img_url CHAR,
    category CHAR(30),
    name CHAR(100),
    price INT,
    time INT
);
