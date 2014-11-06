<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{

        /* @var $record Users*/
        $record = Users::model()->findByAttributes(array('user'=>$this->username)); // CPasswordHelper::hashPassword() - generate password hash to user
        if($record === null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!CPasswordHelper::verifyPassword($this->password, $record->pass))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
            $this->errorCode=self::ERROR_NONE;


        if($this->errorCode !== self::ERROR_NONE){
            $this->errorMessage = 'Incorrect username or password.';
        }
		return !$this->errorCode;
	}
}