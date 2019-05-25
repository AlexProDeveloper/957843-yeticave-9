INSERT INTO users
(name, email, password, avatar, contacts) VALUES
('Тигран Ержанович', 'tigran@gmail.com', '$2y$10$f6qxLh68BtUFsnCdtSrEoOjLFwYsvMfEsFi/E5f5SR1MvIHMxU8LO', '', 'my skype : test'),
('Василий Иванов', 'vasily@ya.ru', '$2y$10$w3fGSauUhdhGg0Uj7Meg9OTgqu2bxRJpaQxSw4iLX9d3WpeFjspWC', '', 'my contacts'),
('Петр Игнатов', 'petr@mail.ru', '$2y$10$0JGIpnmor.SH5847tWG58uwdwbnpjagL8NiYc8vsemOdCDZLZbN6G', '', 'my contacts');

INSERT INTO categories
(name, code) VALUES ("Доски и лыжи", 'boards'), ("Крепления", 'attachment'), ("Ботинки", 'boots'), ("Одежда", 'clothing'),
("Инструменты", 'tools'), ("Разное", 'other');

INSERT INTO lots
(url, category_id, name, start_price, user_id, step) VALUES
("img/lot-1.jpg", 1, "2014 Rossignol District Snowboard", 10999, 1, 1),
("img/lot-2.jpg", 1, "DC Ply Mens 2016/2017 Snowboard", 159999, 1, 100),
("img/lot-3.jpg", 2, "Крепления Union Contact Pro 2015 года размер L/XL", 8000, 1, 746),
("img/lot-4.jpg", 3, "Ботинки для сноуборда DC Mutiny Charocal", 10999, 1, 1000),
("img/lot-5.jpg", 4, "Куртка для сноуборда DC Mutiny Charocal", 7500, 1, 1),
("img/lot-6.jpg", 6, "Маска Oakley Canopy", 5400, 1, 99);

INSERT INTO bets
(bet_price, user_id, lot_id) VALUES
(100.4, 1, 4),
(4562, 2, 4);