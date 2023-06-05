<?php
if(!defined('host2')) define('host2',"localhost");
if(!defined('username2')) define('username2',"root");
if(!defined('password2')) define('password2',"");
if(!defined('db_tbl2')) define('db_tbl2',"docproto");

Class DBConnection2{
    public $conn2;
    function __construct(){
        $this->conn2 = new mysqli(host2,username2,password2,db_tbl2);
        if(!$this->conn2){
            die("Database Connection Error. ".$this->conn2->error);
        }
    }
    function __destruct(){
         $this->conn2->close();
    }
}

$db2 = new DBConnection2();
$conn2= $db2->conn2;




// SELECT id FROM tabla_ejemplo WHERE campo_busqueda = 'valor_buscado';
