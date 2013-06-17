<?php

require_once("HelperForm.class.php");

class Her2FormController extends Controller
{
    public $layout="/layouts/column1";
    
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
                "users"=>array('@'),
                'expression'=>'$user->profile=="IT"',
            ),
            
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionLocalForm ($sampleID= null)
    {
        if ($sampleID != null)
        {
            $aphinityLocalForm=new AphinityLocalForm();
            $aphinityLocalForm->sampleID=$sampleID;
            $aphinityLocalForm->update= isset($_POST["AphinityLocalForm"]['update']) ? $_POST["AphinityLocalForm"]['update'] :"no";
            $aphinityLocalForm->formID=26;
            $contactInfo=$this->getContactInformation($sampleID);
            $labelSubmit="submit";
    //        ce test est nécessaire en cas de maj d'un record existant
    //        sinon la fonction mass assignation écrasera toutes les nouvelles à insérer        
            if ($aphinityLocalForm->update != 'yes')
            {
                $responses= Responses::model()->findAllByAttributes(array("MATERIAL_ID"=>(int)$sampleID,"FORM_ID"=>26));
                if ($responses != null)
                {
                    $labelSubmit="update";
                    $aphinityLocalForm->massAssignation ($responses);
                    $aphinityLocalForm->update='yes';
                }
            }
            $cdBCriteria=new CDbCriteria();
            $cdBCriteria->order="QUESTION_ID, SEQ_ORDER";
            $values=VFormQuestionValue::model()->findAllByAttributes(array("FORM_ID"=>26,"STUDY_ID"=>12),$cdBCriteria);
            $helperForm=new HelperForm();
            $helperForm->setDataToDisplay($values);
            
            if(isset($_POST['AphinityLocalForm']))
            {
                $aphinityLocalForm->attributes=$_POST['AphinityLocalForm'];
                $aphinityLocalForm->scenario=$aphinityLocalForm->computeScenario();
                if ($aphinityLocalForm->validate())
                {
                    try
                    {
                        $userID=Yii::app()->user->getID();
                        $responses=new Responses();
                        if ($aphinityLocalForm->update=='yes')
                        {
                            $compatibilityMode=$aphinityLocalForm->getMapCompatibilityMode();
                            $responses->updateResults ($userID, $aphinityLocalForm->getFields(), $aphinityLocalForm->attributes,$compatibilityMode);
                        }
                        else
                            $responses->insertResults ($userID, $aphinityLocalForm->getFields(),$aphinityLocalForm->attributes);

                        $this->actionSuccess();
                        Yii::app()->end();
                    }
                    catch (Exception $e)
                    {
                        echo $e->getMessage();
                    }
                }
            }
            $this->render("aphinityLocalFormView",array('aphinityLocalForm'=>$aphinityLocalForm,"values"=>$values,
                "contactInfo"=>$contactInfo,"labelSubmit"=>$labelSubmit));
        }
    }
    
    public function actionSuccess()
    {
            $this->render("success");
    }
    
    public function actionReturnSample()
    {
            $biotrackingConn = Yii::app()->dbBiotracking; 
            // Here you will use your complex sql query using a string or other yii ways to create your query
            $sql="select centre_id,centre_description from lab2.v_material_details_all vmda join lab2.v_patients vp on vp.patient_id = vmda.patient_id 
                where location_id = 108 group by  centre_id, centre_description order by centre_description";
            $oCommand = $biotrackingConn->createCommand($sql);
            $oCDbDataReader = $oCommand->queryAll(); // Run query and get all results in a CDbDataReader
            $this->render("ReturnSample", array('oCDbDataReader'=>$oCDbDataReader));
    }
    
    public function actionGetTableSampleReturn()
    {
        if (isset ($_POST["CENTRE_ID"]))
        {
            $centreID=$_POST["CENTRE_ID"];
            if (!empty($centreID))
            {
                // Getting database connection (config/main.php has to set up database
                $biotrackingConn = Yii::app()->dbBiotracking; 
                if (Yii::app()->params['environment']=="prod")
                        $schema="lab2";
                else
                        $schema="lab_dev2";
                
                $sql="select vcrp.material_id,local_id, centre_description, screening_number,ra.address_id, address_street, address_postcode, address_state, country, address_city,cl_reception_date
                from $schema.v_central_result_part1 vcrp join $schema.v_material_details_all vmda on vmda.material_id = vcrp.material_id 
                join $schema.v_patients vp on vp.patient_id = vmda.patient_id 
                join $schema.return_addresses ra on ra.material_id = vmda.material_id 
                join $schema.addresses a  on a.address_id = ra.address_id  
                join $schema.v_country_filtered vc on vc.country_id = a.country_id 
                join $schema.material_cl_reception mcr on mcr.material_id = vmda.material_id
                where centre_id =:CENTREID and location_id=108
                group by vcrp.material_id,local_id, centre_description, screening_number,ra.address_id, address_street, address_postcode, address_state, country, address_city,cl_reception_date";
                $oCommand = $biotrackingConn->createCommand($sql);
                // Bind the parameter
                $oCommand->bindParam(':CENTREID', $centreID, PDO::PARAM_STR);
                $oCDbDataReader = $oCommand->query();
                $td=array("MATERIAL_ID", "LOCAL_ID", "CENTRE_DESCRIPTION", "SCREENING_NUMBER", "ADDRESS_STREET", "ADDRESS_POSTCODE", "ADDRESS_STATE", "COUNTRY", "ADDRESS_CITY", "CL_RECEPTION_DATE");
                $this->renderPartial("_returnSample",array("oCDbDataReader"=>$oCDbDataReader,"td"=>$td));
            }
        }
    }
    
    private function getContactInformation ($materialID)
    {
        $ar = VMaterialProperty::model()->findByPk($materialID);
        return $ar;
    }
}
?>

