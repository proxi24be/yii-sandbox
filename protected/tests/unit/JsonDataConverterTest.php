<?php
/**
 * User: TRANN
 * Date: 6/18/13
 * Time: 5:14 PM
 */

use \application\components\helper as helper;

class JsonDataConverterTest extends \CTestCase {

    public $dataConverter;
    public $input;

    public function testInitiate () {
        $this->dataConverter = new helper\JsonDataConverter('');
        $this->assertNotNull ($this->dataConverter);
    }

    public function testJsonEmpty () {
        $input = '';
        $this->dataConverter = new helper\JsonDataConverter($input);
    }

    public function testConstraintModelExist () {
        $input = '{"data": "name"}';
        $this->dataConverter = new helper\JsonDataConverter($input);
    }

    public function testConstraintDataExist () {
        $input = '{"model": "name"}';
        $this->dataConverter = new helper\JsonDataConverter($input);
    }

    public function testGetModelName () {
        $input = '{"model": "name", "data" : {} }';
        $this->dataConverter = new helper\JsonDataConverter($input);

        $this->assertEquals($this->dataConverter->getModelName(), "name");
    }

    public function testGetData () {
        $input = '{"model": "name", "data" : {} }';
        $this->dataConverter = new helper\JsonDataConverter($input);

        $this->assertTrue(count($this->dataConverter->getData()) == 0);
    }

    public function testGetDataOnSingleObject () {
        $input = '{"model": "name", "data" : {"ID":"45"} }';
        $this->dataConverter = new helper\JsonDataConverter($input);

        $this->assertEquals($this->dataConverter->getData()[0], array('ID' => '45'));
    }

    public function testGetDataOnMultipleObjects () {
        $input = '{"model": "name", "data" : [{"ID":"45"}, {"ID":"1"}] }';
        $this->dataConverter = new helper\JsonDataConverter($input);

        $expected = array();
        $expected[]['ID'] = 45;
        $expected[]['ID'] = 1;
        $this->assertEquals($expected, $this->dataConverter->getData());
    }

}
