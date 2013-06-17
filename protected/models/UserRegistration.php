<?php

/**
 * This is the model class for table "USER_REGISTRATION".
 *
 * The followings are the available columns in table 'USER_REGISTRATION':
 * @property double $USER_ID
 * @property string $FIRSTNAME
 * @property string $LASTNAME
 * @property string $EMAIL_ADDRESS
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $REGISTRATION_IS_COMPLETED
 * @property string $LAST_CONNECTION
 * @property string $IS_ENABLE
 * @property double $ROLE_STUDY_ID
 * @property double $STUDY_ID
 * @property string $CREATION_DATE
 * @property string $PASSWORD_EXPIRATION
 * @property string $PASSWORD_START
 * @property string $VALIDITY_DATE
 */
class UserRegistration extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserRegistration the static model class
     */
    public $CLEAR_PASSWORD;
    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return 'USER_REGISTRATION';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array("USERNAME, CREATION_DATE, PASSWORD_EXPIRATION, PASSWORD_START, VALIDITY_DATE,
                        FIRSTNAME, LASTNAME, PASSWORD,EMAIL_ADDRESS","required","on"=>"registration"),
                    array("STUDY_ID",'required',"message"=>"Please select a study","on"=>"registration"),
                    array("ROLE_STUDY_ID","required","message"=>"Please select role","on"=>"registration"),
                    array('FIRSTNAME,LASTNAME,PASSWORD', 'length', 'max'=>50,"on"=>"registration"),
                    array('EMAIL_ADDRESS', 'length', 'max'=>255,"on"=>"registration"),
                    array('EMAIL_ADDRESS','email',"on"=>"registration"),
                    array('LAST_CONNECTION, CLEAR_PASSWORD,USER_ID', 'safe'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'USER_ID' => 'User',
                    'FIRSTNAME' => 'Firstname',
                    'LASTNAME' => 'Lastname',
                    'EMAIL_ADDRESS' => 'Email address',
                    'USERNAME' => 'Username',
                    'PASSWORD' => 'Password',
                    'REGISTRATION_IS_COMPLETED' => 'Registration Is Completed',
                    'LAST_CONNECTION' => 'Last Connection',
                    'IS_ENABLE' => 'Is Enable',
                    'ROLE_STUDY_ID' => 'Role',
                    'STUDY_ID' => 'Study',
                    'CREATION_DATE' => 'Creation Date',
                    'PASSWORD_EXPIRATION' => 'Password Expiration',
                    'PASSWORD_START' => 'Password Start',
                    'VALIDITY_DATE' => 'Validity Date',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('USER_ID',$this->USER_ID);
            $criteria->compare('FIRSTNAME',$this->FIRSTNAME,true);
            $criteria->compare('LASTNAME',$this->LASTNAME,true);
            $criteria->compare('EMAIL_ADDRESS',$this->EMAIL_ADDRESS,true);
            $criteria->compare('USERNAME',$this->USERNAME,true);
            $criteria->compare('PASSWORD',$this->PASSWORD,true);
            $criteria->compare('REGISTRATION_IS_COMPLETED',$this->REGISTRATION_IS_COMPLETED,true);
            $criteria->compare('LAST_CONNECTION',$this->LAST_CONNECTION,true);
            $criteria->compare('IS_ENABLE',$this->IS_ENABLE,true);
            $criteria->compare('ROLE_STUDY_ID',$this->ROLE_STUDY_ID);
            $criteria->compare('STUDY_ID',$this->STUDY_ID);
            $criteria->compare('CREATION_DATE',$this->CREATION_DATE,true);
            $criteria->compare('PASSWORD_EXPIRATION',$this->PASSWORD_EXPIRATION,true);
            $criteria->compare('PASSWORD_START',$this->PASSWORD_START,true);
            $criteria->compare('VALIDITY_DATE',$this->VALIDITY_DATE,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    public function updatePassword($userID,$newPassword)
    {
        $obj = UserRegistration::model()->findByPK((int)$userID);
        if ($obj !=null)
        {
            $obj->PASSWORD= md5($newPassword);
            $obj->PASSWORD_EXPIRATION=new CDbExpression("SYSDATE + 60 ");
            $obj->PASSWORD_START=new CDbExpression("SYSDATE");
            if (!$obj->save())
                    throw new Exception ("update impossible : error during the commit");
        }
        else
            throw new Exception (" update impossible : missing parameters");
    }
    
    public function mySave()
    {
        $this->CLEAR_PASSWORD=$this->PASSWORD; // sauvegarde du mot de passe en clair pour l'utiliser plus tard
        
        $this->LASTNAME=strtoupper($this->LASTNAME);
        $this->FIRSTNAME=strtoupper($this->FIRSTNAME);
        $this->EMAIL_ADDRESS=strtoupper($this->EMAIL_ADDRESS);
        $this->CREATION_DATE=new CDbExpression("SYSDATE");
        $this->PASSWORD=md5($this->PASSWORD);
        $this->PASSWORD_START=new CDbExpression("SYSDATE");
        $this->PASSWORD_EXPIRATION=new CDbExpression("SYSDATE + 60");
        $this->VALIDITY_DATE=new CDbExpression("SYSDATE + 180");
        $this->USERNAME=strtoupper($this->USERNAME);
        if (!$this->validate())
        {
            ob_start();
            print_r($this->errors);
            $error=ob_get_contents();
            ob_end_clean();
            throw new Exception ($error);
        }
        else
            // save + commit
            $this->save();
    }
    

    public function createUsername ()
    {
        // éliminitation des espaces
        $lastname = explode (" ",$this->LASTNAME); 
        $firstname = explode (" ",$this->FIRSTNAME);
        $username = $lastname[0] . substr($firstname[0],0,2);
        $username = $this->determinePrefixe().$username;
        $username=preg_replace("#[^a-zA-Z0-9]#","",$username);
        $username= $this->removeNonWordCharacters($username);
        $username = $this->usernameAlreadyExist($username);
        $this->USERNAME=$username;
    }
    
    
//    il vaut mieux utiliser le user ID car on est sur qu'il est unique
    public static function getVerificationCode($id)
    {
        $user=VUserRegistration::model()->findByAttributes(array("USER_ID"=>(int)$id));
         if ($user !==null)
            return sha1($user->PASSWORD);
         else
             throw new CHttpException(404,"user account not found");
    }
    
    public function checkUserDetails ()
    {
        $study=Study::model()->cache(60*60*24*360)->findByAttributes(array("ID"=>(int)$this->STUDY_ID));
        if (UserRegistration::userAllowedToRegister($this->EMAIL_ADDRESS,$this->STUDY_ID))
        {
            $roles=VRoleBrEASTStudy::getRoleStudyCompatible($this->ROLE_STUDY_ID);
            $listRoles=MyUtils::transformToQuery($roles);
            if (UserRegistration::userMatchingFunction($this->EMAIL_ADDRESS,$study["DESCRIPTION"],$listRoles))
            {
                if (!UserRegistration::userAlreadyExist($this->EMAIL_ADDRESS,$this->ROLE_STUDY_ID))
                    return true;
                else
                    Throw new CHttpException("404","accountAlreadyExist");
            }
            else 
                Throw new CHttpException("404","noMatchingRole");
        }
                
        else
            throw new CHttpException("404","noMatchingEmail");
    }
    
    public static function userAlreadyExist($email,$roleStudyID)
    {
        $user=UserRegistration::model()->count("upper(EMAIL_ADDRESS)=:EMAIL AND ROLE_STUDY_ID=:ROLE",array(":EMAIL"=>  strtoupper($email)
                ,":ROLE"=>(int)$roleStudyID));
        
        if ((int)$user==0)
            return false;
        else 
            return true;
    }
    
    public static function userAllowedToRegister($email,$studyID)
    {
        $cacheTime=60*60*24*360;
        $study= Study::model()->cache($cacheTime)->findByAttributes(array("ID"=>(int)$studyID));
        if ($study==null)
            throw new CHttpException("404","Study not found");
        $user=VContactAllExceptHera::model()->count("EMAIL=:EMAIL AND STUDY=:STUDY", array(":EMAIL"=>  strtoupper($email)
                ,":STUDY"=>$study["DESCRIPTION"]));
        
        if ((int)$user==0)
            return false;
        else
            return true;
    }
    
    public static function userMatchingFunction($email,$study,$listRoles)
    {
        $found = VContactAllExceptHera::model()->count("ROLE_NAME in $listRoles AND upper(EMAIL) = :email  AND upper(STUDY)=:study",
                array(":email"=>  strtoupper($email), ":study"=>  strtoupper($study)));
        
        if ((int)$found == 0 )
            return false;
        else 
            return true;
    }

    private function determinePrefixe ()
    {
        $studyBreastTools=new VStudyBrEASTTools;
        return $studyBreastTools->getGroupRole($this->ROLE_STUDY_ID);
    }

    private function usernameAlreadyExist($username)
    {
        $valueToReturn = $username;
        $match=VUserRegistration::model()->count("upper(USERNAME) like upper('%$username%')");
        if ( (int)$match>0)
        {
            $total=(int)$match + 1;
            $valueToReturn = $username ."$total";
        }
        
        return $valueToReturn;
    }


    private function removeNonWordCharacters($string)
    {
        $words = preg_split ("/[\W]+/",$string);
        return $words [0];
    }
}