<?php
namespace App\Models\Token;

class PasswordRecoveryToken implements IToken{


    private static $_tokenText;

    public static function generate()
    {
        //Generate password recovery token
         self::$_tokenText = date('dmth:m:s').'password REcovery' . time() . rand(50,100);
         return hash("sha1" , self::$_tokenText);
    }

}

?>