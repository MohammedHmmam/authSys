<?php
namespace App\Models\Token;

class ConfirmationLink {

    public static function generate($token){
        //This link Must Be change when the script run on live server
        return  'EmailConfirmController.php/?token='.$token;
        //. $_SERVER['REQUEST_URI']
        //$_SERVER['HTTP_HOST']
    }

}

?>