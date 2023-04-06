<?php
namespace App\Controllers;
require_once '../../vendor/autoload.php';
use App\Models\Databases\MySqlDb;
use App\Models\Token\TokenRepo;
use App\Models\Users\UserRepo;
use App\Models\Validation\Token\TokenExpire;

if(isset($_GET['token'])&& !empty($_GET['token'])){
    $mySql = new MySqlDb();
    $tokenRepo = new TokenRepo($mySql);

    if(TokenExpire::isExpired($tokenRepo->getTokenGenerationTime($_GET['token']))){
        header('Location:../../Views/login.php');
    }else{
        //Confirm Email
        $userRepo = new UserRepo($mySql);
        if($userRepo->updateUser(['confirmationToken'=>null,'tokenGenerationTime'=>null,
                                'emailValidationStatusId'=>2],
                                ['confirmationToken'=>$_GET['token']])){

            header('Location:../../views/login.php');                        
        }
    }

}else{
    echo "Token Does not isset";
}

?>