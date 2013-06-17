<?php

class ConsoleTest extends CTestCase
{
    
    public function testSuccess()
    {
        $this->assertEquals("ok","ok");

        echo date('Y-m-d H:i:s');
    }

}