<?php
require_once 'PHPivot.php';
require_once 'crud.php';

class Delivery {

    private $name;
    private $period;
    public $crud;

    public function __construct() {
        $this->crud = new crud();
    }

    public function show($name, $period) {
        $this->name = $name;
        $this->period = $period;

        $Pivot = PHPivot::create($this->retrieveData())
                ->setPivotRowFields(['cname', 'date'])
                ->setPivotColumnFields(['type', 'pname'])
                ->setPivotValueFields('value')
                ->generate();
        echo $Pivot->toHtml();
    }

    public function retrieveData() {
        $sql = "SELECT 
	    client.name as cname, delivery.type, CONCAT(`month`.num, '/', `year`) AS curr_period,
	    delivery.date, quantity.value, product.name as pname
			FROM
			    client INNER JOIN delivery ON (client.client = delivery.client) INNER JOIN 
			    `period` ON (delivery.`period`= `period`.`period`) INNER JOIN 
			    `month` ON (`period`.`month` = `month`.`month`) INNER JOIN 
			    quantity ON (delivery.delivery = quantity.delivery) INNER JOIN 
			    product ON (quantity.product = product.product)
			WHERE 
			    client.`name`='$this->name' AND 
			    CONCAT(`month`.num, '/', `year`)='$this->period'
		";
        $delivery = $this->crud->getData($sql);

        return $delivery;
    }

    public function showClient() {
        $sql = "select name from client";
        $client_names = $this->crud->getData($sql);
        
        foreach ($client_names as $key => $value) {
        echo"<button class='card-panel' onclick='d.passName(this.textContent)'>";
        echo $value['name'];
        echo "</button>";
           
        }
    }

    public function showPeriod() {
        $sql = "select CONCAT(`month`.num, '/', `year`) as curr_period 
		from 
		period inner join month on period.month=month.month";
        $period = $this->crud->getData($sql);

        foreach ($period as $key => $value) {
        echo "<li class='card-panel' onclick='d.getPeriod(this.textContent)'>";
        echo $value['curr_period']; 
        echo "</li>";
        }
    }

}
