<?php
require_once 'PHPivot.php';
require_once 'crud.php';

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
        $net_dispatch="SELECT 
	    client.name as cname, sum(quantity.value) as value, product.name as pname
			FROM
			    client INNER JOIN delivery ON (client.client = delivery.client) INNER JOIN 
			    `period` ON (delivery.`period`= `period`.`period`) INNER JOIN 
			    `month` ON (`period`.`month` = `month`.`month`) INNER JOIN 
			    quantity ON (delivery.delivery = quantity.delivery) INNER JOIN 
			    product ON (quantity.product = product.product)
        WHERE 
        $criteria AND 
        delivery.type='dispatch'
        GROUP by product.name";
        
        $net_returns="SELECT 
	    client.name as cname, sum(quantity.value)as value, product.name as pname
			FROM
			    client INNER JOIN delivery ON (client.client = delivery.client) INNER JOIN 
			    `period` ON (delivery.`period`= `period`.`period`) INNER JOIN 
			    `month` ON (`period`.`month` = `month`.`month`) INNER JOIN 
			    quantity ON (delivery.delivery = quantity.delivery) INNER JOIN 
			    product ON (quantity.product = product.product)
        WHERE
        $criteria AND 
        delivery.type='returns'
        GROUP by product.name";
        
        $net_delivery="SELECT 
	    client.name as cname, sum(quantity.value) as value, delivery.type as pname
			FROM
			    client INNER JOIN delivery ON (client.client = delivery.client) INNER JOIN 
			    `period` ON (delivery.`period`= `period`.`period`) INNER JOIN 
			    `month` ON (`period`.`month` = `month`.`month`) INNER JOIN 
			    quantity ON (delivery.delivery = quantity.delivery)
            WHERE 
            $criteria 
            GROUP by delivery.type";
        
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
                $summed_dispatch = $this->crud->getData($net_dispatch);
                $summed_returns = $this->crud->getData($net_returns);
                $summed_deliveries = $this->crud->getData($net_delivery);
                
                array_push($delivery, $summed_dispatch, $summed_returns, $summed_deliveries);
                array_push($this->rows, 'cname');
                array_push($this->columns, 'pname');
                $this->values='value';
                $this->column_title='BRANCH';
                $this->myTitle='NET READINGS';
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
