<?php
namespace App\Models\Hash;

class PasswordHash implements IHash{

    public static function hash(string $input){
        //Generate hash to password
        return password_hash($input,PASSWORD_DEFAULT);
    }


    public static function verify(string $plainPassword, string $hashPassword ){
        //return true if password matches
        return password_verify($plainPassword,$hashPassword);
    }

}

?>