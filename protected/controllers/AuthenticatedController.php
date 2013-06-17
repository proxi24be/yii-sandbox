    <?php

class AuthenticatedController extends Controller {

    /**
     * @return array action filters
     */
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
                'users'=>array('@'),
            ),
            
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $cdbCriteria=new CDbCriteria();
        $cdbCriteria->select="APP_NAME";
        $cdbCriteria->group="APP_NAME";
        $cdbCriteria->condition="ROLE_STUDY_ID=:roleStudyID";
        $cdbCriteria->params=array(":roleStudyID"=>(int)Yii::app()->user->roleStudyID);
        $cdbCriteria->order="APP_NAME ASC";
        $roleApp=VStudyBrEASTTools::model()->findAll($cdbCriteria);
        $this->render("index",array("roleApp"=>$roleApp));
    }
    
//    public function actionGoToBiotracking()
//    {
//        $request = <<<REQ
//https://www.biotracking.org/logon_check2.php
//REQ;
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $request);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch,CURLOPT_POSTFIELDS,"user_name=".Yii::app()->user->username."&user_password=".Yii::app()->user->pwd);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $response = curl_exec($ch);
//        curl_close($ch);
//        
//        $this->redirect("https://www.biotracking.org/12/ui_main.php");
//    }
    
    
    public function actionElearning($status=null)
    {
        if (!isset($status))
        {
            $session=new CHttpSession;
             $session->open();
             $session["userID"]=Yii::app()->user->getID();

                $userID= Yii::app()->user->getID();
                $elearning = Elearning::model()->findByPk((int)$userID);

            if ($elearning != null)
            {
                $cpt= $elearning->TRY;
                $elearning->TRY= (int) $cpt + 1;
                if (!$elearning->save())
                        throw new CHttpException("The elearning can not be accessed.");
            }
            else
            {
                $elearning = new Elearning ();
                $elearning->USER_ID=(int)$userID;
                $elearning->TRY=1;
                if (!$elearning->save())
                        throw new CHttpException("The elearning can not be accessed.");
            }

            $path = Yii::app()->createUrl("")."/elearning";
            // profile generic
            $role=Yii::app()->user->profile; 
            
            if (strpos($role,"INVESTIGATOR") !==false)
                    $path="$path/INV Elearning/BrEAST_Index.htm";
            else if (strpos($role,"CRA/MONITOR") !==false || strpos($role, "COUNTRY COORDINATOR") !== false)
                    $path="$path/CRA Elearning/BrEAST_Index.htm";
            else if (strpos($role,"STUDY COORDINATOR") !==false)
                    $path="$path/SC Elearning/BrEAST_Index.htm";
            else if (strpos($role,"DATA MANAGER") !==false || strpos($role,"DM") !==false)
                    $path="$path/DM Elearning/BrEAST_Index.htm";
            else
                 throw new CHttpException("You do not have access to the elearning.");
            
            $this->render("htmlElearning",array("path"=>$path));
            
            //$this->redirect($path);
        }
        
        else // traité le status de l'elearning
            $this->render("elearning",array("status"=>$status));
        
    }
    
}

?>