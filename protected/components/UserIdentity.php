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
	
	//Yii::app()->user->getState('username')
	private $id;
	private $email; 

	public function authenticate()
	{
        $this->email = $this->username;
		$email = $this->email;
		$password = $this->password;
		
		$record = User::model()->findByAttributes(
			array('email'=>$email)
		);
        if($record===null) {
			$record = Vendor::model()->findByAttributes(
				array('email'=>$email)
			);
        }

        if($record===null)
          	$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(!isset($record->email))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($record->password!==$password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else {
			// Login successfull, let's update last login timestamp

			if ( isset($record->vendor_id) ) {
				var_dump( ' I AM HERE ');
				// From vendor table
				$record->user_id = $record->vendor_id;
				$record->full_name = $record->name;
			}

			// From user table
			$this->id=$record->user_id;
			$this->setState('roles', $record->role);
            Yii::app()->user->setState('user', $record);
            Yii::app()->user->setState('email', $record->email);
			$record->update_date = date('Y-m-d H:i:s');
			$record->update();
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

    public function getId(){
        return $this->id;
    }
}
