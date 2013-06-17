<?php
/**
 * User: TRANN
 * Date: 3/29/13
 * Time: 12:49 PM
 */

namespace application\modules\biotracking\business;

use Yii, Exception, CFormModel, VCentresAddress, MyException;
use Patients, VMaterialTypeProperties, VCountryFiltered, MyGenericValue;

class BrEASTSampleDetailsFormAbstract extends CFormModel {

    public $PATIENT_ID, $MATERIAL_TYPE_ID, $VISIT_ID, $CENTRE_ID, $VISIT_NAME;

    public $COLLECTION_DATE, $MATERIAL_STATE;
    // tissue.
    public $LOCAL_ID, $CONDITIONING, $LATERALITY, $FIXATIVES;
    public $ADDRESS_STREET, $ADDRESS_CITY, $ADDRESS_STATE, $ADDRESS_POSTCODE, $COUNTRY_ID;

    public $MATERIAL_ID;
    public $STUDY_ID;
    public $studyName;

    public function rules()
    {
        $rules= array(
            array("PATIENT_ID, VISIT_ID, MATERIAL_TYPE_ID, userID, CENTRE_ID, STUDY_ID, VISIT_NAME", "required"),
            array
            (
                'LOCAL_ID, CONDITIONING, LATERALITY, FIXATIVES, ADDRESS_STREET, ADDRESS_CITY, ADDRESS_STATE,
                ADDRESS_POSTCODE, COUNTRY_ID', 'required', 'on' => 'tissue'
            ),
            array('MATERIAL_ID, studyName, MATERIAL_STATE, COLLECTION_DATE', 'safe'),
        );
        return $rules;
    }

    public function getBusinessAttributes()
    {
        $attributesToReturn = $this->getAttributesArray();
        $attributesToReturn["valuesInDB"] = $this->getAttachedValues();
        if (!isset($this->MATERIAL_ID)) // The sample has not been created yet.
        {

        }
        else // The sample exists in the db therefore we need to fetch information attached to that sample.
        {

        }

        return $attributesToReturn;
    }


    /**
     * @return \CActiveRecord
     * @throws \MyException
     */
    public function getReturnAddress()
    {
        $cacheTime = Yii::app()->params["cacheTime"];

        $patient = Patients::model()->cache($cacheTime)->find('PATIENT_ID = :patientID', array(':patientID' => $this->PATIENT_ID));
        if (null == $patient)
            throw new MyException("Centre not found for patient ID: $this->PATIENT_ID");
        else
        {
            if (isset($this->MATERIAL_ID))
                throw new MyException('return address not implemented yet.');
            else
                return VCentresAddress::model()->cache($cacheTime)->find("CENTRE_ID = :centreID", array(":centreID" => $patient->CENTRE_ID));
        }
    }

    public function getTemperatures()
    {
        $temperatures = array();
        $temperatures[] = array("TEMPERATURE" => "-20C");
        $temperatures[] = array("TEMPERATURE" => "-70C or below");

        return $temperatures;
    }

    public function getFixatives($filter = array())
        // fixatives attributes are only for TISSUE sample
    {
        $rows = array();
        try
        {
            $rows = VMaterialTypeProperties::getValues($this->STUDY_ID, "FIXATIVES");

            if ("SCREENING" == $this->VISIT_NAME || "RECURRENCE" == $this->VISIT_NAME)
            {
                if (0 == count($filter))
                    $filter = array("FORMALIN", "OTHER");

                return MyGenericValue::filteredByGenericValue($rows, $filter, 'FIXATIVES');
            }
            else if ("RANDOMISATION" == $this->VISIT_NAME && "FROZEN" == $this->CONDITIONING)
            {
                if (0 == count($filter))
                    $filter = array("RNA LATER", "OTHER", "LIQUID NITROGEN", "OPTIMUM CUTTING TEMPERATURE (O.C.T.)");

                return MyGenericValue::filteredByGenericValue($rows, $filter, 'FREEZING_PROCEDURE');
            }
            else
                throw new Exception('unknown business rules');
        }
        catch (Exception $e)
        {
            Yii::trace($e->getMessage(), "breast.business.form");
            return $rows;
        }
    }

    public function getSampleStates()
    {
        return VMaterialTypeProperties::getValues($this->STUDY_ID, "MATERIAL_STATE");
    }

    public function getCountries()
    {
        return VCountryFiltered::getCountries($this->studyName);
    }

    /**
     * In a perfect world one should test if all the below attributes are required instead of fetching all the attributes without distinction.
     * However thanks to the cache system there are no overloading for the database.
     * You should consider to add some test control in case of you are not using any cache system.
     */
    private function getAttributesArray()
    {
        $attributesToReturn = array();
        $attributesToReturn["fixatives"] = $this->getFixatives();
        $attributesToReturn["temperatures"] = $this->getTemperatures();
        $attributesToReturn["sampleStates"] = $this->getSampleStates();
        $attributesToReturn["countries"] = $this->getCountries();
        $attributesToReturn["returnAddress"] = $this->getReturnAddress();

        return $attributesToReturn;
    }

    /**
     *
     */
    private function getAttachedValues()
    {
        $mapping = array();
        $mapping["localID"] = array("ngModel" => "pathological");
        $mapping["cryovialsNumber"] = array("ngModel" => "cryovials");
        $mapping["withdrawalTime"] = array("ngModel" => "withdrawalTime");
        $mapping["collectionDateDDMMMYYYY"] = array("ngModel" => "collectionDateDDMMMYYYYSelected");
        $mapping["otherFreezingProcedure"] = array("ngModel" => "otherFreezingProcedureSelected");
        $mapping["comment"] = array("ngModel" => "comment");
        $mapping["addressStreet"] = array("ngModel" => "street");
        $mapping["addressCity"] = array("ngModel" => "city");
        $mapping["addressState"] = array("ngModel" => "state");
        $mapping["addressPostcode"] = array("ngModel" => "postcode");
        $mapping["temperatures"] = array("ngModel" => "temperature");

        // The attribute inArray tell us the model needs to be searched in a list of predefined values
        $mapping["fixatives"] = array("ngModel" => "fixative", "inArray" => true);
        $mapping["countries"] = array("ngModel" => "country", "inArray" => true);
        $mapping["sampleStates"] = array("ngModel" => "sampleState", "inArray" => true);

        return $mapping;
    }

}