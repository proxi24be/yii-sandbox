<?php

class MyLabDev2ActiveRecord extends CActiveRecord {
    private static $dbLabDev2 = null;
 
    protected static function getLabDev2DbConnection()
    {
        if (self::$dbLabDev2 !== null)
            return self::$dbLabDev2;
        else
        {
            self::$dbLabDev2 = Yii::app()->dbLabDev2;
            if (self::$dbLabDev2 instanceof CDbConnection)
            {
                self::$dbLabDev2->setActive(true);
                return self::$dbLabDev2;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
            }
    }
} 

?>

