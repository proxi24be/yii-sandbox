<?php
/**
 * User: TRANN
 * Date: 6/10/13
 * Time: 1:14 PM
 */

Yii::import('application.models.*');
require_once('AdminActiveRecord.php');

class AdmProperty extends AdminActiveRecord {

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getDbConnection()
    {
        return self::getBiotrackingDbConnection();
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ADM_PROPERTY';
    }

    public function rules ()
    {
        return array(
            array('DESCRIPTION', 'required'),
        );
    }

}