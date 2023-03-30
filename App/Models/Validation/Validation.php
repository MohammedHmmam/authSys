<?php
namespace App\Models\Validation;

use App\Models\Databases\MySqlDb;

class Validation{

    //Check if item is empty or not
    public static function isEmpty($item){
        //Remove Spaces From Biggining And End of text
        $text = trim($item);

        //Check if text Empty Or not after remove spaces
        if(empty($text)){
            return true;
        }

        return false;
    }

    //Check Data Type

    //check id item is string
    public static function isString($item){
        if(is_string($item)){
            return true;
        }
        return false;
    }

    //Check if item is numeric
    public static function isNumber($item){
        if(is_numeric($item)){
            return true;
        }
        return false;
    }

    

    //check text length
    public static function isLength($item,$from , $to){
        if(strlen($item) >= $from && strlen($item) <= $to){
            return true;
        }
        return false;
    }

    //Check if Data exists in table
    public static function isExists($table , $where = []){
        $mysql = new MySqlDb();
        return $mysql->query($table , $where );
    }    
 

}

?>