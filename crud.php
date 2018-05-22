
<?php
require 'database.php';
//inherit the method from database to test for a connection

class crud extends database {
   public $db;
    //invoke the super constructor to check for a connection
    public function __construct() {
        parent::__construct();
        $this->db=new database();
        if ($this->db->connect_error) {
          die('Connect Error: '.$this->db->connect_error);
        }
    }


    //function for getting data from database and displaying

    public function getData($query) {
        $result= $this->db->query($query);
        if(!$result){
           die('Failed'. $this->db->error);
        }
        //create an array of the queryied data. To be iterated when the function
        //used
        $rows=array();
        while ($row = $result->fetch_assoc()) {
            $rows[]=$row;
        }
        return $rows;

    }
    //function to execute a query based on an sql statement
    public function execute($query) {
        $result = $this->db->query($query);

        if ($result == false) {
            die('cannot execute query'. $this->db->connect_error) ;
        } else {
            echo "<a href=" .$_SERVER["REQUEST_URI"] ."</a>";
        }
        return $result;
    }


    //function to delete data from a database

    public function delete($id, $table){
        $query="DELETE FROM $table WHERE id=$id";

        $result= $this->query($query);

        if($result==false){
            die('Cannot delete record: '.$this->db->connect_error);
        }
        else{
            echo 'deleted succefully';
        }
    }

}
