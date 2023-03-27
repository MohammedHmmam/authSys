<?php
namespace App\Models\Users;

use App\Models\Databases\IDbHandler;
use App\Models\Users\User;
use App\Models\Databases;
//use App\Models\Databases\MySqlDb;

class UserRepo{

    private  IDbHandler $_db;

    public function __construct(IDbHandler $db)
    {
        $this->_db = $db;
    }


    
    public  function addUser(IUser $user){
        return $this->_db->insert('user_login_data' ,
            [
                'loginName'                 => $user->getLoginName(),
                'passwordHash'              => $user->getPasswordHash(),
                'emailAddress'              => $user->getEmailAddress(),
                'confirmationToken'         => $user->getConfirmationToken(),
                'tokenGenerationTime'       => $user->getTokenGenerationTime(),
                'emailValidationStatusId'   => 1,


            ]
        );
        return false;
    }

    //Update user login data
    public function updateUser($data = [] , $where = []){
        return $this->_db->Update('user_login_data', $data , $where);
        
       
    }

}

?>