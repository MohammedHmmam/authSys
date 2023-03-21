<?php
namespace App\Models\Users;

class EmailValidationStatus implements IEmailValidationStatus{

    private int     $_emailStatusId;
    private string  $_emailStatusDescription;

    //get email Validation status id
    public function getEmailStatusId(){
        return $this->_emailStatusId;
    }

    //set Email Validation status Description
    public function setEmailStatusDescription(string $emailStatus){
        $this->_emailStatusDescription = $emailStatus;
    }
    //get Email Valdation Status Description
    public function getEmailStatusDescription(){
        return $this->_emailStatusDescription;
    }
}


?>