-- Получить минимальную, максимальную и среднюю стоимость всех рабов весом более 60 кг.
SELECT
	AVG(rate) average_rate,
	MIN(rate) minimum_rate,
	MAX(rate) maximum_rate
	FROM slaves;

-- Выбрать категории, в которых больше 10 рабов.
SELECT category.* FROM categories category
INNER JOIN slaves__categories sc on category.id = sc.category_id
WHERE category.parent_id IS NOT NULL
GROUP BY category.id
HAVING count(1) > 10;

--Выбрать категорию с наибольшей суммарной стоимостью рабов.
SELECT category.* FROM categories category
INNER JOIN slaves__categories sc on category.id = sc.category_id
INNER JOIN slaves slave on sc.slave_id = slave.id
WHERE category.parent_id IS NOT NULL
GROUP BY category.id
ORDER BY sum(slave.rate) desc
limit 1;

-- Выбрать категории, в которых мужчин больше чем женщин.
SELECT category.* FROM categories category
INNER JOIN slaves__categories sc on category.id = sc.category_id
INNER JOIN slaves slave on sc.slave_id = slave.id
WHERE category.parent_id IS NOT NULL
GROUP BY category.id
HAVING sum(slave.is_male) > (count(1) - sum(slave.is_male));

--Количество рабов в категории &quot;Для кухни&quot; (включая все вложенные категории).
SELECT count(1) FROM categories category
INNER JOIN slaves__categories sc on category.id = sc.category_id
INNER JOIN slaves slave on sc.slave_id = slave.id
WHERE category.name = 'Для кухни'
GROUP BY category.id;