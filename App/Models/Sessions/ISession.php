<?php
namespace App\Models\Sessions;

interface ISession{

    //Start Session
    public static function startSession();

    //Add new Element to Session Array
    public static function addSession($key,$value);

    //Delete Specific Session
    public static function deleteSession($key);

    //End The Whole Session
    public static function endSession();
}

?>