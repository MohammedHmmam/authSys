<?php
namespace App\Models\Sessions;

use App\Models\Validation\Validation;

class Session implements ISession{

    public function __construct()
    {
        
    }

    //Start New Session
    public static function startSession(){
        if(session_status()== PHP_SESSION_NONE){
            session_start();
            return true;
        }elseif(session_status()== PHP_SESSION_ACTIVE){
            return true;
        }
        return false;
    }

    //Add new key, Value to session Array
    public static function addSession($key, $value = []){
        if(Session::startSession()){
            if(!Validation::isEmpty($key)){
                //$_SESSION[$key] = $value;
                $_SESSION[$key] = $value;
                return true;
            }
            
        }
        return false;
    }

    //Delete Specific session
    public static function deleteSession($key){
        if(isset($_SESSION[$key])){
            $_SESSION[$key] = null;
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    //End All Session Array
    public static function endSession(){
        if(Session::startSession()){
            
            session_unset();
            
            return true;
        }
        return false;
    }

    //function to return session of specific key
    public static function getSession($key){
        if(isset($_SESSION[$key])&& !empty($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return false;
    }


}


?>