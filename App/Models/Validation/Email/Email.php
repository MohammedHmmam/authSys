<?php
namespace App\Models\Validation\Email;

use App\Models\Validation\Validation;
use App\Models\Alerts\ErrorManager;

class Email implements IEmail{

        //Main Function which Call anonther methods
        public static function isValid($field){
            if(self::isEmpty($field)){
                ErrorManager::add(['emailAddress' =>'Email is Required!']);
            }

            if(!self::isValidFormat($field)){
                ErrorManager::add(['emailAddress' => 'Invalid Email Format!']);
            }

            if(!self::unique($field)){
                ErrorManager::add(['emailAddress' => 'Email Unavailable!']);
            }
        }

        //check if email field empty
        public static function isEmpty($field){
            return Validation::isEmpty($field);

        }
    
        //check if Valid format
        public static function isValidFormat($field){
            return filter_var($field,FILTER_VALIDATE_EMAIL);
 
        }
    
        //check if Email is Unique
        public static function unique($field){
            return Validation::isExists('user_login_data' ,['emailAddress'=>$field]);
        }
}

?>