<?php

Yii::import("application.modules.biotracking.models.abstract.*");
Yii::import("application.modules.biotracking.models.custom.*");
include_once("FactorySample.php");
include_once("StudySpecific.php");


class AphinityStudySpecificTest extends CTestCase
{
	private $_instance;
    private $_values;
	public function setup ()
	{
		try
		{
			$this->_instance = FactoryStudySpecific::getStudySpecific('Aphinity');
            $this->_values=array();
            $this->_values["kitNumberSelected"]=array("KIT_NUMBER_ID"=>"1234");
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			$this->_instance=null;
		}

	}
	public function testFactoryStudySpecific()
	{
		$this->assertTrue(null != $this->_instance);
	}

    public function testPropertiesToSaveIsNotNull()
    {
        $this->assertTrue(0 != count($this->_instance->getProperties()));
    }

    public function testPropertySampleKitIDExist()
    {
        $found = DataToCollect::ElementExist("KIT_NUMBER_ID",$this->_instance->getProperties());
        $this->assertTrue(false !== $found);
    }

    public function testIfAllSpecificPropertyExist()
    {
        $this->assertTrue ($this->_instance->checkIfAllSpecificPropertyExist($this->_values));
    }

    public function testSaveSpecificValue()
    {
        $this->assertTrue($this->_instance->saveValues($this->_values));
    }

}
