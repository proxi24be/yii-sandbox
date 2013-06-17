<?php

/**
 * This is the model class for table "PARCEL_DETAILS".
 *
 * The followings are the available columns in table 'PARCEL_DETAILS':
 * @property integer $ID
 * @property double $USER_CREATED
 * @property integer $PARCEL_STATUS_ID
 * @property date $DATE_CREATION
 * @property double $LOC_ID_FROM
 * @property integer $LOC_TYPE_ID_FROM
 * @property double $LOC_ID_TO
 * @property integer $LOC_TYPE_ID_TO
 */
class ParcelDetails extends MyShipmentActiveRecord
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
        return self::getShipmentDbConnection();
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'PARCEL_DETAILS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DATE_CREATION, PARCEL_STATUS_ID, LOC_ID_TO, LOC_TYPE_ID_TO, USER_CREATED, LOC_ID_FROM, LOC_TYPE_ID_FROM','required'),
			// array('USER_CREATED,  LOC_ID_FROM, LOC_TYPE_ID_FROM, LOC_ID_TO, LOC_TYPE_ID_TO', 'numerical'),
			 array('ID', 'safe'),
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
			'ID' => 'ID',
			'USER_CREATED' => 'User Created',
			'PARCEL_STATUS_ID' => 'Parcel Status',
			'DATE_CREATION' => 'Date Creation',
			'LOC_ID_FROM' => 'Loc Id From',
			'LOC_TYPE_ID_FROM' => 'Loc Type Id From',
			'LOC_ID_TO' => 'Loc Id To',
			'LOC_TYPE_ID_TO' => 'Loc Type Id To',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('USER_CREATED',$this->USER_CREATED);
		$criteria->compare('PARCEL_STATUS_ID',$this->PARCEL_STATUS_ID);
		$criteria->compare('DATE_CREATION',$this->DATE_CREATION);
		$criteria->compare('LOC_ID_FROM',$this->LOC_ID_FROM);
		$criteria->compare('LOC_TYPE_ID_FROM',$this->LOC_TYPE_ID_FROM);
		$criteria->compare('LOC_ID_TO',$this->LOC_ID_TO);
		$criteria->compare('LOC_TYPE_ID_TO',$this->LOC_TYPE_ID_TO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}