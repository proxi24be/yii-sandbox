<?php
/**
 * User: TRANN
 * Date: 3/19/13
 * Time: 1:55 PM
 */

Yii::import('application\modules\biotracking\business');
use application\modules\biotracking\business as MyBusiness;


class AttributeToCollectTest extends CTestCase {

    private $_instance;

    protected function setup ()
    {
        $this->_instance=new MyBusiness\AttributeToCollect('patient');
    }

    public function testInitObject ()
    {
        $this->assertTrue(null !== $this->_instance);
    }

    public function testGetColumn ()
    {
        $this->_instance->addColumnNameInDb('PATIENT_ID');
        $this->assertEquals('PATIENT_ID', $this->_instance->getColumnNameInDb());
    }

}