<?php
/**
 * User: TRANN
 * Date: 6/18/13
 * Time: 12:20 PM
 */

Yii::import('application.models.*');
require_once('AdminActiveRecord.php');

class AdmForm extends AdminActiveRecord {


    public $SHORT_DESCRIPTION, $STUDY_ID;

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
            array('STUDY_ID', 'safe'),
        );
    }

    public function relations()
    {
        return array(
            'studies' => array(self::MANY_MANY, 'AdmStudy', 'ADM_STUDY_FORM(FORM_ID, STUDY_ID)'),
        );
    }

    public function behaviors()
    {
        $newBehavior = array(
            'RelationBehavior' => array(
                'class' => 'ext.behaviors.RelationBehavior',
                'model' => 'AdmStudyForm',
                'attributes' => array('FORM_ID' => 'ID', 'STUDY_ID' => 'STUDY_ID')
            )
        );
        return CMap::mergeArray(parent::behaviors(), $newBehavior);
    }
}