<?php
/**
 * User: TRANN
 * Date: 3/30/13
 * Time: 7:36 PM
 */

namespace application\modules\biotracking\business;

use Yii, VMaterialTypeProperties, CDbCriteria;

class DataToCollect {

    private $_studyID;
    private $_sampleType;

    public function __construct($studyID, $sampleType = null) {
        $this->_studyID = $studyID;
        $this->_sampleType = $sampleType;
        $this->_createProperties();
    }

    /**
     *  Create dynamically the properties of the object.
     */
    private function _createProperties() {

        $cacheTime = Yii::app()->params['cacheTime'];
        $cdbCriteria = new CDbCriteria();
        $cdbCriteria->select = 'PROPERTY';
        $cdbCriteria->distinct = true;
        $cdbCriteria->condition = 'STUDY_ID = :studyID';
        $cdbCriteria->params = array(":studyID" => $this->_studyID);
        $properties = VMaterialTypeProperties::model()->cache($cacheTime)->findAll($cdbCriteria);

        foreach ($properties as $property)
        {
            $newProperty = $property->PROPERTY;
            $this->$newProperty = $newProperty;
        }
    }

}