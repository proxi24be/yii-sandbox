<?php

/**
 * This is the model class for table "PARCEL_SAMPLES".
 */
class ParcelSamples extends MyLabDev2ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ParceLSamples the static model class
	 */
	public static function model($className=__CLASS__)
	{
            return parent::model($className);
	}

	public function getDbConnection()
        {
            return self::getLabDev2DbConnection();
        }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
            return 'USER_PRIVILEGE_TEST';
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		
	}
}
