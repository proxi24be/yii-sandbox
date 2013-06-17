<?php
/**
 * User: TRANN
 * Date: 3/21/13
 * Time: 12:18 AM
 */

class MyMapTest extends CTestCase
{
    private $_myMap;

    public function setup()
    {
        $this->_myMap = array();
        $this->_myMap['patient'] = 'patient';
        $this->_myMap['patient id'] = 'patient id';
    }

    public function testThrowExceptionIfKeysDoesNotExist()
    {
        $keys = array('patient', 'patient id');
        $valuesFound = array();
        try
        {
            $valuesFound = MyMap::fetchAttributes($keys, $this->_myMap);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }

        $this->assertEquals($valuesFound, $this->_myMap);
    }

}