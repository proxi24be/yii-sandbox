<?php

class ContentPDF 
{
    private $shipment;
    private $lab;
    
    public function __construct() 
    {
        if (strtoupper(Yii::app()->params['environment'])=='PROD')
        {
            $this->shipment="SHIPMENT_PROD";
            $this->lab="LAB2";
        }
        else
        {
            $this->shipment="SHIPMENT_TEST";
            $this->lab="LAB_DEV2";
        }
    }
    
    public function getAvailabilityContentPDF (array $tabSampleID)
    {
        $valueToReturn = array();
        if (count($tabSampleID)>0)
        {
            $labConn = Yii::app()->dbBiotracking;
            $listOfSamples = implode(",",$tabSampleID);
            $sql=" SELECT SAMPLE_ID,REQUEST_DATE,SAMPLE_NUMBER,SCREENING_NUMBER,MATERIAL_TYPE,COLLECTION_DATE, SAMPLE_KIT_ID KIT_RANDO, KIT_NUMBER_VALUE KIT_SITE 
                FROM $this->shipment.V_MATERIALS_REQUESTED VMR LEFT JOIN
                (SELECT RF.PATIENT_NUMBER, RF.SAMPLE_KIT_ID, KN.KIT_NUMBER_VALUE FROM $this->lab.RECEIVED_FILES RF 
                JOIN $this->lab.PATIENTS PAT ON PAT.SCREENING_NUMBER=RF.PATIENT_NUMBER 
                LEFT JOIN $this->lab.KIT_NUMBER KN ON PROPERTY_VALUE= PAT.PATIENT_ID 
                GROUP BY RF.PATIENT_NUMBER, RF.SAMPLE_KIT_ID, KN.KIT_NUMBER_VALUE) KN 
                ON KN.PATIENT_NUMBER = SCREENING_NUMBER 
                    WHERE PARCEL_ID=:PARCELID  AND SAMPLE_ID IN ($listOfSamples)  AND VISIT_NAME <>'SCREENING'
                GROUP BY SAMPLE_ID,REQUEST_DATE,SAMPLE_NUMBER,SCREENING_NUMBER,MATERIAL_TYPE,COLLECTION_DATE, SAMPLE_KIT_ID,
                KIT_NUMBER_VALUE ORDER BY SCREENING_NUMBER, SAMPLE_ID";
            $oCommand = $labConn->createCommand($sql);
            $parcelID=0;
            // Bind the parameter
            $oCommand->bindParam(':PARCELID', $parcelID, PDO::PARAM_INT);
            $valueToReturn=$oCommand->queryAll(); // Run query and get all results
        }
        return $valueToReturn ;
    }
    
    public function getShipmentContentPDF ($parcelID)
    {
        $labConn = Yii::app()->dbBiotracking;
        $sql=" SELECT CENTRE_ID,SAMPLE_ID,SAMPLE_NUMBER,SCREENING_NUMBER,MATERIAL_TYPE, SAMPLE_KIT_ID KIT_RANDO, KIT_NUMBER_VALUE KIT_SITE, VISIT_NAME 
            FROM $this->shipment.V_MATERIALS_REQUESTED VMR LEFT JOIN
            (SELECT RF.PATIENT_NUMBER, RF.SAMPLE_KIT_ID, KN.KIT_NUMBER_VALUE FROM $this->lab.RECEIVED_FILES RF 
            JOIN $this->lab.PATIENTS PAT ON PAT.SCREENING_NUMBER=RF.PATIENT_NUMBER 
            LEFT JOIN $this->lab.KIT_NUMBER KN ON PROPERTY_VALUE= PAT.PATIENT_ID 
            GROUP BY RF.PATIENT_NUMBER, RF.SAMPLE_KIT_ID, KN.KIT_NUMBER_VALUE) KN 
            ON KN.PATIENT_NUMBER = SCREENING_NUMBER 
                WHERE PARCEL_ID=:PARCELID  AND VISIT_NAME <>'SCREENING'
            GROUP BY CENTRE_ID,SAMPLE_ID,SAMPLE_NUMBER,SCREENING_NUMBER,MATERIAL_TYPE, SAMPLE_KIT_ID, KIT_NUMBER_VALUE,VISIT_NAME 
                ORDER BY SCREENING_NUMBER, SAMPLE_ID, VISIT_NAME";
        
        $oCommand = $labConn->createCommand($sql);
        // Bind the parameter
        $oCommand->bindParam(':PARCELID', $parcelID, PDO::PARAM_INT);
        return $oCommand->queryAll(); // Run query and get all results
    }
    
}

?>
