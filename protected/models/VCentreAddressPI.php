<?php

/**
 * This is the model class for table "V_CENTRE_ADDRESS_PI".
 *
 * The followings are the available columns in table 'V_CENTRE_ADDRESS_PI':
 * @property double $CENTRE_ID
 * @property double $STUDY_ID
 * @property string $STUDY
 * @property string $COUNTRY
 * @property string $COUNTRY_SHORT
 * @property string $CENTRE
 * @property string $CENTRE_STATUS
 * @property string $INSTITUTION
 * @property string $DEPARTMENT
 * @property string $ADDRESS
 * @property string $CITY
 * @property string $ZIP_CODE
 * @property string $ROLE_NAME
 * @property string $EMAIL
 * @property string $LASTNAME
 * @property string $FIRSTNAME
 * @property string $PHONE
 * @property string $FAX
 * @property double $COUNTRY_ID
 */
class VCentreAddressPI extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VCentreAddressPI the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'V_CENTRE_ADDRESS_PI';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CENTRE_ID, STUDY_ID, COUNTRY_ID', 'numerical'),
			array('STUDY, CENTRE', 'length', 'max'=>50),
			array('COUNTRY, CENTRE_STATUS, INSTITUTION, DEPARTMENT, ADDRESS, CITY, ZIP_CODE, ROLE_NAME, EMAIL, LASTNAME, FIRSTNAME, PHONE, FAX', 'length', 'max'=>255),
			array('COUNTRY_SHORT', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CENTRE_ID, STUDY_ID, STUDY, COUNTRY, COUNTRY_SHORT, CENTRE, CENTRE_STATUS, INSTITUTION, DEPARTMENT, ADDRESS, CITY, ZIP_CODE, ROLE_NAME, EMAIL, LASTNAME, FIRSTNAME, PHONE, FAX, COUNTRY_ID', 'safe', 'on'=>'search'),
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
            'MATERIAL_CENTRE'=>array(self::HAS_MANY, 'VMaterialsToShip', 'CENTRE_ID'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CENTRE_ID' => 'Centre',
			'STUDY_ID' => 'Study',
			'STUDY' => 'Study',
			'COUNTRY' => 'Country',
			'COUNTRY_SHORT' => 'Country Short',
			'CENTRE' => 'Centre',
			'CENTRE_STATUS' => 'Centre Status',
			'INSTITUTION' => 'Institution',
			'DEPARTMENT' => 'Department',
			'ADDRESS' => 'Address',
			'CITY' => 'City',
			'ZIP_CODE' => 'Zip Code',
			'ROLE_NAME' => 'Role Name',
			'EMAIL' => 'Email',
			'LASTNAME' => 'Lastname',
			'FIRSTNAME' => 'Firstname',
			'PHONE' => 'Phone',
			'FAX' => 'Fax',
			'COUNTRY_ID' => 'Country',
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

		$criteria->compare('CENTRE_ID',$this->CENTRE_ID);
		$criteria->compare('STUDY_ID',$this->STUDY_ID);
		$criteria->compare('STUDY',$this->STUDY,true);
		$criteria->compare('COUNTRY',$this->COUNTRY,true);
		$criteria->compare('COUNTRY_SHORT',$this->COUNTRY_SHORT,true);
		$criteria->compare('CENTRE',$this->CENTRE,true);
		$criteria->compare('CENTRE_STATUS',$this->CENTRE_STATUS,true);
		$criteria->compare('INSTITUTION',$this->INSTITUTION,true);
		$criteria->compare('DEPARTMENT',$this->DEPARTMENT,true);
		$criteria->compare('ADDRESS',$this->ADDRESS,true);
		$criteria->compare('CITY',$this->CITY,true);
		$criteria->compare('ZIP_CODE',$this->ZIP_CODE,true);
		$criteria->compare('ROLE_NAME',$this->ROLE_NAME,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('LASTNAME',$this->LASTNAME,true);
		$criteria->compare('FIRSTNAME',$this->FIRSTNAME,true);
		$criteria->compare('PHONE',$this->PHONE,true);
		$criteria->compare('FAX',$this->FAX,true);
		$criteria->compare('COUNTRY_ID',$this->COUNTRY_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}