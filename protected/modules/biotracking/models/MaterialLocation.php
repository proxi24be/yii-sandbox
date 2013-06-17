<?php

/**
 * This is the model class for table "PARCEL_DETAILS".
 *
 * The followings are the available columns in table 'PARCEL_DETAILS':
 * @property integer $MATERIAL_ID
 * @property integer $LOCATION_ID
 * @property date $TIMESTAMP
 * @property integer $LOC_TYPE_ID
 */
class MaterialLocation extends MyBiotrackingActiveRecord
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
		return 'MATERIAL_LOCATION';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MATERIAL_ID, LOCATION_ID, LOC_TYPE_ID','required'),
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
                'createAttribute' => 'TIMESTAMP',
                'updateAttribute' => null,
                'timestampExpression' => "date('Y-m-d H:i:s')",
            )
        );
    }

}