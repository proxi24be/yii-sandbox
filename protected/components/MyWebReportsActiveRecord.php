<?php

class MyWebReportsActiveRecord extends CActiveRecord {
    private static $dbWebReports = null;
 
    protected static function getWebReportDbConnection()
    {
        if (self::$dbWebReports !== null)
            return self::$dbWebReports;
        else
        {
            self::$dbWebReports = Yii::app()->dbWebReports;
            if (self::$dbWebReports instanceof CDbConnection)
            {
                self::$dbWebReports->setActive(true);
                return self::$dbWebReports;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
            }
    }
} 

?>

