<?php
namespace App\Models\Validation\Email;

interface IEmail{

    //Main Function which Call anonther methods
    public static function isValid($field);

    //check if email field empty
    public static function isEmpty($field);

    //check if Valid format
    public static function isValidFormat($field);

    //check if Email is Unique
    public static function unique($field);


}

?>