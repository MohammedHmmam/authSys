<?php
namespace App\Models\Alerts;
use App\Models\Sessions\Session;
use App\Models\Validation\Validation;


class ErrorManager implements IAlerts{

    /*
        This class has a responsiblity for contain Errors messages
        show errors, delete errors
    */
    

    private static $_errors = [];

    //This function will add errors to $errors array
    public static function add( $errors = [])
    {

        //Make sure the argument of errors does not exists
        if(count($errors) > 0){
            //add the errors to ErrorManager::$_errors
            array_push(ErrorManager::$_errors,$errors);
            //Then, add the array of errors to session with Error key
            if(Session::addSession('Error',ErrorManager::$_errors)){
                //ErrorManager::$_errors = [];
                return true;
            }
            
        }
        return false;
    }

    //Access to $_errors array
    public static function showErrors(){
        /*
            - loop into : sessions
        */
        if(Session::getSession('Error')){
            //Empty errors Array
            ErrorManager::$_errors = [];
            for($x=0; $x < count(Session::getSession('Error')); $x++){
                //loop into the internal arrays
                foreach(Session::getSession('Error')[$x] as $key => $value){
                    
                    ErrorManager::$_errors[$key][$x] = $value;

                }

            }
            return ErrorManager::$_errors;
           
        }else{
            return [];
        }
    }

    //This method will empty our $_errors array,
    //And delete error messages from session
    public static function deleteAlerts()
    {
        //We Sholud call this method after show errors

        ErrorManager::$_errors = [];
        //unset to $_SESSION['Error']
        if(Session::deleteSession('Error')){
            return true;
        }
        return false;

    }

    public static function removeAlert($key)
    {
        unset(ErrorManager::$_errors[$key]);
    }

}
?>