<?php

class VCountryFiltered extends MyBiotrackingActiveRecord
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
        return 'V_COUNTRY_FILTERED';
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

    public static function getCountries($study)
    {
        $cacheTime = Yii::app()->params['cacheTime'];
        $connection = Yii::app()->dbBiotracking;
        $sql = "SELECT COUNTRY_ID, COUNTRY FROM V_COUNTRY_FILTERED WHERE lower(study) = :study ORDER BY COUNTRY ASC";
        $command = $connection->cache($cacheTime)->createCommand($sql);
        $command->bindParam(":study", $study, PDO::PARAM_STR);

        return $command->queryAll();
    }
}