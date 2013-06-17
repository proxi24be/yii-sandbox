<?php

class VMaterialsRequested extends MyShipmentActiveRecord {
    
        
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Addresses the static model class
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
        return 'V_MATERIALS_REQUESTED';
    }

}


?>