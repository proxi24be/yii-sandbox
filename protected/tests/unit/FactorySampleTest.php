<?php
/**
 * User: TRANN
 * Date: 3/31/13
 * Time: 11:40 PM
 */
Yii::import('application.modules.biotracking.models.*');
Yii::import('application.modules.biotracking.models.custom.*');
Yii::import('application.modules.biotracking.models.abstract.*');
include_once('FactorySample.php');

class FactorySampleTest extends CDbTestCase {

    private $_jsonObject;

    protected function setup()
    {
        $json = '{"patient":{"PATIENT_ID":"250518","SCREENING_NUMBER":"2089220006","BIRTHDATE":"27-03-2013"},
        "visit":{"VISIT_ID":"442","VISIT_NAME":"SCREENING","VISIT_INTERVAL":"0"},
        "sampleType":{"MATERIAL_TYPE":"54","DESCRIPTION":"TISSUE"},"SAMPLE_NUMBER":"101",
        "conditioning":{"CONDITIONING":"PARAFFIN EMBEDDED"},"laterality":{"LATERALITY":"RIGHT"},
        "birthdate":{"ddmmmyyyy":"27/Mar/2013"},"local_id":{"LOCAL_ID":"test selenium local id"},
        "fixative":{"FIXATIVES":"FORMALIN"},"comment":{"COMMENT":"no comment"},
        "country":{"COUNTRY_ID":"21","COUNTRY":"BELGIUM"},
        "returnAddress":{"ADDRESS_STREET":"bordet 1234","ADDRESS_CITY":"brussels","ADDRESS_POSTCODE":"1000"},
        "collection_date":{"COLLECTION_DATE":"30/Mar/2013"}}';

        $this->_jsonObject = json_decode($json);
    }

    public function testInstanceTissue()
    {
        $factorySample = new FactorySample(12, $this->_jsonObject);
        $this->assertTrue($factorySample->createSample() instanceof Tissue);
    }

}