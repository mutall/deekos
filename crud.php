
<?php
//inherit the method from database to test for a connection

class crud extends mysqli {
    //invoke the super constructor to check for a connection
    public function __construct() {
        parent::__construct('localhost', 'root', '', 'mutall_deekos');
    }
    //function for getting data from database and displaying

    public function getData($sql) {
        $result= $this->query($sql);
        if(!$result){
           die('Failed '. $this->error);
        }
        //create an array of the queryied data. To be iterated when the function
        //used
        $rows=array();
        while ($row = $result->fetch_assoc()) {
            $rows[]=$row;
        }
        return $rows;

    }

}
