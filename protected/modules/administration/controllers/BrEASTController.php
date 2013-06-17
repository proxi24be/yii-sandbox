<?php

class BrEASTController extends Controller
{
    public $layout="/layouts/adminLayout";

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow only authenticated to perform 'index' and 'view' actions
                "users"=>array('@'),
                'ips'=>array('192.168.32.*','127.0.0.1'),
                'expression'=>'$user->profile=="IT"',
            ),
            
            array('deny',  // deny all users
                'users'=>array('*'),
                'message'=>'Access Denied.',
            ),
        );
    }
    
    public function actionIndex()
    {
        $this->render("index");
    }
    
    
    public function actionSpecialUserPrivilege()
    {
        $this->render("specialUserPrivilege");
    }
    
    public function actionAccessDBOfInternalUsers()
    {
        $this->render("AccessDBOfInternalUsers");
    }
    
    public function actionGetFormForInsertingNewPrivilege($username=null, $study=null)
    {
        if (isset($username))
        {
            $study="APHINITY";
            $username=trim($username);
            $userInfo=VUserRegistration::model()->find("USERNAME=:USERNAME",array(":USERNAME"=>strtoupper($username)));
            $sites=array();
            if ($userInfo !=null)
            {
                $clinConn = Yii::app()->db; 
                // Here you will use your complex sql query using a string or other yii ways to create your query
                $sql="select study, study_id, country, country_id, centre, vcapi.centre_id 
                    from v_centre_address_pi vcapi left join (select centre_id from v_user_privileges where user_id=:USERID) 
                    vup on vup.centre_id = vcapi.centre_id where vup.centre_id is null and study=:STUDY  
                    and vcapi.centre_id > 1000 group by study, study_id, country, country_id, centre, vcapi.centre_id  
                    order by COUNTRY, CENTRE";
                $oCommand = $clinConn->createCommand($sql);
                // Bind the parameter
                $userID=(int)$userInfo->USER_ID;
                $oCommand->bindParam(':USERID', $userID, PDO::PARAM_INT);
                $oCommand->bindParam(':STUDY',$study, PDO::PARAM_STR);
                $sites = $oCommand->queryAll(); // Run query and get all results
            }
            $this->renderPartial("formInsertingNewPrivilege",array("userInfo"=>$userInfo,"sites"=>$sites));    
        }
    }
    
    public function actionInsertSpecialPrivilege()
    {
        $message="nothing to do";
        if (isset($_POST["environment"]) && strtoupper($_POST["environment"])=='PROD')
        {
            // ça evite de faire une query
            if ((int)$_POST["STUDY_ID"]==12)
                    $_POST["CLINICAL_STUDY_ID"]= 401;
            else if ((int)$_POST["STUDY_ID"]==1)
                    $_POST["CLINICAL_STUDY_ID"]= 201;
            else if ((int)$_POST["STUDY_ID"]==2)
                    $_POST["CLINICAL_STUDY_ID"]= 301;
            
            $count = count($_POST["CENTRE_ID"]);
            if ($count>0)
            {
                $ok=false;
                if (strtoupper($_POST["environment"])=='PROD')
                        $ok=SpecialUserPrivileges::insertNewPrivilege($_POST);
                else
                    ;
                if ($ok)
                    $message="operation completed";
                else
                    $message="An error has occured";
            }
        }
        echo $message;
    }
    
    public function actionGetListAccessOfInternalUsers($username='')
    {
        $users=array();
        $internalUsers= new InternalUsers ();
        $username=trim($username);
        try
        {
            if (false==$internalUsers->openConnection(Yii::app()->params["dbSysClin"]))
                    throw new Exception ($internalUsers->getErrorMessage());

            $users["clin"]=$internalUsers->getInternalClinUser($username);
            $internalUsers->closeConnection();
            
            if (false==$internalUsers->openConnection(Yii::app()->params["dbSysLab"]))
                    throw new Exception ($internalUsers->getErrorMessage());

            $users["lab"]=$internalUsers->getInternalLabUser($username);
            $internalUsers->closeConnection();
            
            if (false==$internalUsers->openConnection(Yii::app()->params["dbSysSnap"]))
                    throw new Exception ($internalUsers->getErrorMessage());

            $users["snap"]=$internalUsers->getInternalSnapUser($username);
            $internalUsers->closeConnection();
            
            if (false==$internalUsers->openConnection(Yii::app()->params["dbSysSnap2"]))
                    throw new Exception ($internalUsers->getErrorMessage());

            $users["snap2"]=$internalUsers->getInternalSnap2User($username);
            $internalUsers->closeConnection();
        }
        catch (Exception $e)
        {
            Yii::log($e->getMessage());
        }
        
        $this->renderPartial("displayInternalUser",array("users"=>$users));
    }
    
}
