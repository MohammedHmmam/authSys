<?php
namespace App\Models\Alerts;

interface IAlerts{
    //Add Alert
    public static function add( $errors = []);

    //delete all Alert
    public static function deleteAlerts();

    //remove specific alert
    public static function removeAlert($key);
}


?>