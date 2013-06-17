<?php

class Elearning extends CActiveRecord
{
    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
    
    public function tableName()
    {
        return 'BREAST_REGISTRATION.ELEARNING';
    }
    
    public function primaryKey() 
    {
        return "USER_ID";
    }
}