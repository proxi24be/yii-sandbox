<?php

class MyParcels {
    
    private $tabSampleID;
    private $LOCTYPEIDFROM = 2;
    private $PARCELSTATUSID= 1;

    public function __construct(array $tabSampleID)
    {
        $this->tabSampleID=$tabSampleID;
    }

    /*
    *   return array multidimensional 
    */
    public function createParcel ()
    {
        $parcelCentreSamples = $this->groupByCentreID($this->tabSampleID);
        $logsErrors = array();
        $centres = $parcelCentreSamples->getCentreSamples();
        foreach($centres as $centreID => $arr)
        {
            $parcelID=$this->getParcelID($centreID);
            $parcelCentreSamples->addParcelCentre($parcelID,$centreID);
        }
        
        return $parcelCentreSamples;
    }


    public function attachSampleToParcels (ParcelCentreSamples $parcelCentreSamples)
    {
        $tabParcelID = array();
        $parcels = $parcelCentreSamples->getParcelID();
        foreach ($parcels as $parcelID)
        {
            $samples = $parcelCentreSamples->getSamples($parcelID);
            foreach($samples as $sampleID)
            {
                ParcelSamples::model()->updateAll(array("PARCEL_ID"=>$parcelID, "REQUEST_DATE_SHIPMENT"=>new CDbExpression("SYSDATE")),"PARCEL_ID=0 AND SAMPLE_ID=:SAMPLEID",array(":SAMPLEID"=>$sampleID) );
                $tabParcelID[$parcelID]=$parcelID;
            }
        }
        return $tabParcelID; 
    }


    private function groupByCentreID (array $tabSampleID)
    {
        $parcelCentreSamples = new ParcelCentreSamples;
        foreach ($tabSampleID as $sampleID)
        {
            $sample=VMaterialsRequested::model()->find("SAMPLE_ID=:SAMPLE_ID",array(":SAMPLE_ID"=>$sampleID));
                if ($sample != null)
                     $parcelCentreSamples->addCentreSamples($sample->CENTRE_ID,$sampleID);
        }

        return $parcelCentreSamples;
    }

    private function getParcelID ($centreID)
    {
        $parcelDetails = new ParcelDetails;
        $parcelDetails->USER_CREATED= Yii::app()->user->getID();
        $parcelDetails->PARCEL_STATUS_ID = $this->PARCELSTATUSID;
        $parcelDetails->DATE_CREATION= new CDbExpression("SYSDATE");
        $parcelDetails->DATE_REQUEST_SHIPMENT= new CDbExpression("SYSDATE");
        $parcelDetails->LOC_ID_FROM=$centreID;
        $parcelDetails->LOC_TYPE_ID_FROM= $this->LOCTYPEIDFROM; 
        $parcelDetails->LOC_ID_TO=109;
        $parcelDetails->LOC_TYPE_ID_TO= 1;
        if ($parcelDetails->save())
            $parcelID=$parcelDetails->getPrimaryKey();        
        
        return $parcelID;
    }


}



?>