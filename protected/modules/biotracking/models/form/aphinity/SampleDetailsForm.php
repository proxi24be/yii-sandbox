<?php

class SampleDetailsForm extends BrEASTSampleDetailsForm
{
    public $PATIENT_ID;
    public $MATERIAL_TYPE_ID;
    public $VISIT_ID;
    public $patientNumber;
    public $birthdate_dd_mmm_yyyy;
    public $birthdate_dd_mm_yyyy;
    public $center;
    public $CONDITIONING;
    public $LATERALITY;
    public $SAMPLE_NUMBER;
    public $KIT_NUMBER_ID;
    public $blood_technical;
    public $endTaxanes;
    public $MATERIAL_ID;

    public $LOCAL_ID;
    public $CRYOVIALS_NUMBER;
    public $TEMPERATURE;
    public $collection_date_dd_mmm_yyyy;
    public $COLLECTION_DATE_DD_MM_YYYY;
    public $FIXATIVES;
    public $OTHER_FREEZING_PROCEDURE;
    public $MATERIAL_STATE;
    public $COMMENT;
    public $WITHDRAWAL_TIME;

    public $ADDRESS_STREET;
    public $ADDRESS_CITY;
    public $ADDRESS_STATE;
    public $ADDRESS_POSTCODE;
    public $COUNTRY_ID;


    protected function beforeValidate()
    {
        $vPatient=VPatients::model()->find("PATIENT_ID=:PATIENTID",array(":PATIENTID"=>(int)$this->PATIENT_ID));
        if (null!=$vPatient)
        {
            $this->patientNumber=$vPatient->SCREENING_NUMBER;
            $this->center=$vPatient->CENTRE_DESCRIPTION;
        }

        $this->setReturnAddress();
        parent::beforeValidate();
    }

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        $rules= array(
            array("CONDITIONING, LATERALITY, birthdate_dd_mmm_yyyy, PATIENT_ID, SAMPLE_NUMBER, VISIT_ID, MATERIAL_TYPE_ID","required"),
            array("birthdate_dd_mm_yyyy, KIT_NUMBER_ID, blood_technical, endTaxanes, MATERIAL_ID","safe"),
        );

        $parentRules=parent::rules();
        $rules[]=$parentRules[0];

        return $rules;
    }

    public function attributeLabels()
    {
        return array(
            "patientNumber"=>"Patient number",
            "birthdate_dd_mmm_yyyy"=>"Patient birthdate",
            "center"=>"Center",
            "visitName"=>"Visit",
            "sampleType"=>"Sample type",
            "CONDITIONING"=>"Conditioning",
            "LATERALITY"=>"Laterality",
            "SAMPLE_NUMBER"=>"Sample number",
            "LOCAL_ID"=>"Local pathological ID",
            "CRYOVIALS_NUMBER"=>"Number of cryovials",
            "TEMPERATURE"=>"Storage temperature",
            "collection_date_dd_mmm_yyyy"=>"Collection date",
            "FIXATIVES"=>"Fixative",
            "OTHER_FREEZING_PROCEDURE"=>"If other, please specify",
            "MATERIAL_STATE"=>"Sample state",
            "COMMENT"=>"Comment",
            "ADDRESS_STREET"=>"Street",
            "ADDRESS_CITY"=>"City",
            "ADDRESS_STATE"=>"State",
            "ADDRESS_POSTCODE"=>"Postcode",
            "COUNTRY_ID"=>"Country"
        );
    }

    private function setReturnAddress()
    {
        // update
        if (!empty ($this->MATERIAL_ID))
        {

        }
        else
        {
            $vCentresAddress=VCentresAddress::model()->cache(Yii::app()->params["cacheTime"])->find("CENTRE=:CENTRE",array(":CENTRE"=>$this->center));
            if (null != $vCentresAddress)
            {
                $this->ADDRESS_CITY=$vCentresAddress->ADDRESS_CITY;
                $this->ADDRESS_POSTCODE=$vCentresAddress->ADDRESS_POSTCODE;
                $this->ADDRESS_STREET=$vCentresAddress->ADDRESS_STREET;
                $this->ADDRESS_STATE=$vCentresAddress->ADDRESS_STATE;
                $this->COUNTRY_ID=$vCentresAddress->COUNTRY_ID;
            }
        }
    }

}