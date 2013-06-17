<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserForm extends CFormModel
{
	public $STUDY_ID;
	public $ROLE_STUDY_ID;
        public $FIRSTNAME;
        public $LASTNAME;
        public $PASSWORD;
        public $PASSWORD_CONFIRMED;
        public $EMAIL_ADDRESS;
        public $EMAIL_ADDRESS_CONFIRMED;
        public $USERNAME;
        public $LAST_CONNECTION;
        public $CREATION_DATE;
        public $PASSWORD_EXPIRATION;
        public $PASSWORD_START;
        public $VALIDITY_DATE;
        public $COUNTRY;
        public $CENTRE;
        public $usernameOrEmail;
        public $verifyCode;
        public $updatePassword;
        public $updatePasswordConfirmed;
        public $userID;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
                        array("STUDY_ID",'required',"message"=>"Please select a study", "on"=>"registration"),
                        array("ROLE_STUDY_ID","required","message"=>"Please select a role", "on"=>"registration"),
                        array("COUNTRY","required","message"=>"Please select a country", "on"=>"registration"),
                        array('FIRSTNAME, LASTNAME, PASSWORD,EMAIL_ADDRESS,PASSWORD_CONFIRMED,EMAIL_ADDRESS_CONFIRMED', 'required', "on"=>"registration"),
			array('FIRSTNAME,LASTNAME,PASSWORD', 'length', 'max'=>50, "on"=>"registration"),
                        array('PASSWORD', 'match', 'pattern'=>'/^[a-zA-Z]*[0-9]+[a-zA-Z]*[0-9]+[a-zA-Z]*[0-9]+[a-zA-Z]*[0-9]+[a-zA-Z]*$/','message'=>"The password entered is not valid","on"=>"registration"),
                        array('PASSWORD_CONFIRMED','passwordConfirmed','on'=>'registration'),
			array('EMAIL_ADDRESS', 'length', 'max'=>255, "on"=>"registration"),
                        array('EMAIL_ADDRESS_CONFIRMED',"emailAddressConfirmed","on"=>"registration"),
                        array('EMAIL_ADDRESS','email', "on"=>"registration"),
                        array('usernameOrEmail,verifyCode', 'required', "on"=>"resetPassword"),
                        array('updatePassword, updatePasswordConfirmed,userID', 'required', "on"=>"updatePassword"),
                        array('updatePassword', 'match', 'pattern'=>'/^[a-zA-Z]*[0-9]+[a-zA-Z]*[0-9]+[a-zA-Z]*[0-9]+[a-zA-Z]*[0-9]+[a-zA-Z]*$/','message'=>"The password entered is not valid","on"=>"updatePassword"),
                        array('updatePasswordConfirmed', 'updatePasswordConfirmed', "on"=>"updatePassword"),
                        array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),"on"=>"resetPassword"),
                        array('CENTRE,LAST_CONNECTION, CREATION_DATE, PASSWORD_EXPIRATION, PASSWORD_START, VALIDITY_DATE', 'safe'),
                        array('PASSWORD_CONFIRMED,EMAIL_ADDRESS_CONFIRMED,CENTRE,usernameOrEmail,verifyCode,updatePassword,updatePasswordConfirmed', 'safe', "on"=>"registration")
		);
	}
        
        
        public function updatePasswordConfirmed($attribute)
        {
            if ($this->updatePassword !==$this->$attribute)
                $this->addError ($attribute, "The password fields did not match");
        }
        
        public function passwordConfirmed($attribute)
        {
            if ($this->PASSWORD !==$this->$attribute)
                $this->addError ($attribute, "The password fields did not match");
        }
        
        public function emailAddressConfirmed($attribute)
        {
            if ($this->EMAIL_ADDRESS !==$this->$attribute)
                $this->addError ($attribute, "The email address fields did not match");
        }
        
        /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'USER_ID' => 'User',
			'FIRSTNAME' => 'First name',
			'LASTNAME' => 'Last name',
			'EMAIL_ADDRESS' => 'Enter your email address',
                        'EMAIL_ADDRESS_CONFIRMED' => 'Re-enter your email address',
			'USERNAME' => 'Username',
			'PASSWORD' => 'Choose your password',
                        'PASSWORD_CONFIRMED' => 'Re-enter your password',
			'REGISTRATION_IS_COMPLETED' => 'Registration Is Completed',
			'LAST_CONNECTION' => 'Last Connection',
			'IS_ENABLE' => 'Is Enable',
			'ROLE_STUDY_ID' => 'Role',
			'STUDY_ID' => 'Study',
			'CREATION_DATE' => 'Creation Date',
			'PASSWORD_EXPIRATION' => 'Password Expiration',
			'PASSWORD_START' => 'Password Start',
			'VALIDITY_DATE' => 'Validity Date',
                        'COUNTRY' => 'Country',
                        'CENTRE' => 'Centre number',
                    //  en caché il autorise d'entrer aussi l'adresse email mais il vaut mieux le cacher à l'utilisateur cette
                    //fonctionnalité
                        'usernameOrEmail' => 'Enter your account username',
                        'updatePassword'=>"Choose your new password",
                        'updatePasswordConfirmed'=>"Re-enter your new password"
		);
	}
        
        public function checkUsernameAndEmail()
        {
            $usernameOrEmail=strtolower(trim($this->usernameOrEmail));
            $ar= VUserRegistration::model()->find("lower(USERNAME)=:username or lower(EMAIL_ADDRESS)=:email", 
                    array(":username"=>$usernameOrEmail,":email"=>$usernameOrEmail));
            return $ar;
        }
}
