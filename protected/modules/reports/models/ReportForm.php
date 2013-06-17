<?php

class ReportForm extends CFormModel
{
	public $REPORT_ID;
        public $STUDY_ID;
        public $GROUP_ID;
        public $REGION_ID;
        public $RANDO_SITE_ID;
        public $PATIENT_POSITION_ID;
        public $MONITORING_GROUP_ID;
        public $PAYMENT_GROUP_ID;
        public $SCREENING_PATIENT_ID;
        public $CURRENT_SITE_ID;
        public $NETWORK_ID;
        public $QUEUE_ID;
        public $FORMAT;
        public $EXEC_FILE;
        public $FILENAME;
        public $DEST_PATH;
        
        public $KEY1=array(1,2,3,4,5,6,7,8,9,10);
//        par convention le screening_patient_id == patient number
        public $KEY2=array("STUDY_ID","GROUP_ID","REGION_ID","RANDO_SITE_ID","PATIENT_POSITION_ID","MONITORING_GROUP_ID",
            "PAYMENT_GROUP_ID","SCREENING_PATIENT_ID","CURRENT_SITE_ID","NETWORK_ID");

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
            return array(
                    array("REPORT_ID,FORMAT","required"),
                    array("STUDY_ID, GROUP_ID, REGION_ID, RANDO_SITE_ID,PATIENT_POSITION_ID,MONITORING_GROUP_ID,PAYMENT_GROUP_ID,
                        SCREENING_PATIENT_ID,CURRENT_SITE_ID,NETWORK_ID,REPORT_ID, QUEUE_ID, FORMAT, EXEC_FILE, FILENAME, DEST_PATH","safe"),
            );
	}
        
        public function attributeLabels()
	{
            return array(
                'REPORT_ID' => 'Select a report',
                'GROUP_ID' => 'Select a group',
                'REGION_ID' => 'Select a country',
                'RANDO_SITE_ID' => 'Select a site',
                'PATIENT_POSITION_ID' => 'Select a patient',
                'SCREENING_PATIENT_ID' => 'Select a patient',
                'CURRENT_SITE_ID' => 'Select a site',
                'FORMAT' => 'Format output',
            );
	}
        
        public function getDoubleKeyParams()
        {
            return new DoubleKey($this->KEY1,$this->KEY2);
        }

}
