<?php

class VRoleBrEASTStudy extends CActiveRecord
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
		return 'V_ROLE_BREAST_STUDY';
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
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public static function getRoleStudyCompatible ($roleStudyID)
        {
            $cacheTime=60*60*24*360;
            $roles = array();
            $breastProfile= VRoleBrEASTStudy::model()->cache($cacheTime)->findByAttributes(array("ROLE_STUDY_ID"=>(int)$roleStudyID));
            $compatibleRoles= VRoleBrEASTStudy::model()->cache($cacheTime)->findAllByAttributes(array("BREAST_PROFILE_ID"=>(int)$breastProfile["BREAST_PROFILE_ID"]));
            if (count($compatibleRoles)>0)
            {
                foreach ($compatibleRoles as $role)
                    $roles[]= $role["ROLE_STUDY"];
            }
            else 
                throw new CHttpException("404","The role does not exist");
            
            return $roles;
        }

}