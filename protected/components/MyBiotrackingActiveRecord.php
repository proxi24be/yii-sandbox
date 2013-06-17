<?php

class MyBiotrackingActiveRecord extends CActiveRecord {
    private static $dbBiotracking = null;
 
    protected static function getBiotrackingDbConnection()
    {
        if (self::$dbBiotracking !== null)
            return self::$dbBiotracking;
        else
        {
            self::$dbBiotracking = Yii::app()->dbBiotracking;
            if (self::$dbBiotracking instanceof CDbConnection)
            {
                self::$dbBiotracking->setActive(true);
                return self::$dbBiotracking;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
            }
    }
} 
