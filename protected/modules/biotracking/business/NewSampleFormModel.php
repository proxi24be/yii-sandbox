<?php
/**
 * User: TRANN
 * Date: 3/26/13
 * Time: 11:13 PM
 */

namespace application\modules\biotracking\business;

use CFormModel, Patients, KitNumber, MyException;


/**
 * Class NewSampleFormModel
 * @package application\modules\biotracking\business
 *
 * The convention is database column name in UPPERCASE
 */
class NewSampleFormModel  extends CFormModel {

    public $PATIENT_ID, $STUDY_ID, $VISIT_NAME, $KIT_NUMBER_ID, $BIRTHDATE;
    public $ddmmmyyyy;
    public $studyName;
    public $userID;

    public function rules()
    {
        return array(
            // Verified on all scenarios.
            array('PATIENT_ID, STUDY_ID, VISIT_NAME, BIRTHDATE, studyName, userID', 'required'),
            // Verified only on aphinity scenario.
            array('KIT_NUMBER_ID', 'checkIfNotScreening', 'on' => 'aphinity'),
            // Make the attribute safe with mass assignation
            array('ddmmmyyyy', 'safe'),
        );
    }

    public function checkIfNotScreening($attribute)
    {
        if ('screening' !== strtolower(trim($this->VISIT_NAME)) && empty($this->$attribute))
            $this->addError($attribute, 'The property is empty !!!');
    }

    /**
     * Following the business rule define by the study.
     * That function will execute some database operation.
     *
     * It is highly recommanded to execute a validation in prior.
     */
    public function executeBusiness()
    {
        if ('null' === $this->BIRTHDATE || empty($this->BIRTHDATE))
        {
            if (!empty($this->ddmmmyyyy))
                Patients::saveBirthdate($this->PATIENT_ID, $this->ddmmmyyyy);
        }

        if ('aphinity' === strtolower($this->studyName))
        {
            if ('screening' !== $this->VISIT_NAME && !empty($this->KIT_NUMBER_ID))
            {
                $kitNumber = KitNumber::model()->find('PROPERTY_VALUE = :patientID', array(":patientID" => $this->PATIENT_ID));
                if (null == $kitNumber)
                    KitNumber::saveKitNumber($this->userID, $this->PATIENT_ID, $this->KIT_NUMBER_ID);
            }
        }
    }

}