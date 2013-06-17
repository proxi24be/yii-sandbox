<?php

require_once("BiotrackingAbstractController.php");
require_once("abstract/Biotracking.php");
require_once ("custom/MyPatient.php");

class SampleTypeController extends BiotrackingAbstractController
{
    public function actionGetListOfSampleType($patientID,$visitID)
    {
        try
        {
            if (empty($patientID) || $patientID=='undefined')
                throw new Exception("patient ID cannot be null");

            if (empty($visitID) || $visitID=='undefined')
                throw new Exception("visit ID cannot be null");
            
            $patient=new MyPatient();
            // As the patient ID is unique for every study it is not necessary to send study ID parameter 
            echo CJSON::encode($patient->getSampleByVisit($patientID,$visitID));
        }
        catch (Exception $e)
        {
            Yii::log($e->getMessage(),"error","app.biotracking.SampleTypeController");
        }
    }
    
}
