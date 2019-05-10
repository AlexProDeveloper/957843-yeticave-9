CREATE DATABASE YetiCave
DEFAULT  CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE YetiCave;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    name CHAR(30) UNIQUE,
    email char(50) NOT NULL,
    password CHAR(255),
    avatar CHAR(255),
    contacts CHAR(255)
);

CREATE TABLE bets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    bet_price FLOAT,
    user_id INT,
    lot_id INT
);

CREATE TABLE lots(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    winner_id INT,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    url CHAR(255),
    name CHAR(100) UNIQUE,
    description TEXT,
    start_price FLOAT,
    ended_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    step FLOAT
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(30),
    code CHAR(20)
);


