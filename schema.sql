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
    id INT AUTO_INCREMENT PRIMARY KEY,
    img_url CHAR,
    category_id INT,
    name CHAR(100) UNIQUE,
    price INT,
    time INT
);

CREATE TABLE categiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR
);
