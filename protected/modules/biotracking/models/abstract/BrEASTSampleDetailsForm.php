<?php
/**
 * Created by JetBrains PhpStorm.
 * User: trann
 * Date: 11/01/13
 * Time: 11:06
 */

abstract class BrEASTSampleDetailsForm extends CFormModel
{
    public $VISIT_ID;
    public $visitName;
    public $sampleType;
    public $MATERIAL_TYPE_ID;
    public $studyId;

    private $_listTemperature = array("-20C", "-70C or below");
    private $_studyName;

    protected function beforeValidate()
    {
        $this->_studyName = 12 == $this->studyId ? "APHINITY" : "to define";

        $visits = Visits::model()->cache(Yii::app()->params["cacheTime"])->findByPk((int)$this->VISIT_ID);
        if (null == $visits)
            throw new Exception("BrEASTSampleDetailsForm visit object not found !");

        $this->visitName = $visits->VISIT_NAME;

        $sampleType = MaterialTypes::model()->cache(Yii::app()->params["cacheTime"])->findByPk((int)$this->MATERIAL_TYPE_ID);
        if (null == $sampleType)
            throw new Exception("BrEASTSampleDetailsForm sampleType object not found !");

        $this->sampleType = $sampleType->DESCRIPTION;

        return parent::beforeValidate();
    }

    public function rules()
    {
        return array(
            array("VISIT_ID, MATERIAL_TYPE_ID, studyId", "safe")
        );
    }

    public function attributeLabels()
    {
        return array(
            "visitName" => "Visit",
            "sampleType" => "Sample type"
        );
    }

    public function getListTemperature()
    {
        return $this->_listTemperature;
    }

    public function getListCountry()
    {
        return VCountryFiltered::getCountries($this->_studyName);
    }

    public function getListValueOfProperty($propertyName)
    {
        return VMaterialTypeProperties::getValues($this->studyId, $propertyName);
    }

}
