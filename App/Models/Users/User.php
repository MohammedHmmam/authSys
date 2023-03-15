<?php
namespace App\Users;

use DateTime;

class User implements IUser{
    
    private int                 $_userId; //user Id generated automatically in database
    private string              $_loginName; // username, email, phone number that used for login
    private string              $_passwordHash; //password after hashed
    private string              $_passwordSalt; //auto generated Salt When set password
    private int                 $_hashAlgorithmId;//
    private string              $_emailAddress;
    private string              $_confirmationToken;
    private DateTime            $_tokenGenerationTime;
    private int                 $_emailStatusId; // contain id of email status from emailValidation Status
    private string              $_passwordRecoveryToken;
    private DateTime            $_recoveryTokenTime;


    //Setter & Getter

    //get user id
    public function getUserId(){
        return $this->_userId;
    }

    //set Login name
    public function setLoginName(string $loginName){
        $this->_loginName = $loginName;
    }
    //get login name
    public function getLoginName(){
        return $this->_loginName;
    }

    //set password hash
    public function setPasswordHash(string $passwordHash){
        $this->_passwordHash = $passwordHash;
    }
    //get password hash
    public function getPasswordHash(){
        return $this->_passwordHash;
    }

    //set password Salt
    public function setPasswordSalt(string $passwordSalt){
        $this->_passwordSalt = $passwordSalt;
    }
    //get password salt
    public function getPasswordSalt(){
        return $this->_passwordSalt;
    }


    //Set Hash Alogrithm ID
    public function setHashAlgorithmId(int $hashAlgorithmId){
        $this->_hashAlgorithmId = $hashAlgorithmId;
    }
    //get Hash Algorithm Id
    public function getHashAlgorithmId(){
        return $this->_hashAlgorithmId;
    }


    //set Email Address
    public function setEmailAddress(string $emailAddress){
        $this->_emailAddress = $emailAddress;
    }
    //get Email Address
    public function getEmailAddress(){
        return $this->_emailAddress;
    }

    //set confirmation Token
    public function setConfirmationToken(string $confirmationToken){
        $this->_confirmationToken = $confirmationToken;
    }
    //get Confirmation token
    public function getConfirmationToken(){
        return $this->_confirmationToken;
    }

    //set Token Generation Time
    public function setTokenGenerationTime(Datetime $tokenGenerationTime){
        $this->_tokenGenerationTime = $tokenGenerationTime;
    }
    //get Token Generation time
    public function getTokenGenerationTime(){
        return $this->_tokenGenerationTime;
    }

    //set Email Validation Status Id
    public function setEmailStatusId(int $emailStatusId){
        $this->_emailStatusId = $emailStatusId;
    }
    //get Email Validation Status Id
    public function getEmailStatusId(){
        return $this->_emailStatusId;
    }


    //set password recovery token
    public function setPasswordRecoveryToken(string $passwordRecoveryToken){
        $this->_passwordRecoveryToken = $passwordRecoveryToken;
    }
    //get password Recovery token
    public function getPasswordRecoveryToken(){
        return $this->_passwordRecoveryToken;
    }

    //set recovery Token Time
    public function setRecoveryTokenTime(DateTime $recoveryTokenTime){
        $this->_recoveryTokenTime = $recoveryTokenTime;
    }
    //get recovery Token Time
    public function getRecoveryTokenTime(){
        return $this->_recoveryTokenTime;
    }


    

}

?>