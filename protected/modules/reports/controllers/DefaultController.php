<?php
require_once ("MyUtils.class.php");
require_once("ListBoxReport.class.php");
require_once("DoubleKey.class.php");

class DefaultController extends Controller
{
   public $layout="//layouts/ReportLayout";
    
    /**
     * @return array action filters
     */
        public function filters()
        {
            return array(
                'accessControl', // perform access control for CRUD operations
            );
        }
    
        public function accessRules()
        {
            return array(
                array('allow',  // allow only authenticated to perform 'index' and 'view' actions
                    "users"=>array("@"),
                    'expression'=>'$user->profile=="IT" || $user->profile=="CRA/MONITOR" || $user->profile=="DATA MANAGER" 
                        || $user->profile=="COUNTRY COORDINATOR" || $user->profile=="INVESTIGATOR" 
                        || $user->profile=="STUDY COORDINATOR" || $user->profile=="TRANSLATIONAL COORDINATOR"',
                ),

                array('deny',  // deny all users
                    'users'=>array('*'),
                    'message'=>'Access denied.',
                ),
            );
        }
    
        public function actionIndex()
	{
            $model= new ReportForm();
            $cacheTime=Yii::app()->params["cacheTime"];
            $userID=Yii::app()->user->getID();
            $roleStudyID=(int)Yii::app()->user->roleStudyID;
            $dependency = new CDbCacheDependency("SELECT COUNT(REPORT_ID) FROM WEBREPORTS.V_REPORT_ROLE WHERE ROLE_STUDY_ID=$roleStudyID");
            $reports = VReportRole::model()->cache((int)$cacheTime,$dependency)->findAll("ROLE_STUDY_ID=:roleStudyID",array(":roleStudyID"=>$roleStudyID));
            $reportLongDescription=CJSON::encode(CHtml::listData($reports, "REPORT_ID", "LONG_DESCRIPTION"));
            $reports=CHtml::listData($reports, "REPORT_ID", "REPORT_NAME");
            asort($reports);
            $this->render('reportParameterView',array("model"=>$model,"reports"=>$reports,"reportLongDescription"=>$reportLongDescription));
	}
        
        public function actionGetAllParametersOfUser()
        {
            $sessionID=Yii::app()->session->getSessionID();
            $fileName="protected/runtime/reportJSON/$sessionID.json";
            if (!file_exists($fileName))
            {
                $userID=Yii::app()->user->getID();
                $criteria=new CDbCriteria();
                $criteria->condition="USER_ID=:userID";
                $criteria->params=array(":userID"=>(int)$userID);
                $criteria->order="COUNTRY, RANDO_CRTN, PATIENT";
                $userGroupPatient=VUserGroupPatient::model()->findAll($criteria);
                file_put_contents($fileName, CJSON::encode($userGroupPatient));
                $serial="protected/runtime/reportJSON/$sessionID.serial";
                file_put_contents($serial, serialize($userGroupPatient));
            }
            if (file_exists($fileName))
                echo file_get_contents($fileName);
        }
        
        public function actionGetReportParamView($reportID=null)
        {
            if ($reportID!=null)
            {
                $model= new ReportForm();
                $cacheTime=Yii::app()->params["cacheTime"];
                $roles= VReportRole::model()->cache((int)$cacheTime)->findAllByAttributes(array("ROLE_STUDY_ID"=>(int)Yii::app()->user->roleStudyID,
                    "REPORT_ID"=>(int)$reportID));
                $formats=VReports::getSpecificParam(array("select"=>"FORMAT,FORMAT_ID","order"=>"FORMAT_ID"), $reportID);
                $formats= CHtml::listData($formats, "FORMAT", "FORMAT");
                if (count ($roles) > 0)
                    $params = VReports::getListParams($reportID,$roles);
                else
                    $params=VReports::getDefaultListParams();

                if (count ($params) >0)
                    $this->renderPartial("_reportParameterView", array("model"=>$model,"params"=>$params,"formats"=>$formats));
                else
                    throw new CHttpException("Access denied.");
            }
            else
                echo "";
        }
        
        public function actionOrderReport()
        {
            if (isset($_POST["ReportForm"]))
            {
                $queueID=0;
                $reportForm = new ReportForm();
                $reportForm->attributes=$_POST["ReportForm"];
                $record=VReports::model()->findByAttributes(array("REPORT_ID"=>$reportForm->REPORT_ID));
                $reportForm->EXEC_FILE=$record["EXEC_FILE"];
                $reportForm->FILENAME=$record["SHORT_DESCRIPTION"];
                $reportForm->DEST_PATH=$record["DEST_PATH"];
                $queueID=Queue::createRecord($reportForm);
                $reportForm->QUEUE_ID=$queueID;
                if ($queueID != null && ! empty($queueID))
                {
                    QueueParameters::insertAllParameters($reportForm);
//                   demande de creation de report au serveur
                    if ($record==null)
                        throw new CHttpException("Your report can not be executed");
                    else
                    {
                        switch ($record["SERVER_ID"])
                        {
                            case 1: //weblogic
                                $newReport= new OracleReport($reportForm);
                                break;
                        }
                        $params = $newReport->createGenericParam();
                        $newReport->generateReport($params);
                        $url = Yii::app()->createUrl("reports/default/reviewReport");
                        $this->redirect($url);
                    }
                }
                 else 
                     throw new CHttpException("Your report can not be executed");
            }
        }
        
        public function actionReviewReport()
        {
            $rowsToUpdate= VQueue::getReportNotFinished();
            Queue::updateStampFinished($rowsToUpdate);
            $results = VQueue::getReportOrderByUser();
            $this->render("reviewReportView",array("results"=>$results));
        }
        
        public function actionReportOrderedByUser()
        {
            $results = VQueue::getReportOrderByUser();
            echo CJSON::encode($results);
        }
        
        public function actionGetReport($QID=0)
        {
            $userID=(int)Yii::app()->user->getID();
            $recordExist=Queue::model()->findByAttributes(array("USER_ID"=>$userID,"QUEUE_ID"=>(int)$QID));
            if ($recordExist != null)
            {
                $pathToFile=$recordExist["FILEPATH"];
                $content=file_get_contents($pathToFile);
                Yii::app()->getRequest()->sendFile($recordExist["FILENAME"], $content);
            }
            else
                throw new CHttpException("Access denied.");
        }
        
}