<?php
require_once "bootstrap.php";

class Delivery {

    private $name;
    private $period;
    private $display;
    public $crud;
    private $columns;
    private $rows;
    private $values;
    private $myTitle;



    public function __construct() {
        $this->crud = new crud();
        $this->columns=array();
        $this->rows=array();

    }

    public function show($name, $period, $display) {
        $this->name = $name;
        $this->period = $period;
        $this->display = $display;

        $results=$this->retrieveData();
        foreach($results as $result){
            $Pivot = PHPivot::create($result)
                    ->setPivotRowFields($this->rows)
                    ->setPivotColumnFields($this->columns)
                    ->setPivotValueFields($this->values, 1, 0, $this->myTitle)
                    ->generate();
            echo $Pivot->toHtml();
        }
    }

    public function retrieveData() {

        $delivery=array();
        if(is_null($this->name)){
            $criteria="CONCAT(`month`.num, '/', `year`)='$this->period'";
        }
        elseif(is_null($this->period)){
            $criteria="client.`name`='$this->name'";
        }else{
            $criteria="client.`name`='$this->name' AND
			    CONCAT(`month`.num, '/', `year`)='$this->period'";
        }

        $raw_sql = "SELECT
	    client.name as cname, delivery.type, CONCAT(`month`.num, '/', `year`) AS curr_period,
	    delivery.date, quantity.value, product.name as pname
			FROM
			    client INNER JOIN delivery ON (client.client = delivery.client) INNER JOIN
			    `period` ON (delivery.`period`= `period`.`period`) INNER JOIN
			    `month` ON (`period`.`month` = `month`.`month`) INNER JOIN
			    quantity ON (delivery.delivery = quantity.delivery) INNER JOIN
			    product ON (quantity.product = product.product)
			WHERE
			    $criteria
		";
        $net_values = "SELECT
                client.name as cname, 
                sum(quantity.value) as value, 
                product.name as pname,
                delivery.`type` as type
            FROM
                client INNER JOIN 
                delivery ON (client.client = delivery.client) INNER JOIN
                `period` ON (delivery.`period`= `period`.`period`) INNER JOIN
                `month` ON (`period`.`month` = `month`.`month`) INNER JOIN
                quantity ON (delivery.delivery = quantity.delivery) INNER JOIN
                product ON (quantity.product = product.product)
            WHERE
                $criteria
            GROUP BY
                product.name, delivery.`type`
        ";

        // Create a query for selecting the maximum date of a price item
        $max_date="SELECT
            max(date) as curr_date,
            product.product
        FROM
            price INNER JOIN
            product ON product.product=price.product
        WHERE 
            price.`date`<'2030-01-01'
        GROUP BY product.product";

        // query for calculating the current price on the maximum date
        $curr_price="SELECT
                        max_date.product,
                        price.value
                    FROM 
                        price INNER JOIN 
                        ($max_date)as max_date ON max_date.curr_date=price.`date`
                            AND max_date.product=price.product";
        
        // query from calculating the cost 
        $cost="SELECT
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
                    ($curr_price) as curr_price ON product.product=curr_price.product
                ORDER BY 
                    client, period";
        // Query for the calculated grosses for each client on every period 
        $calculated="SELECT 
                        cost.client,
                        cost.period,
                        SUM(cost.cost) as total,
                        'calculated' as `type`
                    FROM 
                        ($cost) as cost
                    GROUP BY 
                        client, period";

        $gross="SELECT 
                    client.client, 
                    period.period,
                    gross.ksh as total,
                    'gross' as type
                FROM
                    gross INNER JOIN 
                    client on gross.client=client.client INNER JOIN
                    period ON period.period=gross.period";
        
        $union="$gross UNION ALL $calculated";

        $variance="SELECT 
                        * 
                    FROM 
                        ($union)as union1 inner join 
                        client on client.client=union1.client inner join
                        period on period.period=union1.period inner join 
                        month on month.month = period.month 
                    WHERE
                        $criteria";

        switch ($this->display){
            case "raw":
                $raw_deliveries = $this->crud->getData($raw_sql);
                array_push($delivery, $raw_deliveries);
                array_push($this->rows, 'cname', 'date');
                array_push($this->columns, 'type', 'pname');
                $this->values='value';
                $this->myTitle='RAW READINGS';



                break;
            case "net":
                $net = $this->crud->getData($net_values);
                
                array_push($delivery, $net);
                array_push($this->rows, 'cname');
                array_push($this->columns, 'type', 'pname');
                $this->values='value';
                $this->column_title='BRANCH';
                $this->myTitle='NET READINGS';
                break;

            case "variance":
                $all_variances=$this->crud->getData($variance);

                array_push($delivery, $all_variances);
                array_push($this->rows, 'name', 'period');
                array_push($this->columns, 'type');
                $this->values='total';
                $this->myTitle='Variances';
                break;
        }


        return $delivery;
    }


    public function showClient() {
        $sql = "select name from client";
        $client_names = $this->crud->getData($sql);

        foreach($client_names as $key =>$value){
            echo "<button class='client button'>".$value['name']."</button>";
        }


        return $client_names;
        }

    public function showPeriod() {
        $sql = "select CONCAT(`month`.num, '/', `year`) as curr_period
		from
		period inner join month on period.month=month.month";
        $period = $this->crud->getData($sql);

        foreach ($period as $key => $value) {
        echo "<button class='period button'>".$value['curr_period']. "</button>";

        }
    }

}
