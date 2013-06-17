<?php

class ParcelCentreSamples{

    private $parcelCentre;
    private $centreSamples;
    private $arrParcelID;
    private $arrCentreID;
    private $errorMsg;

    public function __construct ()
    {
        $this->parcelCentre= array();
        $this->centreSamples= array();
        $this->arrParcelID=array();
        $this->arrCentreID=array();
    }

    public function addCentreSamples ($centreID, $sampleID)
    {
        $this->centreSamples[$centreID][]=$sampleID;
    }

    public function addParcelCentre($parcelID,$centreID)
    {
        $this->parcelCentre[$parcelID]=$centreID;
        $this->arrParcelID[]=$parcelID;
    }

    public function getCentreSamples()
    {
        return $this->centreSamples;
    }

    public function getParcelID()
    {
        return $this->arrParcelID;
    }

    public function getCentreID()
    {
        return $this->arrCentreID;
    }

    public function getSamples($parcelID)
    {
        $centreID = $this->parcelCentre[$parcelID];
        return $this->centreSamples[$centreID];
    }

    public function addErrorMsg($errorMsg)
    {
        $this->errorMsg=$errorMsg;
    }

    public function getParcelCentre ()
    {
        return $this->parcelCentre;
    }
    
}

?>