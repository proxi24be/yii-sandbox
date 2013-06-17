<?php

class Patients extends MyBiotrackingActiveRecord
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
		return 'PATIENTS';
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

    public static function saveBirthdate($patientID, $birthDateDDMMMYYYY)
    {
        if (empty($birthDateDDMMMYYYY))
            throw new MyException ("birthDateDDMMMYYYY cannot be empty !");

        $patient = Patients::model()->find("PATIENT_ID = :PATIENTID", array(":PATIENTID" => (int)$patientID));

        if (null == $patient)
            throw new MyException ("patientID not found");

        if (!method_exists("DateTime", "createFromFormat"))
            throw new MyException ("Php issue DateTime::createFromFormat method does not exist");

        $birthdate = DateTime::createFromFormat('d/M/Y', $birthDateDDMMMYYYY);

        if (null == $birthdate)
            throw new MyException ("error to convert string date $birthDateDDMMMYYYY to an object date");

        $patient->BIRTHDATE = $birthdate->format('d-m-Y');

        if (!$patient->save())
            throw new MyException ("Impossible to update the birthdate of patientID : $patientID");
    }

}