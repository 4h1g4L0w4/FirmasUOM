<?php
if(!defined('host')) define('host',"localhost");
if(!defined('username')) define('username',"root");
if(!defined('password')) define('password',"");
if(!defined('db_tbl')) define('db_tbl',"firmasdb");

Class DBConnection{
    public $conn;
    function __construct(){
        $this->conn = new mysqli(host,username,password,db_tbl);
        if(!$this->conn){
            die("Database Connection Error. ".$this->conn->error);
        }
    }
    function __destruct(){
         $this->conn->close();
    }
}

$db = new DBConnection();
$conn= $db->conn;




// SELECT id FROM tabla_ejemplo WHERE campo_busqueda = 'valor_buscado';
