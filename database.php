<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'todo');


class Database{

    public $connection;


    function __construct(){

        return $this->db_conn();
    }

    public function db_conn(){
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


        if($this->connection){
            echo 'Db Connected';
        }else{
            echo 'connection failed' . mysqli_error($this->connection);
        }
    }

    public function query($sql){

        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;

    }


    private function confirm_query($result){

        if (!$result) {
            die("Query Failed");
        } 
        
    }


    // confirn_query
   
    
    public function escape_string($str){
        $escaped = mysqli_real_escape_string($this->connection, $str);

        return $escaped;
    }



    //  insert_id()
    public function insert_id(){

        return mysqli_insert_id($this->connection);
    }

}

$db = new Database();


?>