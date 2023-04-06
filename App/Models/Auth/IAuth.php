<?php
namespace App\Models\Auth;

use App\Models\Users\IUser;

interface IAuth{


    //Login user
    public function login(IUser $user);


    //check if user logged in or not
    public function isLoggedIn();


    //log out
    public function logout();

}
?>