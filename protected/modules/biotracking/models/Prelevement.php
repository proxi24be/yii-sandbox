<?php

class Prelevement extends MyBiotrackingActiveRecord
{
    public $VISIT_ID;
    public $PATIENT_ID;
    public $COLLECTION_DATE;
    public $STUDY_ID;
    public $USER_ENTERED;
    public $DATE_CREATED;

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
        return 'PRELEVEMENT';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array("VISIT_ID, PATIENT_ID, COLLECTION_DATE, STUDY_ID, USER_ENTERED","required")
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

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'DATE_CREATED',
                'updateAttribute' => null,
                'timestampExpression' => "date('Y-m-d H:i:s')",
            )
        );
    }
}