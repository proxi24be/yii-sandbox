<?php

class DateFormatterTest extends CTestCase

{
    public function testStrToTimeFormatDDMMMYYYY()
    {
        $unixTime=strtotime("07-mar-2010");
        $this->assertTrue($unixTime !== false);
        $this->assertTrue (is_numeric($unixTime));
    }
    public function testStrToTimeFormatDDMMMYYYY_2()
    {
        $unixTime=strtotime("07/mar/2010");
        $this->assertTrue($unixTime === false);
    }
    public function testStrToTimeFormatDDMMMYYYY_3()
    {
        $timestamp=CDateTimeParser::parse('21/10/2008','dd/MM/yyyy');
        $this->assertTrue($timestamp !== false);
    }

    public function testStrToTimeFormatDDMMMYYYY_4()
    {
        $timestamp=CDateTimeParser::parse('08/03/2013 13:31:46','dd/MM/yyyy');
        $this->assertTrue($timestamp === false);
        $this->assertTrue (!is_numeric($timestamp));
    }

}

