<?php

class VUserGroupPatient extends CActiveRecord
{
    
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'BREAST_REGISTRATION.V_USER_GROUP_PATIENT_SCREEN';
    }
    
    
}


?>
