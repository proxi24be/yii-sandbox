<?php

class MySampleFormAttributes
{
    private $_studyID, $_visitName, $_conditioning, $_studyName;

    public function __construct(array $values)
    {
        $this->_studyID = $values['STUDY_ID'];
        $this->_studyName = $values['studyName'];
        $this->_visitName = strtoupper($values['VISIT_NAME']);

        if (array_key_exists('CONDITIONING', $values))
            $this->_conditioning = strtoupper($values['CONDITIONING']);
    }

    public function getAttributes($materialID = null)
    {
        $attributesToReturn = $this->getAttributesArray();
        $attributesToReturn["valuesInDB"] = $this->getAttachedValues();
        if (empty($materialID)) // The sample has not been created yet.
        {

        }
        else // The sample exists in the db therefore we need to fetch information attached to that sample.
        {

        }

        return $attributesToReturn;
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
            $rows = VMaterialTypeProperties::getValues($this->_studyID, "FIXATIVES");

            if ("SCREENING" == $this->_visitName || "RECURRENCE" == $this->_visitName)
            {
                if (0 == count($filter))
                    $filter = array("FORMALIN", "OTHER");

                return MyGenericValue::filteredByGenericValue($rows, $filter, 'FIXATIVES');
            }
            else if ("RANDOMISATION" == $this->_visitName && "FROZEN" == $this->_conditioning)
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
        return VMaterialTypeProperties::getValues($this->_studyID, "MATERIAL_STATE");
    }

    public function getCountries()
    {
        return VCountryFiltered::getCountries($this->_studyName);
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