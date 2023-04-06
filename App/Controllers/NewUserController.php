<?php
namespace App\Controllers;

require_once '../../vendor/autoload.php';

use App\Models\Alerts\ErrorManager;
use App\Models\Databases\MySqlDb;
use App\Models\Validation;
use App\Models\Validation\Email\Email;
use App\Models\Validation\LoginName\LoginName;
use App\Models\Validation\Password\Password;
use App\Models\Sessions\Session;
use App\Models\Users\User;
use App\Models\Hash\PasswordHash;
use App\Models\Token\ConfirmationToken;
use App\Models\Users\UserRepo;
use App\Models\Email\SendEmail;
use App\Models\Token\ConfirmationLink;

if(isset($_POST['submit'])){



    //Delete All error in the sessions
    Session::startSession();
    //Clear the old errors's Messaged
    ErrorManager::deleteAlerts();
    //Delete all errors from Session
    Session::deleteSession('Error');

    //Check Login name
    LoginName::isValid($_POST['loginName']);
    //Check EmailAddress
    Email::isValid($_POST['emailAddress']);
    //Check password
    Password::isValid($_POST['password'],$_POST['re-password']);

    if(count(ErrorManager::showErrors()) === 0){
        /*
            1- Hash Password
            2- Generate Confirmation Token
            3- Insert In Database
            4- Send Token to user Email
            
        */

        $user = new User();
        $user->setLoginName($_POST['loginName']);
        $user->setEmailAddress($_POST['emailAddress']);
        $user->setPasswordHash(PasswordHash::hash($_POST['password']));
        $user->setConfirmationToken(ConfirmationToken::generate());

        $mySql = new MySqlDb();
        $userRepo = new UserRepo($mySql);

        if($userRepo->addUser($user)){
            echo "User Added Succefully";
        }else{
            echo "User Does Not Added!";
        }
        
        //Create Confirmation Token Link
        //echo ConfirmationLink::generate($user->getConfirmationToken());
        echo "<a href='". ConfirmationLink::generate($user->getConfirmationToken()) ."'>Confirm Email</a>";
        
    }else{
        header('Location:../Views/new_user.php');
    }


}else{
    header('Location:../Views/new_user.php');
}


?>