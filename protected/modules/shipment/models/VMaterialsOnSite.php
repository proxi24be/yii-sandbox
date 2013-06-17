<?php

/* The followings are the available columns in table 'ADDRESSES':
 * @property integer $MATERIAL_ID
 * @property integer $PARENT_ID
 * @property string $SAMPLE_NUMBER
 * @property string $TEMPERATURE
 * @property integer $MATERIAL_TYPE_ID
 * @property string $MATERIAL_TYPE
 * @property string $CRYOVIALS_NUMBER
 * @property date $COLLECTION_DATE
 * @property integer $PATIENT_ID
 * @property string $SCREENING_NUMBER
 * @property integer $CENTRE_ID
 * @property string $CENTRE
 * @property integer $VISIT_ID
 * @property string $VISIT_NAME
 * @property integer $STUDY_ID
 * @property string $STUDY
 * @property integer $LOCATION_ID
 * @property string $LOC_TYPE_ID
 * @property string $COUNTRY
 * @property integer $COUNTRY_ID
 */


class VMaterialsOnSite extends MyShipmentActiveRecord {
        
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
        return 'V_MATERIALS_ON_SITE';
    }
    
}



?>