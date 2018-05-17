<?php
//create a database class with methods for creating a new connection
class database extends mysqli{
    //decaler a constructor to check connection each time the class is instatiated 
    public function __construct() {
        parent::__construct('localhost', 'root', '', 'mutall_deekos');
   }
    
            
}
