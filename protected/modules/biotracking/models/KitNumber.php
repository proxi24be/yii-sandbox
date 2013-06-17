<?php

class KitNumber extends MyBiotrackingActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ParcelDetails the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getDbConnection()
    {
        return self::getBiotrackingDbConnection();
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'KIT_NUMBER';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(

        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    public static function saveKitNumber($userEntered, $patientID, $kitNumberID)
    {
        $kitNumber = new KitNumber();
        $kitNumber->PROPERTY_ID = 23;
        $kitNumber->PROPERTY_VALUE = $patientID;
        $kitNumber->USER_ENTERED = $userEntered;
        $kitNumber->KIT_NUMBER_VALUE = $kitNumberID;

        if (!$kitNumber->save())
            throw new Exception("An issue has occured during the saving of kit number.");

        return true;
    }
}