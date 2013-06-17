<?php

// permet d'utiliser la classe email sinon quoi il faut une erreur de deprecated à cause de la version de PHP
error_reporting(E_ALL ^E_DEPRECATED);
define('MAIL_SERVER', 'c2srvmail.bordet.be');
Yii::import ("application.vendors.*");
require_once("phpmailer/class.phpmailer.php");
require_once ("MyUtils.class.php");
require_once("MyMails.class.php");
require_once("Encryption.class.php");

class SiteController extends Controller
{   
    public function actions()
    {
        return array
        (
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                    'class'=>'CCaptchaAction',
                    'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                    'class'=>'CViewAction',
            ),
        );
    }
    
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $model=new LoginForm;
        $this->render("index");
    }
    
    public function actionLogin()
    {
        $model=new LoginForm;
        $this->render("login",array('model'=>$model));
    }
    
    public function actionCheckLogin()
    {
        $model=new LoginForm;
        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and check login
            if($model->validate() && $model->login())
            {
                $url=Yii::app()->createUrl("authenticated/");
                $this->redirect($url);
            }	
        }
        $this->render("login",array('model'=>$model));
    }

    public function actionBrEAST()
    {
        $this->render("breast");
    }

    public function actionLinks()
    {
        $this->render("links");
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $this->render('contact');
    }
    
    
    public function actionJobs()
    {
        $this->render("jobs");
    }

    public function actionTeam($d=0)
    {
        $cacheTime=Yii::app()->params["cacheTime"];
        $team=Team::model()->cache($cacheTime)->findAllByAttributes(array("DEPARTMENT_ID"=>(int)$d));
        $department= Department::model()->cache($cacheTime)->findByAttributes(array("ID"=>(int)$d));
        $ars = Department::model()->cache($cacheTime)->findAll();
        $this->render("team",array("functions"=>$ars,"team"=>$team,"department"=>$department));
    }

    public function actionTrials($s=0)
    {
        $studyID=(int)$s;
        $cDBCriteria= new CDbCriteria();
        $cDBCriteria->order="ID";
        $studies=Studies::model()->findAll($cDBCriteria);
        $backToTrial=$this->createUrl("site/trials");
        $back="<a href='$backToTrial'>Back</a>";
        if ($studyID != 0)
        {
            foreach ($studies as $study)
                if ($study->ID == $studyID)
                       $studyName=$study->LONG_NAME;
        }
        switch ($studyID) 
        {
            case 1 :
                    $content=$this->renderPartial("studies/tax",null,true);
                    break;
            case 2 :
                    $content=$this->renderPartial("studies/hera",null,true);
                    break;
            case 3 :
                    $content=$this->renderPartial("studies/altto",null,true);
                    break;
            case 4 :
                    $content=$this->renderPartial("studies/neoaltto",null,true);
                    break;
            case 5 :
                    $content=$this->renderPartial("studies/aphinity",null,true);
                    break;
            default:
                    $content=$this->renderPartial("defaultStudy",array("studies"=>$studies),true);
                    $back="";
                    $studyName="";
                    break;
        }
        $this->render("trials",array("studies"=>$studies,"studyName"=>$studyName,"content"=>$content,"back"=>$back));
    }
    
    public function actionResetPassword()
    {
        $status="";
        $model=new UserForm("resetPassword");
        // collect user input data
        if(isset($_POST['UserForm']))
        {
            $model->attributes=$_POST['UserForm'];
                // validate user input and check login
            try
            {
                if($model->validate())
                {
                    $ar=$model->checkUsernameAndEmail();
                    if ($ar==null)
                        $status="Wrong username or email address";
                    else
                    {
                        //envois email
                        $to = strtolower($ar["EMAIL_ADDRESS"]);
                        $random = rand(100000,1000000);
                        $code=sha1(md5($random));
                        UserRegistration::model()->updateByPk( (int)$ar["USER_ID"], array("PASSWORD"=>md5($random),"PASSWORD_EXPIRATION"=>new CDbExpression("SYSDATE")));
                        $message=MessageEmail::getResetMessage($ar["FIRSTNAME"], $ar["LASTNAME"], $to, $ar["USERNAME"], $code);
                        $email=new MyMails("breast.technical@bordet.be","BrEAST technical",array($to),array(),
                                array("breast.technical@bordet.be"),"Br-E-A-S-T password reset request",$message,array());
                        $email->send();
                        
                        $status="Thank you ! An email has been sent to your email address($to) with instruction on how to reset your password.";
                    }
                }
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
        $this->render("resetpasswordformview",array('model'=>$model,"status"=>$status));
    }

    public function actionRegistration()
    {
        $cacheTime=Yii::app()->params["cacheTime"];
        $model=new UserForm('registration');
        $studies = MyUtils::getDataForSelectFromModel(Study::model()->cache((int)$cacheTime),"ID >=12",array(),array("ID","DESCRIPTION"));
        asort($studies);
        $countries = MyUtils::getDataForSelectFromModel(VCountriesStudies::model()->cache((int)$cacheTime),"STUDY='APHINITY'",array(),array("COUNTRY_ID","LONG_DESCRIPTION"));
        asort($countries);
        
        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-registration-UserRegistrationForm-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */
        if(isset($_POST['UserForm']))
        {
            $model->attributes=$_POST['UserForm'];
            if($model->validate())
            {
                try
                {
                    $userRegistration= new UserRegistration("registration");
                    $userRegistration->attributes=$model->attributes;
//                    vérifie si le user peut s'enregistrer
                    $userRegistration->checkUserDetails();
                    $userRegistration->createUsername();
                    $userRegistration->mySave();
                    
                    //creation du compte RDC
                    $rdcAccount = new RdcAccount();
                    $rdcAccount->createNewRdcUser("APHINITY", $userRegistration);
                    
                    // attache les centres aux users
                    $registrationProcedure = new RegistrationProcedure ();
                    $registrationProcedure->execute ("user_site_access.insertAndUpdateUserPrivileges()");
                    unset($registrationProcedure);
                    
                    //envois email
                    $from="breast.technical@bordet.be";
                    $fromName="breast technical";
                    // to comment in production
                    $to=array(strtolower($userRegistration->EMAIL_ADDRESS));
                    $cc=array("breast.technical@bordet.be");
                    $subject="BrEAST Website : Your registration";
                    $encryption=new Encryption();
                    
                    
                    $userID= $userRegistration->getPrimaryKey();
                    $code=$encryption->encode($userID."|".UserRegistration::getVerificationCode($userID));
                    $message=MessageEmail::getMessage(strtoupper($userRegistration->FIRSTNAME),  strtoupper($userRegistration->LASTNAME),
                            $userRegistration->EMAIL_ADDRESS,$code);
                    $email=new MyMails($from,$fromName,$to,$cc,array(),$subject,$message,array());
                    $email->send();
                    $this->redirect("statusrequest?status=registration");
                }
                
                catch (CHttpException $e)
                {
                    $typeError=$e->getMessage();
                    Yii::log($e->getMessage());
                    $this->redirect("StatusRequest?status=$typeError");
                    
                }
                catch (Exception $e)
                {
                    Yii::log($e->getMessage());
                    $this->redirect('StatusRequest?status=failed');
                }
            }
        }
        $this->render('UserRegistrationFormView',array('model'=>$model,"studies"=>$studies,"countries"=>$countries));
    }
    
    public function actionDynamicRole()
    {
        if (isset($_POST["UserForm"]["STUDY_ID"]))
        {
            $cacheTime=Yii::app()->params["cacheTime"];
            $studyID=$_POST["UserForm"]["STUDY_ID"];
            $data = MyUtils::getDataForSelectFromModel(VRoleStudy::model()->cache((int)$cacheTime),"STUDY_ID=:STUDY_ID AND ROLE_STUDY_ID IN (13,32,33,45,66,58)",
                    array(":STUDY_ID"=>(int)$studyID),array("ROLE_STUDY_ID","ROLE_STUDY"));
            asort($data);
            $tags = MyUtils::generateTagElems("option",MyUtils::addEmpty($data));
            MyUtils::displayTags($tags);    
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $error=Yii::app()->errorHandler->error;
        if($error)
        {
            if(Yii::app()->request->isAjaxRequest)
                    echo $error['message'];
            else
                    $this->render('error', $error);
        }
    }
    
    public function actionUpdatePassword($user='',$temp="",$status="default")
    {
        $user=trim($user);
        $form=new UserForm("updatePassword");
        $message="";
        if (isset($_POST["UserForm"]))
        {
            $form->attributes=$_POST["UserForm"];
            if ($form->validate())
            {
                try
                {
                    UserRegistration::updatePassword($form->userID,$form->updatePasswordConfirmed);
                    $userRegistration=UserRegistration::model()->findByPk((int)$form->userID);
                    Yii::log("update password : $userRegistration->USERNAME | $form->updatePasswordConfirmed");
                    $clinConn = Yii::app()->db; 
                    // Here you will use your complex sql query using a string or other yii ways to create your query
                    $sql="SELECT COUNT(*) FROM ORACLE_ACCOUNTS  WHERE upper(ORACLE_ACCOUNT_NAME) LIKE upper('$userRegistration->USERNAME')";
                    $oCommand = $clinConn->createCommand($sql);
                    $value=$oCommand->queryScalar(); 
                    if ((int)$value > 0 )
                    {
                        $rdcAccount= new RdcAccount;
                        $rdcAccount->updatePassword(strtoupper($user), $form->updatePasswordConfirmed);
                    }
                    $message="Thank you. Your password has been successfully updated you may use it now.";
                }
                catch (Exception $e)
                {
                    Yii::log($e->getMessage);
                    throw new CHttpException("An error has occured during the update of your password.  Please contact the BrEAST technical if the issue still remains");
                }
            }
        }
        else
        {
            // petite sécurité en plus
            // $temp est une chaine en sha1 
            if (!empty($user) && !empty($temp))
            {
                $user=VUserRegistration::model()->findByAttributes(array("USERNAME"=> strtoupper($user)));
                if ($user==null || sha1($user->PASSWORD) !== $temp )
                {
                    $url=Yii::app()->createUrl("/error");
                    $this->redirect($url);
                }
                $form->userID=$user->USER_ID;
            }
        }
        $this->render("updatePasswordView",array("model"=>$form,"message"=>$message,"status"=>$status));
    }
    
    public function actionStatusRequest($status='')
    {
        $this->render("statusview",array("status"=>$status));
    }
    
    public function actionCompleteRegistration($code='')
    {
        $encryption=new Encryption();
        $decrypted = $encryption->decode($code);
        $composed= explode("|",$decrypted);
        if (count($composed) !==2 )
            throw new CHttpException(404,"verification impossible");
        $verificationCode=UserRegistration::getVerificationCode($composed[0]);
        if ($verificationCode == $composed[1] )
        {
            $user=  VUserRegistration::model()->findByAttributes(array("USER_ID"=>(int)$composed[0]));
            UserRegistration::model()->updateByPk((int)$composed[0],array("REGISTRATION_IS_COMPLETED"=>"YES","LAST_CONNECTION"=>new CDbExpression("SYSDATE")));
            $this->render("completeregistration",array("user"=>$user));
        }
        else
//                    throw new Exception("wrong verification code");
            throw new CHttpException(404,'verification code not found');
    }
    
    
    public function actionDisclaimer()
    {
        $this->render("disclaimer");
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
    }
    
}
