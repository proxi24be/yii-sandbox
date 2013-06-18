<?php
/**
 * User: TRANN
 * Date: 6/18/13
 * Time: 12:20 PM
 */

Yii::import('application.models.*');
require_once('AdminActiveRecord.php');

class AdmForm extends AdminActiveRecord {

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
        return 'ADM_FORM';
    }

    public function rules ()
    {
        return array(
            array('SHORT_DESCRIPTION', 'required'),
        );
    }

    public function relations()
    {
        return array(
            'studies' => array(SELF::MANY_MANY, 'AdmStudy', 'ADM_STUDY_FORM(FORM_ID, STUDY_ID)'),
        );
    }
}