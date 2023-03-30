<?php
namespace App\Models\Validation\LoginName;

use App\Models\Alerts\ErrorManager;
use App\Models\Validation\Validation;

class LoginName implements ILoginName{


        //Main Method
        public static function isValid($field){
            //if Field is empty add An rror
            if(self::isEmpty($field)){
                ErrorManager::add(['loginName' => ' User Name Required! '] );
            }

            //if field Length not between 3 To 20 Add An Error
            if(!self::length($field)){
                ErrorManager::add(['loginName' => 'Username length Min:3 , Max:20']);
            }

            //check if login name exists in database
            if(!self::unique($field)){
                ErrorManager::add(['loginName'=> 'Username not Available!']);
            }
        }

        //check if is empty
        public static function isEmpty($field){
            return Validation::isEmpty($field);
        }

        //check length
        public static function length($field){
            return Validation::isLength($field,3,20);
        }
    
        //must be unique
        public static function unique($field){
            if(!Validation::isExists('user_login_data',['loginName'=>$field]) ){
                return true;
            }
            return false;
        }


}


?>