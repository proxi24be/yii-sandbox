<?php
/**
 * User: TRANN
 * Date: 6/19/13
 * Time: 3:51 PM
 */

Yii::import('application.models.*');
require_once('AdminActiveRecord.php');

class AdmStudyForm extends AdminActiveRecord {


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
        return 'ADM_STUDY_FORM';
    }

    public function rules ()
    {
        return array(
            array('STUDY_ID, FORM_ID', 'required'),
        );
    }

}