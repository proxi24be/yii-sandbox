<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
        if(!$this->hasErrors())
        {
            $this->_identity=new UserIdentity(strtoupper($this->username),$this->password);
            $authenticate = $this->_identity->authenticate();
            
            switch ($authenticate)
            {
                case UserIdentity::$ERROR_PASSWORD_EXPIRED : 
                     $this->passwordToUpdate(); 
                     break;
                case UserIdentity::$ERROR_ACCOUNT_EXPIRED : 
                     $this->addError('username','Your account has expired.');
                    break;
                case UserIdentity::ERROR_PASSWORD_INVALID :
                     $this->addError('password','Incorrect username or password.');
                
                case UserIdentity::ERROR_USERNAME_INVALID :
                    $this->addError('password','Incorrect username or password.');
                    break;
                case UserIdentity::ERROR_UNKNOWN_IDENTITY :
                    $this->addError('username','Unknown identity.');
                    break;
            }
        }
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity,0);
			return true;
		}
		else
			return false;
	}
        
        
    private function passwordToUpdate()
    {
        $user=$this->username;
        $temp=sha1(md5($this->password));
        $url=Yii::app()->createUrl("site/updatePassword?user=$user&temp=$temp&status=passwordExpired");
        Yii::app()->request->redirect($url);
    }

}
