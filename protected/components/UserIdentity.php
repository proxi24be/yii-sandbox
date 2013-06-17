<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    public static $ERROR_PASSWORD_EXPIRED=200;
    public static $ERROR_ACCOUNT_EXPIRED=300;
    private $_id ; 
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
        $record=VUserRegistration::model()->findByAttributes(array('USERNAME'=>  strtoupper($this->username)));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->PASSWORD!== md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
//            vérifier si le user doit changer son mot de passe
            if (!$this->checkExpirationDate($record->PASSWORD_EXPIRATION))
                    $this->errorCode=self::$ERROR_PASSWORD_EXPIRED;
             else if (!$this->checkExpirationDate($record->VALIDITY_DATE))
                     $this->errorCode=self::$ERROR_ACCOUNT_EXPIRED;
            else
            {
                $this->_id=$record->USER_ID;
                // UserRegistration::model()->updateByPk($this->_id, array("LAST_CONNECTION"=>new CDbExpression("SYSDATE")));
                $this->setState('title', $record->ROLE_DESCRIPTION);
                $this->setState('currSelectedStudy', $record->STUDY_ID);
                $this->setState('fullName', $record->FIRSTNAME . " " . $record->LASTNAME);
                $ar=VRoleBrEASTStudy::model()->findByAttributes(array("ROLE_STUDY_ID"=>(int)$record->ROLE_STUDY_ID));
                $this->setState("roleStudyID",(int)$record->ROLE_STUDY_ID);
                $this->setState('profile',$ar->BREAST_PROFILE);
                $this->setState('username',$this->username);
                $this->setState('pwd',$this->password);
                $this->setState('selectedStudy',12);

                $userHttpInfo=new UserHttpInfo();
                try
                {
                    $userHttpInfo->createNewEntry($this->_id);
                }
                catch (Exception $e)
                {

                }
                $this->errorCode=self::ERROR_NONE;
            }
        }
        return $this->errorCode;
    }

    public function getID ()
    {
        return $this->_id;
    }

    /**
     * @param $date
     * @return bool
     * @throws CHttpException the exeception is raised in case the date cannot be converted to unix timestamp
     */
    private function checkExpirationDate ($date)
    {
        $expiration=CDateTimeParser::parse($date,'dd/MM/yyyy HH:mm:ss');
        if ($expiration===false)
            $expiration=CDateTimeParser::parse($date,'dd/MM/yyyy');

        if ($expiration===false)
            throw new CHttpException(500,"Impossible to parse the date $date, the format is not valid");

        $now= time();

        if ($expiration < $now)
            return false;
        else
            return true;
    }
}