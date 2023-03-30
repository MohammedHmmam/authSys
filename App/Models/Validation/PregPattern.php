<?php
namespace App\Models\Validation;

class PregPattern{

    //This class was created to make some validations that is need preg match

//preg_match('/^[a-z0-9-_. ]*$/i',$username))
    
    //this function allowed Only characters a-zA-z And 0-9
    //preg_match('/^[a-z0-9-_. ]*$/i',$username)
    public static function stringAndNumber($text){
        if(preg_match('/^[a-z0-9-_.+*\r\n: ]*$/i',$text)){
            return true;
        }
        return false;
    }

    //this function for only string
    public static function charactersOnly($text){
        if(preg_match('/^[a-zA-Z ]*$/i',$text)){
            return true;
        }

        return false;
    }

    //This function allow Only numbers
    public static function numbersOnly($text){
        if(preg_match('/^[0-9-]*$',$text)){
            return true;
        }

        return false;
    }


}

?>