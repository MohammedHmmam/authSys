<?php
namespace App\Controllers;

require_once '../../vendor/autoload.php';

use App\Models\Validation\LoginName\LoginName;
use App\Models\Validation\Password\Password;
use App\Models\Alerts\ErrorManager;
use App\Models\Auth\Auth;
use App\Models\Sessions\Session;
use App\Models\Users\User;

if(isset($_POST['submit'])){

      //Delete All error in the sessions
      Session::startSession();
      //Clear the old errors's Messaged
      ErrorManager::deleteAlerts();
      //Delete all errors from Session
      Session::deleteSession('Error');


    //Check login name
    if(LoginName::isEmpty($_POST['loginName'])){
        ErrorManager::add(['loginName' => 'username is Required!']);
    }

    //check password field
    if(Password::isEmpty($_POST['password'])){
        ErrorManager::add(['password'=>'Password is Required!']);
    }

    //check if login success
    $user = new User();
    $user->setLoginName($_POST['loginName']);
    $user->setPlainPassword($_POST['password']);

    $auth = new Auth();
    if(!$auth->login($user)){
        ErrorManager::add(['password' => 'Username Or password Incorrect!']);
    }

    //if found Error Redirect to login page
    if(count(ErrorManager::showErrors()) > 0){
        header('Location:../Views/login.php');
    }else{
        /*
        
            You are logged in

        */

            echo "You Are Loggen in <br>";
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";
    }


}else{
    header('Location:../Views/login.php');
}


?>