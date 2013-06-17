<?php
/**
 * User: TRANN
 * Date: 3/30/13
 * Time: 7:47 PM
 */

Yii::import('application\modules\biotracking\business');
Yii::import('application.modules.biotracking.models.*');
use application\modules\biotracking\business as MyBusiness;


class DataToCollectTest extends CTestCase {

    private $_instance;

    public function setup() {
        $this->_instance = new MyBusiness\DataToCollect(12);
    }

    public function testInstanceExist() {
        $this->assertTrue($this->_instance != null);
    }

    public function testPropertyExist() {
        $this->assertTrue(property_exists($this->_instance, 'SAMPLE_NUMBER'));
        $this->assertFalse(property_exists($this->_instance, 'myProperty'));
        $this->assertEquals('TEMPERATURE', $this->_instance->TEMPERATURE);
        $this->_instance->myArray = array();
        $this->_instance->myArray['test'] = 'test';

        print_r(get_object_vars($this->_instance));
    }

}