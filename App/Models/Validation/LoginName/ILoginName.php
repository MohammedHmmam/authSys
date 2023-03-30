<?php
namespace App\Models\Validation\LoginName;

interFace ILoginName{


    //Main Method
    public static function isValid($field);

    //check if is empty
    public static function isEmpty($field);

    //check length
    public static function length($field);

    //must be unique
    public static function unique($field);

}

?>