<?php
namespace App\Models\Email;

class SendEmail implements IEmail{

    public static function send($to,$subject,$message){
        return  mail($to,$subject,$message);
    }

}

?>