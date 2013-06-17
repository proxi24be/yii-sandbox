<?php
/**
 * User: TRANN
 * Date: 6/7/13
 * Time: 3:20 PM
 */

class AdminActiveRecord extends CActiveRecord {

    private static $dbBiotracking = null;

    public function behaviors()
    {
        // Unfortunately the attribute field is case sensitive.
        // See Yii framework doc for more details.
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'timestampExpression' => 'time()',
                'createAttribute' => 'CREATE_TIME',
                'updateAttribute' => 'UPDATE_TIME',
                'setUpdateOnCreate' => true,
            )
        );
    }

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