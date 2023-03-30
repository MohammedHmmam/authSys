<?php
namespace App\Models\Validation\Password;

interface IPassword{

    //Main function which will check password field

    public static function isValid($field);

    public static function isEmpty($field);

    public static function length($field);
}

?>