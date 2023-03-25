<?php
namespace App\Models\Databases;
use App\Models\Databases\IDbHandler;
use mysqli;
USE PDO;
use PDOException;

class MySqlDb implements IDbHandler{

    private $_host;
    private $_dbName;
    private $_dbUser;
    private $_dbPassword;
    private $_dsn;
    private $_charset;
    private $_options = [];
    private $_pdo;
    private $_stmt;


    public function __construct()
    {
        //Instantaie Connection Variables
        $this->_host = 'localhost';
        $this->_dbName = 'authsys';
        $this->_dbUser = 'root';
        $this->_dbPassword = '';
        $this->_charset = 'utf8';
        $this->_dsn = "mysql:host=". $this->_host.";dbname=".$this->_dbName.";charset=".$this->_charset.";";


        //Connection Options
        $this->_options = [
            PDO::ATTR_ERRMODE               =>  PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE    =>  PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES      => false
        ];
    }

    //Connect to Mysql databse
    public function connect()
    {
        try{
            return $this->_pdo = new PDO($this->_dsn,$this->_dbUser , $this->_dbPassword , $this->_options);
        }catch(PDOException $e){
            throw new PDOException($e->getMessage(),(int)$e->getCode());
        }
    }

    //For query if data exists
    public function query($table, $where = []) {
        #select COUNT(*) from pigeons where pigeonId = 3
        $keys = [];
        $values = [];
        $sql = '';
        //check if $table does not empty
        if(!empty($table)){
            $sql = "SELECT COUNT(*) FROM ".$table;

            //check if $where does not exists
            if(!empty($where)){
                foreach($where as $key=>$value){
                    array_push($keys, $key);
                    array_push($values , $value);
                }

                $whereStmt = " WHERE ";

                for($i = 0; $i < count($keys); $i++){
                    $and = ($i == count($keys) - 1)? '': ' AND ';
                    $whereStmt .=  $keys[$i] . "=? ". $and;
                }
                
                $sql .= $whereStmt;

            }else{
                return false ;
            }
        }else{
            return false;
        }

        $mysql = new MySqlDb();
        $this->_pdo = $mysql->connect();

        $this->_stmt = $this->_pdo->prepare($sql);
        $this->_stmt->execute($values);
        return $this->_stmt->fetchAll()[0]['COUNT(*)'];
        

    }

    //Select Data from Mysql Database
    public function select($table , $where = [])
    {


        $keys = [];
        $values = [];
        $sql = '';

        //Check if $table not empty{}
        if(!empty($table)){
            $sql="SELECT * FROM ".$table;
            //1- Check if $where does not empty 
            if(!empty($where)){
                //*** */

                foreach($where as $key=>$value){
                    array_push($keys,$key);
                    array_push($values,$value);
                }
                
                $whereStmt = " WHERE ";
                
                
                for($i = 0; $i < count($keys); $i++){
                    $and = ($i == count($keys) - 1)? '': ' AND ';
                    $whereStmt .=  $keys[$i] . "=? ". $and;
                }
                
                $sql .= $whereStmt ;


                //*** */


            }else{
                //$sql without any where
                $sql="SELECT * FROM ".$table ;
            }

        }else{
            //Table name empty
            return false;
        }

        $mysql = new MySqlDb();
        $this->_pdo = $mysql->connect();

        $this->_stmt = $this->_pdo->prepare($sql);
        $this->_stmt->execute($values);
        return $this->_stmt->fetchAll();


        //END HERE

        
    }

    //Insert data into Mysql Database
    public function insert($table , $data = [])
    {
        //Create PDO code to insert data into database
        if(!empty($data)){

            $keys = [];
            $values = [];
            $sql = '';

            foreach($data as $key=>$value){
                array_push($keys,$key);
                array_push($values, $value);
            }
            $sql = "INSERT INTO " .$table."(";

            $columns='';
            $and='';
            $placeHolders='';
            
            //Write columns name with comma after every column Name
            for($x=0; $x < count($keys); $x++){
                $and = ($x < count($keys) -1)? ',':')VALUES(';
                $columns .=$keys[$x] . $and;
            }
            //Write Placeholders with comma after every one
            $and ='';
            for($y=0; $y<count($values); $y++){
                $and = ($y < count($values) -1)? ',':')';
                $placeHolders .= '? ' .$and;
            }
            //Unset $and variables
            unset($and);
            $sql .= $columns . $placeHolders;
            
            $mysql = new  MySqlDb();
            $this->_pdo =$mysql->connect();
            
            $this->_stmt = $this->_pdo->prepare($sql);
            
            if($this->_stmt->execute($values)){
                return true;
            }
            return false;

            //return $sql . $columns . $placeHolders;


        }else{
            return false;
        }
    }

    //Update Data in Mysql Database
    public function Update($table, $data = [] , $where = [])
    {
         //check parameters
        if(!empty($table) && !empty($data) && !empty($where)){

            //Create Columnd, Values Containers
            $dataKeys       = [];
            $dataValues     = [];

            $whereKeys      = [];
            $whereValues    = [];

            $sql = '';

            $valuesToExecute = [];

            //Fill data keys,(Columns Name Which will Update)  into containers
            foreach($data as $key=>$value){
                array_push($dataKeys, $key);
                array_push($dataValues, $value);
            }
            $sql = "UPDATE " . $table . " SET ";

            $columns = "";
            $and = "";

            for($x=0; $x<count($dataKeys); $x++){
                $and = ($x < count($dataKeys) -1)? ', ':' WHERE ';
                $columns .= $dataKeys[$x] . '=? ' . $and; 
            }
            //Clear $and Variable
            unset($and);
            $sql .= $columns;

            //Get conditions
            foreach($where as $key=>$value){
                array_push($whereKeys , $key);
                array_push($whereValues , $value);
            }
            $whereConditions = '';
            for($y = 0; $y< count($whereKeys); $y++){
                $and = ($y < count($whereKeys) -1) ? ' AND ': '';
                $whereConditions .= $whereKeys[$y] . '=? ' . $and;
            }
            //clear $and Variable
            $sql .=$whereConditions;
            
            //get all values in one array
            for($i=0; $i < count($dataValues);$i++){
                array_push($valuesToExecute,$dataValues[$i]);
            }

            for($n=0; $n < count($whereValues); $n++){
                array_push($valuesToExecute,$whereValues[$n]);
            }

        }else{
            return false;
        }

        $mysql = new MySqlDb();
        $this->_pdo = $mysql->connect();
        $this->_stmt = $this->_pdo->prepare($sql);

        if($this->_stmt->execute($valuesToExecute)){
            return true;
        }else{
            return false;
        }

        
    }

    //Delete Data from Mysql Database
    public function delete($table , $where = [])
    {

        if(!empty($where) && is_array($where)){
            $keys   = [];
            $values = [];
            $cols = "";
            $and = "";
            $param = "";
            foreach($where as $key => $value){
                array_push($keys, $key);
                array_push($values, $value);
            }

            //get keys
            for($x=0; $x < count($keys); $x++){
                $and    = ($x < count($keys) -1)? ' AND ':'';
                $cols   .= $keys[$x] . ' = ? ' . $and;
            }

             $delete = "DELETE FROM ". $table. " WHERE " . $cols;
             $mySql = new MySqlDb();
             $this->_pdo = $mySql->connect();
             $this->_stmt = $this->_pdo->prepare($delete);

             if($this->_stmt->execute($values)){
                return true;
             }else{
                return false;
             }

   

        }else{
            return false;
        }

    }

}



?>