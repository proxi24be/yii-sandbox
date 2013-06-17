<?php

/**
 * This is the model class for table "PARCEL_SAMPLES".
 *
 * The followings are the available columns in table 'PARCEL_SAMPLES':
 * @property double $PARCEL_ID
 * @property double $SAMPLE_ID
 * @property string $REQUEST_DATE
 * @property string $SAMPLE_AVAILABILITY
 * @property string $DATE_AVAILABILITY
 * @property double $USER_CONFIRM
 */
class ParcelSamples extends MyShipmentActiveRecord
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
        return self::getShipmentDbConnection();
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'PARCEL_SAMPLES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PARCEL_ID, SAMPLE_ID, REQUEST_DATE', 'required'),
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
			'PARCEL_ID' => 'Parcel',
			'SAMPLE_ID' => 'Sample',
			'REQUEST_DATE' => 'Request Date',
			'SAMPLE_AVAILABILITY' => 'Sample Availability',
			'DATE_AVAILABILITY' => 'Date Availability',
			'USER_CONFIRM' => 'User Confirm',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('PARCEL_ID',$this->PARCEL_ID);
		$criteria->compare('SAMPLE_ID',$this->SAMPLE_ID);
		$criteria->compare('REQUEST_DATE',$this->REQUEST_DATE,true);
		$criteria->compare('SAMPLE_AVAILABILITY',$this->SAMPLE_AVAILABILITY,true);
		$criteria->compare('DATE_AVAILABILITY',$this->DATE_AVAILABILITY,true);
		$criteria->compare('USER_CONFIRM',$this->USER_CONFIRM);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}