<?php 


class VUserRegistrationTest extends CDbTestCase
{
    public $record; 
    public function setUp()
    {
        $username="TRANNO@IT";
        $password="test1234";
        $this->record=VUserRegistration::model()->find("username=:username and password=:password", array(":username"=>$username,":password"=>md5($password)));
    }

    public function setDown()
    {

    }

    public function testConnectionToDB()
    {
        $this->assertTrue(null!=$this->record);
    }

    public function testUsername()
    {
        $this->assertEquals("TRANNO@IT",$this->record->USERNAME);
        $this->assertNotEquals("jdoe",$this->record->USERNAME);
    }
}


?>