<?php

class MyShipmentActiveRecord extends CActiveRecord {
    private static $dbShipment = null;
 
    protected static function getShipmentDbConnection()
    {
        if (self::$dbShipment !== null)
            return self::$dbShipment;
        else
        {
            self::$dbShipment = Yii::app()->dbShipment;
            if (self::$dbShipment instanceof CDbConnection)
            {
                self::$dbShipment->setActive(true);
                return self::$dbShipment;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
            }
    }
} 

?>

