<?php
namespace App\Models\Token;

class ConfirmationToken implements IToken{

    private static $_tokenText;

    public static function generate()
    {

        //Generate Confirmation Token
        self::$_tokenText = date('dmy h:m:s') . 'confirmEmail'. rand(0,50). time();
        return hash("sha1",self::$_tokenText);
        
    }

}

?>