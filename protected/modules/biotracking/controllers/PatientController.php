<?php

require_once("BiotrackingAbstractController.php");
include_once("abstract/Biotracking.php");
include_once("custom/MyPatient.php");

class PatientController extends BiotrackingAbstractController
{

    public function actionGetListOfVisit($patientID)
    {
        try
        {
            if (!isset($patientID) || empty($patientID))
                throw new Exception("patient ID cannot be null");

            $patient=new MyPatient();
            echo CJSON::encode($patient->getVisit($patientID));
        }
        catch (Exception $e)
        {
            
        }
    }

    public function actionGetSampleType($patientID,$visitID)
    {
        try
        {
            if (empty($patientID) || empty($visitID))
                throw new Exception("patient ID OR visit ID cannot be empty");

            $patient=new MyPatient();
            echo CJSON::encode($patient->getSampleByVisit($patientID,$visitID));
        }
        catch (Exception $e)
        {

        }
    }

    public function actionGetListOfPatient()
    {
        $patient=new MyPatient();
        $patientJSON= $patient->getAllPatient($this->_studyID,$this->_userID);
        echo CJSON::encode($patientJSON);
    }
}

