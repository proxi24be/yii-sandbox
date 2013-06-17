<?php

/* The followings are the available columns in table 'V_PATIENTS':
 * @property integer $STUDY_ID
 * @property string $STUDY
 * @property string $COUNTRY_ID
 * @property integer $COUNTRY
 * @property string $CENTRE_ID
 * @property string $CENTRE
 * @property date $PATIENT_ID
 * @property integer $SCREENING_NUMBER
 * @property string $APPROVAL
 */

class VPatients extends MyShipmentActiveRecord {
    

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Addresses the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


      public function getDbConnection()
    {
        return self::getShipmentDbConnection();
    }


/**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'V_PATIENTS';
    }


}




?>