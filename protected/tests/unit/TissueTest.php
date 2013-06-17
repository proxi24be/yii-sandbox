<?php
/**
 * User: TRANN
 * Date: 4/1/13
 * Time: 11:22 AM
 */

Yii::import('application.modules.biotracking.models.*');
use application\modules\biotracking\business as MyBusiness;
use application\modules\biotracking\business\sample\Tissue;

class TissueTest extends CDbTestCase
{

    public $fixtures = array(
        'prelevement' => 'Prelevement',
    );

    private $_factorySample;

    public function setup()
    {
        try
        {
            $object = new stdClass();
            $object->STUDY_ID = 12;
            $object->USER_ID = 54;
            $object->SAMPLE_NUMBER = '101';
            $object->COMMENT = 'hello the world';

            $conditioning = new stdClass();
            $conditioning->CONDITIONING = 'PARAFFIN EMBEDDED';

            $laterality = new stdClass();
            $laterality->LATERALITY = 'LEFT';

            $address = new stdClass();
            $address->ADDRESS_STREET = '121 bordet';
            $address->ADDRESS_CITY = 'Brussels';
            $address->ADDRESS_POSTCODE = '';
            $address->ADDRESS_STATE = 'Bruxelles capital';
            $address->COUNTRY_ID = 21;

            $visit = new stdClass();
            $visit->VISIT_ID = 442;
            $visit->VISIT_NAME = 'SCREENING';

            $patient = new stdClass();
            $patient->PATIENT_ID = 250518;
            $patient->SCREENING_NUMBER = '2089220006';
            $patient->BIRTHDATE = '27-03-2013';
            $patient->ddmmmyyyy = '27-Mar-2013';

            $newSampleType = new stdClass();
            $newSampleType->MATERIAL_TYPE = 54;
            $newSampleType->DESCRIPTION = 'TISSUE';

            $object->sampleType = $newSampleType;
            $object->visit = $visit;
            $object->patient = $patient;
            $object->conditioning = $conditioning;
            $object->laterality = $laterality;
            $object->address = $address;

            $this->_factorySample = new MyBusiness\FactorySample($object);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function testInstance()
    {
        $this->assertTrue($this->_factorySample != null);

        $tissue = $this->_factorySample->getSampleInstance();
        $this->assertTrue($tissue instanceof Tissue);

        $materialTypeProperties = $tissue->getMaterialTypeProperties();
        $properties = array();
        foreach ($materialTypeProperties as $materialTypeProperty)
            $properties[] = $materialTypeProperty->PROPERTY;

        $expected = array('COLLECTION_TIME', 'CONDITIONING', 'FIXATIVES', 'LATERALITY', 'LOCAL_ID', 'MATERIAL_STATE', 'SAMPLE_NUMBER');
        sort($properties);
        $this->assertEquals($expected, $properties);
    }

    public function testInsertIntoMaterials()
    {
        $tissue = $this->_factorySample->getSampleInstance();
        $tissue->createSampleInformation();
        $this->assertTrue(isset($tissue->materialID));

        $materials = Materials::model()->findByPk($tissue->materialID);
        $this->assertNotNull($materials);
    }

    public function testIntoIntoPrelevement()
    {
        $tissue = $this->_factorySample->getSampleInstance();
        $tissue->createSampleInformation();

        $materials = Materials::model()->findByPk($tissue->materialID);
        $prelevement = Prelevement::model()->findByPk($materials->PRELEVEMENT_ID);
        $this->assertNotNull($prelevement);
    }

    public function testInsertIntoMaterialDetails()
    {
        $tissue = $this->_factorySample->getSampleInstance();
        $tissue->createSampleInformation();
        $materialDetails = MaterialDetails::model()->findAllByAttributes(array('MATERIAL_ID' => $tissue->materialID));
        $this->assertTrue(count($materialDetails) > 0);
    }

    public function testInsertIntoReturnAddresses()
    {
        $tissue = $this->_factorySample->getSampleInstance();
        $tissue->createSampleInformation();
        $returnAddresses = ReturnAddresses::model()->findByAttributes(array('MATERIAL_ID' => $tissue->materialID));
        $this->assertNotNull($returnAddresses);
    }

    public function testInsertIntoMaterialLocation()
    {
        $tissue = $this->_factorySample->getSampleInstance();
        $tissue->createSampleInformation();
        $materialLocation = MaterialLocation::model()->findAllByAttributes(array('MATERIAL_ID' => $tissue->materialID));
        $this->assertTrue(count($materialLocation) > 0);
    }

}