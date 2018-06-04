-- Create a query for selecting the maximum date of a price item
SELECT
	max(date) as curr_date,
	product.product
FROM
	price INNER JOIN
	product ON product.product=price.product
WHERE 
	price.`date`<'2030-01-01'
GROUP BY product.product

-- Create a query for selecting the price value for the maximum date
SELECT
	max_date.product,
	price.value
FROM 
	price INNER JOIN 
	(
		SELECT
			max(date) as curr_date,
			product.product
		FROM
			price INNER JOIN
			product ON product.product=price.product
		WHERE 
			price.`date`<'2030-01-01'
		GROUP BY product.product)as max_date ON max_date.curr_date=price.`date`
		AND max_date.product=price.product
	
		
-- Create a query that combines the two upper ones to display a product of value and quantity 
-- for each client for each period
SELECT
	client.client,
	period.period,
	product.product,
	quantity.value as quantity,
	curr_price.value as price,
	IF(delivery.`type`='DISPATCH',quantity.value*curr_price.value,(quantity.value*curr_price.value)*-1)AS cost
FROM
	delivery INNER JOIN
	client ON client.client=delivery.client INNER JOIN
	period ON period.period=delivery.period INNER JOIN
	quantity ON quantity.delivery=delivery.delivery INNER JOIN
	product ON product.product=quantity.product INNER JOIN
	(
		SELECT
			max_date.product,
			price.value
		FROM 
			price INNER JOIN 
			(
				SELECT
					max(date) as curr_date,
					product.product
				FROM
					price INNER JOIN
					product ON product.product=price.product
				WHERE 
					price.`date`<'2030-01-01'
				GROUP BY product.product)as max_date ON max_date.curr_date=price.`date`
				AND max_date.product=price.product
	) as curr_price ON product.product=curr_price.product
	ORDER BY client, period
	
	SELECT 
		cost.client,
		cost.period,
		SUM(cost.cost) as calculated,
		'calculated' as `type`
	FROM
		(
		SELECT
			client.client,
			period.period,
			product.product,
			quantity.value as quantity,
			curr_price.value as price,
		IF(
			delivery.`type`='DISPATCH',quantity.value*curr_price.value,(quantity.value*curr_price.value)*-1
			)AS cost
		FROM
			delivery INNER JOIN
			client ON client.client=delivery.client INNER JOIN
			period ON period.period=delivery.period INNER JOIN
			quantity ON quantity.delivery=delivery.delivery INNER JOIN
			product ON product.product=quantity.product INNER JOIN
			(
				SELECT
					max_date.product,
					price.value
				FROM 
					price INNER JOIN 
					(
						SELECT
							max(date) as curr_date,
							product.product
						FROM
							price INNER JOIN
							product ON product.product=price.product
						WHERE 
							price.`date`<'2030-01-01'
						GROUP BY product.product)as max_date ON max_date.curr_date=price.`date`
						AND max_date.product=price.product
			) as curr_price ON product.product=curr_price.product) as cost
	GROUP BY client, period
	
SELECT 
	client.client, 
	period.period,
	gross.ksh,
	'gross' as type
FROM
	gross INNER JOIN 
	client on gross.client=client.client INNER JOIN
	period ON period.period=gross.period
	