<?php
/**
 * Created by JetBrains PhpStorm.
 * User: trann
 * Date: 14/01/13
 * Time: 16:21
 * To change this template use File | Settings | File Templates.
 */

class MaterialNotes extends MyBiotrackingActiveRecord
{

    public $MATERIAL_ID;
    public $MATERIAL_NOTE;
    public $DATE_CREATED;
    public $USER_ID;

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
        return 'MATERIAL_NOTES';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array("MATERIAL_ID, MATERIAL_NOTE, USER_ID","required")
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