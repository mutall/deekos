-- Create a query for selecting the maximum date of a price item 
select 
    max(date) as curr_date
from 
    price
WHERE 
    `date`<'2030-01-01'

-- Create a query for selecting the price value for the maximum date
select 
    product.name, 
    price.`date`, 
    price.value
from 
    price INNER JOIN 
    product on price.product=product.product inner join 
    -- sub query
    (
    select 
        max(date) as curr_date
    from 
        price
    WHERE 
        `date`<'2030-01-01'
        ) as curr_price on curr_price.curr_date=price.`date`
        
-- Create a query that combines the two upper ones to display a product of value and quantity 
-- for each client for each period
SELECT
	client.client,
	period.period,
	quantity.value,
	product.product,
	curr_price.value,
	quantity.value*curr_price.value as cost
FROM
	delivery INNER JOIN
	client ON client.client=delivery.client INNER JOIN
	period ON period.period=delivery.period INNER JOIN
	quantity ON quantity.delivery=delivery.delivery INNER JOIN
	product ON product.product=quantity.product INNER JOIN
	(
	SELECT
		product.product, 
		price.`date`, 
		price.value
	FROM 
		price INNER JOIN product on price.product=product.product INNER JOIN 
		(
		SELECT 
			max(date) as curr_date
		FROM
			price
		WHERE 
			`date`<'2030-01-01') as max_date on max_date.curr_date=price.`date`) as curr_price