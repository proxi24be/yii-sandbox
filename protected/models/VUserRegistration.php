<?php

/**
 * This is the model class for table "V_USER_REGISTRATION".
 *
 * The followings are the available columns in table 'V_USER_REGISTRATION':
 * @property double $USER_ID
 * @property string $FIRSTNAME
 * @property string $LASTNAME
 * @property string $EMAIL_ADDRESS
 * @property string $USERNAME
 * @property double $ROLE_BREAST_ID
 * @property string $ROLE_BREAST
 * @property double $ROLE_STUDY_ID
 * @property string $ROLE_NAME_STUDY
 * @property string $PASSWORD
 */
class VUserRegistration extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VUserRegistration the static model class
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
		return 'V_USER_REGISTRATION';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USERNAME, PASSWORD', 'required'),
			// array('USER_ID, ROLE_BREAST_ID, ROLE_STUDY_ID', 'numerical'),
			// array('FIRSTNAME, USERNAME, ROLE_NAME_STUDY', 'length', 'max'=>50),
			// array('LASTNAME', 'length', 'max'=>100),
			// array('EMAIL_ADDRESS, PASSWORD', 'length', 'max'=>255),
			// array('ROLE_BREAST', 'length', 'max'=>30),
			// // The following rule is used by search().
			// // Please remove those attributes that should not be searched.
			// array('USER_ID, FIRSTNAME, LASTNAME, EMAIL_ADDRESS, USERNAME, ROLE_BREAST_ID, ROLE_BREAST, ROLE_STUDY_ID, ROLE_NAME_STUDY, PASSWORD', 'safe', 'on'=>'search'),
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
			'USER_ID' => 'UserID',
			'FIRSTNAME' => 'Firstname',
			'LASTNAME' => 'Lastname',
			'EMAIL_ADDRESS' => 'Email Address',
			'USERNAME' => 'Username',
			'ROLE_BREAST_ID' => 'Role Breast',
			'ROLE_BREAST' => 'Role Breast',
			'ROLE_STUDY_ID' => 'Role Study',
			'ROLE_NAME_STUDY' => 'Role Name Study',
			'PASSWORD' => 'Password',
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

		$criteria->compare('USER_ID',$this->USER_ID);
		$criteria->compare('FIRSTNAME',$this->FIRSTNAME,true);
		$criteria->compare('LASTNAME',$this->LASTNAME,true);
		$criteria->compare('EMAIL_ADDRESS',$this->EMAIL_ADDRESS,true);
		$criteria->compare('USERNAME',$this->USERNAME,true);
		$criteria->compare('ROLE_BREAST_ID',$this->ROLE_BREAST_ID);
		$criteria->compare('ROLE_BREAST',$this->ROLE_BREAST,true);
		$criteria->compare('ROLE_STUDY_ID',$this->ROLE_STUDY_ID);
		$criteria->compare('ROLE_NAME_STUDY',$this->ROLE_NAME_STUDY,true);
		$criteria->compare('PASSWORD',$this->PASSWORD,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function primaryKey()
	{
    	return 'USER_ID';
	}
}