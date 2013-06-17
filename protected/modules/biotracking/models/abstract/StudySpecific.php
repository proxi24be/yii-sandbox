<?php


/**
 * Class StudySpecific
 */
abstract class StudySpecific
{
    protected $_properties;

    public function __construct()
    {
        $this->_properties=array();
    }

    public function getProperties()
    {
        return $this->_properties;
    }

    public function setProperties(array $properties)
    {
        $this->_properties = $properties;
    }

    /**
     * @param  array $valuesToSave
     * @return boolean : true if the operation end successfully otherwise false
     */
    public abstract function saveValues(array $valuesToSave);

}

class AphinityStudySpecific extends StudySpecific
{
    public function __construct()
	{
        parent::__construct();
        $this->setProperties(DataToCollect::factory("aphinity"));
	}

	public function saveValues(array $valuesToSave)
	{
        $checkIfAllSpecificPropertyExist=$this->checkIfAllSpecificPropertyExist($valuesToSave);
        if (! $checkIfAllSpecificPropertyExist)
            throw new Exception ("required attribute(s) is/are missing !");
	}

    public function checkIfAllSpecificPropertyExist($valuesToSave)
    {
        foreach ($this->_properties as $property)
        {
            ;
        }

        return false;
    }
}
