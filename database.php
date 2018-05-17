<?php
//create a database class with methods for creating a new connection
class database{
    
    //Declare the properties private so they are only accessed within the class
    private $host='localhost';
    private $user='root';
    private $pass='';
    private $db='mutall_deekos';
    
    public $connection;

    //decaler a constructor to check connection each time the class is instatiated 
    public function __construct() {
        //create a new connection if one doest exist already
        $this->connection=new mysqli($this->host, $this->user, $this->pass, $this->db);
        //
        //error reporting
        if (!$this->connection){
            die ('connection failed'.error);

        }
        
    }
            
}
