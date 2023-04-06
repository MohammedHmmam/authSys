<?php
namespace App\Models\Auth;

use App\Models\Databases\MySqlDb;
use App\Models\Hash\PasswordHash;
use App\Models\Sessions\Session;
use App\Models\Users\IUser;
use App\Models\Users\User;
use App\Models\Users\UserRepo;

class Auth implements IAuth{

        //Login user
        public function login(IUser $user){
            /*
            1- Select User Data with user name if exists
            2- Fill User data in $user Object
            3- check if password is correct
            4- Save user Object in Session , save Variable $loggedIn = true in Session
            */

            $mySql = new MySqlDb();
            $userRepo = new UserRepo($mySql);

                //check if user found in database
              if($currentUser = $userRepo->getUserByLoginName($user)){
                    //Verify password
                if(PasswordHash::verify($user->getPlainPassword(),$currentUser[0]['passwordHash'])){
                    
                    Session::addSession('user',[
                        'userId'            => $currentUser[0]['userId'],
                        'loginName'         => $currentUser[0]['loginName'],
                        'emailAddress'      => $currentUser[0]['emailAddress'],
                        'status'            => $currentUser[0]['emailValidationStatusId'],
                        'loggedIn'          => true



                    ]);
                    return true;

                }else{
                    return false;
                }
                

              }else{
                
                return false;
              }

        }


        //check if user logged in or not
        public function isLoggedIn(){
            if(Session::getSession('user')['loggedIn']){
                return true;
            }
            return false;
        }
    
    
        //log out
        public function logout(){
            if(Session::deleteSession('user')){
                Session::endSession();
                return true;
            }
            return false;
        }


}



?>