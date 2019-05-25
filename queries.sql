SELECT l.name, l.start_price, l.url, (SELECT MAX(bet_price) FROM bets WHERE lot_id=l.id) as price FROM lots  AS l
LEFT JOIN categories AS c ON l.category_id=c.id
WHERE l.ended_at < NOW()
ORDER BY l.created_at ASC;

SELECT * FROM lots LEFT JOIN categories AS c ON lots.category_id = c.id WHERE lots.id = 1;

UPDATE lots SET name='2014 Rossignol District Snowboard.' WHERE id=1;

SELECT * FROM bets WHERE lot_id = 4 ORDER BY created_at ASC;

SELECT name FROM categories;

-- SELECT u.name, l.name FROM lots as l
-- LEFT JOIN users as u ON l.user_id=u.id
--
--
-- SELECT *, (SELECT name FROM users) as user_name FROM lots
--
-- SELECT * FROM categories;

--
SELECT l.*, c.name  as cat, (SELECT MAX(bet_price)
FROM bets WHERE lot_id=l.id) as price FROM lots  AS l
LEFT JOIN categories AS c ON l.category_id=c.id
WHERE l.id = ?

SELECT lots.*, categories.name as cat, bets.bet_price as price from lots
LEFT JOIN bets ON lots.id = bets.user_id
LEFT JOIN categories ON categories.id = lots.category_id

