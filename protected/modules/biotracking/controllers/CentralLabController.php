<?php
require_once ("MyUtils.class.php");

class CentralLabController extends Controller
{
    private $url="https://www.clinifax.org/breast_yii/index.php/biotracking/centrallab/ventanaform";
    public $layout="/layouts/column1";

    public function actionVentanaForm ($materialID=0)
    {
        $materialID= $materialID==0 ? (int)$_POST["VentanaForm"]['materialID'] : $materialID;
        $detail=$this->getContactInformation($materialID);
        $ventanaModel=new VentanaForm;
        // collect user input data
        if(isset($_POST['VentanaForm']))
        {
            $ventanaModel->attributes=$_POST['VentanaForm'];
            if ($ventanaModel->validate())
            {
                try
                {
                    $this->insertIntoResponse($ventanaModel->attributes,$ventanaModel->getFields());
                    $this->actionSuccess();
                    Yii::app()->end();
                }
                catch (Exception $e)
                {
                    echo $e->getMessage();
                }
            }
        }
        $this->render("ventanaform",array('ventanaModel'=>$ventanaModel,"url"=>$this->url,"contactDetails"=>$detail,"materialID"=>$materialID));					
    }

    public function actionSuccess()
    {
            $this->render("success");
    }
    
    public function actionReturnSample()
    {
            // Getting database connection (config/main.php has to set up database
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
                // Here you will use your complex sql query using a string or other yii ways to create your query
                $sql="select vcrp.material_id,local_id, centre_description, screening_number,ra.address_id, address_street, address_postcode, address_state, country, address_city,cl_reception_date
                from lab2.v_central_result_part1 vcrp join lab2.v_material_details_all vmda on vmda.material_id = vcrp.material_id 
                join lab2.v_patients vp on vp.patient_id = vmda.patient_id 
                join lab2.return_addresses ra on ra.material_id = vmda.material_id 
                join lab2.addresses a  on a.address_id = ra.address_id  
                join lab2.v_country_filtered vc on vc.country_id = a.country_id 
                join lab2.material_cl_reception mcr on mcr.material_id = vmda.material_id
                where centre_id =:CENTREID and location_id=108
                group by vcrp.material_id,local_id, centre_description, screening_number,ra.address_id, address_street, address_postcode, address_state, country, address_city,cl_reception_date";
                $oCommand = $biotrackingConn->createCommand($sql);
                // Bind the parameter
                $oCommand->bindParam(':CENTREID', $centreID, PDO::PARAM_STR);
                $oCDbDataReader = $oCommand->queryAll(); // Run query and get all results in a CDbDataReader
                $td=array("MATERIAL_ID", "LOCAL_ID", "CENTRE_DESCRIPTION", "SCREENING_NUMBER", "ADDRESS_STREET", "ADDRESS_POSTCODE", "ADDRESS_STATE", "COUNTRY", "ADDRESS_CITY", "CL_RECEPTION_DATE");
                $this->renderPartial("_returnSample",array("oCDbDataReader"=>$oCDbDataReader,"td"=>$td));
            }
        }
    }
    
    public function actionCompletedFormTissue()
    {
        $rows = CentralQuery::getALLHer2Form();
        $json= CJSON::encode($rows);
            echo $json;
    }
    
    public function actionDisplayDatatable()
    {
        $this->render("testdatatable");
    }
    
    private function insertIntoResponse(array $values, array $fields)
    {
        foreach ($values as $key => $value)
        if ($key !== "materialID")
        {
            $response= Responses::model()->findByAttributes(array("MATERIAL_ID"=>$values["materialID"], "QUESTION_ID"=>$fields[$key],"FORM_ID"=>$fields["FORM_ID"]));
            if ($response!=null) // update a effectuer
            {
                $response->VALUE=$value;
                if (!$response->save())
                        throw new Exception("inserIntoResponse: impossible to update data");
            }
            else
                Responses::insertNewResponse(array());
        }
    }

    private function getContactInformation ($materialID)
    {
        // Getting database connection (config/main.php has to set up database
        $biotrackingConn = Yii::app()->dbBiotracking; 
        // Here you will use your complex sql query using a string or other yii ways to create your query
        $sql="select A.MATERIAL_ID,A.LOCAL_ID,A.COLLECTION_DATE,D.CONTACT_PERSON,D.CENTRE SHORT_DESCRIPTION,D.FAX_NUMBER,D.ADDRESS_CITY,C.SCREENING_NUMBER, 
                D.CENTRE_NAME LONG_DESCRIPTION,G.DATE_PICKUP, F.COUNTRY COUNTRY from V_MATERIAL_DETAILS_ALL A INNER JOIN V_USER_REGISTRATION B ON A.USER_ENTERED=B.USER_ID 
                INNER JOIN PATIENTS C ON A.PATIENT_ID=C.PATIENT_ID INNER JOIN V_CENTRES_ADDRESS D ON C.CENTRE_ID=D.CENTRE_ID  
                INNER JOIN V_COUNTRY_FILTERED F ON F.COUNTRY_ID=D.COUNTRY_ID LEFT JOIN AIRWAY_NUMBERS G ON G.MATERIAL_ID=A.MATERIAL_ID WHERE A.MATERIAL_ID=:MATERIALID GROUP BY A.MATERIAL_ID,A.LOCAL_ID,A.COLLECTION_DATE,D.CONTACT_PERSON, 
                D.CENTRE,D.FAX_NUMBER,D.ADDRESS_CITY,C.SCREENING_NUMBER, D.CENTRE_NAME ,G.DATE_PICKUP,F.COUNTRY";
        $oCommand = $biotrackingConn->createCommand($sql);
        // Bind the parameter
        $oCommand->bindParam(':MATERIALID', $materialID, PDO::PARAM_STR);
        $oCDbDataReader = $oCommand->queryAll(); // Run query and get all results in a CDbDataReader
        return $oCDbDataReader;
    }
}
?>

