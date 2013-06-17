<?php

class VRoleRdcBrEAST extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
    
    public function tableName()
    {
        return 'BREAST_REGISTRATION.V_ROLE_RDC_BREAST';
    }
    
}
?>
