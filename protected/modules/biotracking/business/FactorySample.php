<?php
/**
 * Created by JetBrains PhpStorm.
 * User: trann
 * Date: 14/01/13
 * Time: 12:37
 */

namespace application\modules\biotracking\business;
use application\modules\biotracking\business\sample as MySample;
use Exception, stdClass, VMaterialTypeProperties;

/**
 * Class FactorySample
 */
class FactorySample
{
    private $_materialTypeProperties;
    private $_json;

    /**
     * @param \stdClass $json
     * @throws \Exception
     */
    public function __construct(stdClass $json)
    {
        $this->_json = $json;
        if (!isset($this->_json->STUDY_ID))
            throw new Exception ("Cannot determine the study ID ! Please note the property is key sensitve.");

        if (!isset($this->_json->sampleType->MATERIAL_TYPE))
            throw new Exception ("Cannot determine which sample object to instantiate !");

        $this->_materialTypeProperties
            = VMaterialTypeProperties::getPropertiesOfSampleType(
                $this->_json->sampleType->MATERIAL_TYPE, $this->_json->STUDY_ID);
    }

    /**
     * @return array of activeRecord
     */
    public function getMaterialTypeProperties()
    {
        return $this->_materialTypeProperties;
    }

    /**
     * @return Blood|Serum|Tissue
     */
    public function getSampleInstance()
    {
        if (12 == $this->_json->STUDY_ID)
            return $this->sampleAphinity($this->_json->sampleType->DESCRIPTION, $this->_materialTypeProperties);
    }

    private function sampleAphinity($materialType, $materialTypeProperties)
    {
        $materialType = strtolower($materialType);
        if ('tissue' == $materialType)
            $sample = new MySample\Tissue ($this->_json, $materialTypeProperties);

        else if (('serum' == $materialType) || ('plasma' == $materialType))
            $sample = new MySample\Serum ($this->_json, $materialTypeProperties);

        else if ('blood' == $materialType)
            $sample = new MySample\Blood ($this->_json, $materialTypeProperties);
        else
            throw new Exception ('unknown sample type');

        return $sample;
    }
} //FactorySample
