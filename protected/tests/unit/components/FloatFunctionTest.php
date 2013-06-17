<?php


class FloatFunctionTest extends CTestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testFloatFunctionCase1()
    {
        $a="99";
        $b="099";
        
        $this->assertEquals(floatval($a),99);
        $this->assertEquals(floatval($b),99);
    }
    
    public function testFloatFunctionCase2()
    {
        $a="-5";
        $b="+5";
        
        $this->assertGreaterThanOrEqual(floatval($a),0.01);
        $this->assertGreaterThanOrEqual(0.01,floatval($b));
    }
    
    public function testFloatFunctionCase6()
    {
        $a="0.03";
        $b="0.045";
        $this->assertGreaterThanOrEqual(0.01,floatval($a));
        $this->assertGreaterThanOrEqual(0.01,floatval($b));
    }
}