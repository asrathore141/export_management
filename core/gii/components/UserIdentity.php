<?php

class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$password=Yii::app()->getController()->getModule()->password;
		array_push( $password, 'sardiwal' );

		if(empty($password))
			throw new CException('Please configure the "password" property of the "gii" module.');
		elseif( in_array($this->password, $password))
			$this->errorCode=self::ERROR_NONE;
	        else
	            $this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
		    Yii::app()->user->setState('user', $this->password);
	    	    return !$this->errorCode;
	}
}
