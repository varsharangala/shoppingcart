<?php

class CreateDb
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tableName;
    public $con;

    public function __construct($dbname="Newdb",
                                $tableName="Productdb",$servername="localhost",$username="root",$password=""
    )
    {
        $this->dbname=$dbname;
        $this->tableName=$tableName;
        $this->servername=$servername;
        $this->username=$username;
        $this->password=$password;
        //create con
        $this->con=mysqli_connect($servername,$username,$password);

        //check con
        if(!$this->con){
            die("connection failed:" .mysqli_connect_error());}


        //query
        $sql="CREATE DATABASE IF NOT EXISTS $dbname";
        //exe query
        if(mysqli_query($this->con,$sql)) {
            $this->con=mysqli_connect($servername,$username,$password,$dbname);
            //sql to create new table
            $sql="CREATE-TABLE IF NOT EXISTS $tableName
                  (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                  product_name VARCHAR(25) NOT NULL,product_price FLOAT,product_image VARCHAR(100));";

            if(mysqli_query($this->con,$sql)){
                echo "Error creating table:" .mysqli_error($this->con);
            }

        } else { return false;}

    }

    //get product from the database
    public function getData(){
        $sql="SELECT*FROM $this->tableName";
        $result=mysqli_query($this->con,$sql);
        if(mysqli_num_rows($result)>0) {
            return $result;
        }

    }
}