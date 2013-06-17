<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluenight
 * Date: 20/01/13
 * Time: 18:04
 */

class MySqliteActiveRecord extends CActiveRecord {
    private static $dbSqlite = null;

    protected static function getSqliteDbConnection()
    {
        if (self::$dbSqlite !== null)
            return self::$dbSqlite;
        else
        {
            self::$dbSqlite = Yii::app()->dbSqlite;
            if (self::$dbSqlite instanceof CDbConnection)
            {
                self::$dbSqlite->setActive(true);
                return self::$dbSqlite;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
        }
    }
}

?>

