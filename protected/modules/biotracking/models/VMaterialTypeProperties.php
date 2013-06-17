<?php

class VMaterialTypeProperties extends MyBiotrackingActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ParcelDetails the static model class
     */
    public static function model($className = __CLASS__)
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
        return 'V_MATERIAL_TYPE_PROPERTIES';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array();
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @param $studyID
     * @param $propertyName
     * @return return an array, the array contains all the allowed values for the property send in paramater
     *
     */
    public static function getValues($studyID, $propertyName)
    {
        $cacheTime = Yii::app()->params['cacheTime'];
        $connection = Yii::app()->dbBiotracking;

        $sql = "SELECT GENERIC_VALUE TEXT, GENERIC_VALUE_ID ID FROM V_MATERIAL_TYPE_PROPERTIES WHERE STUDY_ID=:studyID AND  PROPERTY=:propertyName
            GROUP BY GENERIC_VALUE, GENERIC_VALUE_ID ORDER BY GENERIC_VALUE ASC";

        $command = $connection->cache($cacheTime)->createCommand($sql);
        $command->bindParam(":studyID", $studyID, PDO::PARAM_INT);
        $command->bindParam(":propertyName", $propertyName, PDO::PARAM_STR);

        return $command->queryAll();
    }

    public static function getPropertiesOfSampleType($materialTypeID, $studyID)
    {
        $criteria = new CDbCriteria;
        $criteria->select = "MATERIAL_TYPE, PROPERTY,PROPERTY_ID";
        $criteria->condition = "STUDY_ID=:STUDY_ID AND MATERIAL_TYPE_ID=:MATERIAL_TYPE_ID";
        $criteria->params = array(":STUDY_ID" => $studyID, ":MATERIAL_TYPE_ID" => $materialTypeID);
        $criteria->group = "MATERIAL_TYPE, PROPERTY,PROPERTY_ID";
        $criteria->order = "PROPERTY_ID ASC";

        return VMaterialTypeProperties::model()->cache(Yii::app()->params['cacheTime'])->findAll($criteria);
    }

}