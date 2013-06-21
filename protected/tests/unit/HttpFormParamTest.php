<?php
/**
 * User: TRANN
 * Date: 6/21/13
 * Time: 12:44 PM
 */

use \application\components\helper as helper;

class HttpFormParamTest extends CDbTestCase {

    protected $httpParam ;

    public function setUp()
    {
        $this->httpParam = new helper\HttpFormParam();
    }

    public function testInit () {
        $this->assertNotNull ($this->httpParam);
    }

    /**
     * @expectedException \Exception
     */
    public function testInputNotArray () {
        $this->httpParam->setInput('hello the world');
        $this->httpParam->convert();
    }

    public function testInputIsArrayButNotMap () {
        try
        {
            $this->httpParam->setInput(array('model','data'));
            $this->httpParam->convert();
        }
        catch (Exception $e)
        {
            return;
        }
        $this->fail('An exception missing attribute model has not been raised up.');
    }

    public function testInputIsAMap () {
        $this->httpParam->setInput(array('model' => 'table', 'data' => 'string'));
        $this->assertTrue($this->httpParam->convert());
        $this->assertEquals('table', $this->httpParam->getModelName());
    }

    public function testData () {
        $this->httpParam->setInput(array('model' => 'table', 'data' => 'data'));
        $this->httpParam->convert();
        $this->assertEquals(array('data' => 'data'), $this->httpParam->getData());
    }
}