<?php
namespace App\Models\Token;

use App\Models\Databases\IDbHandler;

class TokenRepo{

    private IDbHandler $_db;


    public function __construct(IDbHandler $db)
    {
        $this->_db = $db;
    }

    public  function getTokenData($token){
        return $this->_db->select('user_login_data',['confirmationToken'=>$token]);
    }

    //get Token Generation Time
    public function getTokenGenerationTime($token){
        return $this->getTokenData($token)[0]['tokenGenerationTime'];
    }
    

}
?>