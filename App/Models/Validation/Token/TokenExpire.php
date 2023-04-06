<?php
namespace App\Models\Validation\Token;

use DateTime;

class TokenExpire{

    public static function isExpired($oldDate){
        // $oldDate -- is the time which stored before in database
        $now = date('Y-m-d H:i:s');
        $dateTime  = new DateTime($oldDate);
        $diff = $dateTime->diff(new DateTime($now));
        if($diff->h >= 6){
            return true;
        }
        return false;
    }



}


?>