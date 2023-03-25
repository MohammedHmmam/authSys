<?php
namespace App\Models\Databases;

interface IDbHandler{


    //Connect to Database
    public function connect();

    //Query if data exists in the table
    public function query($table, $where = []);
    
    //Add new Data
    public function insert($table , $data = []);


    //Select Data
    public function select($table , $where = []);

    //Update Data
    public function Update($table, $data = [] , $where = []);

    //Delete Data
    public function delete($table, $where = []);


}

?>