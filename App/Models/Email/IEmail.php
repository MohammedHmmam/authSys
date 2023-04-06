<?php
namespace App\Models\Email;

interface IEmail {

    public static function send($to,$subject,$message);

}


?>