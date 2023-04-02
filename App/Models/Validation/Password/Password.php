<?php
namespace App\Models\Validation\Password;
use App\Models\Validation\Validation;
use App\Models\Alerts\ErrorManager;

class Password implements IPassword{


    //the main function Which will check password field
    public static function isValid($field , $field2){
        if(self::isEmpty($field)){
            ErrorManager::add(['password' => 'Password is Empty']);
        }

        if(!self::length($field)){
            ErrorManager::add(['password' => 'Password Length Min: 6 , Max: 20']);
        }
        
        if(!self::isMatch($field,$field2)){
            ErrorManager::add(['password' => 'Password Does not match!']);
        }
    }

    public static function isEmpty($field){

       return Validation::isEmpty($field);

    }

    public static function length($field){
        return Validation::isLength($field,6,20);
    }

    public static function isMatch($field1 , $field2){
        if($field1 === $field2){
            return true;
        }
        return false;
    }

}


?>